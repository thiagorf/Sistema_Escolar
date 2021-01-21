<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('curso_score', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('curso_id')->references('id')->on('cursos')->onDelete('cascade');
        //     $table->foreignId('score_id')->references('id')->on('scores')->onDelete('cascade');
        //     $table->timestamps();
        // });
        Schema::create('course_score', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreignId('score_id')->references('id')->on('scores')->onDelete('cascade');
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
        Schema::dropIfExists('curso_score');
        //Schema::dropIfExists('course_score');
    }
}
