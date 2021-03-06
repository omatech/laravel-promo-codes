<?php

namespace Omatech\LaravelPromoCodes\Test\Repositories;

use Omatech\LaravelPromoCodes\Tests\RepositoriesBaseTestCase;

class FindPromoCodeTest extends RepositoriesBaseTestCase
{
    public function test_find_existent_and_active_promo_code_by_id()
    {
        $promoCode = factory($this->promoCodeModelName)->create();

        $find = $this->findPromoCode->make($promoCode->id);

        $this->assertEquals($promoCode->id, $find->getId());
        $this->assertEquals($promoCode->code, $find->getCode());
    }
}