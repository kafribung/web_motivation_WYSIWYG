<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['cinta', 'sosial', 'ekonimi', 'pendidikan', 'budaya', 'bangsa', 'alam', 'agama'];

        foreach ($tags as $tag) {
            \App\Models\Tag::create([
                'title' => $tag,
                'slug' => \Str::slug($tag),
            ]);
        }
    }
}
