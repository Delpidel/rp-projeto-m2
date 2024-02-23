<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 255);
            $table->string('fantasy_name', 255);
            $table->string('cnpj', 14)->unique();
            $table->string('email', 255)->unique();
            $table->string('contact', 20);
            $table->string('city', 50);
            $table->string('neighborhood', 50);
            $table->string('number', 30);
            $table->string('street', 30);
            $table->string('state', 2);
            $table->string('cep', 20);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
