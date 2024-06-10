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
                'data' => '{"type":"result","timestamp":"2024-06-10T02:02:53Z","ping":{"jitter":4.491,"latency":18.494,"low":16.799,"high":26.205},"download":{"bandwidth":602542,"bytes":6863460,"elapsed":11602,"latency":{"iqm":535.118,"low":76.672,"high":1162.987,"jitter":84.513}},"upload":{"bandwidth":2889351,"bytes":39069387,"elapsed":14558,"latency":{"iqm":1789.350,"low":17.867,"high":2550.474,"jitter":100.279}},"packetLoss":0.46082949308755761,"isp":"CMC Telecom Infrastructure Company","interface":{"internalIp":"192.168.153.13","name":"en0","macAddr":"F4:D4:88:8A:45:EE","isVpn":false,"externalIp":"203.205.27.8"},"server":{"id":63853,"host":"speed.dptcloud.vn","port":8080,"name":"DPTCLOUD.VN","location":"Hồ Chi Minh","country":"Vietnam","ip":"103.252.92.183"},"result":{"id":"3144cce4-f455-4906-8e9c-a42da81e6a81","url":"https://www.speedtest.net/result/c/3144cce4-f455-4906-8e9c-a42da81e6a81","persisted":true}}'
            ]
        );

        $data = json_decode($response->getContent(), true);
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(602542, $data['download_speed']);
        $this->assertEquals(2889351, $data['upload_speed']);
    }

    public function testCreateWithoutPayload()
    {
        $response = $this->post(
            '/api/v1/speedtest',
            [
                'file' => UploadedFile::fake()->createWithContent(
                    'test',
                    '{"type":"result","timestamp":"2024-06-10T02:02:53Z","ping":{"jitter":4.491,"latency":18.494,"low":16.799,"high":26.205},"download":{"bandwidth":602542,"bytes":6863460,"elapsed":11602,"latency":{"iqm":535.118,"low":76.672,"high":1162.987,"jitter":84.513}},"upload":{"bandwidth":2889351,"bytes":39069387,"elapsed":14558,"latency":{"iqm":1789.350,"low":17.867,"high":2550.474,"jitter":100.279}},"packetLoss":0.46082949308755761,"isp":"CMC Telecom Infrastructure Company","interface":{"internalIp":"192.168.153.13","name":"en0","macAddr":"F4:D4:88:8A:45:EE","isVpn":false,"externalIp":"203.205.27.8"},"server":{"id":63853,"host":"speed.dptcloud.vn","port":8080,"name":"DPTCLOUD.VN","location":"Hồ Chi Minh","country":"Vietnam","ip":"103.252.92.183"},"result":{"id":"3144cce4-f455-4906-8e9c-a42da81e6a81","url":"https://www.speedtest.net/result/c/3144cce4-f455-4906-8e9c-a42da81e6a81","persisted":true}}'
                )
            ]
        );

        $data = json_decode($response->getContent(), true);
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(602542, $data['download_speed']);
        $this->assertEquals(2889351, $data['upload_speed']);
    }
}
