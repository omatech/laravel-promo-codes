<?php

namespace Omatech\LaravelPromoCodes\Tests\Api;

use Omatech\LaravelPromoCodes\Contracts\PromoCode;
use Omatech\LaravelPromoCodes\Tests\ApiTestCase;

class GenerateTest extends ApiTestCase
{
    public function test_generate_promo_code_via_api()
    {
        $data = factory($this->promoCodeModelName)->make()->toArray();
        unset($data['code']);

        $generate = $this->api->generate($data);
        $this->assertTrue(is_a($generate, PromoCode::class));

        $this->assertDatabaseHas('promo_codes', [
            'id' => $generate->getId(),
            'code' => $generate->getCode()
        ]);
    }
}