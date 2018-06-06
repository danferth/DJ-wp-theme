<?php
//in development there was an issue where the below functions sould
//not be accessed from the TIC-functions.php file. 
//When TIC-functions.php file was implimented with require_once() 
//it through errors from the other functions




//form functions to trim
function trim_value(&$value){
  if(gettype($value) == 'string'){
    $value = trim($value);
  }
  if(gettype($value) == 'array'){
      array_walk($value, 'trim_value');
  }
};
?>