<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CourseApiTest extends TestCase
{
    use MakeCourseTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCourse()
    {
        $course = $this->fakeCourseData();
        $this->json('POST', '/api/v1/courses', $course);

        $this->assertApiResponse($course);
    }

    /**
     * @test
     */
    public function testReadCourse()
    {
        $course = $this->makeCourse();
        $this->json('GET', '/api/v1/courses/'.$course->id);

        $this->assertApiResponse($course->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCourse()
    {
        $course = $this->makeCourse();
        $editedCourse = $this->fakeCourseData();

        $this->json('PUT', '/api/v1/courses/'.$course->id, $editedCourse);

        $this->assertApiResponse($editedCourse);
    }

    /**
     * @test
     */
    public function testDeleteCourse()
    {
        $course = $this->makeCourse();
        $this->json('DELETE', '/api/v1/courses/'.$course->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/courses/'.$course->id);

        $this->assertResponseStatus(404);
    }
}
