<?php

function gcd(int $a, int $b): int {
    while ($b !== 0) { $t = $b; $b = $a % $b; $a = $t; }
    return $a;
}

function modInverse(int $a, int $m): int|false {
    $a = $a % $m;
    for ($x = 1; $x < $m; $x++) {
        if (($a * $x) % $m === 1) return $x;
    }
    return false;
}

function isValidKey(int $a): bool {
    return gcd($a, 26) === 1;
}

function affineEncrypt(string $text, int $a, int $b): string {
    $result = "";
    foreach (str_split(strtoupper($text)) as $char) {
        if (ctype_alpha($char)) {
            $x = ord($char) - 65;
            $result .= chr((($a * $x + $b) % 26) + 65);
        } else {
            $result .= $char;
        }
    }
    return $result;
}

function affineDecrypt(string $text, int $a, int $b): string {
    $aInv = modInverse($a, 26);
    if ($aInv === false) return "Error: No modular inverse found.";
    $result = "";
    foreach (str_split(strtoupper($text)) as $char) {
        if (ctype_alpha($char)) {
            $y = ord($char) - 65;
            $result .= chr((($aInv * ($y - $b + 26)) % 26) + 65);
        } else {
            $result .= $char;
        }
    }
    return $result;
}

$output    = "";
$error     = "";
$inputText = "";
$keyA      = 5;
$keyB      = 8;
$mode      = "encrypt";
$steps     = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputText = trim($_POST['text'] ?? '');
    $keyA      = intval($_POST['key_a'] ?? 5);
    $keyB      = intval($_POST['key_b'] ?? 8);
    $mode      = $_POST['mode'] ?? 'encrypt';
    $keyB      = max(0, min(25, $keyB));

    if (empty($inputText)) {
        $error = "Please enter a message.";
    } elseif (!isValidKey($keyA)) {
        $error = "Key 'a' = $keyA is invalid. It must be coprime with 26.";
    } else {
        $aInv = modInverse($keyA, 26);
        if ($mode === 'encrypt') {
            $output = affineEncrypt($inputText, $keyA, $keyB);
            $count  = 0;
            foreach (str_split(strtoupper($inputText)) as $char) {
                if (ctype_alpha($char) && $count < 6) {
                    $x = ord($char) - 65;
                    $enc = (($keyA * $x + $keyB) % 26);
                    $steps[] = ['from' => $char, 'to' => chr($enc + 65), 'calc' => "($keyA × $x + $keyB) mod 26 = $enc"];
                    $count++;
                }
            }
        } else {
            $output = affineDecrypt($inputText, $keyA, $keyB);
            $count  = 0;
            foreach (str_split(strtoupper($inputText)) as $char) {
                if (ctype_alpha($char) && $count < 6) {
                    $y = ord($char) - 65;
                    $dec = (($aInv * ($y - $keyB + 26)) % 26);
                    $steps[] = ['from' => $char, 'to' => chr($dec + 65), 'calc' => "($aInv × ($y - $keyB + 26)) mod 26 = $dec"];
                    $count++;
                }
            }
        }
    }
}

$validAs = [1,3,5,7,9,11,15,17,19,21,23,25];

?>