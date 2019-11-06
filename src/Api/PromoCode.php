<?php

namespace Omatech\LaravelPromoCodes\Api;

use Omatech\LaravelPromoCodes\Contracts\PromoCode as PromoCodeInterface;
use Omatech\LaravelPromoCodes\Values\Relation;

class PromoCode
{
    /**
     * @var PromoCodeInterface
     */
    private $promoCode;

    /**
     * PromoCode constructor.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $this->promoCode = app()->make(PromoCodeInterface::class);
    }

    /**
     * @param $code
     * @param null $relatedId
     * @param null $relatedType
     * @return bool
     */
    public function check($code, $relatedId = null, $relatedType = null): bool
    {
        $promoCode = $this->promoCode->findByCode($code);

        if (is_null($promoCode)) {
            return false;
        }

        if ($relatedId && $relatedType && $promoCode->isFirstOrderOnly()) {

            //TODO si $row['first_order_only'] == 1 && $users->number_of_orders($userId) > 0, false
        }

        if ($relatedId
            && $relatedType
            && $promoCode->isCustomerOneUseOnly()
        ) {

            $relation = new Relation($promoCode->getId(), $relatedId, $relatedType);

            if ($promoCode->checkRelation($relation)) {
                return false;
            }

        }

        return $promoCode->isValid();
    }

    /**
     * @param $id
     * @return null|PromoCodeInterface
     */
    public function find($id)
    {
        return $this->promoCode::find($id);
    }

    /**
     * @param $code
     * @return null|PromoCodeInterface
     */
    public function findByCode($code)
    {
        return $this->promoCode::findByCode($code);
    }

    /**
     * @param int $id
     */
    public function disable(int $id): void
    {
        $promoCode = $this->promoCode;
        $promoCode->setId($id);
        $this->promoCode->disable();
    }

    /**
     * @param array $data
     * @return PromoCodeInterface
     */
    public function generate(array $data)
    {
        return $this->promoCode::generate($data);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->promoCode::findAll();
    }

    /**
     * @param int $id
     * @param array $data
     */
    public function update(int $id, array $data): void
    {
        $promoCode = $this->promoCode;
        $promoCode->fromArray($data);
        $promoCode->setId($id);
        $promoCode->update();
    }

    /**
     * @param $code
     */
    public function redeem($code)
    {
        if (!$this->check($code)) {
            //TODO error
        }

        $promoCode = $this->promoCode->findByCode($code);

        //TODO redeem: vincular a un usuari / comanda / producte si és el cas


        if ($promoCode->isOneUseOnly()) {
            $this->disable($promoCode->getId());
        }


        //TODO
//       // mirem si ha arribat al max_uses total
//        $maxUses = $promoCode->getMaxUses();
//        if (is_numeric($maxUses)) {
//            $current_num_uses = $promo_codes->number_of_uses($promoCode->getId());
//            if ($current_num_uses >= $maxUses) {
//                $this->disable($promoCode->getId());
//            }
//        }
    }


//
//    function create_promo_code_for_user($user_id)
//    {
//        $sql = "select id, first_name
//					from users
//					where id=$user_id
//					and coupon_id is null";
//        $row = parent::get_one($sql);
//        if ($row) {
//            $promo_code = $this->genera_promo_code($row['first_name']);
//            $sql = "insert into coupons (title, amount_discount, max_uses, start_date, end_date
//				, first_order_only, customer_one_use_only, active, code, action, created, modified, type)
//				values ('¡Felicidades! " . $row['first_name'] . " te invita a 12 euros', 12, 1000000, NOW(), NOW()
//				, 1, 1, 1, '$promo_code', 'Viral user_id " . $row['id'] . "', NOW(), NOW(), 'viral')";
//
//            $new_coupon_id = parent::insert_one($sql);
//
//            $sql = "update users set coupon_id=$new_coupon_id
//				where id=$user_id";
//            parent::update_one($sql);
//
//
//            return $promo_code;
//        }
//        return false;
//    }

//    function genera_reward_promo_code($user_id, $first_name, $friend_user_id, $friend_first_name, $order_id)
//    {
//        $promo_code = self::genera_random_promo_code();
//
//        $sql = "insert into coupons (title, amount_discount, max_uses, start_date, end_date
//		, first_order_only, one_use_only, customer_one_use_only, active, code, action, created, modified, type, original_order_id)
//		values ('¡Felicidades! $first_name por invitar a $friend_first_name tienes 10 euros', 10, 1, NOW(), DATE_ADD(NOW(), interval 100 YEAR)
//		, 0, 1, 1, 1, '$promo_code', 'Reward user_id $user_id for friend $friend_user_id', NOW(), NOW(), 'reward', $order_id)";
//
//
//        $new_coupon_id = parent::insert_one($sql);
//
//        return $promo_code;
//    }
//
//    function get_user_promo_code($user_id)
//    {
//        $sql = "select c.code
//		from users u
//		, coupons c
//		where u.id=$user_id
//		and c.id=u.coupon_id";
//        $row = parent::get_one($sql);
//        if ($row) {
//            return $row['code'];
//        }
//        return false;
//    }

//    function validate_promo_code()
//    {
//        //echo 1; die;
//        // validar cupon
//        global $users;
//        if (isset($_REQUEST['promo_code']) && !empty($_REQUEST['promo_code'])) {
//            $number_of_user_orders = $users->number_of_orders($_REQUEST['user_id']);
//            //var_dump($is_fist_order);
//            //if ($number_of_user_orders==0) echo 'SIIIII';
//            $promo_codes = new promo_codes();
//            $promo_code_row = $promo_codes->check_order_promo($_REQUEST['promo_code'], $_REQUEST['user_id']);
//            if ($promo_code_row) {
//                $_REQUEST['promo_code_row'] = $promo_code_row;
//                // faltara assignar el promo_code a la order pero tot sembla ok
//            } else {// promo code no valid
//                json_errors::error(214);
//            }
//        }
//    }
}