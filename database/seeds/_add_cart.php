<?php

use Illuminate\Database\Seeder;

class _add_cart extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('_add_cart')->insert([
            'id_product' => str_random(10),
            'id_cart' => 1,
            'quantity' => str_random(10)
        ]);
    }
}
