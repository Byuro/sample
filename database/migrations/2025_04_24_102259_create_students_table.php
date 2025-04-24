<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_students_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            // Custom ID field
            $table->string('StudID')->primary();  // Custom ID as String
            $table->string('lastname');
            $table->string('firstname');
            $table->string('sex');
            $table->integer('age');
            $table->text('address');
            $table->string('contact_no');
            $table->string('course');
            $table->string('year');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}

