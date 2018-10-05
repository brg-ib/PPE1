<?php

function parcourir($chaine, $action){
  $acc = null;
  for($i= 0; $i <strlen($chaine); $i++){
    $acc = $action($chaine[$i], $acc);
  }
  return $acc."\n";
}

$pass = function ($char, $str){
  return $str ."*";
};

echo parcourir("je vais chez ce cher Serge", $pass);

?>
