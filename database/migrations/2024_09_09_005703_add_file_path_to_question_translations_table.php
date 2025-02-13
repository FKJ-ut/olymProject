<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('question_translations', function (Blueprint $table) {
            // Add the file_path column after the content column
            $table->string('file_path')->nullable()->after('content');
        });
    }

    public function down()
    {
        Schema::table('question_translations', function (Blueprint $table) {
            // Remove the file_path column
            $table->dropColumn('file_path');
        });
    }

};
