<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->index('user_id');
            $table->string('name');
            $table->string('street');
            $table->string('city');
            $table->string('zip');
            $table->string('country');
            $table->string('url')->nullable();
            $table->string('phone')->nullable();
            $table->string('mail');
            $table->integer('invoice_counter')->nullable();
            $table->float('rate_per_hour_default')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('iban')->nullable();
            $table->string('bic')->nullable();
            $table->string('bank')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
