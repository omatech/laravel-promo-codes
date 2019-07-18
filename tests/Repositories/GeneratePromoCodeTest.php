<?php

namespace Omatech\LaravelPromoCodes\Test\Repositories;

use Omatech\LaravelPromoCodes\Contracts\PromoCode;
use Omatech\LaravelPromoCodes\Tests\RepositoriesBaseTestCase;

class GeneratePromoCodeTest extends RepositoriesBaseTestCase
{
    public function test_generate_new_promo_code_without_code()
    {
        $data = factory($this->promoCodeModelName)->make()->toArray();
        unset($data['code']);

        $generate = $this->generatePromoCode->make($data);

        $this->assertTrue(is_a($generate, PromoCode::class));

        $this->assertDatabaseHas('promo_codes', [
            'id' => $generate->getId(),
            'code' => $generate->getCode()
        ]);
    }

    public function test_generate_new_promo_code_with_nonexistent_code()
    {
        $data = factory($this->promoCodeModelName)->make()->toArray();

        $generate = $this->generatePromoCode->make($data);

        $this->assertTrue(is_a($generate, PromoCode::class));

        $this->assertDatabaseHas('promo_codes', [
            'id' => $generate->getId(),
            'code' => $generate->getCode()
        ]);
    }

    public function test_generate_new_promo_code_with_existent_code()
    {
        $this->expectException(\Exception::class);

        $existentPromoCode = factory($this->promoCodeModelName)->create();
        $data = factory($this->promoCodeModelName)->make([
            'code' => $existentPromoCode->code,
        ])->toArray();

        $generate = $this->generatePromoCode->make($data);

        $this->assertDatabaseMissing('promo_codes', [
            'id' => $generate->getId(),
            'code' => $generate->getCode()
        ]);
    }

}