<?php
  if(isset($_GET['email']) && isset($_GET['token'])){
    $valid = false;
    $tbl = isset($page[1]) ? $page[1] : "users";
    $maxtime = "+ 1 hour";
    $email = @$_GET['email'];
    $token = @$_GET['token'];
    $sql = "SELECT * FROM $tbl WHERE email LIKE '$email' ";
    $res = $db->query($sql);
    if(count($res) > 0){
      $usr = @$res[0];
      // check timer
      $tkn = explode("__",$token);
      $endtime = strtotime($maxtime, end($tkn)); 
      if(time() <= $endtime)
      {
        // Time Validated
        // check token
        $newtoken = md5($usr['id'].md5($email));
        if($tkn[0] == $newtoken){
          // Valid Link
          $valid = true;
        } 
        else
        {
          $err = "Invalid Link : Token mismatch";          
        } 

      }
      else
      {
        $err = "This Link is invalid now, Kindly try again! ";      
      }
      
    }
    else
    {
      die("User doesn't exists");   
    }
  }
  else
  {
    die("This Page not accessible");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('inc/biz/head.php'); ?>
</head>
<body class="g g1 align-fc">
<main class="g g1 w-p30">

  <div class="g align-fc">
      <h3><img src="assets/img/logo.png" alt="MVSHOP" height="70px"></h3>
      <div class="w-p100">
        <h5 class="indigo-text talign-c">Reset Password</h5>
<?php  
  if($valid){
?>
<form id='loginfrm' action='p/resetpassword/<?php echo $tbl; ?>' method='POST' onsubmit='return false; validSubmit("#loginfrm");' enctype='multipart/form-data' >
  <div class="input-group">
    <input type="password" name="password" label="Password" required="" >
    <input type="password" name="cpassword" label="Confirm Password" required="" >
    <input type="hidden" name="tokenid" value="<?php $id = $usr['id']; echo base64_encode(base64_encode($id)); ?>">
    <input type="hidden" name="csrf" value="<?php echo $_SESSION['token'];?>">
  </div>
  <button onclick='validSubmit("#loginfrm")' class='btn'>Set Password</button>
</form>
<?php
}
else
{
  echo "<h5 class='g g1 talign-c margin pad-2 red-text'>$err</h5>";
}

?>
        <div class="g gaa gap-between margin">
            <a href="FORGOT-PASSWORD" class="orange-text text-darken-2">Forgot Password?</a>
            <a href="REGISTER" class="indigo-text">New Register</a>
        </div>
      </div>
    
  </div>
</main>


<?php include('inc/biz/bottomjs.php'); ?>
</body>
</html>