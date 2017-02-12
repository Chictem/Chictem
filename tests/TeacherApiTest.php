<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeacherApiTest extends TestCase
{
    use MakeTeacherTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTeacher()
    {
        $teacher = $this->fakeTeacherData();
        $this->json('POST', '/api/v1/teachers', $teacher);

        $this->assertApiResponse($teacher);
    }

    /**
     * @test
     */
    public function testReadTeacher()
    {
        $teacher = $this->makeTeacher();
        $this->json('GET', '/api/v1/teachers/'.$teacher->id);

        $this->assertApiResponse($teacher->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTeacher()
    {
        $teacher = $this->makeTeacher();
        $editedTeacher = $this->fakeTeacherData();

        $this->json('PUT', '/api/v1/teachers/'.$teacher->id, $editedTeacher);

        $this->assertApiResponse($editedTeacher);
    }

    /**
     * @test
     */
    public function testDeleteTeacher()
    {
        $teacher = $this->makeTeacher();
        $this->json('DELETE', '/api/v1/teachers/'.$teacher->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/teachers/'.$teacher->id);

        $this->assertResponseStatus(404);
    }
}
