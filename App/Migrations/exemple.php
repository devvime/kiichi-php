<?php

namespace App\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class Exemple 
{

    public function up()
    {
        Capsule::schema()->create('exemploTable', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->enum('sex', ['M', 'F'])->nullable();
            $table->date('birth_date')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Capsule::schema()->drop('exemploTable');
    }

}