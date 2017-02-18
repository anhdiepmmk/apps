<?php

defined('COOKIE_ENCRYPT_METHOD') OR define('COOKIE_ENCRYPT_METHOD', 'aes-256-ctr');

function calculateAge($date)
{
    if (empty($date)) {
        return -1;
    }
    $date = str_replace('/', '-', $date);
    return (date('Y', (time() - strtotime($date))) - 1970);
}

/**
 * Encryt (but does not verify) a message
 * 
 * @param string $message - ciphertext message
 * @param string $key - encryption key (raw binary expected)
 * @param boolean $encoded - are we expecting an encoded string?
 * @return string
 */
function encrypt($message, $key, $encode = false)
{
    $nonceSize = openssl_cipher_iv_length(COOKIE_ENCRYPT_METHOD);
    $nonce = openssl_random_pseudo_bytes($nonceSize);

    $ciphertext = openssl_encrypt(
        $message, COOKIE_ENCRYPT_METHOD, $key, OPENSSL_RAW_DATA, $nonce
    );

    // Now let's pack the IV and the ciphertext together
    // Naively, we can just concatenate
    if ($encode) {
        return base64_encode($nonce . $ciphertext);
    }
    return $nonce . $ciphertext;
}

/**
 * Decrypts (but does not verify) a message
 * 
 * @param string $message - ciphertext message
 * @param string $key - encryption key (raw binary expected)
 * @param boolean $encoded - are we expecting an encoded string?
 * @return string
 */
function decrypt($message, $key, $encoded = false)
{
    if ($encoded) {
        $message = base64_decode($message, true);
        if ($message === false) {
            throw new Exception('Encryption failure');
        }
    }

    $nonceSize = openssl_cipher_iv_length(COOKIE_ENCRYPT_METHOD);
    $nonce = mb_substr($message, 0, $nonceSize, '8bit');
    $ciphertext = mb_substr($message, $nonceSize, null, '8bit');

    $plaintext = openssl_decrypt(
        $ciphertext, COOKIE_ENCRYPT_METHOD, $key, OPENSSL_RAW_DATA, $nonce
    );

    return $plaintext;
}

function compressData($data)
{
    return base64_encode(json_encode($data));
}

function extractData($str)
{
    return json_decode(base64_decode($str), true);
}

function generateRandomString($len = 8, $type = 'alnum')
{
    switch ($type) {
        case 'basic':
            return mt_rand();
        case 'alnum':
        case 'numeric':
        case 'nozero':
        case 'alpha':
            switch ($type) {
                case 'alpha':
                    $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    break;
                case 'alnum':
                    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    break;
                case 'numeric':
                    $pool = '0123456789';
                    break;
                case 'nozero':
                    $pool = '123456789';
                    break;
            }
            return substr(str_shuffle(str_repeat($pool,
                        ceil($len / strlen($pool)))), 0, $len);
        case 'unique': // todo: remove in 3.1+
        case 'md5':
            return md5(uniqid(mt_rand()));
        case 'encrypt': // todo: remove in 3.1+
        case 'sha1':
            return sha1(uniqid(mt_rand(), TRUE));
    }
}
