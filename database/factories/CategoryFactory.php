<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static int $count = 0;
    
    public function definition(): array
    {
        $categories = [
            ['name' => 'Laptops', 'description' => 'Computadoras portátiles de última generación'],
            ['name' => 'Smartphones', 'description' => 'Teléfonos inteligentes y accesorios móviles'],
            ['name' => 'Tablets', 'description' => 'Tabletas y dispositivos portátiles'],
            ['name' => 'Audio', 'description' => 'Auriculares, parlantes y sistemas de sonido'],
            ['name' => 'Gaming', 'description' => 'Consolas, controles y accesorios gaming'],
            ['name' => 'Componentes', 'description' => 'Piezas y componentes para computadoras'],
        ];
        
        $category = $categories[self::$count % count($categories)];
        self::$count++;
        
        return [
            'name' => $category['name'],
            'slug' => str($category['name'])->slug(),
            'description' => $category['description'],
            'image' => 'https://picsum.photos/400/300?random=' . rand(1, 100),
        ];
    }
}
