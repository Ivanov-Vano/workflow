<?php

namespace Database\Seeders;

use App\Models\Accesses\Permission;
use App\Models\Accesses\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     *
     * Сидер для первоначальной записи минимальных значений роли, разрешений и пользователей
     *
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // reset cached roles and permissions (сбросить кешированные роли и разрешения)
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //Misc (пустышка)
        $miscPermission = Permission::create(['name' => 'N/A']);

        //Inventory model
        $inventoryPermission1 = Permission::create(['name' => 'просмотр всех: инвентарный']);
        $inventoryPermission2 = Permission::create(['name' => 'просмотр: инвентарный']);
        $inventoryPermission3 = Permission::create(['name' => 'создание: инвентарный']);
        $inventoryPermission4 = Permission::create(['name' => 'изменение: инвентарный']);
        $inventoryPermission5 = Permission::create(['name' => 'удаление: инвентарный']);
        $inventoryPermission6 = Permission::create(['name' => 'восстановление: инвентарный']);
        $inventoryPermission7 = Permission::create(['name' => 'безвозвратное удаление: инвентарный']);

        //Workbook model
        $workbookPermission1 = Permission::create(['name' => 'просмотр всех: рабочая тетрадь']);
        $workbookPermission2 = Permission::create(['name' => 'просмотр: рабочая тетрадь']);
        $workbookPermission3 = Permission::create(['name' => 'создание: рабочая тетрадь']);
        $workbookPermission4 = Permission::create(['name' => 'изменение: рабочая тетрадь']);
        $workbookPermission5 = Permission::create(['name' => 'удаление: рабочая тетрадь']);
        $workbookPermission6 = Permission::create(['name' => 'восстановление: рабочая тетрадь']);
        $workbookPermission7 = Permission::create(['name' => 'безвозвратное удаление: рабочая тетрадь']);


        //CREATE ROLES (создание ролей)
        $userRole = Role::create(['name' => 'Исполнитель'])->syncPermissions([
            $inventoryPermission1,
            $inventoryPermission2,
            $workbookPermission1,
            $workbookPermission2,
        ]);
        //CREATE ROLES (создание ролей)
        $userRole = Role::create(['name' => 'Ответственный'])->syncPermissions([
            $inventoryPermission1,
            $inventoryPermission2,
            $workbookPermission1,
            $workbookPermission2,
        ]);
        $adminRole = Role::create(['name' => 'Администратор'])->syncPermissions([
            $inventoryPermission1,
            $inventoryPermission2,
            $inventoryPermission3,
            $inventoryPermission4,
            $inventoryPermission5,
            $inventoryPermission6,
            $inventoryPermission7,
            $workbookPermission1,
            $workbookPermission2,
            $workbookPermission3,
            $workbookPermission4,
            $workbookPermission5,
            $workbookPermission6,
            $workbookPermission7,
        ]);
    }
}
