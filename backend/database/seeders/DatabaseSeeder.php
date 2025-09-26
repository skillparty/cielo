<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CompanyContent;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear permisos y roles
        $this->createRolesAndPermissions();

        // Crear usuario administrador
        $admin = User::factory()->create([
            'name' => 'Administrador Cielo',
            'email' => 'admin@cielocarnes.test',
            'phone' => '+59170000000',
            'address_line1' => 'Oficina Central',
            'city' => 'La Paz',
            'state' => 'La Paz',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
        ]);
        $admin->assignRole('admin');

        // Crear categorías principales
        $categories = $this->createCategories();

        // Crear productos
        $this->createProducts($categories);

        // Crear recetas
        $this->createRecipes($categories);

        // Crear contenido de empresa
        $this->createCompanyContent();

        // Crear FAQs
        $this->createFaqs();

        // Crear usuarios de prueba
        User::factory(10)->create();
    }

    private function createRolesAndPermissions(): void
    {
        // Crear permisos
        $permissions = [
            'manage_users',
            'manage_products',
            'manage_categories',
            'manage_recipes',
            'manage_combos',
            'manage_orders',
            'manage_payments',
            'manage_faqs',
            'manage_content',
            'manage_contact_messages',
            'view_dashboard',
            'view_reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $logisticsRole = Role::firstOrCreate(['name' => 'logistics']);
        $supportRole = Role::firstOrCreate(['name' => 'support']);

        // Asignar permisos a roles
        $adminRole->givePermissionTo($permissions);
        
        $managerRole->givePermissionTo([
            'manage_products',
            'manage_categories',
            'manage_recipes',
            'manage_combos',
            'view_dashboard',
            'view_reports',
        ]);

        $logisticsRole->givePermissionTo([
            'manage_orders',
            'manage_payments',
            'view_dashboard',
        ]);

        $supportRole->givePermissionTo([
            'manage_faqs',
            'manage_contact_messages',
            'view_dashboard',
        ]);
    }

    private function createCategories(): array
    {
        $mainCategories = [
            ['name' => 'Carnes Frescas', 'slug' => 'carnes-frescas'],
            ['name' => 'Embutidos', 'slug' => 'embutidos'],
            ['name' => 'Fiambres', 'slug' => 'fiambres'],
            ['name' => 'Especiales', 'slug' => 'especiales'],
        ];

        $categories = [];
        foreach ($mainCategories as $categoryData) {
            $category = Category::factory()->create([
                'name' => $categoryData['name'],
                'slug' => $categoryData['slug'],
                'is_active' => true,
                'display_order' => count($categories),
            ]);
            $categories[] = $category;
        }

        // Crear subcategorías
        $subcategories = [
            ['parent' => $categories[0], 'name' => 'Res', 'slug' => 'res'],
            ['parent' => $categories[0], 'name' => 'Cerdo', 'slug' => 'cerdo'],
            ['parent' => $categories[0], 'name' => 'Pollo', 'slug' => 'pollo'],
            ['parent' => $categories[1], 'name' => 'Chorizos', 'slug' => 'chorizos'],
            ['parent' => $categories[1], 'name' => 'Salchichas', 'slug' => 'salchichas'],
            ['parent' => $categories[2], 'name' => 'Jamones', 'slug' => 'jamones'],
            ['parent' => $categories[2], 'name' => 'Mortadelas', 'slug' => 'mortadelas'],
        ];

        foreach ($subcategories as $subData) {
            Category::factory()->create([
                'parent_id' => $subData['parent']->id,
                'name' => $subData['name'],
                'slug' => $subData['slug'],
                'is_active' => true,
            ]);
        }

        return $categories;
    }

    private function createProducts($categories): void
    {
        foreach ($categories as $category) {
            Product::factory(8)->create([
                'category_id' => $category->id,
                'is_active' => true,
            ]);
        }

        // Crear algunos productos destacados
        Product::factory(5)->featured()->create();
    }

    private function createRecipes($categories): void
    {
        Recipe::factory(15)->published()->create([
            'category_id' => $categories[array_rand($categories)]->id,
        ]);

        Recipe::factory(5)->draft()->create();
    }

    private function createCompanyContent(): void
    {
        $sections = [
            [
                'section_key' => 'hero',
                'title' => 'Cielo Carnes',
                'subtitle' => 'Calidad y tradición en cada corte',
                'content' => 'Desde 1985, ofrecemos los mejores productos cárnicos de Bolivia.',
            ],
            [
                'section_key' => 'history',
                'title' => 'Nuestra Historia',
                'subtitle' => 'Más de 35 años de experiencia',
                'content' => 'Fundada en 1985 por la familia Cielo, nuestra empresa ha crecido...',
            ],
            [
                'section_key' => 'values',
                'title' => 'Nuestros Valores',
                'subtitle' => 'Compromiso con la calidad',
                'content' => 'Calidad, frescura, tradición y servicio al cliente son nuestros pilares.',
            ],
        ];

        foreach ($sections as $section) {
            CompanyContent::factory()->create($section + ['is_published' => true]);
        }
    }

    private function createFaqs(): void
    {
        $faqs = [
            [
                'category' => 'General',
                'question' => '¿Cuáles son sus horarios de atención?',
                'answer' => 'Atendemos de lunes a viernes de 8:00 a 18:00 y sábados de 8:00 a 14:00.',
            ],
            [
                'category' => 'Pedidos',
                'question' => '¿Cuál es el monto mínimo de pedido?',
                'answer' => 'El monto mínimo de pedido es de 50 BOB para delivery.',
            ],
            [
                'category' => 'Pagos',
                'question' => '¿Qué métodos de pago aceptan?',
                'answer' => 'Aceptamos tarjetas de crédito/débito, transferencias bancarias por QR y pago contra entrega.',
            ],
            [
                'category' => 'Envíos',
                'question' => '¿Cuánto tiempo tarda la entrega?',
                'answer' => 'Las entregas se realizan en un plazo de 2-4 horas en el área metropolitana.',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::factory()->create($faq + ['is_published' => true]);
        }
    }
}
