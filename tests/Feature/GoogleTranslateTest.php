<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\GoogleTranslate\GoogleTranslateService;
use Mockery;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class GoogleTranslateTest extends TestCase
{
    use WithFaker,WithoutMiddleware;

    public function setUp():void
    {
        parent::setUp();
    }

    public function tearDown():void
    {
        Mockery::close();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_google_translate()
    {
        $mockGoogleTranslateService = Mockery::mock('\App\Services\GoogleTranslate\GoogleTranslateService');
        $mockTranslateClient = Mockery::mock('\Google\Cloud\Translate\V2\TranslateClient');

        $googleTranslateService  = new GoogleTranslateService($mockTranslateClient);

        $params  = (object)array('text' => 'this is test', 'language' => 'hi');

        $mockReportResponse = [
              "source" => "en",
              "input" => "this is test",
              "text" => "यह परीक्षा है",
              "model" => null
        ];

        $test = $mockTranslateClient->shouldReceive('translate')->once()->andReturn($mockReportResponse);
        $response  = $googleTranslateService->translateText($params);
        $this->assertArrayHasKey('translation', $response);
        
    }
}
