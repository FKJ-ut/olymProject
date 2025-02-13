<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsLogsTable extends Migration
{
    public function up()
    {
        Schema::create('question_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('operation'); // Change enum to string
            $table->text('original_content');
            $table->text('updated_content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_logs');
    }
}
