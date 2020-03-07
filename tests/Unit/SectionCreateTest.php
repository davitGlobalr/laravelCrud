<?php

namespace Tests\Unit;

use App\Section;
use App\User;
use Tests\TestCase;

class SectionCreateTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testInsertSection()
    {
        factory(User::class)->create();

        $user = User::first();

        $this->be($user);

        $data = [
            'name' => 'Test',
            'description' => 'Test Text',
        ];

        $section = Section::create($data);

        $this->assertInstanceOf(Section::class, $section);

        $this->assertEquals($data['name'], $section->name);
        $this->assertEquals($data['description'], $section->description);

        $this->assertTrue(true);
    }
}


