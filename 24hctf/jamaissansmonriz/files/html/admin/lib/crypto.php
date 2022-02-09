<?php

$key = "5UP3R_S3CURE,K3Y";
$cipher="AES-128-CBC";

function generate_remember_me_cookie($username, $admin) {
    $iv = substr(md5(mt_rand()), 0, 16);
    $t = time() + (3600 * 24 * 365);
    $data = $username . "|" . $t . "|" . $admin;
    return base64_encode(encrypt($data, $iv) . "|" . $iv);
}

function validate_remember_me_cookie($cookie) {
    global $key, $cipher;
    try {
        $cookie_expended = explode("|", base64_decode($cookie));
        $decrypted_cookie = decrypt($cookie_expended[0], $cookie_expended[1]);
        
        if(!$decrypted_cookie) {
            return false;
        }

        $exp_d_cookie = explode("|", $decrypted_cookie);
        
        if ($exp_d_cookie[1] < time()) {
            return false;
        }
        // TODO: Ajouter des comptes user
        if ($exp_d_cookie[2] != "1") {
            return false;
        }
    } catch (Exception $e) {
        throw $e;
        return false;
    }

    return $exp_d_cookie;
}

function encrypt($data, $iv) {
    global $key, $cipher;
    // $ciphertext_raw = openssl_encrypt($data, $cipher, $key, 0, $iv);
    // return base64_encode(ciphertext_raw);
    return openssl_encrypt($data, $cipher, $key, 0, $iv);
}

function decrypt($cookie, $iv) {
    global $key, $cipher;
    // $ciphertext_raw = base64_decode($cookie);
    // return openssl_decrypt($ciphertext_raw, $cipher, $key, 0, $iv);
    return openssl_decrypt($cookie, $cipher, $key, 0, $iv);
}

?>