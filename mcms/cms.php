<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include('inc/head.php'); ?>
    <title>Cmini</title>
    <style media="screen">
        :root {
          --btn-color : rgba(0,0,0,.7);
        }
        body { background: #7a68fe; background-image:linear-gradient(19deg, #21D4FD 0%, #B721FF 100%); background-repeat: no-repeat; background-size: cover; background-attachment: fixed; font-family:'Roboto',sans-serif;  }
        .loginbox { min-width:300px; color:rgba(0,0,0,.3); background:rgba(0,0,0,.1); border:3px solid rgba(255,255,255,.7); border-radius:7px; padding:1em; width:max-content;  margin:0 auto; display:grid; align-self:center; min-height:100vh;  border:none; background:none;   }
        h4 { font-weight:500; }
        .brand { width:100%; display: grid; justify-content: center; align-items: center;  }
        .brand #logo { width:100px;  animation:padda 3s ease-in-out; fill:#fff; }
        .brand #title {  animation:padda2 2.7s ease-in-out; fill:rgba(0,0,0,.7); animation-delay:1s; }
        @keyframes padda {
          0% {
            stroke-dashoffset: 2000; stroke-dasharray:2000; stroke:#fff; fill:transparent;
          }
          60% { stroke-dashoffset: 0; fill:transparent; stroke:#fff; }
        65% {
              stroke-dashoffset: 0;
              fill:#fff;
              stroke:transparent;
            }
            100% {
                  stroke-dashoffset: 0;
                  fill:#fff;
                  stroke:transparent;
                }
        }

        @keyframes padda2 {
          0% {
            stroke-dashoffset: 2000; stroke-dasharray:2000; stroke:#333; fill:transparent;
          }
          60% { stroke-dashoffset: 0; fill:transparent; stroke:#333; }
        65% {
              stroke-dashoffset: 0;
              fill:rgba(0,0,0,.7);
              stroke:transparent;
            }
            100% {
                  stroke-dashoffset: 0;
                  fill:rgba(0,0,0,.7);
                  stroke:transparent;
                }
        }
/*  APP MENU Style */

    .appsmenu { display:grid; grid-gap:1em; padding:1em; align-items:start; align-self: start; width:70%; margin:0 auto; max-height:calc(100vh - 42vh);  overflow: hidden; overflow-y:auto;  }
    .appsmenu a { transition:1s all ease-in-out;  animation:zoomIn .5s ease-in-out;  display:grid; text-align: center; text-transform: capitalize; grid-gap:.5em; padding:.5em; border-radius:7px; border:2px solid rgba(255,255,255,.0); transition:.5s all; width:100%;  }
    .appsmenu a .mdi { color:rgba(0,0,0,.7); }
    .appsmenu a img { display: block; max-width:64px; max-height:64px; margin:0 auto; }
    .appsmenu a strong {  color:rgba(255,255,255,.7); font-weight:400; text-shadow:1px 1px 1px rgba(0,0,0,.4); }
    .appsmenu a:hover { background:rgba(0,0,0,.4); border:2px solid white; }
    .appsmenu a:hover img { animation:zoomIn .8s; }
    .appsmenu a:hover strong { color:white; }
    .appsmenu a:hover .mdi { color:white;  }
    @media (max-width:800px) {
      .loginbox { border:none; background:transparent; }
      .appsmenu { width:100%; max-height:calc(100vh - 42vh); }
    }

    /* taskbar */
    .taskbar { background:var(--btn-color); color:#fff; font-weight:400; width:100%; position:fixed; bottom:0px; display:grid; 
      grid-template-columns:1fr 3fr 1fr; grid-gap:1em; 
      padding:.5em 1em; 
    }
    .taskbar nav { display:grid; justify-content:center; grid-auto-flow:column;  grid-gap:1em; }  
    .taskbar a { transition:.5s all ease-in-out;  color:rgba(255,255,255,.5); position: relative; text-align: center; min-width:50px;  }
    .taskbar a:hover { color:rgba(255,255,255,.9); }
    .taskbar a > strong { display: none; }
    .taskbar a:hover > strong { animation:fadeInUp .5s;  display:block; position:absolute; top:-10px; left:0; width:100%; text-align:center;   font-weight:400; color:; font-size:small;  }
    .taskbar .profile { display:grid; align-items:center; grid-template-columns:auto 1fr; grid-gap:1em;  }
    .taskbar .user { display:grid;  }
    .taskbar .user small:first-child { font-weight:500; text-transform:capitalize; }
    .taskbar .profile .photo { font-size:2.5em;  }

    /* filter */
    .filter { display:grid; justify-content:center; grid-auto-flow:column; grid-gap:1em;  margin-bottom:2em;   }
    .filter > span { pointer-events:all; display:block;  background:rgba(0,0,0,0.3); color:rgba(255,255,255,.7); padding:.2em 1em; border-radius:20px;  cursor: pointer;  }
    .filter > span:hover,.filter > span.active { background:var(--btn-color); color:rgba(255,255,255,1); }
    </style>
  </head>
  <body>
    <?php
      $cms = new CMS;
      $islogin = $cms->isloggedin();
      if($islogin){
?>
<div class="brand">
  <svg width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 441 393.9" style="enable-background:new 0 0 441 393.9;" xml:space="preserve">
  <path id="logo" d="M337.7,111.5l2.7,0.3c10.1,2.2,14.5,4.1,17.7,9.2c2,3.2,4.4,8.2,1.2,19.6c-2.7-6.4-6.5-9.9-11.8-9.7
    c-4.6,0.1-9.1,1.1-13.3,3.1c-3.9,1.9-8.1,3.9-10.2,8.5c-2.8,6.3,0.4,12.8,1,14c-6.2-4.3-9.2-11.1-7.5-16.7c0.9-3.2,3.1-5.2,4.6-6.3
    c6.2-5,13.4-8.6,21.1-10.6c-6.3-5.6-14.7-8.3-23.2-7.5c1.7-1.6,3.8-2.7,6.1-3.1c-0.3-0.1-0.9-0.3-1.5-0.5c-2.1-0.6-4.3-1.1-6.5-1.4
    c-7.3-0.9-10.1,0.3-18.7,0.7c-8.7,0.4-15.2,0.6-21.8-2.7c-3-1.6-5.8-3.7-8-6.3c3.5,1.5,7.3,2.4,11.1,2.9c5.5,0.7,10.1,0,18.1-1
    c5.5-0.7,5.7-1,9.5-1.4c3.7-0.3,8.3-0.7,12.6,0c2.4,0.4,7.3,1,12.6,4.8C335,108.4,336.7,110.1,337.7,111.5z"/>
  <g id="title">
    <path d="M290.1,149.2c4.7,0,9.1,0.9,13.1,2.6c4.1,1.8,7.6,4.2,10.7,7.2c3.1,3.1,5.5,6.6,7.3,10.7c1.8,4.1,2.6,8.4,2.6,13.1v33.8
      h-13.4v-33.8c0-2.8-0.5-5.4-1.6-7.9c-1.1-2.5-2.5-4.6-4.4-6.5c-1.9-1.9-4-3.3-6.5-4.4c-2.5-1.1-5.2-1.6-8-1.6
      c-2.8,0-5.4,0.5-7.9,1.6c-2.5,1-4.6,2.5-6.5,4.4c-1.9,1.9-3.3,4-4.4,6.5s-1.6,5.1-1.6,7.9v33.8h-13.4v-33.8c0-2.8-0.5-5.4-1.6-7.9
      c-1.1-2.5-2.5-4.6-4.4-6.5c-1.9-1.9-4-3.3-6.5-4.4c-2.5-1.1-5.2-1.6-8-1.6c-2.8,0-5.4,0.5-7.9,1.6c-2.5,1-4.6,2.5-6.5,4.4
      c-1.9,1.9-3.3,4-4.4,6.5c-1.1,2.5-1.6,5.1-1.6,7.9v33.8h-13.4v-33.8c0-4.7,0.9-9.1,2.6-13.1c1.8-4.1,4.2-7.6,7.2-10.7
      c3.1-3.1,6.6-5.5,10.7-7.2c4.1-1.8,8.5-2.6,13.1-2.6c5.6,0,10.7,1.2,15.4,3.7c4.7,2.5,8.5,5.8,11.6,10c3.1-4.2,7-7.5,11.7-10
      C279.5,150.4,284.6,149.2,290.1,149.2z"/>
    <path d="M342.1,149.2v67.4h-13.2v-67.4H342.1z"/>
    <path d="M349.1,169.9c1.7-4.1,4.2-7.6,7.2-10.7c3.1-3.1,6.6-5.5,10.7-7.2c4.1-1.8,8.5-2.6,13.1-2.6c4.7,0,9.1,0.9,13.1,2.6
      c4.1,1.8,7.6,4.2,10.7,7.2c3.1,3.1,5.5,6.6,7.3,10.7c1.8,4.1,2.6,8.4,2.6,13.1v33.8h-13.4V183c0-2.8-0.5-5.4-1.6-7.9
      s-2.5-4.6-4.4-6.5c-1.9-1.9-4-3.3-6.5-4.4c-2.5-1.1-5.2-1.6-8-1.6c-2.8,0-5.4,0.5-7.9,1.6c-2.5,1-4.6,2.5-6.5,4.4
      c-1.9,1.9-3.3,4-4.4,6.5s-1.6,5.1-1.6,7.9v33.8h-13.4V183C346.4,178.3,347.3,173.9,349.1,169.9z"/>
    <path d="M431.7,149.2v67.4h-13.2v-67.4H431.7z"/>
    <g>
      <path d="M41.6,110.1c11-11,23.4-19.3,37.3-24.8c13.8-5.5,27.9-8.3,42.3-8.3c14.3,0,28.4,2.8,42.3,8.3
        c13.8,5.5,26.3,13.8,37.3,24.8l15.5,15.5l-31,31.5l-16-15.5c-6.7-6.7-14.2-11.7-22.5-15c-8.3-3.3-16.8-5-25.5-5
        c-8.7,0-17.2,1.7-25.5,5c-8.3,3.3-15.8,8.3-22.5,15c-6.7,6.3-11.7,13.7-15,22c-3.3,8.3-5,16.8-5,25.5c0,8.7,1.7,17.2,5,25.5
        c3.3,8.3,8.3,15.8,15,22.5c13.3,13.3,29.3,20,48,20c9,0,17.7-1.7,26-5c8.3-3.3,15.7-8.3,22-15l16-15.5l31,31.5l-15.5,15.5
        c-11,11-23.4,19.3-37.3,24.8c-13.8,5.5-27.9,8.3-42.3,8.3c-14.3,0-28.4-2.7-42.3-8.3C65,288,52.6,279.7,41.6,268.7
        c-11-11-19.2-23.3-24.5-37c-5.3-13.7-8-27.8-8-42.3c0-14.5,2.7-28.6,8-42.3C22.4,133.4,30.6,121.1,41.6,110.1z"/>
    </g>
  </g>
  </svg>
</div>
<div class="filter">
  <span data-filter="all" class="active">All</span>
<!--   <span data-filter="doctor">Doctor</span> -->
  <span data-filter="admin">Admin</span>
</div>

<?php
// App Menu
echo "<div class='appsmenu g l5 m4 s3 xs1  align-fc'>";
  $cms->allapps();
/////  Default Menu /////////
?>

<?php
/////////////////////////////
echo "</div>";
///////////
?>
<!-- TaskBar Bottom -->
<footer class="taskbar">
  <div class="profile">
     <div class="photo"><a href="#profilechange" class="modal-target"><i class="mdi mdi-account-circle mdi-36px"></i> <strong>Profile</strong> </a>    </div> 
     <div class="user">      
       <small><?php echo @$_SESSION['cms']['user']['name']; ?> </small>
       <small><?php echo @$_SESSION['cms']['role']; ?> </small>
       <small><?php echo @$_SESSION['cms']['user']['email']; ?> </small>
     </div>
  </div>
  <nav class="pinnedapps"> 
    
  </nav>
  <div class="g align-r">
    <a href="LOGOUT" > <i class="mdi mdi-logout mdi-36px"></i> <strong>Logout</strong> </a> 
  </div>
</footer>

<div id="profilechange" class="modal small">
   <div class="modal-container">
      <i class="modalclosebtn mdi mdi-close"></i>
      <div>
          <div class="talign-l"><h4 class="mdi mdi-account-circle blue-text"> Profile</h4></div>
          <form id="profilechng" action="CMS/p/profilechange" method="POST" onsubmit="return false;">
              <input type="text" name="name" label="Name" required="" value="<?php echo @$_SESSION['cms']['user']['name'] ?>" >
              <input type="text" name="email" required="" label="Email" value="<?php echo @$_SESSION['cms']['user']['email'] ?>">
              <input type="password" name="password" label="Password" required >
              <input type="hidden" name="id" required="" value="<?php echo @$_SESSION['cms']['user']['id'] ?>">
              <input type="hidden" name="csrf" value="<?php echo $_SESSION['token']; ?>">
              <span onclick="validSubmit('#profilechng')" class="btn blue">Save</span>
          </form>
      </div>
   </div> 
</div>

<script>
//* Filter
window.addEventListener('load',function(){
  var filters = document.querySelectorAll('.filter span');
  filters.forEach(function(filter){
    filter.addEventListener("click",function(e){          
      filters.forEach(function(flt){
       flt.classList.remove('active');
      })  
      e.target.classList.add('active');
      var filter = e.target.getAttribute('data-filter');
      document.querySelectorAll(".appsmenu a").forEach(function(capp){
          if(filter == 'all'){
                capp.style.display = 'grid';
          }
          else
          {
              if(capp.classList.contains(filter)){
                capp.style.display = 'grid';
              }
              else
              {                
                capp.style.display = 'none';                
              }
          }          
      })
    })
  })
    
});

</script>

<?php
///////////
      }
      else {
    ?>

    <div class="loginbox">
      <div class="brand">
        <svg width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        	 viewBox="0 0 441 393.9" style="enable-background:new 0 0 441 393.9;" xml:space="preserve">
        <path id="logo" d="M337.7,111.5l2.7,0.3c10.1,2.2,14.5,4.1,17.7,9.2c2,3.2,4.4,8.2,1.2,19.6c-2.7-6.4-6.5-9.9-11.8-9.7
        	c-4.6,0.1-9.1,1.1-13.3,3.1c-3.9,1.9-8.1,3.9-10.2,8.5c-2.8,6.3,0.4,12.8,1,14c-6.2-4.3-9.2-11.1-7.5-16.7c0.9-3.2,3.1-5.2,4.6-6.3
        	c6.2-5,13.4-8.6,21.1-10.6c-6.3-5.6-14.7-8.3-23.2-7.5c1.7-1.6,3.8-2.7,6.1-3.1c-0.3-0.1-0.9-0.3-1.5-0.5c-2.1-0.6-4.3-1.1-6.5-1.4
        	c-7.3-0.9-10.1,0.3-18.7,0.7c-8.7,0.4-15.2,0.6-21.8-2.7c-3-1.6-5.8-3.7-8-6.3c3.5,1.5,7.3,2.4,11.1,2.9c5.5,0.7,10.1,0,18.1-1
        	c5.5-0.7,5.7-1,9.5-1.4c3.7-0.3,8.3-0.7,12.6,0c2.4,0.4,7.3,1,12.6,4.8C335,108.4,336.7,110.1,337.7,111.5z"/>
        <g id="title">
        	<path d="M290.1,149.2c4.7,0,9.1,0.9,13.1,2.6c4.1,1.8,7.6,4.2,10.7,7.2c3.1,3.1,5.5,6.6,7.3,10.7c1.8,4.1,2.6,8.4,2.6,13.1v33.8
        		h-13.4v-33.8c0-2.8-0.5-5.4-1.6-7.9c-1.1-2.5-2.5-4.6-4.4-6.5c-1.9-1.9-4-3.3-6.5-4.4c-2.5-1.1-5.2-1.6-8-1.6
        		c-2.8,0-5.4,0.5-7.9,1.6c-2.5,1-4.6,2.5-6.5,4.4c-1.9,1.9-3.3,4-4.4,6.5s-1.6,5.1-1.6,7.9v33.8h-13.4v-33.8c0-2.8-0.5-5.4-1.6-7.9
        		c-1.1-2.5-2.5-4.6-4.4-6.5c-1.9-1.9-4-3.3-6.5-4.4c-2.5-1.1-5.2-1.6-8-1.6c-2.8,0-5.4,0.5-7.9,1.6c-2.5,1-4.6,2.5-6.5,4.4
        		c-1.9,1.9-3.3,4-4.4,6.5c-1.1,2.5-1.6,5.1-1.6,7.9v33.8h-13.4v-33.8c0-4.7,0.9-9.1,2.6-13.1c1.8-4.1,4.2-7.6,7.2-10.7
        		c3.1-3.1,6.6-5.5,10.7-7.2c4.1-1.8,8.5-2.6,13.1-2.6c5.6,0,10.7,1.2,15.4,3.7c4.7,2.5,8.5,5.8,11.6,10c3.1-4.2,7-7.5,11.7-10
        		C279.5,150.4,284.6,149.2,290.1,149.2z"/>
        	<path d="M342.1,149.2v67.4h-13.2v-67.4H342.1z"/>
        	<path d="M349.1,169.9c1.7-4.1,4.2-7.6,7.2-10.7c3.1-3.1,6.6-5.5,10.7-7.2c4.1-1.8,8.5-2.6,13.1-2.6c4.7,0,9.1,0.9,13.1,2.6
        		c4.1,1.8,7.6,4.2,10.7,7.2c3.1,3.1,5.5,6.6,7.3,10.7c1.8,4.1,2.6,8.4,2.6,13.1v33.8h-13.4V183c0-2.8-0.5-5.4-1.6-7.9
        		s-2.5-4.6-4.4-6.5c-1.9-1.9-4-3.3-6.5-4.4c-2.5-1.1-5.2-1.6-8-1.6c-2.8,0-5.4,0.5-7.9,1.6c-2.5,1-4.6,2.5-6.5,4.4
        		c-1.9,1.9-3.3,4-4.4,6.5s-1.6,5.1-1.6,7.9v33.8h-13.4V183C346.4,178.3,347.3,173.9,349.1,169.9z"/>
        	<path d="M431.7,149.2v67.4h-13.2v-67.4H431.7z"/>
        	<g>
        		<path d="M41.6,110.1c11-11,23.4-19.3,37.3-24.8c13.8-5.5,27.9-8.3,42.3-8.3c14.3,0,28.4,2.8,42.3,8.3
        			c13.8,5.5,26.3,13.8,37.3,24.8l15.5,15.5l-31,31.5l-16-15.5c-6.7-6.7-14.2-11.7-22.5-15c-8.3-3.3-16.8-5-25.5-5
        			c-8.7,0-17.2,1.7-25.5,5c-8.3,3.3-15.8,8.3-22.5,15c-6.7,6.3-11.7,13.7-15,22c-3.3,8.3-5,16.8-5,25.5c0,8.7,1.7,17.2,5,25.5
        			c3.3,8.3,8.3,15.8,15,22.5c13.3,13.3,29.3,20,48,20c9,0,17.7-1.7,26-5c8.3-3.3,15.7-8.3,22-15l16-15.5l31,31.5l-15.5,15.5
        			c-11,11-23.4,19.3-37.3,24.8c-13.8,5.5-27.9,8.3-42.3,8.3c-14.3,0-28.4-2.7-42.3-8.3C65,288,52.6,279.7,41.6,268.7
        			c-11-11-19.2-23.3-24.5-37c-5.3-13.7-8-27.8-8-42.3c0-14.5,2.7-28.6,8-42.3C22.4,133.4,30.6,121.1,41.6,110.1z"/>
        	</g>
        </g>
        </svg>
      </div>
      <form id="loginc" action="CMS/p/LOGIN" method="post" autocomplete="off">
          <?php
            if(strtolower(@$page[1])!='admin'){
              echo '<input type="text" name="email" label="Email" >';
            }
          ?>
          <input type="password" name="password" label="Password" >
          <span class="btn" onclick="eliSubmit('#loginc');" >Login</span>
      </form>
    </div>

<?php
  }  
?>


    <?php include("inc/bottomjs.php"); ?>
  </body>
</html>