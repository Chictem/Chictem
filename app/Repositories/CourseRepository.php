<?php

namespace App\Repositories;

use App\Models\Course;
use Germey\Generator\Common\BaseRepository;

class CourseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'url',
        'created_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Course::class;
    }
}
