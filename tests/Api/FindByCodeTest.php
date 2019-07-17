<?php

namespace Omatech\LaravelPromoCodes\Tests\Api;

use Omatech\LaravelPromoCodes\Tests\ApiTestCase;

class FindByCodeTest extends ApiTestCase
{
    public function test_find_existent_and_active_promo_code_by_code_via_api()
    {
        $promoCode = factory($this->promoCodeModelName)->create();

        $find = $this->api->findByCode($promoCode->code);

        $this->assertEquals($promoCode->code, $find->getCode());
    }
}