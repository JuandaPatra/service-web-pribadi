<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShowLeadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('show_leads')->insert([
            [
                'name' => 'Template 1',
                'link' => 'google.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Template 2',
                'link' => 'google.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Template 3',
                'link' => 'google.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Template 1',
                'link' => 'google.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            ]);
    }
}
