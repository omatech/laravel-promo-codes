<?php

namespace Omatech\LaravelPromoCodes\Api;

class PromoCode
{
    /**
     * @var \Omatech\LaravelPromoCodes\Contracts\PromoCode
     */
    private $promoCode;

    /**
     * PromoCode constructor.
     * @param \Omatech\LaravelPromoCodes\Contracts\PromoCode $promoCode
     */
    public function __construct(\Omatech\LaravelPromoCodes\Contracts\PromoCode $promoCode)
    {

        $this->promoCode = $promoCode;
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
     * @return null|\Omatech\LaravelPromoCodes\Contracts\PromoCode
     */
    public function find($id)
    {
        return $this->promoCode->find($id);
    }

    /**
     * @param $code
     * @return null|\Omatech\LaravelPromoCodes\Contracts\PromoCode
     */
    public function findByCode($code)
    {
        return $this->promoCode->findByCode($code);
    }

    /**
     * @param int $id
     */
    public function disable(int $id)
    {
        //TODO
        //    function disable($id)
        //    {
        //        $sql = "update coupons set active=0 where id=$id";
        //        return parent::update_one($sql);
        //    }
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
//
//    function genera_promo_code($base)
//    {
//        $base = filter_text($base);
//        $base = preg_replace("/[^a-zA-Z0-9]+/", "", $base);
//        $ret = substr(strtoupper($base), 0, 6);
//        $ret = str_replace('-', 'J', $ret);
//        $ret = str_replace('.', 'Q', $ret);
//        $ret = str_replace('=', 'M', $ret);
//        $ret = str_replace('1', 'X', $ret);
//
//        $exists = true;
//        $i = 1;
//        while ($exists) {
//            $sql = "select count(*) num
//				from coupons
//				where code='" . $ret . $i . "'
//			";
//            $row = parent::get_one($sql);
//            //echo $row['num']." codes for $ret$i\n";
//            $exists = $row['num'] > 0;
//            if ($exists) {
//                $i++;
//            }
//        }
//        return $ret . $i;
//    }
//
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
//    function genera_random_promo_code()
//    {
//        $base = self::generateRandomString(6);
//        return self::genera_promo_code($base);
//    }
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
//    function generateRandomString($length = 10)
//    {
//        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
//        $charactersLength = strlen($characters);
//        $randomString = '';
//        for ($i = 0; $i < $length; $i++) {
//            $randomString .= $characters[rand(0, $charactersLength - 1)];
//        }
//        return $randomString;
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