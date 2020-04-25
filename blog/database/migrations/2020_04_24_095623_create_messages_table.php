<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('theme')->nullable();
            $table->text('message')->nullable();
            $table->bigInteger('file_id')->unsigned()->nullable();
            $table->boolean('read')->default(0);
            $table->boolean('response')->default(0);
            $table->boolean('user_canceled')->default(0);
            $table->boolean('manager_canceled')->default(0);
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
        Schema::dropIfExists('messages');
    }
}
