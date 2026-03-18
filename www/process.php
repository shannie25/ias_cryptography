<?php
require_once __DIR__ . "/ciphers/hill.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cipher = $_POST['cipher'];
    $mode = $_POST['mode'];
    $text = $_POST['text'];
    $key = $_POST['key'] ?? null;

    $result = "";

    switch ($cipher) {

        case "hill":
            $result = hillCipher($text, $mode, $key);
            break;

        case "playfair":
            include "ciphers/playfair.php";
            $result = playfairCipher($text, $mode);
            break;

        case "vigenere":
            include "ciphers/vigenere.php";
            $result = vigenereCipher($text, $mode);
            break;

        case "affine":
            include "ciphers/affine.php";
            $result = affineCipher($text, $mode);
            break;

        default:
            $result = "Invalid cipher selected.";
    }

    echo "<h3>Result:</h3>";
    echo "<p>$result</p>";
}
?>