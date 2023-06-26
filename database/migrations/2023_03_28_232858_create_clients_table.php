<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade');

            $table->unsignedInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')
                ->onDelete('cascade');

            $table->unsignedInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade');

            $table->string('email');
            $table->string('phone');
            $table->string('password');
            $table->string('postal_code');
            $table->string('address');
            $table->string('photo');
            $table->timestamps();

            // $table->foreignId('country_id')->constrained()->onDelete('cascade');
            // $table->foreignId('state_id')->constrained()->onDelete('cascade');
            // $table->foreignId('city_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
