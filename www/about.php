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
          <h3>About Us</h3>
        </div>
    </div>

      <div class="container pad-t-7 pad-b-7">
         <?php $tmp->content("ABOUT-US",'content','15'); ?>
      </div>


      <?php $tmp->inc("card-divisions",'15'); ?>



  </main>
  <?php include('inc/footer.php')?>
  <?php include('inc/bottomjs.php'); ?>
</body>

</html>