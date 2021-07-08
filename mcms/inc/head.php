<meta charset="utf-8">
<base href="<?php echo _BASEURL_; ?>" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php  
if(file_exists(_BASEROOT_.'assets/elicss/eli.css')){
	echo '<link rel="stylesheet" href="assets/elicss/eli.css">';
}
else
{
	echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/aj-techsoul/ELICSS@3.7.1/eli.css">';	
}
?>
