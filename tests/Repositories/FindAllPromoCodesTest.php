<?php

namespace Omatech\LaravelPromoCodes\Test\Repositories;

use Omatech\LaravelPromoCodes\Tests\RepositoriesBaseTestCase;

class FindAllPromoCodesTest extends RepositoriesBaseTestCase
{
    public function test_find_all()
    {
        $promoCodes = factory($this->promoCodeModelName, 10)->create()->toArray();

        $findAll = $this->findAllPromoCode->make();

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