<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // nomi delle categorie
        $categories = [
           'Today news',
           'Politics',
           'Economy',
           'Sport',
           'Lifestyle'
        ];

        // popoliamo con un foreach
        foreach($categories as $category_name){
            $new_category = new Category();
            $new_category->name = $category_name;
            $new_category->slug = Str::slug($category_name, '-');
            $new_category->save();
        }
    }
}
