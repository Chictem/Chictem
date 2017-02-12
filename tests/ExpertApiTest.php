<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExpertApiTest extends TestCase
{
    use MakeExpertTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateExpert()
    {
        $expert = $this->fakeExpertData();
        $this->json('POST', '/api/v1/experts', $expert);

        $this->assertApiResponse($expert);
    }

    /**
     * @test
     */
    public function testReadExpert()
    {
        $expert = $this->makeExpert();
        $this->json('GET', '/api/v1/experts/'.$expert->id);

        $this->assertApiResponse($expert->toArray());
    }

    /**
     * @test
     */
    public function testUpdateExpert()
    {
        $expert = $this->makeExpert();
        $editedExpert = $this->fakeExpertData();

        $this->json('PUT', '/api/v1/experts/'.$expert->id, $editedExpert);

        $this->assertApiResponse($editedExpert);
    }

    /**
     * @test
     */
    public function testDeleteExpert()
    {
        $expert = $this->makeExpert();
        $this->json('DELETE', '/api/v1/experts/'.$expert->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/experts/'.$expert->id);

        $this->assertResponseStatus(404);
    }
}
