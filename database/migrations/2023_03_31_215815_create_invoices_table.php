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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('invoice_number', 50);
            $table->string('invoice_date');
            $table->string('due_date');
            $table->foreignId('product_id')->constrained();
            $table->string('currency');
            $table->string('quantity');
            $table->string('unit_price');
            $table->string('amount_commission');
            $table->float('discount')->default(0);
            $table->foreignId('tax_id')->constrained();
            $table->string('value_vat');
            $table->string('amount');
            $table->string('status', 50);
            $table->integer('value_status');
            $table->string('created_by');
            $table->softDeletes();
            $table->timestamps();
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
};
