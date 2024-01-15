<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Envioramental_impact;
use App\Models\Material;
use App\Models\Supplier;
use App\Models\Type;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Type::factory(5)->create();
        Supplier::factory(5)->create();
        Envioramental_impact::factory(5)->create();
        Material::factory()->count(5)->create();
    }
}
