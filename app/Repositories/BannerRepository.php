<?php

namespace App\Repositories;

use App\Models\Banner;
use Germey\Generator\Common\BaseRepository;

class BannerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'title'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Banner::class;
    }
}
