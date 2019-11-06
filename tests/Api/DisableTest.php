<?php
namespace Omatech\LaravelPromoCodes\Tests\Api;

use Omatech\LaravelPromoCodes\Tests\ApiTestCase;

class DisableTest extends ApiTestCase
{
    public function test_disable_an_active_code()
    {
        $promoCode = factory($this->promoCodeModelName)->create();

        $this->assertDatabaseHas('promo_codes', [
            'id' => $promoCode->id,
            'active' => true
        ]);

        $this->api->disable($promoCode->id);

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

        $this->api->disable($promoCode->id);

        $this->assertDatabaseHas('promo_codes', [
            'id' => $promoCode->id,
            'active' => false
        ]);
    }

    public function test_try_to_disable_nonexistent_code()
    {
        $this->expectException(\Exception::class);

        $this->api->disable(999);
    }
}