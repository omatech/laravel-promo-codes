<?php

namespace Omatech\LaravelPromoCodes\Contracts;

use Omatech\LaravelPromoCodes\Values\Relation;

interface CheckRelated
{
    public function make(Relation $relation): bool;
}