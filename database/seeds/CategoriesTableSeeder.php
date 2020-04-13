<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categories = ['東京'];

      foreach ($categories as $category) {
          DB::table('categories')->insert([
              'category_name' => $category,
              'user_id'    => 2,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
          ]);
      }
    }
}
