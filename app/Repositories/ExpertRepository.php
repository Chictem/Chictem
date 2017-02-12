<?php

namespace App\Repositories;

use App\Models\Expert;
use Germey\Generator\Common\BaseRepository;

class ExpertRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'image',
        'age'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Expert::class;
    }
}
