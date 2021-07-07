/* EliCSS Framework : 3.7.1 */

// let jspath = location.href.substring(0, location.href.lastIndexOf("/")+1);
let jspath = "assets/elicss/";
// let jspath = "https://cdn.jsdelivr.net/gh/AJ-TechSoul/ELICSS@3.7.5/";

function toast(){
  let body = document.body;
  var script = '<div class="toast result"></div>'
  body.innerHTML += script;
  console.log('Eli: Site Ready!');
}

function RunScript(selector,jsscript){
  target = document.querySelector(selector);
  var newScript = document.createElement("script");
  var inlineScript = document.createTextNode(jsscript);
  newScript.appendChild(inlineScript);
  target.appendChild(newScript);
}

async function loadScript(url, callback)
{
    // Adding the script tag to the head as suggested before
    var head = document.head;
    var body = document.body;
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = url;

    if(url.search("shoelace") > 0){
      script.type = "module"; 
    }

    // Then bind the event to the callback function.
    // There are several events for cross browser compatibility.
    script.onreadystatechange = callback;
    script.onload = callback;

    // Fire the loading
    body.appendChild(script);
}

async function checkmobility(){
  /* Responsive */
  var meta = '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
  if(!document.querySelector('meta[name=viewport]')){
    eli('head').prepend(meta);
  }
  /* Favicon */
  var favicon = "assets/img/logo.png";
  var favlink = '<link rel="icon" type="image/png" href="'+ jspath +'logo.png">';
  var favlink2 = '<link rel="icon" type="image/png" href="'+favicon+'">';
  if(!document.querySelector('link[rel=icon]')){
   var http = new XMLHttpRequest();
    http.open('HEAD', favicon, false); 
    http.send(); 
   // console.log(http.status);

    if (http.status === 200) { 
      eli('head').prepend(favlink2);
     }
     else
      {
        eli('head').prepend(favlink);
      }
  }
}

      toast();      
      
        loadScript(jspath+"swal/sweetalert2.all.min.js");
        loadScript(jspath+"eli-library.js");              
        loadScript(jspath+'eli-forms.js');
        loadScript(jspath+"eli-grid.js");
        loadScript(jspath+"eli-helpers.js");
        loadScript(jspath+"eli-validation.js");
        loadScript(jspath+"eli-components.js");
        loadScript(jspath+"eli-datatemplating.js");
        loadScript(jspath+"eli-image.js");
        loadScript(jspath+"elislider.js");
     // loadScript('https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.0.0-beta.13/dist/shoelace/shoelace.esm.js');

//console.log(jspath);

window.addEventListener('load', async function(){
    new carousel();
    new dataTables('.dt');
    new eselect('.eselect');
    new eselect('.etags',{ 
          taggable:true 
        });
    new eselect('.etag',{ 
          taggable:true, 
          maxSelections: 1
        });
    elislider();    
    if(document.querySelector('.input-field')){ 
          document.querySelectorAll('.input-field > label').forEach( function(item, index) {
            item.classList.add('active');
          });
          //setTimeout(UpdateFields,3000);
      }

   await checkmobility();
});
