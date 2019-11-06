<?php

namespace Omatech\LaravelPromoCodes\Test\Repositories;

use Omatech\LaravelPromoCodes\Tests\RepositoriesBaseTestCase;

class UpdatePromoCodeTest extends RepositoriesBaseTestCase
{
    public function test_update_title()
    {
        $title = 'New Title';
        $data = factory($this->promoCodeModelName)->create()->toArray();

        $data['title'] = $title;

        $this->updatePromoCode->make($data['id'], $this->promoCodeDomain->fromArray($data));

        $this->assertDatabaseHas('promo_codes', [
            'id' => $data['id'],
            'title' => $title,
        ]);
    }

    public function test_its_not_possible_to_update_code()
    {
        $code = 'NEWCODE';
        $data = factory($this->promoCodeModelName)->create()->toArray();

        $data['code'] = $code;

        $this->updatePromoCode->make($data['id'], $this->promoCodeDomain->fromArray($data));

        $this->assertDatabaseMissing('promo_codes', [
            'id' => $data['id'],
            'code' => $code,
        ]);
    }

    public function test_its_not_possible_to_update_active_directly()
    {
        $active = false;
        $data = factory($this->promoCodeModelName)->create()->toArray();

        $data['active'] = $active;

        $this->updatePromoCode->make($data['id'], $this->promoCodeDomain->fromArray($data));

        $this->assertDatabaseMissing('promo_codes', [
            'id' => $data['id'],
            'active' => $active,
        ]);
    }
}