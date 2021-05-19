<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->index('user_id');
            $table->string('name');
            $table->string('alias_name')->nullable();
            $table->string('street');
            $table->string('city');
            $table->string('zip');
            $table->string('country');
            $table->string('mail');
            $table->string('website')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('rate_per_hour')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
