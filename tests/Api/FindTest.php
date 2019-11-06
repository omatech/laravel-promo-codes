<?php

namespace Omatech\LaravelPromoCodes\Tests\Api;

use Omatech\LaravelPromoCodes\Tests\ApiTestCase;

class FindTest extends ApiTestCase
{
    public function test_find_existent_and_active_promo_code_by_id_via_api()
    {
        $promoCode = factory($this->promoCodeModelName)->create();

        $find = $this->api->find($promoCode->id);

        $this->assertEquals($promoCode->id, $find->getId());
    }
}