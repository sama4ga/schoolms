<?php

function hash_password(string $password){
  $random = openssl_random_pseudo_bytes(18);
  $salt = sprintf("$2y$%02d$%s",
              13, // 2^n cost factor
              substr(strtr(base64_encode($random),"+","."),0,22)
          );
  $hash = crypt($password,$salt);
  return $hash;
}


function verify_hash($password,$hash){
  $given_hash = crypt($password,$hash);

  // constant time string fucntion
  function isEqual($str1,$str2){
    $n1 = strlen($str1);
    if (strlen($str2) != $n1) {
      return false;
    }
    for ($i=0,$diff=0; $i != $n1; ++$i) { 
      $diff |=ord($str1[$i])^ord($str2[$i]);
    }
    return !$diff;
  }

  
  if (isEqual($given_hash,$hash)) {
    return true;
  }

  
}

?>