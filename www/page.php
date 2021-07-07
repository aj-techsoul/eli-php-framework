<?php
  $pg = @$page[0];
  if(isset($page[0])){
    $pgn = $page[0];
    $c2 = $db->query("SELECT * FROM contents WHERE pagename='$pgn' ","CMS");
    $default['content'] = base64_encode("<h1 class='grey-text tsize-15 margin-t-2'>CONTENT/PAGE NOT FOUND</h1> <div class='g align-l'><a href='index.php' class='btn black mdi mdi-arrow-left'> Go Home</a></div>");
    $c = (count($c2) > 0) ? $c2[0] : $default;
  }
  else {
    $c = array();
    $c['content'] = "<h1 class='grey-text'>PAGE NOT FOUND</h1> <div><br><a href='index.php'>Go Home</a></div>";
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('inc/head.php'); ?>
    <!-- <link rel="stylesheet" href="assets/css/mcontent.css" > -->
    <meta name="keywords" content="<?php echo @$c['keyword']; ?>">
    <meta name="description" content="<?php  echo @$c['description']; ?>">
</head>

<body>
  <main>

    <?php include('inc/nav.php'); ?>

    <div class="g g1 valign-c align-l pad-t-4 pad-b-4 purple darken-2 white-text">
        <div class="container">
          <h3><?php  echo @$c['title']; ?></h3>
        </div>
    </div>

    <div>
      <div class="pad-t-7 pad-b-7">
        <?php  echo base64_decode(@$c['content']); ?>
      </div>


      



  </main>
  <?php include('inc/footer.php')?>

  <?php include('inc/bottomjs.php'); ?>
</body>

</html>