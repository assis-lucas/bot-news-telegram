<?php

use Illuminate\Database\Seeder;

class KeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keywords')->insert([
            'name' => 'f1',
        ]);
        
        DB::table('keywords')->insert([
            'name' => 'carros',
        ]);

        DB::table('keywords')->insert([
            'name' => 'volkswagen',
        ]);

        DB::table('keywords')->insert([
            'name' => 'backstage',
        ]);

        DB::table('keywords')->insert([
            'name' => 'razuk',
        ]);

        DB::table('keywords')->insert([
            'name' => 'audi',
        ]);

    }
}
