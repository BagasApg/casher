<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $categories = [
            (object) array('name' => 'Tools'),
            (object) array('name' => 'Foods'),
            (object) array('name' => 'Drinks'),
            (object) array('name' => 'Stationary'),
        ];

        $items = [
            (object) [
                'category_id' => 1,
                'name' => 'Palu',
                'stock' => 15,
                'price' => 25000
            ],
            (object) [
                'category_id' => 1,
                'name' => 'Gergaji',
                'stock' => 4,
                'price' => 76000
            ],
            (object) [
                'category_id' => 2,
                'name' => 'Permen',
                'stock' => 54,
                'price' => 1000
            ],
        ];

        foreach($categories as $cat){
            $c = new Category();
            $c->name = $cat->name;
            $c->save();
        }

        foreach($items as $item){
            $i = new Item();
            $i->category_id = $item->category_id;
            $i->name = $item->name;
            $i->stock = $item->stock;
            $i->price = $item->price;
            $i->save();
        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
