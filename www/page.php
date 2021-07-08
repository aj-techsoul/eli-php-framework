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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/aj-techsoul/ELICSS@3.7.1/eli.css" />
    <meta name="keywords" content="<?php echo @$c['keyword']; ?>">
    <meta name="description" content="<?php  echo @$c['description']; ?>">
    <script defer="" src="https://cdn.jsdelivr.net/gh/aj-techsoul/ELICSS@3.7.1/eli.min.js"></script>
</head>

<body>
  <main>

    <div class="g g1 valign-c align-l pad-t-4 pad-b-4 grey lighten-4 black-text">
        <div class="container">
          <h3><?php  echo @$c['title']; ?></h3>
        </div>
    </div>

    <div>
      <div class="pad-t-7 pad-b-7 container">
        <?php  echo base64_decode(@$c['content']); ?>
      </div>


      



  </main>
</body>

</html>