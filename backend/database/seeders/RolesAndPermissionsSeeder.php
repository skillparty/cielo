<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar caché de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        $permissions = [
            // Permisos de pedidos
            'view orders',
            'create orders',
            'edit orders',
            'delete orders',
            'manage order status',
            'process refunds',
            'verify payments',
            
            // Permisos de productos
            'view products',
            'create products',
            'edit products',
            'delete products',
            'manage inventory',
            
            // Permisos de usuarios
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage user roles',
            
            // Permisos de reportes
            'view reports',
            'export reports',
            'view analytics',
            
            // Permisos de configuración
            'view settings',
            'edit settings',
            'manage payment methods',
            'manage shipping',
            
            // Permisos administrativos
            'access admin panel',
            'view dashboard',
            'manage system',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles con permisos específicos
        
        // Super Admin - Todos los permisos
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdmin->syncPermissions(Permission::all());

        // Admin - Casi todos los permisos excepto gestión del sistema
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions([
            'access admin panel',
            'view dashboard',
            'view orders', 'create orders', 'edit orders', 'delete orders',
            'manage order status', 'process refunds', 'verify payments',
            'view products', 'create products', 'edit products', 'delete products', 'manage inventory',
            'view users', 'create users', 'edit users',
            'view reports', 'export reports', 'view analytics',
            'view settings', 'edit settings', 'manage payment methods', 'manage shipping',
        ]);

        // Moderador - Gestión de pedidos y productos
        $moderator = Role::firstOrCreate(['name' => 'moderator']);
        $moderator->syncPermissions([
            'access admin panel',
            'view dashboard',
            'view orders', 'edit orders', 'manage order status', 'verify payments',
            'view products', 'edit products', 'manage inventory',
            'view users',
            'view reports', 'export reports',
        ]);

        // Operador - Solo gestión básica de pedidos
        $operator = Role::firstOrCreate(['name' => 'operator']);
        $operator->syncPermissions([
            'access admin panel',
            'view dashboard',
            'view orders', 'edit orders', 'manage order status',
            'view products',
            'view reports',
        ]);

        // Crear usuario super admin por defecto
        $superAdminUser = User::firstOrCreate(
            ['email' => 'admin@cielo.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password123'),
                'phone' => '+59170000001',
                'address_line1' => 'Oficina Central',
                'city' => 'La Paz',
                'state' => 'La Paz',
                'email_verified_at' => now(),
                'accepted_terms_at' => now(),
            ]
        );
        
        if (!$superAdminUser->hasRole('super-admin')) {
            $superAdminUser->assignRole('super-admin');
        }

        // Crear usuario admin de ejemplo
        $adminUser = User::firstOrCreate(
            ['email' => 'administrador@cielo.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('admin123'),
                'phone' => '+59170000002',
                'address_line1' => 'Oficina Administrativa',
                'city' => 'La Paz',
                'state' => 'La Paz',
                'email_verified_at' => now(),
                'accepted_terms_at' => now(),
            ]
        );
        
        if (!$adminUser->hasRole('admin')) {
            $adminUser->assignRole('admin');
        }

        $this->command->info('Roles y permisos creados exitosamente.');
        $this->command->info('Usuario Super Admin: admin@cielo.com / password123');
        $this->command->info('Usuario Admin: administrador@cielo.com / admin123');
    }
}