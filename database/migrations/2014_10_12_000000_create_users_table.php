<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->text('profile_photo_path')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->foreignId('gender_id')->nullable()->constrained()->onDelete('set null')->onUpdate('set null');
            $table->foreignId('country_id')->nullable()->constrained()->onDelete('set null')->onUpdate('set null');
            $table->foreignId('state_id')->nullable()->constrained()->onDelete('set null')->onUpdate('set null');
            $table->softDeletes();
            $table->timestamp('last_online_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
