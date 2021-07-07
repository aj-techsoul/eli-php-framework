<?php
/**
 *  ELi FRAMEWORK
 */
function getProjectPath(){
  $currentfile = dirname(__FILE__);
  $absprojectpath = preg_replace('#\/[^/]*$#', '', $currentfile);
  return $absprojectpath.'/';
}
$projectpath = getProjectPath();

// DEFINE
//------------------------------------
//------------------------------------
define('CMS','mcms/');
define('USER','user/');
define('WWW','www/');
define('VIEW','www/');
define("ELI","ELI/");
define("CLASS_DIR","ELI/classes/");
define("PROCESS","ELI/process/");
define('_ABSPATH_',$_SERVER['DOCUMENT_ROOT']);
define('_CMSDB_',$projectpath);

if(isset($_SESSION['user'])){
  define('CURRENT_USER',$_SESSION['user']);
}


require('config.php');
$http = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
define('HTTP',$http);
define('_PROJECTPATH_',$projectpath);
define('_BASEURL_',HTTP."://".$_SERVER["SERVER_NAME"]."/".$websitepath);
define('_BASEROOT_',_ABSPATH_."/".$websitepath);
define('_BASEPATH_',HTTP."://".$_SERVER["SERVER_NAME"]."/".$websitepath.WWW);
define('_CMSPATH_',HTTP."://".$_SERVER["SERVER_NAME"]."/".$websitepath.CMS);
define('PAGE',@$_GET['url']);
define('CMSURL',_BASEURL_."CMS/");
?>
