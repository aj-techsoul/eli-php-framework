<header class="ha1 sticky" >
    <div class="brand">
      <img src="<?php echo CMS; ?>core/assets/logo.png">
    </div>

      <nav class="nav">
        <?php echo (!isset($_SESSION['cms'])) ? '<a href="LOGIN">LOGIN</a>' : ''; ?>
        <a href="LOGOUT" >LOGOUT</a>
      </nav>

</header>
