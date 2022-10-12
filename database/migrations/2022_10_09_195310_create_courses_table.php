<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->set('category', ['Web Developmen', 'Marketing', 'Content'])->nullable();
            $table->decimal('price', $precision = 12, $scale = 2)->nullable();
            $table->string('image')->default('course.png');
            $table->string('path')->nullable;
            $table->foreignId('mentor');
            $table->foreign('mentor')->references('id')->on('users');          
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
        Schema::dropIfExists('courses');
    }
};
