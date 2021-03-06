<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('course_id')->nullable();
            $table->enum('payment_method', ['online', 'offline']);
            $table->date('payment_date');
            $table->enum('payment_status', ['success', 'pending', 'refund']);
            $table->string('receipt_img')->nullable();
            $table->date('enroll_date')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
}
