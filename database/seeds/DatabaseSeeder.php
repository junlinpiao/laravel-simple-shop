<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Product;

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
        $this->call(ProductTableSeeder::class);
    }
}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
            'name' => 'Xinming',
            'email' => 'ximingfan@gmail.com',
            'password' => Hash::make('xinming12345'),
            
        ));
    }

}

class ProductTableSeeder extends Seeder {

    public function run()
    {
        DB::table('products')->delete();

        Product::create(array(
            'name' => "Men's and Woen outdoor protective masks (black)",
            'price' => '$19.99',
            'image_url' => 'https://m.media-amazon.com/images/I/71RU5yX822L._AC_UL320_.jpg',
            'image_path' => '71RU5yX822L._AC_UL320_.jpg',
        ));
    }

}
