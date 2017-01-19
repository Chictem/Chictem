<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagApiTest extends TestCase
{
    use MakeTagTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTag()
    {
        $tag = $this->fakeTagData();
        $this->json('POST', '/api/v1/tags', $tag);

        $this->assertApiResponse($tag);
    }

    /**
     * @test
     */
    public function testReadTag()
    {
        $tag = $this->makeTag();
        $this->json('GET', '/api/v1/tags/'.$tag->id);

        $this->assertApiResponse($tag->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTag()
    {
        $tag = $this->makeTag();
        $editedTag = $this->fakeTagData();

        $this->json('PUT', '/api/v1/tags/'.$tag->id, $editedTag);

        $this->assertApiResponse($editedTag);
    }

    /**
     * @test
     */
    public function testDeleteTag()
    {
        $tag = $this->makeTag();
        $this->json('DELETE', '/api/v1/tags/'.$tag->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/tags/'.$tag->id);

        $this->assertResponseStatus(404);
    }
}
