<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePollCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        DB::table('poll_categories')->insert([
            ['name' => 'Random'],
            ['name' => 'Entertainment'],
            ['name' => 'Food'],
            ['name' => 'Life Experiences'],
            ['name' => 'Politics'],
            ['name' => 'Relationships'],
            ['name' => 'Religion'],
            ['name' => 'Science & Tech'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll_categories');
    }
}
