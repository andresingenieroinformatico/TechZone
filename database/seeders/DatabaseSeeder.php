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

        // Test customer
        $testCustomer = User::factory()->create([
            'name' => 'Cliente TechZone',
            'email' => 'cliente@techzone.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_CUSTOMER,
        ]);

        // Sellers
        $sellers = User::factory(5)->create([
            'role' => User::ROLE_SELLER,
        ]);

        // Customers
        $customers = User::factory(10)->create([
            'role' => User::ROLE_CUSTOMER,
        ])->push($testCustomer);

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
                ])->each(function ($product) use ($customers, $category) {
                    $productNames = [
                        'Laptops' => ['Laptop Pro 14', 'Ultrabook Air 15', 'Laptop Gamer RTX'],
                        'Smartphones' => ['Smartphone Nova X', 'Smartphone Pixel Max', 'Smartphone Galaxy Edge'],
                        'Tablets' => ['Tablet Studio 11', 'Tablet Mini Plus', 'Tablet Pro 12'],
                        'Audio' => ['Audifonos Bluetooth Pro', 'Parlante Portatil Max', 'Soundbar Cinema 2.1'],
                        'Gaming' => ['Consola Next Play', 'Control Inalambrico Pro', 'Teclado Mecanico RGB'],
                        'Componentes' => ['SSD NVMe 1TB', 'Tarjeta Grafica RX', 'Memoria RAM 32GB'],
                    ];

                    $names = $productNames[$category->name] ?? $productNames['Componentes'];
                    $name = $names[($product->id - 1) % count($names)];

                    $product->update([
                        'name' => $name,
                        'slug' => str($name . ' ' . $product->id)->slug(),
                        'description' => "Producto destacado de la categoria {$category->name}, ideal para renovar tu setup con buen rendimiento y garantia.",
                    ]);

                    // Image configurations by category with specific colors and themes
                    $categoryConfig = [
                        'Laptops' => ['bg' => '4F46E5', 'text' => 'FFFFFF', 'label' => 'Laptop'],
                        'Smartphones' => ['bg' => '06B6D4', 'text' => 'FFFFFF', 'label' => 'Smartphone'],
                        'Tablets' => ['bg' => '8B5CF6', 'text' => 'FFFFFF', 'label' => 'Tablet'],
                        'Audio' => ['bg' => 'EC4899', 'text' => 'FFFFFF', 'label' => 'Audio'],
                        'Gaming' => ['bg' => '22C55E', 'text' => 'FFFFFF', 'label' => 'Gaming'],
                        'Componentes' => ['bg' => 'F59E0B', 'text' => 'FFFFFF', 'label' => 'Componente'],
                    ];
                    
                    $config = $categoryConfig[$category->name] ?? $categoryConfig['Componentes'];
                    
                    // Generate image URLs with custom styling
                    $imageNum = rand(1, 3);
                    $images = [
                        "https://placehold.co/800x600/{$config['bg']}/{$config['text']}?text={$config['label']}+{$imageNum}",
                        "https://placehold.co/800x600/{$config['bg']}/{$config['text']}?text={$config['label']}+" . ($imageNum + 1),
                        "https://placehold.co/800x600/{$config['bg']}/{$config['text']}?text={$config['label']}+" . ($imageNum + 2),
                    ];
                    
                    // Primary Image
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $images[0],
                        'is_primary' => true,
                    ]);
                    
                    // Secondary Images
                    for ($i = 1; $i < 3; $i++) {
                        ProductImage::create([
                            'product_id' => $product->id,
                            'path' => $images[$i % count($images)],
                            'is_primary' => false,
                        ]);
                    }

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
