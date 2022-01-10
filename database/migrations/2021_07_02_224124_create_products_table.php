<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $this->seedProducts();
    }

    private function seedProducts()
    {
        $products = [
            'Automotive',
            'Baby',
            'Books',
            'Electronics',
            'Home',
            'Jewelry',
            'Music',
            'Software',
            'Watches',
        ];

        foreach ($products as $product) {
            Product::create(['name' => $product]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
