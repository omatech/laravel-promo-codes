<?php

namespace Omatech\LaravelPromoCodes\Tests\Api;

use Omatech\LaravelPromoCodes\Tests\ApiTestCase;

class UpdateTest extends ApiTestCase
{
    public function test_update_via_api()
    {
        $title = 'New Title';
        $data = factory($this->promoCodeModelName)->create()->toArray();

        $data['title'] = $title;

        $this->api->update($data['id'], $data);

        $this->assertDatabaseHas('promo_codes', [
            'id' => $data['id'],
            'title' => $title,
        ]);
    }
}