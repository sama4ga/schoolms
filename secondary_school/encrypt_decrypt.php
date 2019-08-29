<?php
declare(strict_types=1);

/**
 * Encrypt a message
 * 
 * @param string $message - message to encrypt
 * @param string $key - encryption key
 * @return string
 * @throws RangeException
 */
function safeEncrypt(string $message, string $key):string{
  
  if (mb_strlen($key,'8bit') !== SODIUM_CRYPTO_SECRETBOX_KEYBYTES) {
    throw new RangeException("Key is not the correct size (must be 32 bytes).", 1);
  }

  $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

  $cipher = base64_encode(
    $nonce.
    sodium_crypto_secretbox(
      $message,
      $nonce,
      $key
    )
  );
  sodium_memzero($message);
  sodium_memzero($key);

  return $cipher;
}



/**
 * Decrypt a message
 * 
 * @param string $encrypted - message encrypted with safeEncrypt
 * @param string $key - encryption key
 * @return string
 * @throws RangeException
 */

 function safeDecrypt(string $encrypted, string $key):string{
   
  $decoded = base64_decode($encrypted);
   $nonce = mb_substr($decoded,0,SODIUM_CRYPTO_SECRETBOX_NONCEBYTES,'8bit');
   $ciphertext = mb_substr($decoded,SODIUM_CRYPTO_SECRETBOX_NONCEBYTES,null,'8bit');

   $plain = sodium_crypto_secretbox_open(
     $ciphertext,
     $nonce,
     $key
   );

   if (!is_string($plain)) {
     throw new Exception("Invalid MAC", 1);
  }

  sodium_memzero($ciphertext);
  sodium_memzero($key);
  return $plain;
 }




/**
 * Decrypt a message using openssl
 * 
 * @param string $string - message encrypted with safeEncrypt
 * @param string $key - encryption key
 * @return string
 * @throws RangeException
 */

 function gen_key(){
   $key_size = 32; // 256 bits
   $encryption_key = openssl_random_pseudo_bytes($key_size,$strong); // strong willbe true if the key is crypto safe
   return $encryption_key;
 }
 function gen_iv(){
   /* $iv_size = 16; // 128 bits
   $iv = openssl_random_pseudo_bytes($iv_size,$strong); */

   $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("AES-256-CBC"));
  return $iv;
 }







 function pkcs7_pad($data, $size){
      
   $length = $size - strlen($data) % $size;
   return $data.str_repeat(chr($length),$length);  

 }
 function encrypt($data){
   $enc_name = openssl_encrypt(
     pkcs7_pad($data,16), // alternatively, use aes-256-ctr
     'AES-256-CBC',
     $encryption_key,
     0,
     $iv
   );
   return $enc_name;
 }








 function pkcs7_unpad($data){
  return substr($data,0,-ord($data[strlen($data)-1]));
 }
 function decrypt($data,$enc_name,$encryption_key,$iv){
   $name = pkcs7_unpad(
     openssl_decrypt(
       $enc_name,
       'AES-256-CBC',
       $encryption_key,
       0,
       $iv
     )
    );
    return $name;
 }






 function fnEncrypt(string $string){
  $encryption_key = gen_key();
  $iv = gen_iv(); 

    $encrypted = openssl_encrypt($string,'aes-256-cbc',$encryption_key,OPENSSL_RAW_DATA,$iv);
    $encrypted = bin2hex($encrypted).":".bin2hex($iv).":".bin2hex($encryption_key);
    return $encrypted;
  
 }
 function fnDecrypt(string $encrypted){
   $parts = explode(":",$encrypted);
    $decrypted = openssl_decrypt(hex2bin($parts[0]),"aes-256-cbc",hex2bin($parts[2]),OPENSSL_RAW_DATA,hex2bin($parts[1]));
    return $decrypted;
 }
 
 
?>