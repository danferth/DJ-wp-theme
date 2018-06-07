<?php
//in development there was an issue where the below functions sould
//not be accessed from the TIC-functions.php file. 
//When TIC-functions.php file was implimented with require_once() 
//it through errors from the other functions




//form functions to trim all values from $_POST[]
function trim_value(&$value){
  if(gettype($value) == 'string'){
    $value = trim($value);
  }
  if(gettype($value) == 'array'){
      array_walk($value, 'trim_value');
  }
};

//check if required elements have a value
function checkRequired($requiredArray, $query_string, $server_dir, $next_page){
  //set counter to 0
  $requiredCount = 0;
  //check for empty fields
  foreach($requiredArray as $require){
    if($require === ''){
      ++$requiredCount;
    }
  }
  //redirect back with error
  if($requiredCount > 0){
    $query_string .= '&success=required';
    header('Location: https://' . $server_dir . $next_page . $query_string);
  }
};

//check emails if they are valid or not and return with error if so
function checkEmailValid($emailArray, $server_dir, $next_page, $query_string){
  $isEmailValid = 0;
  foreach($emailArray as $emailToCheck){
    $check = filter_var($emailToCheck, FILTER_VALIDATE_EMAIL);
      if($check == ''){
        ++$isEmailValid;
      }
  }
  //if $isEmailValis is greater than 0 then there are issues with one
  //or more of the emails so redirect to form and trigger error message
  if($isEmailValid > 0){
    $query_string .= '&success=email';
    header('Location: http://' . $server_dir . $next_page . $query_string);
  }
};
//check honeypots
function checkHoneypot($honeyArray, $query_string, $server_dir, $next_page){
  $honeyCount = 0;
  foreach($honeyArray as $honey){
    if($honey != ''){
      ++$honeyCount;
    }
  }
  if($honeyCount > 0){
    $query_string = '?first_name=Edward';
		$query_string .= '&success=true';
		header('Location: http://' . $server_dir . $next_page . $query_string);
  }
};


//end doc
?>