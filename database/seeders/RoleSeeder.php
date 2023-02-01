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
            'name'       => 'Supervisor',
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('roles')->insert([
            'name'       => 'Staff',
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
                'type'       => 'Sale',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor'],
            ],
            [
                'name'       => 'sale.update',
                'alias'      => 'Update Sale',
                'type'       => 'Sale',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor'],
            ],
            [
                'name'       => 'sale.delete',
                'alias'      => 'Delete Sale',
                'type'       => 'Sale',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor'],
            ],
            [
                'name'       => 'product.create',
                'alias'      => 'Create Product',
                'type'       => 'Product',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor', 'Staff'],
            ],
            [
                'name'       => 'product.store',
                'alias'      => 'Store Product',
                'type'       => 'Product',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor', 'Staff'],
            ],
            [
                'name'       => 'product.edit',
                'alias'      => 'Edit Product',
                'type'       => 'Product',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor'],
            ],
            [
                'name'       => 'product.update',
                'alias'      => 'Update Product',
                'type'       => 'Product',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor'],
            ],
            [
                'name'       => 'product.delete',
                'alias'      => 'Delete Product',
                'type'       => 'Product',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor'],
            ],
            [
                'name'       => 'supplier.create',
                'alias'      => 'Create Supplier',
                'type'       => 'Supplier',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor', 'Staff'],
            ],
            [
                'name'       => 'supplier.store',
                'alias'      => 'Store Supplier',
                'type'       => 'Supplier',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor', 'Staff'],
            ],
            [
                'name'       => 'supplier.edit',
                'alias'      => 'Edit Supplier',
                'type'       => 'Supplier',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor', 'Staff'],
            ],
            [
                'name'       => 'supplier.update',
                'alias'      => 'Update Supplier',
                'type'       => 'Supplier',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor', 'Staff'],
            ],
            [
                'name'       => 'supplier.delete',
                'alias'      => 'Delete Supplier',
                'type'       => 'Supplier',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor'],
            ],
            [
                'name'       => 'category.create',
                'alias'      => 'Create Category',
                'type'       => 'Category',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor', 'Staff'],
            ],
            [
                'name'       => 'category.store',
                'alias'      => 'Store Category',
                'type'       => 'Category',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor', 'Staff'],
            ],
            [
                'name'       => 'category.edit',
                'alias'      => 'Edit Category',
                'type'       => 'Category',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor', 'Staff'],
            ],
            [
                'name'       => 'category.update',
                'alias'      => 'Update Category',
                'type'       => 'Category',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor', 'Staff'],
            ],
            [
                'name'       => 'category.delete',
                'alias'      => 'Delete Category',
                'type'       => 'Category',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor'],
            ],
            [
                'name'       => 'customer.create',
                'alias'      => 'Create Customer',
                'type'       => 'Customer',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor', 'Staff'],
            ],
            [
                'name'       => 'customer.store',
                'alias'      => 'Store Customer',
                'type'       => 'Customer',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor', 'Staff'],
            ],
            [
                'name'       => 'customer.edit',
                'alias'      => 'Edit Customer',
                'type'       => 'Customer',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor', 'Staff'],
            ],
            [
                'name'       => 'customer.update',
                'alias'      => 'Update Customer',
                'type'       => 'Customer',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor', 'Staff'],
            ],
            [
                'name'       => 'customer.delete',
                'alias'      => 'Delete Customer',
                'type'       => 'Customer',
                'guard_name' => 'web',
                'role'       => ['Admin', 'Supervisor'],
            ],
            [
                'name'       => 'contract.index',
                'alias'      => 'Index Contract',
                'type'       => 'Contract',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'contract.create',
                'alias'      => 'Create Contract',
                'type'       => 'Contract',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'contract.store',
                'alias'      => 'Store Contract',
                'type'       => 'Contract',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'contract.edit',
                'alias'      => 'Edit Contract',
                'type'       => 'Contract',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'contract.update',
                'alias'      => 'Update Contract',
                'type'       => 'Contract',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'contract.delete',
                'alias'      => 'Delete Contract',
                'type'       => 'Contract',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'user.index',
                'alias'      => 'Index User',
                'type'       => 'User',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'user.create',
                'alias'      => 'Create User',
                'type'       => 'User',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'user.store',
                'alias'      => 'Store User',
                'type'       => 'User',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'user.edit',
                'alias'      => 'Edit User',
                'type'       => 'User',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'user.update',
                'alias'      => 'Update User',
                'type'       => 'User',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'user.delete',
                'alias'      => 'Delete User',
                'type'       => 'User',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'role.index',
                'alias'      => 'Index Role',
                'type'       => 'Role',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'role.create',
                'alias'      => 'Create Role',
                'type'       => 'Role',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'role.store',
                'alias'      => 'Store Role',
                'type'       => 'Role',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'role.edit',
                'alias'      => 'Edit Role',
                'type'       => 'Role',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'role.update',
                'alias'      => 'Update Role',
                'type'       => 'Role',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'role.delete',
                'alias'      => 'Delete Role',
                'type'       => 'Role',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
        ];

        foreach ($permissions as $k => $v) {
            DB::table('permissions')->insert([
                'name'       => $v['name'],
                'alias'      => $v['alias'],
                'type'       => $v['type'],
                'guard_name' => $v['guard_name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if (in_array('Admin', $v['role'])) {
                $role = Role::findByName('Admin');
                $role->givePermissionTo($v['name']);
            }

            if (in_array('Supervisor', $v['role'])) {
                $role = Role::findByName('Supervisor');
                $role->givePermissionTo($v['name']);
            }

            if (in_array('Staff', $v['role'])) {
                $role = Role::findByName('Staff');
                $role->givePermissionTo($v['name']);
            }
        }
    }
}
