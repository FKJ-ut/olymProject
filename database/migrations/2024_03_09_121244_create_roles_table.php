<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('team')->nullable(); // Add new nullable string column
            $table->timestamps();
        });

        // Insert initial roles
        DB::table('roles')->insert([
            ['name' => 'Host'],
            ['name' => 'Admin'],
            ['name' => 'Leader'],
            ['name' => 'Examiner'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
