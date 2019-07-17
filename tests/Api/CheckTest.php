<?php
namespace Omatech\LaravelPromoCodes\Tests\Api;

use Omatech\LaravelPromoCodes\Tests\ApiTestCase;

class CheckTest extends ApiTestCase
{
    public function test_check_when_code_exists_and_is_active()
    {
        $promoCode = factory($this->promoCodeModelName)->create();
        $userId = 0;//TODO
        $check = $this->api->check($promoCode->code, $userId);

        $this->assertTrue(is_bool($check));
        $this->assertTrue($check);
    }

    public function test_check_when_code_exists_but_is_not_active()
    {
        $promoCode = factory($this->promoCodeModelName)->create([
            'active' => false
        ]);
        $userId = 0;//TODO
        $check = $this->api->check($promoCode->code, $userId);

        $this->assertTrue(is_bool($check));
        $this->assertFalse($check);
    }

    public function test_check_when_code_not_exists()
    {
        $userId = 0;//TODO
        $check = $this->api->check('TEST123456789', $userId);

        $this->assertTrue(is_bool($check));
        $this->assertFalse($check);
    }

    public function test_check_when_code_exists_but_is_expired()
    {
        $promoCode = factory($this->promoCodeModelName)->state('expired')->create();
        $userId = 0;//TODO
        $check = $this->api->check($promoCode->code, $userId);

        $this->assertTrue(is_bool($check));
        $this->assertFalse($check);
    }

    public function test_check_when_code_exists_but_is_not_started()
    {
        $promoCode = factory($this->promoCodeModelName)->state('not-started')->create();
        $userId = 0;//TODO
        $check = $this->api->check($promoCode->code, $userId);

        $this->assertTrue(is_bool($check));
        $this->assertFalse($check);
    }
}