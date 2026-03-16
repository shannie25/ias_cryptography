<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title>Cipher Selection Menu</title>
</head>
<body>

<h2>Select Cipher Method</h2>

<form method="post" action="process.php">

    <label for="cipher">Choose a Cipher:</label>
    <select name="cipher" id="cipher">
        <option value="" selected disabled hidden>Default</option>
        <option value="hill">Hill</option>
        <option value="playfair">Playfair</option>
        <option value="vigenère">Vigenère</option>
        <option value="affine">Affine</option>

    </select>

    <br><br>

    <label for="mode">Operation:</label>
    <select name="mode" id="mode">
        <option value="encode">Encode</option>
        <option value="decode">Decode</option>
    </select>

    <br><br>

    <label for="text">Input Text:</label><br>
    <textarea name="text" rows="5" cols="40"></textarea>

    <br><br>

    <input type="submit" value="Process">

</form>

</body>
</html>