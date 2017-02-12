<?php

use Faker\Factory as Faker;
use App\Models\Course;
use App\Repositories\CourseRepository;

trait MakeCourseTrait
{
    /**
     * Create fake instance of Course and save it in database
     *
     * @param array $courseFields
     * @return Course
     */
    public function makeCourse($courseFields = [])
    {
        /** @var CourseRepository $courseRepo */
        $courseRepo = App::make(CourseRepository::class);
        $theme = $this->fakeCourseData($courseFields);
        return $courseRepo->create($theme);
    }

    /**
     * Get fake instance of Course
     *
     * @param array $courseFields
     * @return Course
     */
    public function fakeCourse($courseFields = [])
    {
        return new Course($this->fakeCourseData($courseFields));
    }

    /**
     * Get fake data of Course
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCourseData($courseFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->text,
            'url' => $fake->word,
            'created_at' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $courseFields);
    }
}
