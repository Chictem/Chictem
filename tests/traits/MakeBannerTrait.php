<?php

use Faker\Factory as Faker;
use App\Models\Banner;
use App\Repositories\BannerRepository;

trait MakeBannerTrait
{
    /**
     * Create fake instance of Banner and save it in database
     *
     * @param array $bannersFields
     * @return Banner
     */
    public function makeBanner($bannersFields = [])
    {
        /** @var BannerRepository $bannersRepo */
        $bannersRepo = App::make(BannerRepository::class);
        $theme = $this->fakeBannerData($bannersFields);
        return $bannersRepo->create($theme);
    }

    /**
     * Get fake instance of Banner
     *
     * @param array $bannersFields
     * @return Banner
     */
    public function fakeBanner($bannersFields = [])
    {
        return new Banner($this->fakeBannerData($bannersFields));
    }

    /**
     * Get fake data of Banner
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBannerData($bannersFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'title' => $fake->word,
            'user_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $bannersFields);
    }
}
