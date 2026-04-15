<?php

function generatePlayfairMatrix($key) {
    $key = strtoupper(preg_replace('/[^A-Z]/', '', $key));
    $key = str_replace('J', 'I', $key);

    $alphabet = "ABCDEFGHIKLMNOPQRSTUVWXYZ";
    $matrix = [];
    $used = [];

for ($i = 0; $i < strlen($key); $i++) {
    if (!in_array($key[$i], $used)) {
            $used[] = $key[$i];
    }
}


for ($i = 0; $i < strlen($alphabet); $i++) {
    if (!in_array($alphabet[$i], $used)) {
            $used[] = $alphabet[$i];
    }
}

$matrix = array_chunk($used, 5);
    return $matrix;
}

function findPosition($matrix, $char) {
    for ($i = 0; $i < 5; $i++) {
        for ($j = 0; $j < 5; $j++) {
            if ($matrix[$i][$j] == $char) {
                return [$i, $j];
        }
    }
}
    return null;
}

function preparePlayfairText($text, $mode) {
    $text = strtoupper(preg_replace('/[^A-Z]/', '', $text));
    $text = str_replace('J', 'I', $text);
    $result = "";

for ($i = 0; $i < strlen($text); $i++) {
    $a = $text[$i];
    $b = ($i + 1 < strlen($text)) ? $text[$i + 1] : 'X';

    if ($a == $b) {
        $result .= $a . 'X';
    } else {
        $result .= $a . $b;
        $i++;
    }
}

    if (strlen($result) % 2 != 0) {
        $result .= 'X';
    }

    return $result;
}

function playfairCipher($text, $mode, $key = "") {

    if (empty($key)) return "Playfair key is required.";

    $matrix = generatePlayfairMatrix($key);
    $text = preparePlayfairText($text, $mode);

    $result = "";

    for ($i = 0; $i < strlen($text); $i += 2) {

        $a = $text[$i];
        $b = $text[$i + 1];

        list($row1, $col1) = findPosition($matrix, $a);
        list($row2, $col2) = findPosition($matrix, $b);

    if ($row1 == $row2) {
        if ($mode == "encode") {
            $result .= $matrix[$row1][($col1 + 1) % 5];
            $result .= $matrix[$row2][($col2 + 1) % 5];
    } else {
            $result .= $matrix[$row1][($col1 + 4) % 5];
            $result .= $matrix[$row2][($col2 + 4) % 5];
        }

        } elseif ($col1 == $col2) {
            if ($mode == "encode") {
                $result .= $matrix[($row1 + 1) % 5][$col1];
                $result .= $matrix[($row2 + 1) % 5][$col2];
            } else {
                $result .= $matrix[($row1 + 4) % 5][$col1];
                $result .= $matrix[($row2 + 4) % 5][$col2];
            }

        } else {
            $result .= $matrix[$row1][$col2];
            $result .= $matrix[$row2][$col1];
        }
    }

    return $result;
}
?>
