<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('inc/head.php'); ?>
</head>

<body>
  <main class="">  

  <?php include('inc/nav.php'); ?>

    <div class="g g1 valign-c align-l pad-t-4 pad-b-4 purple darken-2 white-text">
        <div class="container">
          <h3>Our Centers</h3>
        </div>
    </div>


    <div class="container pad-4">
    <?php $tmp->content("CONTACT-US",'content','12'); ?>
    </div>

    <div class="g grey lighten-4">
      <div class="container pad-4">
              <h5 class="talign-c pad-2">We Grow with your Valuable Feedback</h5>
      <form action="" method="POST" >
        <div class="g l2 m2 s1 xs1 ggap-2">
          <div class="input-group">
            <input type="text" name="name" value="" label="name" required="">
            <input type="email" name="email" value="" label="email">
            <input type="tel" name="phone" value="" label="Phone">

            <select name="type" label="Select Option">
              <option value=""></option>
              <option value="feedback">Feedback</option>
              <option value="invester">Invester</option>
            </select>
          </div>
       

            <textarea name="msg" label="message"></textarea>
       
        </div>
        <div class="g align-c">
          <button class="btn big mdi mdi-send">Send</button>
        </div>
      </form>
      </div>
    </div>


    <section class="g l3 m2 s1 xs1 ggap-5 container pad-t-8 pad-b-8">

<?php $tmp->inc("contact-details",'12'); ?>

		</section>


    <?php include('inc/footer.php'); ?>

  </main>


  <?php include('inc/bottomjs.php'); ?>
</body>

</html>