<?php

namespace Omatech\LaravelPromoCodes\Domains;

use Illuminate\Support\Str;
use Omatech\LaravelPromoCodes\Contracts\DisablePromoCode;
use Omatech\LaravelPromoCodes\Contracts\FindPromoCode;
use Omatech\LaravelPromoCodes\Contracts\FindPromoCodeByCode;
use Omatech\LaravelPromoCodes\Contracts\GeneratePromoCode;
use Omatech\LaravelPromoCodes\Contracts\PromoCode as PromoCodeInterface;

class PromoCode implements PromoCodeInterface
{
    private $id;
    private $type;
    private $title;
    private $pctDiscount;
    private $amountDiscount;
    private $pctShippingDiscount;
    private $maxUses;
    private $startDate;
    private $endDate;
    private $firstOrderOnly;
    private $oneUseOnly;
    private $customerOneUseOnly;
    private $active;
    private $code;
    private $action;

    /**
     * @param int $id
     * @return null|PromoCodeInterface
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function find(int $id): ?PromoCodeInterface
    {
        return app()->make(FindPromoCode::class)->make($id);
    }

    /**
     * @param string $code
     * @return null|PromoCodeInterface
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function findByCode(string $code): ?PromoCodeInterface
    {
        return app()->make(FindPromoCodeByCode::class)->make($code);
    }

    /**
     * @param array $data
     * @return null|PromoCodeInterface
     */
    public function fromArray(array $data): ?PromoCodeInterface
    {
        $fillable = [
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
        ];

        foreach ($fillable as $field) {
            $camelField = Str::camel($field);
            $snakeField = Str::snake($field);
            $setter = 'set' . $camelField;

            if (key_exists($field, $data)) {
                $value = $data[$field];
            } elseif (key_exists($camelField, $data)) {
                $value = $data[$camelField];
            } elseif (key_exists($snakeField, $data)) {
                $value = $data[$snakeField];
            } else {
                continue;
            }

            if (method_exists($this, $setter)) {
                $this->{$setter}($value);
            }
        }

        return $this;
    }

    /**
     * @param int $id
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function disable(int $id): void
    {
        app()->make(DisablePromoCode::class)->make($id);
    }

    /**
     * @param array $data
     * @return PromoCodeInterface
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function generate(array $data): PromoCodeInterface
    {
        return app()->make(GeneratePromoCode::class)->make($data);
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isActive()
            && $this->isStarted()
            && !$this->isExpired();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getPctDiscount()
    {
        return $this->pctDiscount;
    }

    /**
     * @param mixed $pctDiscount
     */
    public function setPctDiscount($pctDiscount): void
    {
        $this->pctDiscount = $pctDiscount;
    }

    /**
     * @return mixed
     */
    public function getAmountDiscount()
    {
        return $this->amountDiscount;
    }

    /**
     * @param mixed $amountDiscount
     */
    public function setAmountDiscount($amountDiscount): void
    {
        $this->amountDiscount = $amountDiscount;
    }

    /**
     * @return mixed
     */
    public function getPctShippingDiscount()
    {
        return $this->pctShippingDiscount;
    }

    /**
     * @param mixed $pctShippingDiscount
     */
    public function setPctShippingDiscount($pctShippingDiscount): void
    {
        $this->pctShippingDiscount = $pctShippingDiscount;
    }

    /**
     * @return mixed
     */
    public function getMaxUses()
    {
        return $this->maxUses;
    }

    /**
     * @param mixed $maxUses
     */
    public function setMaxUses($maxUses): void
    {
        $this->maxUses = $maxUses;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return bool
     */
    public function isStarted()
    {
        return $this->startDate < now();
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        return $this->endDate < now();
    }

    /**
     * @return mixed
     */
    public function getFirstOrderOnly()
    {
        return $this->firstOrderOnly;
    }

    /**
     * @param mixed $firstOrderOnly
     */
    public function setFirstOrderOnly(bool $firstOrderOnly): void
    {
        $this->firstOrderOnly = $firstOrderOnly;
    }

    /**
     * @return mixed
     */
    public function getOneUseOnly()
    {
        return $this->oneUseOnly;
    }

    /**
     * @param mixed $oneUseOnly
     */
    public function setOneUseOnly(bool $oneUseOnly): void
    {
        $this->oneUseOnly = $oneUseOnly;
    }

    /**
     * @return mixed
     */
    public function getCustomerOneUseOnly()
    {
        return $this->customerOneUseOnly;
    }

    /**
     * @param mixed $customerOneUseOnly
     */
    public function setCustomerOneUseOnly(bool $customerOneUseOnly): void
    {
        $this->customerOneUseOnly = $customerOneUseOnly;
    }

    /**
     * @return mixed
     */
    public function isActive(): bool
    {
        return $this->active === true;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active): void
    {
        $this->active = (bool)$active;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action): void
    {
        $this->action = $action;
    }


}