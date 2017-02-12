<?php

namespace App\Repositories;

use App\Models\BannerItem;
use Germey\Generator\Common\BaseRepository;

class BannerItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'url',
        'image'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return BannerItem::class;
    }
}
