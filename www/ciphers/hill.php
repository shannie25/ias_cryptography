<?php

function hillCipher($text, $mode, $key) {

  
    if (!$key || !is_array($key)) {
        return "Key matrix is required.";
    }


    if (count($key) != 3 || count($key[0]) != 3) {
        return "Key must be a 3x3 matrix.";
    }


    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if (!isset($key[$i][$j]) || !is_numeric($key[$i][$j])) {
                return "Invalid key values.";
            }
            $key[$i][$j] = intval($key[$i][$j]) % 26;
        }
    }

    if ($mode == "encode") {
        return hillEncrypt($text, $key);
    } else {
        return "Decryption not implemented yet";
    }
}

function charToNum($char) {
    return ord($char) - ord('A');
}

function numToChar($num) {
    return chr(($num % 26 + 26) % 26 + ord('A'));
}

function prepareText($text) {
    $text = strtoupper(str_replace(' ', '', $text));

 
    $text = preg_replace("/[^A-Z]/", "", $text);

   
    while (strlen($text) % 3 != 0) {
        $text .= 'X';
    }

    return $text;
}

function hillEncrypt($plaintext, $key) {

    $plaintext = prepareText($plaintext);
    $ciphertext = "";

    for ($i = 0; $i < strlen($plaintext); $i += 3) {

      
        $p = [
            charToNum($plaintext[$i]),
            charToNum($plaintext[$i+1]),
            charToNum($plaintext[$i+2])
        ];

        
        for ($row = 0; $row < 3; $row++) {
            $sum = 0;

            for ($col = 0; $col < 3; $col++) {
                $sum += $key[$row][$col] * $p[$col];
            }

            $ciphertext .= numToChar($sum % 26);
        }
    }

    return $ciphertext;
}

?>