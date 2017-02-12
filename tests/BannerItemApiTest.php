<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BannerItemApiTest extends TestCase
{
    use MakeBannerItemTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBannerItem()
    {
        $bannerItem = $this->fakeBannerItemData();
        $this->json('POST', '/api/v1/bannerItems', $bannerItem);

        $this->assertApiResponse($bannerItem);
    }

    /**
     * @test
     */
    public function testReadBannerItem()
    {
        $bannerItem = $this->makeBannerItem();
        $this->json('GET', '/api/v1/bannerItems/'.$bannerItem->id);

        $this->assertApiResponse($bannerItem->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBannerItem()
    {
        $bannerItem = $this->makeBannerItem();
        $editedBannerItem = $this->fakeBannerItemData();

        $this->json('PUT', '/api/v1/bannerItems/'.$bannerItem->id, $editedBannerItem);

        $this->assertApiResponse($editedBannerItem);
    }

    /**
     * @test
     */
    public function testDeleteBannerItem()
    {
        $bannerItem = $this->makeBannerItem();
        $this->json('DELETE', '/api/v1/bannerItems/'.$bannerItem->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/bannerItems/'.$bannerItem->id);

        $this->assertResponseStatus(404);
    }
}
