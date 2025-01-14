<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShowLeadsSourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('show_leads_sources')->insert([
            [
                'source_id' => 1,
                'show_lead_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'source_id' => 2,
                'show_lead_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'source_id' => 3,
                'show_lead_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'source_id' => 1,
                'show_lead_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'source_id' => 2,
                'show_lead_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
