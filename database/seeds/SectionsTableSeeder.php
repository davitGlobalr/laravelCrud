<?php

use App\Section;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    public function run()
    {
        $sections = factory(App\Section::class, 15)->create();
    }
}
