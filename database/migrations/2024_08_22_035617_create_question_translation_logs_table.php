<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionTranslationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_translation_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questiontranslation_id');
            $table->text('original_content');
            $table->text('updated_content');
            $table->timestamps();

            // Define foreign key constraint (optional, depending on your use case)
            $table->foreign('questiontranslation_id')
                  ->references('id')
                  ->on('question_translations')
                  ->onDelete('cascade'); // Cascade delete if the original question translation is deleted
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_translation_logs');
    }
}

