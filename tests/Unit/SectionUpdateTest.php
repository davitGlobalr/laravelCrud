<?php

namespace Tests\Unit;

use App\Section;
use Tests\TestCase;

class SectionUpdateTest extends TestCase
{
    /**
     * A basic unit update example.
     *
     * @return void
     */
    public function testUpdateSectionName()
    {
        $data['name'] = 'Test';

        //just creating a new section in case of no section
        factory(Section::class)->create();

        $section = Section::first();

        $section->update($data);

        $this->assertInstanceOf(Section::class, $section);

        $this->assertEquals($data['name'], $section->name);

        $this->assertTrue(true);

    }
}
