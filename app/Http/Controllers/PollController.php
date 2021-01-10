<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PollController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Poll::class, 'poll');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = Poll::latest()->paginate(10);

        return view('polls.index', ['polls' => $polls]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PollCategory::all()->sortBy('id');

        return view('polls.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the poll.
        $poll = $this->validatePoll();

        // Validate the options.
        $options = $this->validateOptions();

        // Attach the poll to the authenticated user.
        $poll['user_id'] = Auth::id();

        // Handle poll image.
        if (Arr::has($poll, 'image')) {
            $poll = $this->handleImage($poll);
        }

        // Create the poll.
        $poll = Poll::create($poll);

        // Strip out the empty options.
        $options = Arr::collapse($options);
        $options = Arr::where($options, function ($option) {
            return $option['name'] !== null;
        });

        // Attach each option to the newly created poll.
        $pollId = $poll->id;
        for ($i = 0; $i < count($options); $i++) {
            Arr::set($options[$i], 'poll_id', $pollId);
        }

        // Create the options.
        $poll->options()->createMany($options);

        // Redirect.
        return redirect(route('polls.show', $poll));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        return view('polls.show', ['poll' => $poll]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        $options = $poll->options;
        $categories = PollCategory::all()->sortBy('id');

        return view('polls.edit', ['poll' => $poll, 'options' => $options, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        // Validate the poll.
        $updatedPoll = $this->validatePoll();

        // Validate the options.
        $updatedOptions = $this->validateOptions();

        // Handle poll image.
        if (Arr::has($updatedPoll, 'image')) {
            $updatedPoll = $this->handleImage($updatedPoll);
        }

        // Update the poll.
        $poll->update($updatedPoll);

        // Update the options.
        foreach ($poll->options as $index => $option) {
            $option->update($updatedOptions['options'][$index]);
        }

        // Redirect.
        return redirect(route('polls.show', $poll));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        Storage::disk('public')->delete($poll['image']);

        $poll->delete();

        return redirect(route('polls.index'));
    }

    protected function validatePoll()
    {
        return request()->validate([
            'title' => 'required|string|min:5|max:80',
            'category_id' => 'required|integer|exists:poll_categories,id',
            'image' => 'nullable|image|max:1024',
        ]);
    }

    protected function validateOptions()
    {
        return request()->validate([
            'options.0.name' => 'required|string|max:80',
            'options.1.name' => 'required|string|max:80',
            'options.2.name' => 'nullable|string|max:80',
            'options.3.name' => 'nullable|string|max:80',
            'options.4.name' => 'nullable|string|max:80',
        ]);
    }

    protected function handleImage($poll)
    {
        // Get the name of the image path.
        $image = $poll['image'];
        $extension = $image->extension();
        $path = 'polls/' . Str::uuid() . '.' . $extension;
        $storagePath = storage_path('app/public/' . $path);

        // Crop and resize the image, then save it.
        $croppedImage = Image::make($image);
        $croppedImage = $croppedImage->fit(200);
        $croppedImage->save($storagePath);

        // Set the image path on the poll.
        $poll['image'] = $path;

        return $poll;
    }
}
