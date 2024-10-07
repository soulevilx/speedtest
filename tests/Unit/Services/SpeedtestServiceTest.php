<?php

namespace Tests\Unit\Services;

use App\Services\Speedtest\Entities\DownloadEntity;
use App\Services\Speedtest\Entities\InterfaceEntity;
use App\Services\Speedtest\Entities\PingEntity;
use App\Services\Speedtest\Entities\ResultEntity;
use App\Services\Speedtest\Entities\ServerEntity;
use App\Services\Speedtest\Entities\SpeedtestEntity;
use App\Services\Speedtest\Entities\UploadEntity;
use App\Services\Speedtest\Interfaces\ISpeedtestExecutor;
use App\Services\Speedtest\SpeedtestService;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class SpeedtestServiceTest extends TestCase
{
    public function testSpeedtest()
    {
        $this->instance(
            ISpeedtestExecutor::class,
            Mockery::mock(
                ISpeedtestExecutor::class,
                function (MockInterface $mock) {
                    $mock->shouldReceive('execute')
                        ->andReturn(
                            file_get_contents(
                                __DIR__ . '/../../Fixtures/speedtest.json'
                            )
                        );
                }
            )
        );

        $service = app(SpeedtestService::class);
        $result = $service->speedtest();
        $this->assertInstanceOf(SpeedtestEntity::class, $result);
        $this->assertInstanceOf(DownloadEntity::class, $result->getDownload());
        $this->assertInstanceOf(
            InterfaceEntity::class,
            $result->getInterface()
        );
        $this->assertInstanceOf(PingEntity::class, $result->getPing());
        $this->assertInstanceOf(ResultEntity::class, $result->getResult());
        $this->assertInstanceOf(ServerEntity::class, $result->getServer());
        $this->assertInstanceOf(UploadEntity::class, $result->getUpload());

        $this->assertEquals('2024-10-07', $result->getTime()->format('Y-m-d'));
        $this->assertEquals(15.879, $result->getPing()->jitter);
        $this->assertTrue(
            filter_var($result->getResultUrl(), FILTER_VALIDATE_URL) !== false
        );

        $hostname = $this->faker->name;
        $ip = $this->faker->ipv4;
        $service->save($hostname, $ip, $result);
        $this->assertDatabaseHas('speedtest', [
            'hostname' => $hostname,
            'ip' => $ip,
        ]);
    }
}
