<?php

namespace Omatech\LaravelPromoCodes\Test\Repositories;

use Omatech\LaravelPromoCodes\Contracts\PromoCode;
use Omatech\LaravelPromoCodes\Tests\RepositoriesBaseTestCase;
use Omatech\LaravelPromoCodes\Tests\Resources\UserTestModel;

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

    public function test_generate_new_promo_code_with_prefix()
    {
        $prefix = 'TEST';
        $data = factory($this->promoCodeModelName)->make()->toArray();
        unset($data['code']);
        $data['prefix'] = $prefix;

        $generate = $this->generatePromoCode->make($data);

        $this->assertTrue(strpos($generate->getCode(), 'TEST') !== false);

        $this->assertDatabaseHas('promo_codes', [
            'id' => $generate->getId(),
            'code' => $generate->getCode(),
        ]);
    }

    public function test_generate_new_promo_code_for_specific_user()
    {
        $data = factory($this->promoCodeModelName)->make()->toArray();
        unset($data['code']);

        $data['related_id'] = 1;
        $data['related_type'] = UserTestModel::class;

        $generate = $this->generatePromoCode->make($data);

        $this->assertDatabaseHas('promo_codes', [
            'id' => $generate->getId(),
            'code' => $generate->getCode(),
        ]);

        $this->assertDatabaseHas('model_promo_codes', [
            'promo_code_id' => $generate->getId(),
            'model_id' => 1,
            'model_type' => UserTestModel::class,
        ]);
    }

}