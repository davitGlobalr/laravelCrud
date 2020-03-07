<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('section_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id');

            $table->foreign('user_id', 'user_id_fk_355234')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('section_id');

            $table->foreign('section_id', 'section_id_fk_355234')->references('id')->on('sections')->onDelete('cascade');
        });
    }
}
