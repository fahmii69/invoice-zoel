<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        DB::table('role_has_permissions')->delete();

        DB::table('roles')->insert([
            'name'       => 'Admin',
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('roles')->insert([
            'name'       => 'User',
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $permissions = [
            // [
            //     'name'       => '',
            //     'alias'      => '',
            //     'guard_name' => 'web',
            //     'role'       => ['Admin'],
            // ],
            // [
            //     'name'       => 'sale.create',
            //     'alias'      => 'Create Sale',
            //     'guard_name' => 'web',
            //     'role'       => ['Admin'],
            // ],
            // [
            //     'name'       => 'sale.store',
            //     'alias'      => 'Store Sale',
            //     'guard_name' => 'web',
            //     'role'       => ['Admin'],
            // ],
            [
                'name'       => 'sale.edit',
                'alias'      => 'Edit Sale',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'sale.update',
                'alias'      => 'Update Sale',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'sale.delete',
                'alias'      => 'Delete Sale',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'product.create',
                'alias'      => 'Create Product',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'product.store',
                'alias'      => 'Store Product',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'product.edit',
                'alias'      => 'Edit Product',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'product.update',
                'alias'      => 'Update Product',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'product.delete',
                'alias'      => 'Delete Product',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'supplier.create',
                'alias'      => 'Create Supplier',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'supplier.store',
                'alias'      => 'Store Supplier',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'supplier.edit',
                'alias'      => 'Edit Supplier',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'supplier.update',
                'alias'      => 'Update Supplier',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'supplier.delete',
                'alias'      => 'Delete Supplier',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'category.create',
                'alias'      => 'Create Category',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'category.store',
                'alias'      => 'Store Category',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'category.edit',
                'alias'      => 'Edit Category',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'category.update',
                'alias'      => 'Update Category',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'category.delete',
                'alias'      => 'Delete Category',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'customer.create',
                'alias'      => 'Create Customer',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'customer.store',
                'alias'      => 'Store Customer',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'customer.edit',
                'alias'      => 'Edit Customer',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'customer.update',
                'alias'      => 'Update Customer',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'customer.delete',
                'alias'      => 'Delete Customer',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'contract.index',
                'alias'      => 'Index Contract',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'contract.create',
                'alias'      => 'Create Contract',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'contract.store',
                'alias'      => 'Store Contract',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'contract.edit',
                'alias'      => 'Edit Contract',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'contract.update',
                'alias'      => 'Update Contract',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'contract.delete',
                'alias'      => 'Delete Contract',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'user.create',
                'alias'      => 'Create User',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'user.store',
                'alias'      => 'Store User',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'user.edit',
                'alias'      => 'Edit User',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'user.update',
                'alias'      => 'Update User',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'user.delete',
                'alias'      => 'Delete User',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
        ];

        foreach ($permissions as $k => $v) {
            DB::table('permissions')->insert([
                'name'       => $v['name'],
                'alias'      => $v['alias'],
                'guard_name' => $v['guard_name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if (in_array('Admin', $v['role'])) {
                $role = Role::findByName('Admin');
                $role->givePermissionTo($v['name']);
            }
        }
    }
}
