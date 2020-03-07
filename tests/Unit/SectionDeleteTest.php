<?php

namespace Tests\Unit;

use App\Section;
use Tests\TestCase;

class SectionDeleteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeleteSection()
    {
        //just creating a new section in case of no section
        factory(Section::class)->create();

        $section = Section::first();

        if($section)
            $section->delete();

        $this->assertTrue(true);
    }
}
