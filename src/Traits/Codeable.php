<?php
namespace Omatech\LaravelPromoCodes\Traits;

trait Codeable
{
    /**
     * @return string
     */
    private function generateCode(): string
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $base = $randomString;
        $base = preg_replace("/[^a-zA-Z0-9]+/", "", $base);
        $ret = substr(strtoupper($base), 0, 6);
        $ret = str_replace('-', 'J', $ret);
        $ret = str_replace('.', 'Q', $ret);
        $ret = str_replace('=', 'M', $ret);
        $ret = str_replace('1', 'X', $ret);

        $exists = true;
        $i = 1;
        while ($exists) {
            $ret = $ret . $i;

            $exists = $this->checkIfCodeExists($ret);
            if ($exists) {
                $i++;
            }
        }

        return $ret;
    }

    /**
     * @param string $code
     * @return bool
     */
    private function checkIfCodeExists(string $code): bool
    {
        return !is_null($this->findPromoCodeByCode->make($code));
    }
}