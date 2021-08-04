<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'products.create']);
        Permission::create(['name' => 'products.edit']);
        Permission::create(['name' => 'products.delete']);
        Permission::create(['name' => 'products.view']);
        Permission::create(['name' => 'products.buy']);

        $seller = Role::create(['name' => 'Продавец']);
        $seller->givePermissionTo('products.create');
        $seller->givePermissionTo('products.edit');
        $seller->givePermissionTo('products.delete');
        $seller->givePermissionTo('products.view');
        $seller->givePermissionTo('products.buy');

        $customer = Role::create(['name' => 'Покупатель']);
        $customer->givePermissionTo('products.view');
        $customer->givePermissionTo('products.buy');

        $userSeller = User::factory()->create([
           'name'  => 'Seller1',
           'email' => 'seller1@ez2pay'
        ]);
        $userSeller->assignRole($seller);

        $userSeller2 = User::factory()->create([
            'name'  => 'Seller2',
            'email' => 'seller2@ez2pay'
        ]);
        $userSeller2->assignRole($seller);

        $userCustomer = User::factory()->create([
            'name'  => 'Customer',
            'email' => 'customer@ez2pay'
        ]);
        $userCustomer->assignRole($customer);
    }
}
