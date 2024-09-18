<?php

use App\Models\Admin\Parliament;

function getCurrentParliament(){
  return Parliament::latest()->first();
}


  /**
    * getLayout
    */
function getLayout(){
  if (auth()->user()->id == 1)
    return 'layouts.app';
  else
    return 'layouts.user';
}


function getDashboard(){
  if (auth()->user()->id == 1)
    return 'admin.dashboard';
  else
    return 'user.dashboard'; 
}

if (!function_exists('encryptInteger')) {
  function encryptInteger($value)
  {
    $key = env("ID_ENCRYPTION_KEY");
    $cipher = "AES-256-CBC";
    $keyLength = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($keyLength);
    $options = OPENSSL_RAW_DATA;
    $encrypted = openssl_encrypt($value, $cipher, $key, $options, $iv);
    $encryptedValue = base64_encode($encrypted);
    $result = base64_encode($iv) . ':' . $encryptedValue;
    $result = str_replace( '/', '++',$result); 
    return 'pRS'.$result;
  }
}

if (!function_exists('decryptInteger')) {
  function decryptInteger($encrypted)
  {
    $encrypted = str_replace( '++', '/',$encrypted); 
    $encrypted = substr($encrypted, 3);
    $key = env("ID_ENCRYPTION_KEY");
    $cipher = "AES-256-CBC";
    $keyLength = openssl_cipher_iv_length($cipher);

    if(strpos($encrypted, ':') !== false){
      list($iv, $encryptedValue) = explode(':', $encrypted, 2);
      $iv = base64_decode($iv);
      $options = OPENSSL_RAW_DATA;
      $decrypted = openssl_decrypt(base64_decode($encryptedValue), $cipher, $key, $options, $iv);
      return $decrypted;
    }
  }
}