function closeapp(){
	if(window.opener != null || window.history.length == 1){
		// window.close works
	 	window.close();
	}
	else
	{
		// window.close doesn't work
	 	window.location.href = "CMS";
	}
}