<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::factory()->create([
            'name' => 'Admin TechZone',
            'email' => 'admin@techzone.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_ADMIN,
        ]);

        // Sellers
        $sellers = User::factory(5)->create([
            'role' => User::ROLE_SELLER,
        ]);

        // Customers
        $customers = User::factory(10)->create([
            'role' => User::ROLE_CUSTOMER,
        ]);

        // Categories
        $categories = [
            ['name' => 'Laptops', 'description' => 'Computadoras portátiles de última generación'],
            ['name' => 'Smartphones', 'description' => 'Teléfonos inteligentes y accesorios móviles'],
            ['name' => 'Tablets', 'description' => 'Tabletas y dispositivos portátiles'],
            ['name' => 'Audio', 'description' => 'Auriculares, parlantes y sistemas de sonido'],
            ['name' => 'Gaming', 'description' => 'Consolas, controles y accesorios gaming'],
            ['name' => 'Componentes', 'description' => 'Piezas y componentes para computadoras'],
        ];
        
        $categoryModels = collect($categories)->map(function ($cat) {
            return Category::create([
                'name' => $cat['name'],
                'slug' => str($cat['name'])->slug(),
                'description' => $cat['description'],
                'image' => 'https://picsum.photos/400/300?random=' . rand(1, 100),
            ]);
        });

        // Products for each seller
        foreach ($sellers as $seller) {
            foreach ($categoryModels->random(3) as $category) {
                Product::factory(3)->create([
                    'seller_id' => $seller->id,
                    'category_id' => $category->id,
                ])->each(function ($product) use ($customers) {
                    // Images
                    ProductImage::factory()->create([
                        'product_id' => $product->id,
                        'is_primary' => true,
                    ]);
                    ProductImage::factory(2)->create([
                        'product_id' => $product->id,
                        'is_primary' => false,
                    ]);

                    // Reviews
                    Review::factory(rand(1, 5))->create([
                        'product_id' => $product->id,
                        'user_id' => $customers->random()->id,
                    ]);
                });
            }
        }
    }
}
