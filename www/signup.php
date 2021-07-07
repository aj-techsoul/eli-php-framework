<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('inc/head.php'); ?>
</head>

<body>
  <main>

    <?php include('inc/nav.php'); ?>

    <div class="g g1 valign-c align-l pad-t-4 pad-b-4 purple darken-2 white-text">
        <div class="container">
          <h3>Sign Up</h3>
        </div>
    </div>

      <div class="container pad-t-7 pad-b-7 g g1 align-fc">
        <form action="p/signup" method="POST" id="signupfrm" onsubmit="return false" class="loginfrm">
            <input type="text" name="name"  label="Name" >
            <input type="email" name="email" required label="Email" >
            <input type="tel" name="phone" required label="Phone No." >
            <input type="password" name="password" required label="New Password" >
            <input type="password" name="cpassword" required label="Confirm Password" >
            <input type="hidden" name="csrf" value="<?php echo $_SESSION['token'] ?>">
            <span onclick="validSubmit('#signupfrm')" class="btn">Submit</span>



        <div class="g l1a m1a s1 xs1 ggap-1 w-p100 margin-t-2">
            <a href="forgotpassword.php">Forgot Password</a>
            <a href="LOGIN">Login</a>
        </div>
        </form>
      </div>


      



  </main>
  <?php include('inc/footer.php')?>

  <?php include('inc/bottomjs.php'); ?>
</body>

</html>