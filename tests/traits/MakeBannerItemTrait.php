<?php

use Faker\Factory as Faker;
use App\Models\BannerItem;
use App\Repositories\BannerItemRepository;

trait MakeBannerItemTrait
{
    /**
     * Create fake instance of BannerItem and save it in database
     *
     * @param array $bannerItemFields
     * @return BannerItem
     */
    public function makeBannerItem($bannerItemFields = [])
    {
        /** @var BannerItemRepository $bannerItemRepo */
        $bannerItemRepo = App::make(BannerItemRepository::class);
        $theme = $this->fakeBannerItemData($bannerItemFields);
        return $bannerItemRepo->create($theme);
    }

    /**
     * Get fake instance of BannerItem
     *
     * @param array $bannerItemFields
     * @return BannerItem
     */
    public function fakeBannerItem($bannerItemFields = [])
    {
        return new BannerItem($this->fakeBannerItemData($bannerItemFields));
    }

    /**
     * Get fake data of BannerItem
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBannerItemData($bannerItemFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->word,
            'banner_id' => $fake->randomDigitNotNull,
            'description' => $fake->text,
            'url' => $fake->word,
            'image' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $bannerItemFields);
    }
}
