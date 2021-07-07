<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('inc/head.php'); ?>
</head>

<body>
  <main>  
  <?php include('inc/nav.php'); ?>

    <div class="g g1 valign-c align-l pad-t-4 pad-b-4 purple darken-2 white-text">
        <div class="container">
          <h3>Partner with us</h3>
        </div>
    </div>

    <div class="container pad-2 pad-t-4 pad-b-4">

<!-- .. -->

<form action='https://bigin.zoho.com.au/crm/WebToContactForm' name='CMIGNITEWebToContacts' method='POST' enctype='multipart/form-data' onSubmit='javascript:document.charset="UTF-8"; return checkMandatory()' accept-charset='UTF-8'>
<!-- Do not remove this code. -->
  <input type='hidden' style='display:none;' name='xnQsjsdp' value='d402c3856faf723eaa458711556eaea44cb55664a143a88c020254f8e5e09107'/>
  <input type='hidden' name='zc_gad' id='zc_gad' value=''/>
  <input type='hidden' style='display:none;' name='xmIwtLD' value='32c80678fefbf9ac727f4aee3fcc402224ecc011fe0e0bf8953327c625bec781'/>
  <input type='hidden' style='display:none;' name='actionType' value='Q29udGFjdHM='/>
  <input type='hidden' style='display:none;' name='returnURL' value='https://whiteshieldhealthcare.com.au/thankyou' />
  <div style="font-size: 21px; margin-bottom: 15px;word-break: break-word;">Sell your medical centre</div>
  <div style="border:0;width: 100%;background-color: white;color:black;font-family:Arial;text-align:left; font-size: 15;">
  <div class="bgn-wf-row">
  <div class="bgn-wf-label">Medical Centre name
  </div>
  <div class="bgn-wf-field">
  <input name="Account Name" type="text" maxlength="120" value="" placeholder="" />
  </div>
  </div>
<div class="g l2 m2 s1 xs1 ggap-1">
    <div class="bgn-wf-row">
  <div class="bgn-wf-label">First Name
  <span class="bgn-star">&#42;</span>
  </div>
  <div class="bgn-wf-field">
  <input name="First Name" type="text" maxlength="40" value="" placeholder="" />
  </div>
  </div>
  <div class="bgn-wf-row">
  <div class="bgn-wf-label">Last Name
  <span class="bgn-star">&#42;</span>
  </div>
  <div class="bgn-wf-field">
  <input name="Last Name" type="text" maxlength="80" value="" placeholder="" />
  </div>
  </div>
</div>
  <div class="bgn-wf-row">
  <div class="bgn-wf-label">Designation
  <span class="bgn-star">&#42;</span>
  </div>
  <div class="bgn-wf-field">
  <input name="CONTACTCF2" type="text" maxlength="255" value="" placeholder="" />
  </div>
  </div>
  <div class="g l2 m2 s1 xs1 ggap-1">
  <div class="bgn-wf-row">
  <div class="bgn-wf-label">Email
  <span class="bgn-star">&#42;</span>
  </div>
  <div class="bgn-wf-field">
  <input name="Email" type="text" maxlength="100" value="" placeholder="" />
  </div>
  </div>
  <div class="bgn-wf-row">
  <div class="bgn-wf-label">Mobile
  <span class="bgn-star">&#42;</span>
  </div>
  <div class="bgn-wf-field">
  <input name="Mobile" type="text" maxlength="30" value="" placeholder="" />
  </div>
  </div>
</div>
  <div class="bgn-wf-row">
  <div class="bgn-wf-label">Message
  </div>
  <div class="bgn-wf-field">
  <textarea name="Description" maxlength="32000" placeholder="" ></textarea>
  </div>
  </div>
  <div class="bgn-wf-row">
  <div class="bgn-wf-label">Website
  </div>
  <div class="bgn-wf-field">
  <input name="CONTACTCF3" type="text" maxlength="255" value="" placeholder="" />
  </div>
  </div>
  <div class="bgn-wf-row"><div class="bgn-wf-label"></div><div class="bgn-wf-field g la1 ma1 sa1 xs1 ggap-2 margin-t-3">
  <input onclick='disableSubmitwhileReset()' type='reset' class="default btn big grey lighten-3 purple-text" value='Reset' />
  <input  id='formsubmit' type='submit' value='Submit' class="default btn big btn-block" />
  </div></div>
  </div>
  <script>
  var mndFileds=new Array('First Name','Last Name','CONTACTCF2','Email','Mobile');
  var fldLangVal=new Array('First Name','Last Name','Designation','Email','Mobile');
  var name='';
  var email='';
  function disableSubmitwhileReset(){var e=document.getElementById("formsubmit");null!==document.getElementById("privacyTool")||null!==document.getElementById("consentTool")?(e.disabled=!0,e.style.opacity="0.5;"):e.removeAttribute("disabled")}
  function checkMandatory(){var e,t=mndFileds.length;for(e=0;e<t;e++){var i=document.forms.CMIGNITEWebToContacts[mndFileds[e]];if(i){if(0===i.value.replace(/^\s+|\s+$/g,"").length)return"file"===i.type?(alert("Please select a file to upload."),i.focus(),!1):(alert(fldLangVal[e]+" cannot be empty."),i.focus(),!1);if("SELECT"===i.nodeName){if("-None-"===i.options[i.selectedIndex].value)return alert(fldLangVal[e]+" cannot be none."),i.focus(),!1}else if("checkbox"===i.type&&!1===i.checked)return alert("Please accept  "+fldLangVal[e]),i.focus(),!1;try{"Last Name"===i.name&&(name=i.value)}catch(e){murphy.error(e)}}}return validateFileUpload()}
  function validateFileUpload(){var e=document.getElementById("theFile"),t=0;if(e){if(e.files.length>3)return alert("You can upload a maximum of three files at a time."),!1;if("files"in e){var i=e.files.length;if(0!==i){for(var o=0;o<i;o++){var a=e.files[o];"size"in a&&(t+=a.size)}if(t>20971520)return alert("Total file(s) size should not exceed 20MB."),!1}}}}</script>
</form>

<!-- .. -->

<!--       <form action="" method="POST" class="">
        <div class="g l2 m2 s1 xs1 ggap-1">
          <div>
            <input type="text" name="name" value="" label="name" required="">
            <input type="email" name="email" value="" label="email">
            <input type="tel" name="phone" value="" label="Phone">

            <select name="type" label="Select Option">
              <option value=""></option>
              <option value="feedback">Feedback</option>
              <option value="invester">Invester</option>
            </select>
          </div>
          <div class="g">
            <textarea name="msg" label="message"></textarea>
          </div>
        </div>
        <div class="g align-c">
          <button class="btn mdi mdi-send">Send</button>
        </div>
      </form> -->
    </div>


    <?php include('inc/footer.php')?>
  </main>


  <?php include('inc/bottomjs.php'); ?>
</body>

</html>