<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('sms_responses', function (Blueprint $table) {
            $table->id();
            $table->string('driver');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('bulk_code');
            $table->text('message');
            $table->integer('message_status')->nullable();
            $table->integer('delivery_status')->nullable();
            $table->json('response');
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
        Schema::dropIfExists('sms_responses');
    }
}
