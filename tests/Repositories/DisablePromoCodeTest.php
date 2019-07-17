<?php

namespace Omatech\LaravelPromoCodes\Test\Repositories;

use Omatech\LaravelPromoCodes\Tests\RepositoriesBaseTestCase;

class DisablePromoCodeTest extends RepositoriesBaseTestCase
{
    public function test_disable_an_active_code()
    {
        $promoCode = factory($this->promoCodeModelName)->create();

        $this->assertDatabaseHas('promo_codes', [
            'id' => $promoCode->id,
            'active' => true
        ]);

        $this->disablePromoCode->make($promoCode->id);

        $this->assertDatabaseHas('promo_codes', [
            'id' => $promoCode->id,
            'active' => false
        ]);

    }

    public function test_disable_nonactive_code()
    {
        $promoCode = factory($this->promoCodeModelName)->create([
            'active' => false
        ]);

        $this->assertDatabaseHas('promo_codes', [
            'id' => $promoCode->id,
            'active' => false
        ]);

        $this->disablePromoCode->make($promoCode->id);

        $this->assertDatabaseHas('promo_codes', [
            'id' => $promoCode->id,
            'active' => false
        ]);
    }

    public function test_try_to_disable_nonexistent_code()
    {
        $this->expectException(\Exception::class);

        $this->disablePromoCode->make(999);
    }
}