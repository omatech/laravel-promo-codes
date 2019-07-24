<?php

namespace Omatech\LaravelPromoCodes\Repositories\Related;

use Omatech\LaravelPromoCodes\Repositories\RelatedRepository;
use Omatech\LaravelPromoCodes\Values\Relation;

class CheckRelated extends RelatedRepository implements \Omatech\LaravelPromoCodes\Contracts\CheckRelated
{
    /**
     * @param Relation $relation
     * @return bool
     */
    public function make(Relation $relation): bool
    {
        $model = $this->model
            ->where('promo_code_id', $relation->getPromoCodeId())
            ->where('model_id', $relation->getModelId())
            ->where('model_type', $relation->getModelType())
            ->first();

        return !is_null($model);
    }
}