<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'list-mosque', 'title' =>'استعراض المساجد']);
        Permission::create(['name' => 'add-mosque', 'title' => 'إضافة مسجد']);
        Permission::create(['name' => 'edit-mosque', 'title' => 'تعديل مسجد']);
        Permission::create(['name' => 'delete-mosque', 'title' =>'حذف مسجد']);
        Permission::create(['name' => 'publish-mosque', 'title' =>'نشر مسجد']);
        Permission::create(['name' => 'unpublish-mosque', 'title' =>'إلغاء نشر مسجد']);

        Permission::create(['name' => 'list-order', 'title' => 'استعراض الطلبات']);
        Permission::create(['name' => 'search-order', 'title' => 'بحث في الطلبات']);
        Permission::create(['name' => 'assign-order', 'title' =>'إسناد الطلبات للسائقين']);

        Permission::create(['name' => 'list-transfer', 'title' => 'استعراض التحويلات']);
        Permission::create(['name' => 'confirm-transfer', 'title' => 'تأكيد التحويلات']);

        Permission::create(['name' => 'list-users', 'title' => 'استعراض المستخدمين']);
        Permission::create(['name' => 'add-users', 'title' => 'إضافة مستخدم']);
        Permission::create(['name' => 'edit-users', 'title' => 'تعديل مستخدم']);
        Permission::create(['name' => 'delete-users', 'title' =>'حذف مستخدم']);
        Permission::create(['name' => 'publish-users', 'title' =>'حظر مستخدم']);
        

        $role1 = Role::create(['name' => 'Super-Admin', 'title' => 'المشرف العام']);

        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@qatrahksa.com',
            'password' => Hash::make("admin@1901")
        ]);
        $user->assignRole($role1);


        Role::create(['name' => 'Admin', 'title' => 'إداري']);
        Role::create(['name' => 'Data-Entry', 'title' => 'مدخل بيانات']);
        $role2 = Role::create(['name' => 'Driver', 'title' => 'سائق']);
        Role::create(['name' => 'Accountant', 'title' => 'محاسب']);

        $user = User::factory()->create([
            'name' => 'ALi Driver',
            'email' => 'super9@admin.com',
            'password' => Hash::make("12345678")
        ]);
        $user->assignRole($role2);
    }
}
