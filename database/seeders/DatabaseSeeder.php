<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $warehouse = Warehouse::create([
            'name' => 'Default Warehouse',
            'email' => 'default@warehouse.com',
            'contact' => '0123456789',
        ]);

        $user = User::create([
            'name' => 'Bayazid Hasan',
            'email' => 'admin@bayazid.com',
            'password' => bcrypt('bayazid'),
        ]);



        $warehouse->users()->attach($user);

    }



}
