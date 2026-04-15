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

    <div id="vigenereKey">
        <label for="vigenere_key">Vigenère Key (letters only):</label><br>
        <input type="text" name="vigenere_key" placeholder="">
    </div>


</form>

</body>

<script>

    const playfairKey = document.getElementById("playfairKey");
    playfairKey.style.display = "none";
    
    cipherSelect.addEventListener("change", function() {
        hillKey.style.display = this.value === "hill" ? "block" : "none";
        vigenereKey.style.display = this.value === "vigenere" ? "block" : "none";
        playfairKey.style.display = this.value === "playfair" ? "block" : "none";
});
    const cipherSelect = document.getElementById("cipher");
    const hillKey = document.getElementById("hillKey");
    const vigenereKey = document.getElementById("vigenereKey");


    hillKey.style.display = "none";

    cipherSelect.addEventListener("change", function() {
        hillKey.style.display = this.value === "hill" ? "block" : "none";
        vigenereKey.style.display = this.value === "vigenere" ? "block" : "none";
    });



</script>
</html>
