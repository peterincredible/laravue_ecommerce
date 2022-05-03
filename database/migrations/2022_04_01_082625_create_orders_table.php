<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('quantity')->default(1);
            $table->integer('price')->default(1);
            $table->string('ref');
            $table->string('phone_no');
            $table->string('state');
            $table->string('local_govt');
            $table->string('town');
            $table->string('street');
            $table->date('date');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
