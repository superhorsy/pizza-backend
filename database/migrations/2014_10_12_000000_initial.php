<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Initial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('google_id')->unique();
                $table->string('name');
                $table->rememberToken();
                $table->timestamps();
            }
        );

        Schema::create(
            'orders',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('user_id')->unsigned()->nullable()->index();
                $table->json('order_list');
                $table->double('total');
                $table->string('name');
                $table->string('phone');
                $table->string('address');
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on(
                    'users'
                );
            }
        );

        Schema::create(
            'pizzas',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->text('description');
                $table->double('price_usd');
            }
        );

        DB::table('pizzas')->insert(
            [
                [
                    'name'        => 'All Dressed Pizza',
                    'description' => 'Pepperoni, Salami, Mushrooms, Green Peppers, Onions, Bacon, Hamburger',
                    'price_usd'       => 10.45
                ],
                [
                    'name'        => 'Hawaiian Pizza',
                    'description' => 'Ham, Pineapple, Mozzarella Cheese',
                    'price_usd'       => 11.45
                ],
                [
                    'name'        => 'Philly Cheese Steak Pizza',
                    'description' => 'Zesty Sauce, Sliced Steak, Red Onions, Tomatoes, Green Peppers, Mushrooms, topped with Mozza and Cheddar Cheese',
                    'price_usd'       => 12.45
                ],
                [
                    'name'        => 'Cheeseburger Pizza',
                    'description' => 'Hamburger, Cheddar and Mozzarella Cheese, your choice of 4 vegetables',
                    'price_usd'       => 12.45
                ],
                [
                    'name'        => 'Meat Lovers Pizza',
                    'description' => 'Pepperoni, Salami, Bacon, Hamburger, Ham, Donair Meat, Italian Sausage',
                    'price_usd'       => 14.15
                ],
                [
                    'name'        => 'Donair Pizza',
                    'description' => 'Tomatoes, Red Onions, Black Olives, Feta & Mozzarella Cheese, topped with Oregano and Olive Oil',
                    'price_usd'       => 13.65
                ],
                [
                    'name'        => 'Canadian Classic Pizza',
                    'description' => 'Pepperoni, Mushrooms, Bacon, Mozza Cheese & a Garlic-Based Crust',
                    'price_usd'       => 10.95
                ],
                [
                    'name'        => 'Vegetarian Pizza',
                    'description' => 'Mushrooms, Green Peppers, Onions, Tomatoes, Hot Peppers, Olives, Pineapple',
                    'price_usd'       => 9.95
                ],
                [
                    'name'        => 'Cheese Lovers Pizza',
                    'description' => 'Feta, Cheddar, Mozzarella & Parmesan Cheeses',
                    'price_usd'       => 19.95
                ],
                [
                    'name'        => 'BBQ Chicken Pizza',
                    'description' => 'Savoury Chicken, Zesty Sauce Bland, Tomatoes, Green Peppers, Red Onions, Mushrooms, Mozza and Cheddar Cheese',
                    'price_usd'       => 14.75
                ],
                [
                    'name'        => 'Bubba Pizza',
                    'description' => 'Garlic Spread, Donair Meat, Onions, Tomatoes, Donair Sauce',
                    'price_usd'       => 13.25
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('pizzas');
    }
}
