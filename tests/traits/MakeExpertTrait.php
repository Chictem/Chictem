<?php

use Faker\Factory as Faker;
use App\Models\Expert;
use App\Repositories\ExpertRepository;

trait MakeExpertTrait
{
    /**
     * Create fake instance of Expert and save it in database
     *
     * @param array $expertFields
     * @return Expert
     */
    public function makeExpert($expertFields = [])
    {
        /** @var ExpertRepository $expertRepo */
        $expertRepo = App::make(ExpertRepository::class);
        $theme = $this->fakeExpertData($expertFields);
        return $expertRepo->create($theme);
    }

    /**
     * Get fake instance of Expert
     *
     * @param array $expertFields
     * @return Expert
     */
    public function fakeExpert($expertFields = [])
    {
        return new Expert($this->fakeExpertData($expertFields));
    }

    /**
     * Get fake data of Expert
     *
     * @param array $postFields
     * @return array
     */
    public function fakeExpertData($expertFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->text,
            'image' => $fake->word,
            'age' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $expertFields);
    }
}
