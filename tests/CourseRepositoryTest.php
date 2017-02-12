<?php

use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CourseRepositoryTest extends TestCase
{
    use MakeCourseTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CourseRepository
     */
    protected $courseRepo;

    public function setUp()
    {
        parent::setUp();
        $this->courseRepo = App::make(CourseRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCourse()
    {
        $course = $this->fakeCourseData();
        $createdCourse = $this->courseRepo->create($course);
        $createdCourse = $createdCourse->toArray();
        $this->assertArrayHasKey('id', $createdCourse);
        $this->assertNotNull($createdCourse['id'], 'Created Course must have id specified');
        $this->assertNotNull(Course::find($createdCourse['id']), 'Course with given id must be in DB');
        $this->assertModelData($course, $createdCourse);
    }

    /**
     * @test read
     */
    public function testReadCourse()
    {
        $course = $this->makeCourse();
        $dbCourse = $this->courseRepo->find($course->id);
        $dbCourse = $dbCourse->toArray();
        $this->assertModelData($course->toArray(), $dbCourse);
    }

    /**
     * @test update
     */
    public function testUpdateCourse()
    {
        $course = $this->makeCourse();
        $fakeCourse = $this->fakeCourseData();
        $updatedCourse = $this->courseRepo->update($fakeCourse, $course->id);
        $this->assertModelData($fakeCourse, $updatedCourse->toArray());
        $dbCourse = $this->courseRepo->find($course->id);
        $this->assertModelData($fakeCourse, $dbCourse->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCourse()
    {
        $course = $this->makeCourse();
        $resp = $this->courseRepo->delete($course->id);
        $this->assertTrue($resp);
        $this->assertNull(Course::find($course->id), 'Course should not exist in DB');
    }
}
