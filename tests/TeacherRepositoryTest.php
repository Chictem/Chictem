<?php

use App\Models\Teacher;
use App\Repositories\TeacherRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeacherRepositoryTest extends TestCase
{
    use MakeTeacherTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TeacherRepository
     */
    protected $teacherRepo;

    public function setUp()
    {
        parent::setUp();
        $this->teacherRepo = App::make(TeacherRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTeacher()
    {
        $teacher = $this->fakeTeacherData();
        $createdTeacher = $this->teacherRepo->create($teacher);
        $createdTeacher = $createdTeacher->toArray();
        $this->assertArrayHasKey('id', $createdTeacher);
        $this->assertNotNull($createdTeacher['id'], 'Created Teacher must have id specified');
        $this->assertNotNull(Teacher::find($createdTeacher['id']), 'Teacher with given id must be in DB');
        $this->assertModelData($teacher, $createdTeacher);
    }

    /**
     * @test read
     */
    public function testReadTeacher()
    {
        $teacher = $this->makeTeacher();
        $dbTeacher = $this->teacherRepo->find($teacher->id);
        $dbTeacher = $dbTeacher->toArray();
        $this->assertModelData($teacher->toArray(), $dbTeacher);
    }

    /**
     * @test update
     */
    public function testUpdateTeacher()
    {
        $teacher = $this->makeTeacher();
        $fakeTeacher = $this->fakeTeacherData();
        $updatedTeacher = $this->teacherRepo->update($fakeTeacher, $teacher->id);
        $this->assertModelData($fakeTeacher, $updatedTeacher->toArray());
        $dbTeacher = $this->teacherRepo->find($teacher->id);
        $this->assertModelData($fakeTeacher, $dbTeacher->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTeacher()
    {
        $teacher = $this->makeTeacher();
        $resp = $this->teacherRepo->delete($teacher->id);
        $this->assertTrue($resp);
        $this->assertNull(Teacher::find($teacher->id), 'Teacher should not exist in DB');
    }
}
