<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Archive;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);

        $rootUser = User::firstOrCreate(
            ['email' => 'root@root.com'],
            [
                'name' => 'Root',
                'password' => Hash::make('123123'),
                'type' => 'super-admin',
                'email_verified_at' => now(),
            ]
        );

        $categories = Category::factory()
            ->count(6)
            ->state(['user_id' => $rootUser->id])
            ->create();

        $childCategories = Category::factory()
            ->count(6)
            ->state(['user_id' => $rootUser->id])
            ->state(fn () => ['parent_id' => $categories->random()->id])
            ->create();

        $allCategories = $categories->concat($childCategories);

        $products = Product::factory()
            ->count(30)
            ->state(fn () => [
                'user_id' => $rootUser->id,
                'category_id' => $allCategories->random()->id,
            ])
            ->create();

        $products->each(function (Product $product) {
            $archives = Archive::factory()
                ->count(rand(1, 3))
                ->create();

            $product->archives()->syncWithoutDetaching($archives->pluck('id'));
        });
    }
}
