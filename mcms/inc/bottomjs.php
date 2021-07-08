<?php  
if(file_exists(_BASEROOT_.'assets/elicss/eli.js')){
	echo '<script src="assets/elicss/eli.js" defer=""></script>';
}
else
{
	echo '<script src="https://cdn.jsdelivr.net/gh/aj-techsoul/ELICSS@3.7.1/eli.min.js" defer=""></script>';	
}
?>


<script src="mcms/assets/js/cms.js" ></script>