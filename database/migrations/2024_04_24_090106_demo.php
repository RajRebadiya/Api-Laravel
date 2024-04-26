<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class demo extends Migration
{
    public function up()
    {
        Schema::create('demo', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing primary key column
            $table->string('fname');
            $table->text('lname');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('demo');
    }
}
