<?php
  $cms = new CMS;
  $cms->allowperm("admin");    //$cms->allowperm($_SESSION['cms']['role']);
?>
<?php
  $db = new DATABASE;
  $tbl = "templates";
  $sql = "SELECT t.*,p.new_page  FROM $tbl as t
  LEFT JOIN pages as p on t.pageid = p.id ";
  $pages =  $db->query($sql,'CMS');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include("mcms/inc/head.php"); ?>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo CMS."core/appicon/app.".$page[1].".png"; ?>">
  <title>TEMPLATE-EDITOR</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.54.0/codemirror.min.css" integrity="sha256-Ez4TnBJ24JkU8Z622YHGxDaYrslkqNZ62ewvn08Skco=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.54.0/theme/material-ocean.min.css" integrity="sha256-liP64rlWYZGPbq1rvpeeS7CL8uNzuDEeFVUWCQcITeA=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.54.0/theme/midnight.min.css" integrity="sha256-dCaCwUXpme0tJSsjWxgWEUy2ZP5JsbNuQB7hCCaH99I=" crossorigin="anonymous" />
<style media="screen">
  :root {
      --c1 : '';
      --c1 : '';
  }

  section { padding:1em; grid-gap:1em; }
  a { text-decoration: none; }
  .allpages { list-style: none; padding:0px; margin:0px; min-width:300px; max-height:300px; overflow: hidden; overflow-y: auto; display:grid; grid-gap:.1em; align-content: start; }
  .allpages li { display:grid; grid-template-columns:1fr auto; background:rgba(0,0,0,.05); padding:.4em .9em; align-items: center; border-radius:3px; grid-gap:.5em; cursor: pointer; transition:1s all; }
  .allpages li a { color:rgba(0,0,0,0.7); font-weight:500; }
  .allpages li a > small { display:block; font-size:.67em; font-weight:500;color:rgba(0,0,0,.3); text-indent:0em; }
  .allpages li i { color:rgba(0,0,0,0.3); }
  .allpages li:hover i { color:red; }
  .allpages li i:hover { text-shadow:1px 1px 2px rgba(0,0,0,.3); }
  .allpages li:hover { background:rgba(0,0,0,.1); box-shadow:1px 2px 3px rgba(0,0,0,.2); }
  section.header { animation:slideIn 1s; align-items: center; background:rgba(0,0,0,.9); color:#fff; position: fixed; top:0px; left:0px; right:0px; z-index:3; }
  .formbox { align-items: start; }
  body { padding-top:100px; }
  .i1a { display:grid; grid-template-columns:1fr auto; border-radius:7px; }
  .i1aa { display:grid; grid-template-columns:1fr auto auto; border-radius:7px;  }
  .i1a .input-field,.i1aa .input-field { border-top-right-radius:0px; border-bottom-right-radius:0px; }
  .i1aa .input-field:nth-child(2) { border-radius:0px; }
  .i1a .btn,.i1aa .btn { border-top-left-radius:0px; border-bottom-left-radius:0px; display:grid; align-items: center; }
  .i1a .mdi,.i1aa .mdi { font-size:1rem; }
  .scrolp { overflow: hidden; overflow-y:auto; max-height:200px; }

  .sitem { display: grid;  grid-gap:.5em; align-items: start; padding:0px; }
  .sitem li { display:grid; grid-template-columns:1fr auto; align-content: space-between; align-items: center; border:1px solid rgba(0,0,0,.0); padding:.2em .5em; border-radius:7px; transition:.5 all; }
  .sitem li:hover { border-color:rgba(0,0,0,.2); }
  .sitem li p { width:100%; text-align: left; display:grid;color:rgba(0,0,0,.7); transition:.5 all;}
  .sitem li:hover p { color:rgba(0,0,0,.9); }
  .sitem li .btn { visibility: hidden; transition:.5 all; }
  .sitem li:hover .btn { visibility:visible; }
  @media (max-width:720px) {
    .allpages { min-width:200px; }
    .header .btn { display:block; padding:.2em; }
    .header h4 { font-size:1.5rem; }
    .formbox { margin-top:70px; }
    .i1aa { grid-template-columns:1fr; grid-gap:.2em; }
  }
</style>

</head>
<body>


<section class="header g g1a m1a s1 xs1">
  <h4><?php include(CMS.'inc/apptitle.php'); ?> Template Manager</h4>
  <div class="g g2 ggap">
    <a href="CMS/templatemanager" class="mdi mdi-file-outline btn">New</a>
    <span class="btn blue mdi mdi-floppy" onclick="getContent(); validSubmit('#addPG')" > SAVE</span>
  </div>
</section>

<?php
  if(isset($_GET['edit']) && is_numeric($_GET['edit']) ){
    $eid = $_GET['edit'];
    $c2 = $db->query("SELECT * FROM $tbl WHERE id='$eid' ",'CMS');
//    print_r($c2);
    $c = (count($c2) > 0) ? $c2[0] : '';
  }
  else {
    $c =  array();
  }
?>

<section class="formbox g g1a m1a s1 xs1">

  <form action="CMS/p/templatemanager/addtemplate" method="post" enctype="multipart/form-data" id="addPG" >
      <div class="i1a">
        <select name="pageid" label="Page Type" required >
            <option value="0">/</option>
            <?php
                $pgc = $db->query("SELECT * FROM pages WHERE status='1' ","CMS");
                foreach ($pgc as $pc) {
                  echo "<option value='$pc[id]'>$pc[new_page]</option>";
                }
            ?>
        </select>
        <a href="#pagecategory" class="modal-target mdi mdi-plus-box btn black"></a>
      </div>
      <input type="text" name="type" value="<?php echo @$c['type']; ?>" list="ttype" label="Template Type" required>
      <datalist id="ttype">
          <option>head</option>
          <option>header</option>
          <option>footer</option>
          <option>bottomjs</option>
      </datalist>
      <input type="text" name="role" value="<?php echo (isset($c['role'])) ? $c['role'] :'FREE'; ?>" label="Role" required>
      <textarea id="contentArea" name="content" class="default" required > <?php echo base64_decode(@$c['content']); ?> </textarea>
      <input type="hidden" name="csrf" value="<?php echo $_SESSION['token']; ?>" class="default">
      <input type="hidden" name="id" value="<?php echo @$c['id']; ?>" class="default">
  </form>

  <ul class="allpages">
    <li><h6>All Template</h6> </li>
<!--
<li> <a href="#">PageName <small>Wed 18,2020</small> </a> <i class="mdi mdi-delete"></i> </li>
-->
    <?php
    //  $db = new DATABASE;
      if(count($pages) > 0){
        foreach ($pages as $p) {
          echo "<li> <a href=\"CMS/templatemanager?edit=$p[id]\">$p[type] <small>".$p['new_page']."</small> </a> <i class=\"mdi mdi-delete\"></i> </li>";
        }
      }
    ?>
  </ul>


</section>





<!--
  MODAL
-->

<div id="pagecategory" class="modal">
  <div class="modal-container">
    <i class="modalclosebtn mdi mdi-close"></i>
      <div class="">
          <form id='addpgcat' class="" action="CMS/p/pagemanager/addpagecategory" onsubmit="return false;" method="post">
              <div class="i1aa">
                <input type="text" name="new_page" value="" label="Page Category" required>
                <input type="text" name="actual_page" value="page.php" required label="Actual Page">
                <span class="mdi mdi-plus-box btn black" onclick="validSubmit('#addpgcat')" ></span>
              </div>
              <input type="hidden" name="csrf" value="<?php echo $_SESSION['token']; ?>">
          </form>
          <div class="g g1 scrolp" >
              <ol  class="sitem gaaa">
                <?php
                    $pgc = $db->query("SELECT * FROM pages WHERE status='1' ","CMS");
                    foreach ($pgc as $pc2) {
                      echo "<li>
                        <p><strong>$pc[new_page]</strong>
                        <small>$pc2[actual_page]</small></p>
                        <span class=\"btn red mdi mdi-delete hide \"></span>
                      </li>";
                    }
                ?>

              </ol>
          </div>
      </div>
    </div>
</div>

<!-- // -->

<?php include("mcms/inc/bottomjs.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.54.0/codemirror.min.js" integrity="sha256-zW3RviTWD2qcjPDA/ByugxSFO5EPHb8Yl0Z6o7X9Zqk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.54.0/keymap/sublime.min.js" integrity="sha256-KPnHyOqFWn7kxgwQnrXHK9wLtgU1QP4+g3oo4UXmIkI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.54.0/mode/htmlmixed/htmlmixed.min.js" integrity="sha256-GQZ9+vs5r8hhzJxB1fgAojLiI4Me/rpFHzPiUHh1Wks=" crossorigin="anonymous"></script>
<script>
  var editor = CodeMirror.fromTextArea(contentArea, {
    lineNumbers: true,
    mode: "htmlmixed",
    theme: "midnight",
    keymap: "sublime",
    lineNumbers: true,
    inputStyle: 'contenteditable'
  });
  function getContent(){
    document.querySelector('[name=content]').innerHTML = editor.getValue();
  }
</script>
  <?php
      if(!isset($_POST['edit']) && !is_numeric(@$_POST['edit']) ){
?>
<script type="text/javascript">
    document.getElementById('addPG').reset();
</script>
<?php
      }
  ?>



</body>
</html>
