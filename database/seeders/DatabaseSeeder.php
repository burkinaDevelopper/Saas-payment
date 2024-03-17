<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Database\Factories\ProductFactory;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Product::factory(2)->sequence(
            [
             'name' => 'Offre basique',
             'stripe_product_id'=>'price_1Oo9ADKbPoHE7grJB1Safcbu',
             'price'=>9.99,
           ],
            [
                'name' => 'Offre premium',
                'stripe_product_id'=>'price_1Oo9BEKbPoHE7grJRRlrsxcj',
                'price'=>19.99,
            ],
        )
        ->create();
    }
}
