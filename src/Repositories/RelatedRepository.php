<?php

namespace Omatech\LaravelPromoCodes\Repositories;

use Omatech\LaravelPromoCodes\Models\RelatedModel;

class RelatedRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function model()
    {
        return RelatedModel::class;
    }
}