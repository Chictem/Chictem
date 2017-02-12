<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BannerApiTest extends TestCase
{
    use MakeBannerTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBanner()
    {
        $banners = $this->fakeBannerData();
        $this->json('POST', '/api/v1/banners', $banners);

        $this->assertApiResponse($banners);
    }

    /**
     * @test
     */
    public function testReadBanner()
    {
        $banners = $this->makeBanner();
        $this->json('GET', '/api/v1/banners/'.$banners->id);

        $this->assertApiResponse($banners->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBanner()
    {
        $banners = $this->makeBanner();
        $editedBanner = $this->fakeBannerData();

        $this->json('PUT', '/api/v1/banners/'.$banners->id, $editedBanner);

        $this->assertApiResponse($editedBanner);
    }

    /**
     * @test
     */
    public function testDeleteBanner()
    {
        $banners = $this->makeBanner();
        $this->json('DELETE', '/api/v1/banners/'.$banners->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/banners/'.$banners->id);

        $this->assertResponseStatus(404);
    }
}
