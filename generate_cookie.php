<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $somehexvalue1 = $_POST['somehexvalue1'];
    $somehexvalue2 = $_POST['somehexvalue2'];
    $somehexvalue3 = $_POST['somehexvalue3'];

    function toNumbers($d) {
        $e = array();
        preg_replace_callback('/(..)/', function($matches) use (&$e) {
            $e[] = hexdec($matches[0]);
        }, $d);
        return $e;
    }

    function toHex() {
        $d = 1 == func_num_args() && is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
        $e = "";
        foreach ($d as $f) {
            $e .= (16 > $f ? "0" : "") . dechex($f);
        }
        return strtolower($e);
    }

    $a = toNumbers($somehexvalue1);
    $b = toNumbers($somehexvalue2);
    $c = toNumbers($somehexvalue3);

    // Make sure to include the aes.js library in the same directory as this PHP file
    require_once('aes.js');
  
    $cookie = "__test=" . toHex(slowAES_decrypt($c, 2, $a, $b)) . "; expires=Thu, 31-Dec-37 23:55:55 GMT; path=/";

    echo $cookie;
}
?>
