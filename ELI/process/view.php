<?php
$csrf_got = @$_POST['csrf'];
$validateEmail = false; // VALIDATE EMAIL (true/false)
$url = page(PAGE);
//print_r($url);
switch (@$url[1]){

    // Dummy
    case "categorylist":
      echo '<option value="0">Main</option>';
      $db = new DATABASE;
      $res =  $db->query("SELECT c.id,c.category FROM category as c
                          WHERE c.pid='0' AND c.status='1'");
      $tpl=new TEMPLATE;
      $template='<option value="{{id}}">{{category}}</option>';
      $list=$tpl->viewer($res,$template);
    break;

    default:
      $pageurl = VIEW."$page";
      if(file_exists($pageurl))
      {
        include($pageurl);
      }
      else
      {
        include(VIEW.'404.php');
      }
    break;
}
?>
