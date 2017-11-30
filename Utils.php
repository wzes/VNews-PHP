<?php
/**
 * Created by PhpStorm.
 * User: xuantang
 * Date: 11/30/17
 * Time: 6:47 PM
 */

class Utils {
    /**
     * Get user id
     * @return string
     */
    public function getRandomUserID() {
        return uniqid();
    }

    /**
     * Get the chinese means from the db
     * @param $str
     * @return mixed|string
     */
    public function decodeMeans($str) {
        $res = $this->transfer($str);
        $res = str_replace("u", "%u", str_replace('"','', $res));
        $res = $this->transfer($res);
        return $res;
    }

    /**
     * Transfer the character
     * @param $str
     * @return string
     */
    private function transfer($str) {
        $ret = '';
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++) {
            if ($str[$i] == '%' && $str[$i+1] == 'u') {
                $val = hexdec(substr($str, $i+2, 4));
                if ($val < 0x7f) $ret .= chr($val);
                else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f));
                else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f));
                $i += 5;
            } else if ($str[$i] == '%') {
                $ret .= urldecode(substr($str, $i, 3));
                $i += 2;
            } else $ret .= $str[$i];
        }
        return $ret;
    }
}