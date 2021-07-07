<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('inc/head.php'); ?>
</head>

<body>
  <main>

    <?php include('inc/nav.php'); ?>

    <div class="g g1 valign-c align-l pad-t-4 pad-b-4 purple darken-2 white-text">
        <div class="container g l1a m1a s1 xs1 talign-l valign-c">
          <h4>Welcome, <?php echo CURRENT_USER['name'] ?>  </h4>
          <a href="LOGOUT" class="mdi mdi-logout"> Logout</a>
        </div>
    </div>

      <div class="container pad-t-7 pad-b-7 g g1">
          <div class="g la1 ma1 s1 xs1 valign-c ggap-2 margin-b-3">
            <h4>Reports</h4> <small class="c4-text">Download Reports</small>
          </div>

         <ul class="list-group">
          
             <?php
                $dir = "files/reports/";
                $rpts = scandir($dir);
                unset($rpts[0]);
                unset($rpts[1]);
                if(count($rpts) > 0){
                    foreach($rpts as $rpt){
                     echo '<li><a class="g g1a ggap-1" download="" href="'.$dir.$rpt.'">'.$rpt.' <small>'.date("F d Y H:i:s. ", filemtime($dir.$rpt)).'</small></a></li>'; 
                    }
                }
                else
                {
                  echo '<li><a href="#">No Reports Now</a></li>';        
                }
             ?>
         </ul> 

      </div>


      



  </main>
  <?php include('inc/footer.php')?>

  <?php include('inc/bottomjs.php'); ?>
</body>

</html>