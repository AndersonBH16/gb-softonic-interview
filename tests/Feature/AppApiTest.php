<?php

namespace Tests\Feature;

use Tests\TestCase;

class AppApiTest extends TestCase
{
    public function testGetAppEndpointReturnsCorrectJson()
    {
        $response = $this->get('/api/21824');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'author_info' => ['name', 'url'],
                'title',
                'version',
                'url',
                'short_description',
                'license',
                'thumbnail',
                'rating',
                'total_downloads',
                'compatible',
            ]);
    }
}
