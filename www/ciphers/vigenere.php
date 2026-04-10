<?php
    function vigenereCipher($text, $mode, $key){
        $key = strtoupper(preg_replace('/[^a-zA-Z]/', '', $key));
        if (empty($key)) return 'Key is required.';

        $encrypt = ($mode === 'encode');
        $result = '';
        $ki = 0;

        for ($i = 0; $i < strlen($text); $i++){
            $ch = $text[$i];
            if (ctype_alpha($ch)){
                $upper = strtoupper($ch);
                $p = ord($upper) - 65;
                $k = ord($key[$ki % strlen($key)]) - 65;
                $new =$encrypt ? ($p + $k) % 26 : (($p - $k +26) % 26);
                $result .= ctype_lower($ch) ? strtolower(chr($new + 65)) : chr($new +65);
                $ki++;
            }else{
                $result .= $ch;
            }
        }

        return $result;
    }
?>