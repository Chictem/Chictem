<?php

use App\Models\BannerItem;
use App\Repositories\BannerItemRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BannerItemRepositoryTest extends TestCase
{
    use MakeBannerItemTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BannerItemRepository
     */
    protected $bannerItemRepo;

    public function setUp()
    {
        parent::setUp();
        $this->bannerItemRepo = App::make(BannerItemRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateBannerItem()
    {
        $bannerItem = $this->fakeBannerItemData();
        $createdBannerItem = $this->bannerItemRepo->create($bannerItem);
        $createdBannerItem = $createdBannerItem->toArray();
        $this->assertArrayHasKey('id', $createdBannerItem);
        $this->assertNotNull($createdBannerItem['id'], 'Created BannerItem must have id specified');
        $this->assertNotNull(BannerItem::find($createdBannerItem['id']), 'BannerItem with given id must be in DB');
        $this->assertModelData($bannerItem, $createdBannerItem);
    }

    /**
     * @test read
     */
    public function testReadBannerItem()
    {
        $bannerItem = $this->makeBannerItem();
        $dbBannerItem = $this->bannerItemRepo->find($bannerItem->id);
        $dbBannerItem = $dbBannerItem->toArray();
        $this->assertModelData($bannerItem->toArray(), $dbBannerItem);
    }

    /**
     * @test update
     */
    public function testUpdateBannerItem()
    {
        $bannerItem = $this->makeBannerItem();
        $fakeBannerItem = $this->fakeBannerItemData();
        $updatedBannerItem = $this->bannerItemRepo->update($fakeBannerItem, $bannerItem->id);
        $this->assertModelData($fakeBannerItem, $updatedBannerItem->toArray());
        $dbBannerItem = $this->bannerItemRepo->find($bannerItem->id);
        $this->assertModelData($fakeBannerItem, $dbBannerItem->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteBannerItem()
    {
        $bannerItem = $this->makeBannerItem();
        $resp = $this->bannerItemRepo->delete($bannerItem->id);
        $this->assertTrue($resp);
        $this->assertNull(BannerItem::find($bannerItem->id), 'BannerItem should not exist in DB');
    }
}
