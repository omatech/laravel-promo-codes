<?php

namespace Omatech\LaravelPromoCodes\Test\Repositories;

use Omatech\LaravelPromoCodes\Tests\RepositoriesBaseTestCase;

class FindPromoCodeByCodeTest extends RepositoriesBaseTestCase
{
    public function test_find_existent_and_active_promo_code_by_code()
    {
        $promoCode = factory($this->promoCodeModelName)->create();

        $find = $this->findPromoCodeByCode->make($promoCode->code);

        $this->assertEquals($promoCode->id, $find->getId());
        $this->assertEquals($promoCode->code, $find->getCode());
    }
}