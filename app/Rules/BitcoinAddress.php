<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BitcoinAddress implements Rule
{
	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */

	public function passes($attribute, $value)
	{
		return static::validate($value);
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */

	public function message()
	{
		return 'You must enter a valid Bitcoin address.';
	}

	public function validate($address){

		if ($this->isBech32($address))
		{
			return true;
		}

        $decoded = static::decodeBase58($address);

		if (!$decoded) {
			return false;
		}

        $d1 = hash("sha256", substr($decoded,0,21), true);
        $d2 = hash("sha256", $d1, true);

        if(substr_compare($decoded, $d2, 21, 4)){
                //throw new \Exception("bad digest");
				return false;
        }
        return true;
	}
	public function decodeBase58($input) {
        $alphabet = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";

        $out = array_fill(0, 25, 0);
        for($i=0;$i<strlen($input);$i++){
                if(($p=strpos($alphabet, $input[$i]))===false){
                        //throw new \Exception("invalid character found");
						return false;
                }
                $c = $p;
                for ($j = 25; $j--; ) {
                        $c += (int)(58 * $out[$j]);
                        $out[$j] = (int)($c % 256);
                        $c /= 256;
                        $c = (int)$c;
                }
                if($c != 0){
                    //throw new \Exception("address too long");
					return false;
                }
        }

        $result = "";
        foreach($out as $val){
                $result .= chr($val);
        }

        return $result;
	}

	public function isBech32($address)
	{
		$charset = "qpzry9x8gf2tvdw0s3jn54khce6mua7l";

		foreach (str_split($address) as $c)
		{
			if (ord($c) < 33 || ord($c) > 126) return false;
		}

		if ($address != strtolower($address) && $address != strtoupper($address)) {
			return false;
		}

		$address = strtolower($address);

		$pos = strrpos($address, "1");

		if ($pos < 1) return false;
		if ($pos + 7 > strlen($address)) return false;
		if (strlen($address) > 90) return false;

		$rev = strrev($address);
		$parts = explode("1", $rev, 2);
		if (count($parts) != 2) {
			return false;
		}

		$hrp = strrev($parts[1]);
		$data = strrev($parts[0]);

		foreach (str_split($data) as $c)
		{
			if (strpos($charset, $c) === false) {
				//dd("BAD char: {$c}");
				return false;
			}
		}

		if (!$this->bech32_verify_checksum($hrp, $data)) {
			return false;
		}

		return true;
	}

	function bech32_verify_checksum($hrp, $data)
	{
		// TODO: Verify the bech32 checksum
		// https://github.com/sipa/bech32/blob/master/ref/python/segwit_addr.py

		return $hrp == "bc";

	}
}
