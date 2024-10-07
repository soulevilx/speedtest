<?php

namespace Tests\Feature\Controllers;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ApiControllerTest extends TestCase
{
    public function testCreateWithPayload()
    {
        $response = $this->post(
            '/api/v1/speedtest',
            [
                'hostname' => $this->faker->name,
                'ip' => $this->faker->ipv4,
                'data' => file_get_contents(
                    __DIR__.'/../../Fixtures/speedtest.json'
                ),
            ]
        );

        $data = json_decode($response->getContent(), true);
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(451104, $data['download_speed']);
        $this->assertEquals(9306569, $data['upload_speed']);
    }

    public function testCreateWithoutPayload()
    {
        $response = $this->post(
            '/api/v1/speedtest',
            [
                'hostname' => $this->faker->name,
                'ip' => $this->faker->ipv4,
                'file' => UploadedFile::fake()->createWithContent(
                    $this->faker->word,
                    file_get_contents(
                        __DIR__.'/../../Fixtures/speedtest.json'
                    )
                ),
            ]
        );

        $data = json_decode($response->getContent(), true);
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(451104, $data['download_speed']);
        $this->assertEquals(9306569, $data['upload_speed']);
    }
}
