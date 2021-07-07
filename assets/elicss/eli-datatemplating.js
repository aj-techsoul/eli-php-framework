function isNumeric(str) {
  if (typeof str != "string") return false // we only process strings!  
  return !isNaN(str) && // use type coercion to parse the _entirety_ of the string (`parseFloat` alone does not do this)...
         !isNaN(parseFloat(str)) // ...and ensure strings of whitespace fail
}


/* 
// Example 1	
var datacontainer = '#datapop';
var templatecontainer = document.querySelector(datacontainer);
var template = document.querySelector(datacontainer +' > tmp');

var data = fetch('http://localhost/rad/plugins-maker/jsonsgdata/data.php')
  .then(response => response.json())
  .then(json => setData(json,template.innerHTML,templatecontainer));
*/
//-------------------

// Example 2	
/*
var datacontainer = '#datapop';

var data = fetch('http://localhost/rad/plugins-maker/jsonsgdata/data.php')
  .then(response => response.json())
  .then(json => setDataQ(json,datacontainer));
*/
//-------------------

// Example 3	
//setDataQt("http://localhost/rad/plugins-maker/jsonsgdata/data.php",'#datapop');

//-------------------
// SetData = raw1  = you need to first fetch then you need call this function with 
// jsondata,template_innerhtml and container under which it has to embed
function setData(json,templateHTML,container){
	container.innerHTML = "";
	////////////////////////
	////////////////////////
	//console.log("-");
	
	var i = 0;
	for(var ix = Object.keys(json).length - 1; ix >= 0; ix--) {
		let j = json[Object.keys(json)[ix]];
		if(typeof j != 'object'){    		
			j = json;
			obj = false;
		}
		else
		{
			obj = true;
		}
	
	let temp = templateHTML;
		for (const [key, value] of Object.entries(j)) {
				let mask = '{{'+key+'}}';
				temp = temp.replace(new RegExp(mask, 'g'),value);	
				i++;					
				if(obj==false && i == Object.entries(j).length){
					container.insertAdjacentHTML('beforeend',temp);	
				}
			}
			if(obj==true){
				container.insertAdjacentHTML('beforeend',temp);	
			}
	}
	///////////
	
	///////////
	///////////
}


// setDataQ =. is for quicker than setData and here just you need to fetch and then //send the parameter of json and main container
//
function setDataQ(json,tcontainer){
	var container = document.querySelector(tcontainer);
	var template = document.querySelector(tcontainer +' > tmp') || document.querySelector(tcontainer);
	var templateHTML = template.innerHTML;

	container.innerHTML = "";

	////////////////////////
	////////////////////////
	//console.log("Q");
	var i = 0;
	for(var ix = Object.keys(json).length - 1; ix >= 0; ix--) {
		let j = json[Object.keys(json)[ix]];
		if(typeof j != 'object'){    		
			j = json;
			obj = false;
		}
		else
		{
			obj = true;
		}
	
	let temp = templateHTML;
		for (const [key, value] of Object.entries(j)) {
				let mask = '{{'+key+'}}';
				temp = temp.replace(new RegExp(mask, 'g'),value);	
				i++;					
				if(obj==false && i == Object.entries(j).length){
					container.insertAdjacentHTML('beforeend',temp);	
				}
			}
			if(obj==true){
				container.insertAdjacentHTML('beforeend',temp);	
			}
	}
	///////////
	
	///////////
	///////////
}


// setDataQt =. is more quicker than setData and here just you don't need to fetch. 
// You just need to call this function send the parameter of url to fetch json and main container
// 
function setDataQt(urljson,tcontainer){
	var container = document.querySelector(tcontainer);
	var template = document.querySelector(tcontainer +' > tmp') || document.querySelector(tcontainer);
	var templateHTML = template.innerHTML;

fetch(urljson)
  .then(response => response.json())
  .then(json => {
	container.innerHTML = "";

	////////////////////////
	//console.log("QT");
	
	var i = 0;
	for(var ix = Object.keys(json).length - 1; ix >= 0; ix--) {
		let j = json[Object.keys(json)[ix]];
		if(typeof j != 'object'){    		
			j = json;
			obj = false;
		}
		else
		{
			obj = true;
		}
	
	let temp = templateHTML;
		for (const [key, value] of Object.entries(j)) {
				let mask = '{{'+key+'}}';
				temp = temp.replace(new RegExp(mask, 'g'),value);	
				i++;					
				if(obj==false && i == Object.entries(j).length){
					container.insertAdjacentHTML('beforeend',temp);	
				}
			}
			if(obj==true){
				container.insertAdjacentHTML('beforeend',temp);	
			}
	}
	///////////
 
  });	
}
