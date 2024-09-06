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
        Schema::create('checkout__details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("checkout_id")->references("id")->on("checkouts");
            $table->foreignId("product_id")->references("id")->on("products");
            $table->unsignedBigInteger("unite_price");
            $table->unsignedInteger("item_amount");
            $table->unsignedBigInteger("total_price");
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
        Schema::dropIfExists('checkout__details');
    }
};
