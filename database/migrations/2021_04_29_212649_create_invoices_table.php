<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->index('user_id');
            // CUSTOMER INFORMATIONS
            $table->unsignedBigInteger('customer_id');
            $table->index('customer_id');
            
            $table->string('customer_name');
            $table->string('customer_alias')->nullable();
            $table->string('customer_street');
            $table->string('customer_zip');
            $table->string('customer_city');
            $table->string('customer_mail')->nullable();
            $table->string('customer_website')->nullable();

            
            // OWN INFORMATIONS
            $table->string('name');
            $table->string('street');
            $table->string('zip');
            $table->string('city');
            $table->string('mail');
            $table->string('url')->nullable();
            $table->string('phone')->nullable();
            $table->string('iban');
            $table->string('bank');
            $table->string('bic');
            $table->string('tax_id')->nullable();

            
            // INVOICE INFORMATIONS
            $table->integer('invoice_number');
            $table->string('invoice_description');
            $table->string('invoice_date');
            $table->text('invoice_additional')->nullable();
            $table->boolean('invoice_partial_pay')->default(false);
            $table->float('invoice_partial_pay_sum')->nullable();
            $table->date('invoice_partial_pay_date')->nullable();
            $table->date('invoice_pay_date');
            $table->string('invoice_state');

            //POSITIONS
            $table->text('all_positions');
            $table->float('netto_total');
            $table->text('mwst_total');
            $table->float('brutto_total');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
