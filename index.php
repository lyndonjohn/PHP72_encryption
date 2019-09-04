<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Encryption/Decryption</title>
</head>

<body>
    <form method="post">
        <p>Enter Secret Message:</p>
        <textarea name="secret_message" cols="30" rows="10"></textarea>
        <p><button type="submit">Submit</button></p>
    </form>

    <?php
    if ($_POST) {
        $msg = 'This is a super secret message!';

        // Generating an encryption key and a nonce
        $key   = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES); // 256 bit
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES); // 24 bytes

        // Encrypted message
        $ciphertext = sodium_crypto_secretbox($msg, $nonce, $key);

        if ($_POST['secret_message'] === sodium_crypto_secretbox_open($ciphertext, $nonce, $key)) {
            echo 'Success!';
        } else {
            echo 'Failed!';
        }
    }
    ?>
</body>

</html>