<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 10; $i++) { 
            Item::create([
                'name' => 'Item Ke '.$i,
                'price' => 20000,
                'description' => 'Ini adalah item ke '.$i,
                'stock' => 30 + $i,
            ]); 
        }

        
    }
}
