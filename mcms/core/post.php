<?php
$csrf_got = @$_POST['csrf'];
$v = new VALIDATOR;
$mail = new MAILER;
$db = new DATABASE;

$cms = new CMS;
$islogin = $cms->isloggedin();
//////////////////////////////
if(isset($page[1]) && $page[1]=='p' || isset($page[2]) && $page[2]=='p'){
  if(strtolower($page[1]) == 'admin'){
    $ppage = $page[3];
  }
  else {
    $ppage = $page[2];
  }
  switch($ppage){
      case "LOGIN":
          if(isset($_POST['password'])){
            $c = new CMS;
            $usrname = @$_POST['email'];
            $usrpass = @$_POST['password'];
            $r =  $c->login($usrpass,$usrname,$_SESSION['token']);

            if($r){
              //print_r($r);
              echo "Successfully Login";
              $redirect = (isset($_SESSION['ref']))? $_SESSION['ref'] : CMSURL;
              echo "<script>window.location.href='".$redirect."';</script>";
            }
            else {
              echo "<span class='badge'>Wrong Password</span>";
            }
          }
          else {
            echo "No Key to the Door!";
          }
      break;
      case "profilechange":
        if(isset($_POST) && $v->required($_POST['name'],'Name') && $v->required($_POST['email'],'Email') && $v->required($_POST['password'],'Password') && isset($_SESSION['cms']['user']['id']) && isset($_SESSION['cms']['dbarea']) && check_csrf($csrf_got) )
        {
            $fd = $v->need('name,email,password',$_POST); 
            $fd['password'] = md5($_POST['password']);

            //$fd['logdate'] = date("Y-m-d H:i:s");
            if(isset($_SESSION['cms']['role'])){
              $eid = @$_SESSION['cms']['user']['id'];      
              $role = $_SESSION['cms']['role'];
              $dbarea = $_SESSION['cms']['dbarea'];
              //print_r($_SESSION);
                switch ($role) {
                  case 'doctor':                                            
                      $res =  $db->update_row('doctors',$fd," id='$eid' ",$dbarea);
                  break;
                  
                  default:                            
                    $res = $db->update_row("users",$fd," id='$eid' ",$dbarea);
                  break;
                }

               if(@$res['success']){
                  echo @$res['message'];
               } 
               else
                {
                  echo "Nothing new updated";
                }
            }
        } 
        else
        {
          echo "Please Refresh and Try again.";
        }
      break;
      default:
      break;
  }
}
////////////////
if(isset($page[1]) && $page[1]=='p' || isset($page[2]) && $page[2]=='p' && $islogin){
  if(strtolower($page[1]) == 'admin'){
    $ppage = $page[3];
  }
  else {
    $ppage = $page[2];
  }

// Initialize
$csrf_got = @$_POST['csrf'];
$ValidateEmail = true; // VALIDATE EMAIL (true/false)
$v = new VALIDATOR;
$mail = new MAILER;
$db = new DATABASE;
//////////////////

  switch($ppage){
    case "pagemanager":
      switch ($page['3']) {
        case "addPage":
          if(isset($_POST) && $v->required($_POST['pagename'],'PageName') &&  $v->required($_POST['content'],'content') && check_csrf($csrf_got)){
            $fd = $v->need('title,pagename,keyword,description,pageid',$_POST);
            $fd['content'] = base64_encode($_POST['content']);

            ///////// find previewimg /////
              preg_match_all('/<img[^>]+>/i',$_POST['content'], $result);
              $img = array();
                foreach( $result[0] as $img_tag)
                {
                    preg_match_all('/(src)=("[^"]*")/i',$img_tag, $img);
                }

               $imgprev = trim(@$img[2][0],'"');

              if(isset($imgprev) && $imgprev!="" && file_exists(_BASEROOT_.'/'.$imgprev))
              {
                $fd['previewimg'] = $imgprev;
              }

              
            ///////////////////////////////

              $chk = $db->query("SELECT * FROM contents WHERE pagename LIKE '$fd[pagename]' ",'CMS');
              if(count($chk) > 0){

                if(isset($_POST['id']) && is_numeric($_POST['id']) ){
                  $id = $_POST['id'];
                  $res =  $db->update_row('contents',$fd," id='$id' ","CMS");
                //  print_r($res);
                  echo $res['message'];
                }
                else {
                    echo $fd['pagename']." already exist";
                }
              }
              else {
                $res =  $db->insert_row('contents',$fd,'CMS');
              //  print_r($res);
                echo $res['message'];
              }
          }
          else {
            echo "Please kindly all fields";
          }
        break;

        case "addpagecategory":
          if(isset($_POST) && $v->required($_POST['new_page'],'Page Category') && check_csrf($csrf_got)){
            $fd = $v->need('new_page,actual_page',$_POST);
            $fd['status'] = '1';
            $tbl = "pages";
              $chk = $db->query("SELECT * FROM $tbl WHERE new_page LIKE '$fd[new_page]' ",'CMS');
              if(count($chk) > 0){
                  $res =  $db->update_row($tbl,$fd," new_page LIKE '$fd[new_page]' ","CMS");
                  echo $res['message'];
              }
              else {
                $res =  $db->insert_row($tbl,$fd,'CMS');
              //  print_r($res);
                echo $res['message'];
              }
          }
          else {
            echo "Please kindly all fields";
          }
      break;

      case "addBlog":
        if(isset($_POST) && $v->required($_POST['pagename'],'PageName') &&  $v->required($_POST['content'],'content') && check_csrf($csrf_got)){
          $fd = $v->need('title,pagename,keyword,description',$_POST);
          $fd['content'] = base64_encode($_POST['content']);
          $fd['did'] = @$_SESSION['cms']['user']['id'];
            
          ///////// find previewimg /////
              preg_match_all('/<img[^>]+>/i',$_POST['content'], $result);
              $img = array();
                foreach( $result[0] as $img_tag)
                {
                    preg_match_all('/(src)=("[^"]*")/i',$img_tag, $img);
                }

               $imgprev = trim(@$img[2][0],'"');

              if(isset($imgprev) && $imgprev!="" && file_exists(_BASEROOT_.'/'.$imgprev))
              {
                $fd['previewimg'] = $imgprev;
              }

          

            $chk = $db->query("SELECT * FROM blogs WHERE pagename LIKE '$fd[pagename]' ");


            if(count($chk) > 0){

              if(isset($_POST['id']) && is_numeric($_POST['id']) ){
                $id = $_POST['id'];
                $res =  $db->update_row('blogs',$fd," id='$id' ");
              //  print_r($res);
                echo $res['message'];
              }
              else {
                  echo $fd['pagename']." already exist";
              }
            }
            else {
              $res =  $db->insert_row('blogs',$fd);
            //  print_r($res);
              echo $res['message'];
            }
        }
        else {
          echo "Please kindly all fields";
        }
      break;

        default:
          // code...
          break;
      }
    break;

    case "templatemanager":
      switch ($page['3']) {
          case 'addtemplate':
          if(isset($_POST) && $v->required($_POST['type'],'type') &&  $v->required($_POST['content'],'content') && check_csrf($csrf_got)){
            $tbl = "templates";
            $fd = $v->need('content,type,role,pageid',$_POST);
            $fd['content'] = base64_encode($_POST['content']);
              $chk = $db->query("SELECT * FROM $tbl WHERE pageid LIKE '$fd[pageid]' AND type LIKE '$fd[type]' ",'CMS');
              if(count($chk) > 0){
                $res =  $db->update_row($tbl,$fd,"  pageid LIKE '$fd[pageid]' AND type LIKE '$fd[type]'  ","CMS");
                //  print_r($res);
                  echo $res['message'];
              }
              else {
                $res =  $db->insert_row($tbl,$fd,'CMS');
              //  print_r($res);
                echo $res['message'];
              }
          }
          else {
            echo "Please kindly all fields";
          }
        }
          break;


      case "appointment":
        switch ($page['3']) {
            case 'addremark':
            if(isset($_POST) && $v->required($_POST['id'],'id') &&  $v->required($_POST['status'],'Attended') && $islogin && check_csrf($csrf_got)){
              $tbl = "appointment";
              $fd = $v->need('id,status,remarks',$_POST);
              $fd['did'] = @$_SESSION['cms']['user']['id'];
                  $res =  $db->update_row($tbl,$fd," id='$fd[id]' ");
                  if($res['success']){
                    echo $res['message'];
                    //upload prescription
                    if(isset($_FILES)){
                      $u = new UPLOADER;
                      $uconfig['filename'] = "mycybermd_prescription_$fd[id]";
                      $u->upload($_FILES['prescription'],"prescription/".$fd['id'],$uconfig);
                      echo "<script>window.location.reload();</script>";
                    }
                    ////////////
                  }
                  else {
                    echo "Update Failed";
                  }
            }
            else {
              echo "Please kindly all fields";
            }
          }
          break;

    case "forums":
      switch($page['3']){
          default:
            if(isset($_POST) && $v->required($_POST['id'],"Forum ID") && $islogin && check_csrf($csrf_got)){
              $id = $_POST['id'];
              $tbl = "blogs";
              $fd = $v->need('title,keyword,content',$_POST);
            //  echo $fd['content'];
              $fd['content'] = base64_encode($fd['content']);
              $fd['fid']=$id;
              $fd['did']= $_SESSION['cms']['user']['id'];
              $chk = $db->query("SELECT * FROM blogs WHERE fid='$id'");
              if(count($chk) > 0){
                // update
                $bid = @$chk[0]['id'];
                $res = $db->update_row($tbl,$fd," id='$bid' ");
                // Set ForUM Status


                $fds['did'] = $fd['did'];
                $fds['status'] = "answered";
                $fds['alink']='FORUM/'.$bid.'/'.$_POST['pagename'];
                $db->update_row("forums",$fds," id='$id' ");
              }
              else {
                // insert
                $res = $db->insert_row($tbl,$fd);
                $bid = @$res['id'];
                // Set ForUM Status
                $fds['did'] = $fd['did'];
                $fds['status'] = "answered";
                $fds['alink']='FORUM/'.@$bid.'/'.@$_POST['pagename'];
                $db->update_row("forums",$fds," id='$id' ");
              }
              if($res['success']){
                echo "Forum Replied Successfully";
              }
              else {
                echo "Its already replied";
              }
            }
            else {
              echo "Please reply properly";
            }
          break;
      }
    break;

    case "assigndoctor":
      if(isset($_POST['id']) && isset($_POST['did']) && is_numeric($_POST['did']) ){
         $eid = @$_POST['id'];
         $fd = $v->need("did",$_POST);        
         $db = new DATABASE; 
         $res = $db->update_row("ibu",$fd," id='$eid' AND status > 0 ");
         //echo $_POST['id'];
         //print_r($res);
         if($res['success']){
          echo $res['message'];
         }
         else
          {
            echo "Unable to Assign";
          }
      }
      else
      {
        echo "Select a doctor";
      }
    break;

    case "addplogs":
      if(isset($_POST['id']) && isset($_POST['remarks']) && isset($_POST['subject'])){

         $fd = $v->need("remarks,subject,status",$_POST);
         $fd['iid'] = @$_POST['id'];
         $fd['did'] = @$_SESSION['cms']['user']['id'];         
         $db = new DATABASE; 
         $chk = $db->query("SELECT * FROM ibulogs WHERE iid='$fd[iid]' AND 
         did='$fd[did]' AND  logdate >= CURRENT_TIMESTAMP - INTERVAL 5 MINUTE ORDER BY logdate desc");
         if(count($chk) > 0){
            $eid = @$chk[0]['id'];
            $res = $db->update_row("ibulogs",$fd," id='$eid' ");   
         }
         else
          {
            $res = $db->insert_row("ibulogs",$fd);   
          }
         
         //echo $_POST['id'];
         //print_r($res);
         if($res['success']){
          echo $res['message'];
         }
         else
          {
            echo "Unable to Log";
          }
      }
      else
      {
        echo "Please fill details properly";
      }
    break;

    default:
    //  echo "404 Error";
      break;
  }
}
?>
