<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories first
        $carnesFrescas = Category::create([
            'slug' => 'carnes-frescas',
            'name' => 'Carnes Frescas',
            'description' => 'Carnes frescas de la más alta calidad',
            'display_order' => 1,
            'is_active' => true,
        ]);

        $fiambres = Category::create([
            'slug' => 'fiambres',
            'name' => 'Fiambres',
            'description' => 'Fiambres artesanales y tradicionales',
            'display_order' => 2,
            'is_active' => true,
        ]);

        $embutidos = Category::create([
            'slug' => 'embutidos',
            'name' => 'Embutidos',
            'description' => 'Embutidos especiales para parrilla',
            'display_order' => 3,
            'is_active' => true,
        ]);

        // Create products
        $products = [
            [
                'category_id' => $carnesFrescas->id,
                'sku' => 'LOMO-001',
                'slug' => 'lomo-cerdo-premium',
                'name' => 'Lomo de Cerdo Premium',
                'subtitle' => 'Corte selecto',
                'description' => 'Corte selecto de lomo de cerdo, ideal para asados especiales. Carne tierna y jugosa de la más alta calidad.',
                'preparation_tips' => 'Ideal para asar a la parrilla o al horno. Cocinar a fuego medio.',
                'base_price' => 85.00,
                'unit_type' => 'kg',
                'unit_quantity' => 1.0,
                'stock' => 25.5,
                'safety_stock' => 5.0,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $fiambres->id,
                'sku' => 'JAMON-001',
                'slug' => 'jamon-serrano-artesanal',
                'name' => 'Jamón Serrano Artesanal',
                'subtitle' => 'Curado tradicional',
                'description' => 'Jamón curado artesanalmente con técnicas tradicionales. Sabor intenso y textura perfecta.',
                'preparation_tips' => 'Servir en láminas finas a temperatura ambiente.',
                'base_price' => 120.00,
                'unit_type' => 'kg',
                'unit_quantity' => 1.0,
                'stock' => 15.0,
                'safety_stock' => 3.0,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $embutidos->id,
                'sku' => 'CHOR-001',
                'slug' => 'chorizo-parrillero',
                'name' => 'Chorizo Parrillero',
                'subtitle' => 'Especial para parrilla',
                'description' => 'Chorizo especial para parrilla, con especias selectas. Perfecto para asados familiares.',
                'preparation_tips' => 'Cocinar a fuego medio en parrilla por 8-10 minutos.',
                'base_price' => 45.00,
                'unit_type' => 'kg',
                'unit_quantity' => 1.0,
                'stock' => 30.0,
                'safety_stock' => 8.0,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $carnesFrescas->id,
                'sku' => 'COST-001',
                'slug' => 'costillas-bbq',
                'name' => 'Costillas BBQ',
                'subtitle' => 'Perfectas para barbacoa',
                'description' => 'Costillas de cerdo perfectas para barbacoa. Carne tierna que se desprende del hueso.',
                'preparation_tips' => 'Marinar por 2 horas antes de cocinar. Cocción lenta recomendada.',
                'base_price' => 65.00,
                'unit_type' => 'kg',
                'unit_quantity' => 1.0,
                'stock' => 20.0,
                'safety_stock' => 5.0,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $fiambres->id,
                'sku' => 'SALA-001',
                'slug' => 'salami-italiano',
                'name' => 'Salami Italiano',
                'subtitle' => 'Con hierbas aromáticas',
                'description' => 'Salami tradicional italiano con hierbas aromáticas. Sabor auténtico y textura perfecta.',
                'preparation_tips' => 'Servir en rodajas finas con pan y queso.',
                'base_price' => 75.00,
                'unit_type' => 'kg',
                'unit_quantity' => 1.0,
                'stock' => 12.0,
                'safety_stock' => 3.0,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_id' => $carnesFrescas->id,
                'sku' => 'TOCI-001',
                'slug' => 'tocino-ahumado',
                'name' => 'Tocino Ahumado',
                'subtitle' => 'Ahumado natural',
                'description' => 'Tocino ahumado naturalmente, perfecto para desayunos. Sabor intenso y aroma irresistible.',
                'preparation_tips' => 'Cocinar en sartén a fuego medio hasta dorar.',
                'base_price' => 55.00,
                'unit_type' => 'kg',
                'unit_quantity' => 1.0,
                'stock' => 18.0,
                'safety_stock' => 4.0,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_id' => $embutidos->id,
                'sku' => 'LONG-001',
                'slug' => 'longaniza-casera',
                'name' => 'Longaniza Casera',
                'subtitle' => 'Receta tradicional',
                'description' => 'Longaniza casera con receta tradicional boliviana. Especias locales y sabor auténtico.',
                'preparation_tips' => 'Cocinar a fuego lento para mejor sabor.',
                'base_price' => 42.00,
                'unit_type' => 'kg',
                'unit_quantity' => 1.0,
                'stock' => 25.0,
                'safety_stock' => 6.0,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'category_id' => $carnesFrescas->id,
                'sku' => 'CHUL-001',
                'slug' => 'chuletas-cerdo',
                'name' => 'Chuletas de Cerdo',
                'subtitle' => 'Corte premium',
                'description' => 'Chuletas de cerdo de corte premium. Ideales para parrilla o sartén.',
                'preparation_tips' => 'Sellar a fuego alto y terminar a fuego medio.',
                'base_price' => 70.00,
                'unit_type' => 'kg',
                'unit_quantity' => 1.0,
                'stock' => 22.0,
                'safety_stock' => 5.0,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
