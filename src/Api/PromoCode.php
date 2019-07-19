<?php

namespace Omatech\LaravelPromoCodes\Api;

use Omatech\LaravelPromoCodes\Contracts\PromoCode as PromoCodeInterface;

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
     * @param $userId
     * @return bool
     */
    public function check($code, $userId): bool
    {
        $promoCode = $this->promoCode->findByCode($code);

        //TODO si $row['first_order_only'] == 1 && $users->number_of_orders($userId) > 0, false
        //TODO si $row['customer_one_use_only'] == 1 && $users->number_of_orders_with_coupon($userId, $code) > 0, false

        //TODO
//        if ($_REQUEST['promo_code_row']['one_use_only'] == 1) {
//            $promo_codes->disable($_REQUEST['promo_code_row']['id']);
//        } else {// mirem si ha arribat al max_uses total
//            if (isset($_REQUEST['promo_code_row']['max_uses']) && is_numeric($_REQUEST['promo_code_row']['max_uses'])) {
//                $current_num_uses = $promo_codes->number_of_uses($_REQUEST['promo_code_row']['id']);
//                if ($current_num_uses >= $_REQUEST['promo_code_row']['max_uses']) {
//                    $promo_codes->disable($_REQUEST['promo_code_row']['id']);
//                }
//            }
//        }

        return !is_null($promoCode) && $promoCode->isValid();
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
        $this->promoCode->disable($id);
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

//
//    function number_of_uses($id)
//    {
//        $sql = "select count(*) num
//			from coupons_orders co
//			where co.coupon_id=$id";
//        $row = parent::get_one($sql);
//        if ($row) {
//            return ($row['num']);
//        }
//        return 0;
//    }
//

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
////
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
//
//    function genera_random_promo_code_with_prefix($prefix = '', $length = 5)
//    {
//        $base = self::generateRandomString($length);
//        $sql = "select count(*) num
//			from coupons
//			where code='$prefix.$base'
//		";
//        $row = parent::get_one($sql);
//        $exists = $row['num'] > 0;
//        if ($exists) {
//            return $this->genera_random_promo_code_with_prefix($prefix, $length);
//        } else {// cas normal, no existia
//            return $prefix . $base;
//        }
//    }
//
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