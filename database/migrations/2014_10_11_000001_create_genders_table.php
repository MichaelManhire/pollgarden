<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abbreviation');
        });

        DB::table('genders')->insert([
            [
                'name' => 'Male',
                'abbreviation' => 'M',
            ],
            [
                'name' => 'Female',
                'abbreviation' => 'F',
            ],
            [
                'name' => 'Non-binary',
                'abbreviation' => 'NB',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genders');
    }
}
