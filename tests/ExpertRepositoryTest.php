<?php

use App\Models\Expert;
use App\Repositories\ExpertRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExpertRepositoryTest extends TestCase
{
    use MakeExpertTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ExpertRepository
     */
    protected $expertRepo;

    public function setUp()
    {
        parent::setUp();
        $this->expertRepo = App::make(ExpertRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateExpert()
    {
        $expert = $this->fakeExpertData();
        $createdExpert = $this->expertRepo->create($expert);
        $createdExpert = $createdExpert->toArray();
        $this->assertArrayHasKey('id', $createdExpert);
        $this->assertNotNull($createdExpert['id'], 'Created Expert must have id specified');
        $this->assertNotNull(Expert::find($createdExpert['id']), 'Expert with given id must be in DB');
        $this->assertModelData($expert, $createdExpert);
    }

    /**
     * @test read
     */
    public function testReadExpert()
    {
        $expert = $this->makeExpert();
        $dbExpert = $this->expertRepo->find($expert->id);
        $dbExpert = $dbExpert->toArray();
        $this->assertModelData($expert->toArray(), $dbExpert);
    }

    /**
     * @test update
     */
    public function testUpdateExpert()
    {
        $expert = $this->makeExpert();
        $fakeExpert = $this->fakeExpertData();
        $updatedExpert = $this->expertRepo->update($fakeExpert, $expert->id);
        $this->assertModelData($fakeExpert, $updatedExpert->toArray());
        $dbExpert = $this->expertRepo->find($expert->id);
        $this->assertModelData($fakeExpert, $dbExpert->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteExpert()
    {
        $expert = $this->makeExpert();
        $resp = $this->expertRepo->delete($expert->id);
        $this->assertTrue($resp);
        $this->assertNull(Expert::find($expert->id), 'Expert should not exist in DB');
    }
}
