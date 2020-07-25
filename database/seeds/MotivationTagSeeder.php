<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivationTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            DB::table('motivation_tag')->insert([
                'motivation_id' => rand(1, 5),
                'tag_id'        => rand(1, 5),
                'created_at'   => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
