<?php

namespace Omatech\LaravelPromoCodes\Tests\Api;

use Omatech\LaravelPromoCodes\Tests\ApiTestCase;

class FindAllTest extends ApiTestCase
{
    public function test_find_all_via_api()
    {
        $promoCodes = factory($this->promoCodeModelName, 10)->create()->toArray();

        $findAll = $this->api->findAll();

        $this->assertTrue(is_array($findAll));
        $this->assertEquals(10, count($findAll));
        $ids = array_column($promoCodes, 'id');
        $codes = array_column($promoCodes, 'code');

        foreach ($findAll as $promoCode) {
            $this->assertTrue(array_search($promoCode->getId(), $ids) !== false);
            $this->assertTrue(array_search($promoCode->getCode(), $codes) !== false);
        }
    }
}