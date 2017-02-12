<?php

use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagRepositoryTest extends TestCase
{
    use MakeTagTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TagRepository
     */
    protected $tagRepo;

    public function setUp()
    {
        parent::setUp();
        $this->tagRepo = App::make(TagRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTag()
    {
        $tag = $this->fakeTagData();
        $createdTag = $this->tagRepo->create($tag);
        $createdTag = $createdTag->toArray();
        $this->assertArrayHasKey('id', $createdTag);
        $this->assertNotNull($createdTag['id'], 'Created Tag must have id specified');
        $this->assertNotNull(Tag::find($createdTag['id']), 'Tag with given id must be in DB');
        $this->assertModelData($tag, $createdTag);
    }

    /**
     * @test read
     */
    public function testReadTag()
    {
        $tag = $this->makeTag();
        $dbTag = $this->tagRepo->find($tag->id);
        $dbTag = $dbTag->toArray();
        $this->assertModelData($tag->toArray(), $dbTag);
    }

    /**
     * @test update
     */
    public function testUpdateTag()
    {
        $tag = $this->makeTag();
        $fakeTag = $this->fakeTagData();
        $updatedTag = $this->tagRepo->update($fakeTag, $tag->id);
        $this->assertModelData($fakeTag, $updatedTag->toArray());
        $dbTag = $this->tagRepo->find($tag->id);
        $this->assertModelData($fakeTag, $dbTag->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTag()
    {
        $tag = $this->makeTag();
        $resp = $this->tagRepo->delete($tag->id);
        $this->assertTrue($resp);
        $this->assertNull(Tag::find($tag->id), 'Tag should not exist in DB');
    }
}
