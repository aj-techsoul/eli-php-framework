<?php
CLASS VALIDATOR
{
  function name($name,$json='n')
  {
    if(is_array($name)){
      $postedarray = (is_array($postedarray)) ? $postedarray : $GLOBALS['_POST'];
    }

    if(isset($name) && strlen($name)>=3 && !preg_match('/[^A-Za-z0-9 ]/', $name))
    {
      return TRUE;
    }
    else {

      if(strtolower($json)=='y'){
        $j['status'] = "fail";
        $j['message'] = 'Invalid Name, Please correct it!<br />';
        echo json_encode($j);
        die();
      }else
      {
        die('Invalid Name, Please correct it!<br />');
      }
      return false;
    }

  }

  function phone($phone,$json='n')
  {
    $phone = trim($phone);

    if(isset($phone) && strlen($phone)>=10 && preg_match("/^[+]?[1-9][0-9]{9,14}$/", $phone))
    {
      return TRUE;
    }   
    else {
       if(strtolower($json)=='y'){
        $j['status'] = "fail";
        $j['message'] = 'Invalid Number, Your Phone Number should be 10 digits!<br />';
        echo json_encode($j);
        die();
      }else
      {
      die('Invalid Number, Your Phone Number should be of 10 digits!<br />');
      }
      return false;
    }
  }

  function email($email,$json='n')
  {
        if(isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
        {
          return TRUE;
        }
        else {
           if(strtolower($json)=='y'){
        $j['status'] = "fail";
        $j['message'] = 'Invalid Email, Please check it!<br />';
        echo json_encode($j);
        die();
      }else
      {
          die('Invalid Email, Please check it!<br />');
      }
          return false;
        }
  }

  function password($password,$json='n')
  {
        if(isset($password) && strlen(trim($password))>=6 )
        {
          return TRUE;
        }
        else {
            if(strtolower($json)=='y'){
        $j['status'] = "fail";
        $j['message'] = 'Very Weak Password, Please keep minimum 6 characters!<br />';
        echo json_encode($j);
        die();
      }else
      {
          die('Very Weak Password, Please keep minimum 6 characters!<br />');
      }
          return false;
        }
  }

  function confirmpass($pass,$cpass,$json='n')
  {


        if(isset($pass) && isset($cpass) && $pass==$cpass)
        {
          return TRUE;
        }
        else {
           if(strtolower($json)=='y'){
        $j['status'] = "fail";
        $j['message'] = 'Passwords not matching !<br />';
        echo json_encode($j);
        die();
      }else
      {
          die('Passwords not matching !<br />');
      }
          return false;
        }
  }

  function varchar($name,$json='n')
  {
    if(isset($name) && strlen($name)>=3)
    {
      return TRUE;
    }
    else {
       if(strtolower($json)=='y'){
        $j['status'] = "fail";
        $j['message'] = 'Invalid Title, Please correct it!<br />';
        echo json_encode($j);
        die();
      }else
      {
      die('Invalid Title, Please correct it!<br />');
      }
      return false;
    }

  }


  function number($posteddata,$name,$json='n')
  {
    if(isset($posteddata) && is_numeric($posteddata))
    {
      return TRUE;
    }
    else {
       if(strtolower($json)=='y'){
        $j['status'] = "fail";
        $j['message'] = "Invalid $name, Please correct it!<br />";
        echo json_encode($j);
        die();
      }else
      {
      die("Invalid $name, Please correct it!<br />");
      }
      return false;
    }

  }

   function voterid($voterid,$json='n')
   {
        $alpha = substr($voterid, 0, 3);
        $numeric = substr($voterid, 3, 7);
        if(strlen(trim($voterid))==10 && is_numeric($numeric) && preg_match("/[a-z]/i", $voterid))
        {
            return TRUE;
        }
        else
        {
             if(strtolower($json)=='y'){
        $j['status'] = "fail";
        $j['message'] = 'Invalid VoterID Card Number';
        echo json_encode($j);
        die();
      }else
      {
            die('Invalid VoterID Card Number');
            }
            return FALSE;
        }
   }


   function senderid($sid,$json='n')
   {
     if(isset($sid) && strlen($sid)==6 && !preg_match('/[^A-Za-z0-9 ]/', $sid))
     {
       return TRUE;
     }
     else {

       if(strtolower($json)=='y'){
         $j['status'] = "fail";
         $j['message'] = 'Invalid Sender Id, Please correct it!<br />';
         echo json_encode($j);
         die();
       }else
       {
         die('Invalid Sender Id, Please correct it!<br />');
       }
       return false;
     }

   }



  function safe($string)
  {
    $string = trim(addslashes($string));
    $string = htmlspecialchars($string);
     return $string;
  }

  function appointmentdatetime($apdatetime,$fieldname=""){
   // die(date("H",strtotime($apdatetime)));
     $h = date("H",strtotime($apdatetime));

    if($apdatetime >= date("Y-m-d H:i:s") && $h <= 24 && $h >= 8 ){
      return true;
    }
    else
    {
  //    return false;
      die("Operating hours 8 AM till Midnight");
    }
  }

  function greater($shouldgreater,$shouldsmaller,$fieldnames)
  {
        if(is_numeric($shouldgreater) && is_numeric($shouldsmaller))
        {
            if($shouldgreater>=$shouldsmaller)
            {
              return true;
            }
            else {
              $fn =  explode(',',$fieldnames);
              die(@$fn[0]. " field should be greater than field ".@$fn[1]);
            }
        }
        else {
          die($fieldnames.' should be number');
        }
  }

function message($minlength=10,$posteddata,$name="Message"){
  if(strlen($posteddata) >= $minlength){
    return true;
  }
  else {
    die($name.' should have atleast '.$minlength.' characters');
  }
}

  function need($variablesneeded,$posteddata="")
  {
    $posteddata = (is_array($posteddata)) ? $posteddata : $GLOBALS['_POST'];
      if(is_array($posteddata))
      {
        $needed  = explode(",", $variablesneeded);
          foreach ($posteddata as $key=>$value) {
            if(in_array($key, $needed))
            {
              $neededdata[$key] = self::safe($value);
            }
          }
      }

      return (isset($neededdata))? $neededdata : "";
  }

  function required($field,$fieldname="",$json='n')
  {
    $fieldname = (isset($fieldname))? $fieldname : ucfirst($field);
    if(isset($field) && $field!="" )
    {
        return TRUE;
    }
    else {
    //  return FALSE;
     if(strtolower($json)=='y'){
        $j['status'] = "fail";
        $j['message'] = "Please fill&nbsp;<strong>$fieldname</strong>";
        echo json_encode($j);
        die();
      }else
      {
      die("Please fill&nbsp;<strong>$fieldname</strong>");
      }
    }
  }

  function required_fields($fields,$postedarray="")
  {
    $postedarray = (is_array($postedarray)) ? $postedarray : $GLOBALS['_POST'];
    // print_r($postedarray);
    // die();
    $flds = explode(",",$fields);
    if(count($flds) > 0){
        foreach($flds as $fld){
          if(in_array($fld,array_keys($postedarray))){
            // field exists            
            if($postedarray[$fld]!=""){                          
              // true
              return TRUE;
            }
            else
            {
              die("Please fill&nbsp;<strong>".ucfirst($fld)."</strong>");  
            }
          }
          else
          {
            // fields doesnt exists
            die("Please fill&nbsp;<strong>".ucfirst($fld)."</strong>");
          }
        }
    }
    else
    {
      return TRUE;
    }

  }

  function refcheck($ref){
    if(preg_replace('/(^[Rr])/', '', $ref)){
      $rc = explode('-',$ref);
      if(is_numeric($rc[1])){
        return $rc[1];
      }
    }
  }

}
?>
