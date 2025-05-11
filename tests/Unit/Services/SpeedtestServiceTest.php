<?php

namespace Tests\Unit\Services;

use App\Entities\Speedtest\DownloadEntity;
use App\Entities\Speedtest\InterfaceEntity;
use App\Entities\Speedtest\PingEntity;
use App\Entities\Speedtest\ResultEntity;
use App\Entities\Speedtest\ServerEntity;
use App\Entities\Speedtest\UploadEntity;
use App\Entities\SpeedtestEntity;
use App\Services\Process\Interfaces\IProcess;
use App\Services\Speedtest\SpeedtestService;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class SpeedtestServiceTest extends TestCase
{
    public function testSpeedtest()
    {
        $this->instance(
            IProcess::class,
            Mockery::mock(
                IProcess::class,
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
        $this->assertDatabaseHas('speedtests', [
            'hostname' => $hostname,
            'ip' => $ip,
        ]);
    }
}
