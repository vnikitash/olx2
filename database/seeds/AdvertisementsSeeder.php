<?php

use Illuminate\Database\Seeder;

class AdvertisementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 100; $i++) {
            DB::table('advertisements')->insert([
                'title' => 'test',
                'description' => 'testing',
                'price' => '55.55',
                'category_id' => '1',
                'user_id' => '1',
            ]);
        }
    }
}