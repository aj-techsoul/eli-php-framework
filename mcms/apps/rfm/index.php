<?php
  $cms = new CMS;
  $cms->allowperm("admin");    //$cms->allowperm($_SESSION['cms']['role']);
  $fmpath = CMS."apps/rfm/filemanager/dialog.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <base href="<?php echo _BASEURL_ ?>" target="_self">
    <meta charset="utf-8">
    <title>File-Manager</title>
  </head>
  <body>
      <script type="text/javascript">
          window.location.href = '<?php echo $fmpath; ?>';
      </script>
  </body>
</html>
