<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->longText('description');
            $table->string('course_img')->nullable();
            $table->unsignedInteger('price');
            $table->tinyInteger('status');
            $table->date('create_date');
            $table->date('expire_date');
            $table->unsignedInteger('hours_left');
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');

            $table->primary('id');
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
}
