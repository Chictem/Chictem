<?php

use Faker\Factory as Faker;
use App\Models\Tag;
use App\Repositories\TagRepository;

trait MakeTagTrait
{
    /**
     * Create fake instance of Tag and save it in database
     *
     * @param array $tagFields
     * @return Tag
     */
    public function makeTag($tagFields = [])
    {
        /** @var TagRepository $tagRepo */
        $tagRepo = App::make(TagRepository::class);
        $theme = $this->fakeTagData($tagFields);
        return $tagRepo->create($theme);
    }

    /**
     * Get fake instance of Tag
     *
     * @param array $tagFields
     * @return Tag
     */
    public function fakeTag($tagFields = [])
    {
        return new Tag($this->fakeTagData($tagFields));
    }

    /**
     * Get fake data of Tag
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTagData($tagFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->text,
            'user_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $tagFields);
    }
}
