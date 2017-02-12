<?php

use Faker\Factory as Faker;
use App\Models\Teacher;
use App\Repositories\TeacherRepository;

trait MakeTeacherTrait
{
    /**
     * Create fake instance of Teacher and save it in database
     *
     * @param array $teacherFields
     * @return Teacher
     */
    public function makeTeacher($teacherFields = [])
    {
        /** @var TeacherRepository $teacherRepo */
        $teacherRepo = App::make(TeacherRepository::class);
        $theme = $this->fakeTeacherData($teacherFields);
        return $teacherRepo->create($theme);
    }

    /**
     * Get fake instance of Teacher
     *
     * @param array $teacherFields
     * @return Teacher
     */
    public function fakeTeacher($teacherFields = [])
    {
        return new Teacher($this->fakeTeacherData($teacherFields));
    }

    /**
     * Get fake data of Teacher
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTeacherData($teacherFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'image' => $fake->word,
            'description' => $fake->text,
            'job' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $teacherFields);
    }
}
