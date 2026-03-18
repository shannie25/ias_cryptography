<?php
 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cipher Selection Menu</title>
<style>
.matrix {
    width: 30px;
    height: 30px;
}
</style>
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

    <div id="hillKey">
        <h3>Hill Cipher Key</h3>

        <input type="number" name="key[0][0]" placeholder="" class="matrix">
        <input type="number" name="key[0][1]" placeholder="" class="matrix">
        <input type="number" name="key[0][2]" placeholder="" class="matrix">
        <br><br>

        <input type="number" name="key[1][0]" placeholder="" class="matrix">
        <input type="number" name="key[1][1]" placeholder="" class="matrix">
        <input type="number" name="key[1][2]" placeholder="" class="matrix">
        <br><br>

        <input type="number" name="key[2][0]" placeholder="" class="matrix">
        <input type="number" name="key[2][1]" placeholder="" class="matrix">
        <input type="number" name="key[2][2]" placeholder="" class="matrix">
    </div>

    <br>
    <input type="submit" value="Process">

</form>

</body>

<script>
    const cipherSelect = document.getElementById("cipher");
    const hillKey = document.getElementById("hillKey");


    hillKey.style.display = "none";

    cipherSelect.addEventListener("change", function() {
        if (this.value === "hill") {
            hillKey.style.display = "block";
        } else {
            hillKey.style.display = "none";
        }
    });
</script>
</html>