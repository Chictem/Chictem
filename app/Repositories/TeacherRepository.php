<?php

namespace App\Repositories;

use App\Models\Teacher;
use Germey\Generator\Common\BaseRepository;

class TeacherRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'image',
        'description',
        'job'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Teacher::class;
    }
}
