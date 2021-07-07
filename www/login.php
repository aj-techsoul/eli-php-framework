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
          <h3>Login</h3>
        </div>
    </div>

      <div class="container pad-t-7 pad-b-7 g g1 align-fc">
        <form action="p/login" method="POST" id="signupfrm" onsubmit="return false" class="loginfrm">
            <input type="email" name="email" required label="Email" licon="mdi mdi-email" >
            <input type="password" name="password" required label="New Password" licon="mdi mdi-key" >
            <input type="hidden" name="csrf" value="<?php echo $_SESSION['token'] ?>">
            <span onclick="validSubmit('#signupfrm')" class="btn">Submit</span>

        <div class="g l1a m1a s1 xs1 ggap-1 w-p100">
            <a href="SIGNUP">Sign up</a>
            <a href="forgotpassword.php">Forgot Password</a>
        </div>
        </form>

      </div>


      



  </main>
  <?php include('inc/footer.php')?>

  <?php include('inc/bottomjs.php'); ?>
</body>

</html>