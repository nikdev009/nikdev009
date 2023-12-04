<?php

namespace Database\Seeders;
use App\Models\category;
use App\Models\subcategory;
use App\Models\product;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

       User::create([
        'name'=>'laraadmin',
        'email'=>'admin@gmial.com',
        'password'=>bcrypt('admin@123'),
        'email_verified_at'=>now(),
        'is_admin'=>1
       ]);
       user::create([
           'name'=>'retailer',
           'email'=>'retailer@gmail.com',
           'password'=>bcrypt('nihar@123'),
           'email_verified_at'=>now(),
           'is_admin'=>2,
       ]);
    }
}
