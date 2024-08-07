<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobscraperVacanciesTable extends Migration
{
    public function up()
    {
        Schema::create('jobscraper_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->string('company');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobscraper_vacancies');
    }
}
