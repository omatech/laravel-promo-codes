<?php

namespace Omatech\LaravelPromoCodes\Tests\Migrations;

use Illuminate\Support\Facades\Schema;
use Omatech\LaravelPromoCodes\Tests\BaseTestCase;

class PromoCodesMigrationTableTest extends BaseTestCase
{
    public function test_check_table()
    {
        $this->assertTrue(Schema::hasTable('promo_codes'));
    }

    public function test_check_columns()
    {
        $columns = [
            'id',
            'type',
            'title',
            'pct_discount',
            'amount_discount',
            'pct_shipping_discount',
            'max_uses',
            'start_date',
            'end_date',
            'first_order_only',
            'one_use_only',
            'customer_one_use_only',
            'active',
            'code',
            'action',
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn('promo_codes', $column),
                'Error: column ' . $column . ' not exists in promo_codes table');
        }
    }
}