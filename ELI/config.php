<?php
// DATABASE CONFIG
//------------------------------------
//------------------------------------

# USER DATABASE
$GLOBALS['USER']['config']['dbtype'] = "sqlite"; // mysql,sqlite
$GLOBALS['USER']['config']['dbhost'] = "localhost"; // FOR SQLITE, Please mention SQLlite File Path
$GLOBALS['USER']['config']['dbuser'] = "admin";
$GLOBALS['USER']['config']['dbpass'] = "admin";
$GLOBALS['USER']['config']['dbname'] = "db/cmsv3";// FOR SQLITE, Please mention SQLlite File Path

# CMS Database
$GLOBALS['CMS']['config']['dbtype'] = "sqlite"; // mysql,sqlite
$GLOBALS['CMS']['config']['dbhost'] = "localhost"; // FOR SQLITE, Please mention SQLlite File Path
$GLOBALS['CMS']['config']['dbuser'] = "admin";
$GLOBALS['CMS']['config']['dbpass'] = "admin";
$GLOBALS['CMS']['config']['dbname'] = "db/cmsv3";


# EMAIL INFORMATION
$GLOBALS['config']['SmtpServer']="mail.techsoul.in";
$GLOBALS['config']['SmtpPort']=587;
$GLOBALS['config']['SmtpUser']="dummy@app.techsoul.in";
$GLOBALS['config']['SmtpPass']="dummy@777";
$GLOBALS['config']['SMTPSecure']="tls";
$GLOBALS['config']['mailFROM']="dummy@app.techsoul.in";


# CMS
$GLOBALS['cmspass'] = "superadmin777";


# SMS INFORMATION
$GLOBALS['sms']['url'] = "http://sms.360marketings.in/vendorsms/pushsms.aspx";
$GLOBALS['sms']['user'] = "TECHSOUL";
$GLOBALS['sms']['pass'] = "TechSou4567";
$GLOBALS['sms']['sid'] = "TechSo";

//------------------------------------
//   SITE DETAILS
//------------------------------------
$GLOBALS['impMail'] = "techsoul4@gmail.com";
$GLOBALS['site']['name'] = "MyCyberMD";
$GLOBALS['site']['author'] = "AJ";
$GLOBALS['shorturl'] = "";
//------------------------------------

$GLOBALS['config']['mailFROM'] = "techsoul4@gmail.com";
$GLOBALS['officemail'] = "aj@techsoul.in";

//------------------------------------
// Facebook Login

define('PROFILE_PIC', _ABSPATH_.'/files/dp/');

//------------------------------------
// Custom User Sets
//------------------------------------

// $_SESSION['user']['name'] = "Ajay";
// $_SESSION['user']['id'] = "1";
// $_SESSION['user']['role'] = "admin";

//////////////////////////////////////////

date_default_timezone_set("Asia/Kolkata");
//echo date('d-m-Y h:i a'); //Returns IST
//------------------------------------

$freepages = "REGISTER,LOGIN,SIGNUP,contact.php,partner.php,test.php";

// IMPORTANT TO SET
$websitepath = "ELIProductCMS/";
 ?>
