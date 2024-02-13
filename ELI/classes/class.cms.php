<?php

    /**
     * Mini CMS by TechSoul
     */
    class CMS
    {
        function login($password,$username="",$csrf=""){

          if(!isset($GLOBALS['cmspass'])){
            $GLOBALS['cmspass'] = "Super777";
          }

          //echo $GLOBALS['cmspass'];

            // You have to mandatory set password end with 777. To Salt.
            if($GLOBALS['cmspass'] == $password  && check_csrf($csrf)){
                $db = new DATABASE;
                $sql = "SELECT * FROM superuser limit 1";
                $usr =  $db->query($sql,'CMS');

                $_SESSION['cms']['active'] = "y";
                $_SESSION['cms']['logdate'] = date('Y-m-d H:i:s');
                $_SESSION['cms']['ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['cms']['role'] = "superadmin";
                $_SESSION['cms']['user'] = @$usr[0];

              return true;
            }
            
            if(isset($password) && isset($username) && check_csrf($csrf) ){
              // Comment below line if not encrypting the password.
              $password = md5($password);
              $db = new DATABASE;
              $tbl = "users";
              $sql = "SELECT * FROM $tbl WHERE role LIKE '$username' AND password LIKE '$password'  OR email LIKE '$username' AND password LIKE '$password' ";

              $dbchk = $db->connect_db('',$GLOBALS['USER']['dbtype'],true);
              if($dbchk['success']){                
                $usr =  $db->query($sql,'USER');     
              }
              else
              {
                $usr = array();
              }
              if(count($usr) > 0){
                $susr = $usr[0];
                unset($susr['password']);
                $_SESSION['cms']['dbarea'] = "USER";
                $_SESSION['cms']['active'] = "y";
                $_SESSION['cms']['logdate'] = date('Y-m-d H:i:s');
                $_SESSION['cms']['ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['cms']['role'] = (isset($susr['role'])) ? $susr['role'] : 'doctor';
                $_SESSION['cms']['user'] = $susr;
                return true;
              }
              else
              {
                $db = new DATABASE;
                $tbl = "users";
                $sql = "SELECT * FROM $tbl WHERE role LIKE '$username' AND password LIKE '$password'  OR email LIKE '$username' AND password LIKE '$password' ";
              
                $uadmin =  $db->query($sql,'CMS');                

                  if(count($uadmin) > 0){
                      $susr = $uadmin[0];
                      unset($susr['password']);
                      $_SESSION['cms']['dbarea'] = "CMS";
                      $_SESSION['cms']['active'] = "y";
                      $_SESSION['cms']['logdate'] = date('Y-m-d H:i:s');
                      $_SESSION['cms']['ip'] = $_SERVER['REMOTE_ADDR'];
                      $_SESSION['cms']['role'] = (isset($susr['role'])) ? $susr['role'] : 'admin';
                      $_SESSION['cms']['user'] = $susr;
                      return true;
                    }
                    else
                    {
                      return false;
                    }
              }
            }
        }


        function isloggedin(){
          if(isset($_SESSION['cms']['active'])){
            return true;
          }
          else {
            return false;
          }
        }

        function getappinfo($appdir){
            $appinfo = $appdir."/app.inf";
            if(file_exists($appinfo)){
              $appinf = file_get_contents($appinfo);
              $appinfarray = json_decode($appinf,true);
              return $appinfarray;
            }
            else
            {
              return "App info cannot found";
            }
        }

       function scanapps(){
          $appdir = CMS."apps/";
          $allapps = scandir($appdir);
          if(count($allapps) > 0){
              foreach ($allapps as $a) {
                 $chk1 = substr($a, 0, 1);
                 if($chk1!="."){
                  // Real Apps
                  if(file_exists($appdir."/".$a."/app.inf")){
                      $inf = self::getappinfo($appdir."/".$a);
                      $cmsapps[$a] = $inf;
                  }
                  else
                  {
                    //echo $a."No";
                  }
                 }
              }
              return $cmsapps;
          }
          else
          {
            return "No Apps";
          }
       }

       function cmsnavigator($page){
        $islogin = self::isloggedin();
        $role = @$_SESSION['cms']['role'];
        if(strtolower(@$page[1]) === 'admin'){
          $currentpg = @$page[2];
          $apppage = @$page[3];
        }
        else {
          $currentpg = @$page[1];
          $apppage = @$page[2];
        }

        $cmsapps = self::scanapps();
        
        // AppPage
        $ocpg = CMS."apps/".strtolower($currentpg)."/index.php";
        require(CMS."core/config.php");

       // echo $ocpg;

        //post.php
        if(isset($currentpg) && $currentpg=='p' OR $apppage=='p'  ){
            require(CMS."core/post.php");
        }
        elseif($islogin){
            if(file_exists($ocpg)){
              //include(CMS."inc/header.php");
              include($ocpg);
            }
            else {
              if(strtolower($currentpg) == 'logout' OR strtolower($apppage) == 'logout' AND $islogin ){
                unset($_SESSION['cms']);
                session_destroy();
                header("location: ".CMSURL);
              }
              $_SESSION['ref'] = (is_array($page))? implode("/",$page) : CMSURL;
              include(CMS.'cms.php');
            }
        }
        else {
          $_SESSION['ref'] = (is_array($page))? implode("/",$page) : CMSURL;
          include(CMS.'cms.php');
        }
      }

      // Allow Permission
      function allowperm($role){
           $role2 = strtolower($role);
           $role2 = explode(',',$role2);
           $currentRole = strtolower($_SESSION['cms']['role']);
          if(isset($role2) AND !in_array($currentRole,$role2)){
            die("Sorry, No Access, Only $role can access");
          }
      }

      function allapps(){
        $cmsapps = self::scanapps();
       // print_r($cmsapps);
        if(count($cmsapps) > 0){
          foreach ($cmsapps as $appname => $info) {
            $info['icon'] = CMS."apps/".$appname."/".$info['icon'];
            // filter
            if(isset($info['filter']) && $info['filter']!=""){
              $filter = explode(',',@$info['filter']);
              $filter = implode(" ",$filter);
            }
            else
            {
              $filter = "";
            }


              if(in_array($appname,$GLOBALS['apppopup'])){
                  
                  // popup
                  echo "<a  class='".@$filter."' target='_blank' style='cursor:pointer;' onclick=\"PopupCenter('CMS/$appname','".$info['name']."','1200','620');\" > <img src='".$info['icon']."' /> <strong>".$info['name']."</strong>   </a>";
                 }
                 else
                  {
                   // Direct Open New 
                   echo "<a class='".@$filter."' target='_blank' href='CMS/$appname' > <img src='".$info['icon']."' /> <strong>".$info['name']."</strong>   </a>";
                  }
                 
          }
        }

      }

    }
?>
