<?php

use App\Models\Banner;
use App\Repositories\BannerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BannerRepositoryTest extends TestCase
{
    use MakeBannerTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BannerRepository
     */
    protected $bannersRepo;

    public function setUp()
    {
        parent::setUp();
        $this->bannersRepo = App::make(BannerRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateBanner()
    {
        $banners = $this->fakeBannerData();
        $createdBanner = $this->bannersRepo->create($banners);
        $createdBanner = $createdBanner->toArray();
        $this->assertArrayHasKey('id', $createdBanner);
        $this->assertNotNull($createdBanner['id'], 'Created Banner must have id specified');
        $this->assertNotNull(Banner::find($createdBanner['id']), 'Banner with given id must be in DB');
        $this->assertModelData($banners, $createdBanner);
    }

    /**
     * @test read
     */
    public function testReadBanner()
    {
        $banners = $this->makeBanner();
        $dbBanner = $this->bannersRepo->find($banners->id);
        $dbBanner = $dbBanner->toArray();
        $this->assertModelData($banners->toArray(), $dbBanner);
    }

    /**
     * @test update
     */
    public function testUpdateBanner()
    {
        $banners = $this->makeBanner();
        $fakeBanner = $this->fakeBannerData();
        $updatedBanner = $this->bannersRepo->update($fakeBanner, $banners->id);
        $this->assertModelData($fakeBanner, $updatedBanner->toArray());
        $dbBanner = $this->bannersRepo->find($banners->id);
        $this->assertModelData($fakeBanner, $dbBanner->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteBanner()
    {
        $banners = $this->makeBanner();
        $resp = $this->bannersRepo->delete($banners->id);
        $this->assertTrue($resp);
        $this->assertNull(Banner::find($banners->id), 'Banner should not exist in DB');
    }
}
