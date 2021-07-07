function init(){

//Some Function
function disableScroll() {
    // Get the current page scroll position
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,

        // if any scroll is attempted, set this to the previous value
        window.onscroll = function(e) {
            e.preventDefault();
            e.stopPropagation();
            window.scrollTo(scrollLeft, scrollTop);
        };
}

function enableScroll() {
    window.onscroll = function() {};
}



// TAB
document.querySelectorAll('.tabs a').forEach(item => {
  item.style.cursor = "pointer";
  item.addEventListener('click', async function (e) {
    e.preventDefault();

    document.querySelectorAll(".tabs li.active").forEach(ditem =>{
      ditem.classList.remove("active");
    })

    document.querySelectorAll(".tab-content.active").forEach(d2item =>{
      d2item.classList.remove("active");
    })

 // console.log(e);
    if(e.target.parentElement.nodeName === 'LI'){
      e.target.parentElement.classList.add("active");
    }

    var tabcontent = e.target.getAttribute('href') || e.target.getAttribute('tabhref');
    tabcontent = tabcontent.trim();
    console.log(tabcontent);
    var tabc = document.querySelector(".tab-content"+tabcontent);
    console.log(tabc);
    if(tabc){
      tabc.classList.add("active");
    }

 });
})


// search result
function searchResultClicked(field){
  console.log(field);
}

// SEARCH FIELD

    var searchInputID = 0;
    Array.from(document.querySelectorAll('input[type=search]:not(.default)')).forEach((item) => {
      searchInputID += 1;
    //
      var type = item.getAttribute('type');
      var geturl = item.getAttribute('get');
      var label = item.getAttribute('label');
      var licon = item.getAttribute('licon');
      var ricon = item.getAttribute('ricon');
      var rtype = item.getAttribute('resulttype');
      var callback = item.getAttribute('cb');



      var inputtag = item.outerHTML;

      var inp = '';
      var gr = '';
      var inputpadding = 'noinputpadding';
      if(licon){
          var inp = inp + '<i class="'+ licon +'"></i>';
          gr = gr + 'a';
      }
      if(label){
          var inp = inp +  '<label>'+ label +'</label>';
          inputpadding = '';
      }

      inp = inp +  item.outerHTML;
      gr = gr + 1;
      if(ricon){
          var inp = inp +  '<i class="'+ ricon +'"></i>';
          gr = gr + 'a';
      }

      var starttag = '<div id="searchInputID'+ searchInputID +'" class="input-field search-field ';
      var endtag = '</div>';
      var sresult = '<div class="searchresult '+rtype+'"></div>';

      var finalinput = starttag + inputpadding + ' g'+gr+' ">'+ inp + sresult + endtag;
      item.outerHTML = finalinput;

/////// 2nd Part of Code ///
          var sid = '#searchInputID'+searchInputID;
          document.querySelector(sid+' input[type=search]').onkeyup = function(e) {
            var sresult = e.target.parentElement.querySelector('.searchresult');
if(e.target.value.length < 3){
  sresult.innerHTML = "";
  enableScroll();
}
else {

            switch(e.key){
              case 'ArrowDown':
// press down to focus
          sresult.querySelectorAll('.sri').forEach((sri) => {
              sri.addEventListener('focus', function(e) {
                sri.onkeydown = function(e){
                  disableScroll();
                  if(e.key == 'ArrowDown'){
                    if(sri.nextSibling){
                      sri.nextSibling.focus();
                    }
                    else {
                        sresult.previousSibling.focus();
                    }
                  }
                  if(e.key == 'ArrowUp'){
                    if(sri.previousSibling){
                      sri.previousSibling.focus();
                    }
                    else {
                        sresult.previousSibling.focus();
                    }
                  }
                  if(e.keyCode == 13) {
                      sresult.innerHTML = "";
                      if(sresult.previousSibling){
                        sresult.previousSibling.value = e.target.innerHTML;
                      }
                    //  console.log(e.target.innerHTML);
                      enableScroll();
                  }
                  if(e.keyCode == 27) {
                      sresult.innerHTML = "";
                      enableScroll();
                  }
                }
              },true);
              sresult.querySelector('.sri').focus();
          });


//console.log(document.querySelectorAll('.sri'));
e.preventDefault();
              break;
              default:
//any text written
var q = e.target;
var geturl = q.attributes.get.value;
var dvr = "";
if(geturl.indexOf('?') > 0 && geturl.charAt(geturl.length-1) != '&') {
    dvr = '&';
}
else {
      dvr = '?';
}

var qval = q.name +'='+ encodeURI(q.value);
eget(geturl+dvr+qval,'',function(data){
      var datajson = JSON.parse(data);
    //  console.log(datajson.length);
      if(typeof datajson =='object' && datajson.length > 0){
        sresult.innerHTML = "";
        //console.log(typeof datajson);
        datajson.forEach((sr) => {

          sresult.innerHTML += "<a  href='#' class='sri'>"+sr+"</a>";
        })
      }
      else {
        //console.log(typeof data);
        sresult.innerHTML = "<a href='#' class='sri'>"+data+"</a>";
      }
})
              break;
            }

          }
}



    })




/*
    Array.from(document.querySelectorAll('.searchresult')).forEach((item) => {
        item.addEventListener('click', function (e) {
          var srval = e.target.value;
          var srinput = item.closest('div');
          var inputtag = srinput.getElementsByTagName('input');
          inputtag[0].value = srval;

          Array.from(document.querySelectorAll('.searchresult')).forEach((item) => {
            item.remove();
          })

          //.value = srval;
        });
    })
*/


// INPUT FIELD
    Array.from(document.querySelectorAll('input:not(.default)')).forEach((item) => {
      var type = item.getAttribute('type');

      var label = item.getAttribute('label');
      var licon = item.getAttribute('licon');
      var ricon = item.getAttribute('ricon');

if(type!=='checkbox' && type!='radio' && type!='file' && type!="hidden" && type!='search' )
{
  var inp = '';
  var gr = '';
  var inputpadding = 'noinputpadding';
  if(licon){
      var inp = inp + '<i class="'+ licon +'"></i>';
      gr = gr + 'a';
  }
  if(label){
      var inp = inp +  '<label>'+ label +'</label>';
      inputpadding = '';
  }
  inp = inp +  item.outerHTML;
  gr = gr + 1;
  if(ricon){
      var inp = inp +  '<i class="'+ ricon +'"></i>';
      gr = gr + 'a';
  }
  var starttag = '<p class="input-field ';
  var endtag = '</p>';

  var finalinput = starttag + inputpadding + ' g'+gr+' ">'+ inp + endtag;
  item.outerHTML = finalinput;
}



    })

// RADIO FIELD
    Array.from(document.querySelectorAll('input[type=radio]:not(default)')).forEach((item) => {

      var label = item.getAttribute('label');
//      var ricon = item.getAttribute('ricon');

      var inp = '';
      var gr = '';
/*
<label><input type="radio" name="r" value="sr" label="Radio" class="default" > <span>Radio</span> </label>
*/


      inp = inp +  item.outerHTML;
      if(label){
          gr = gr + 'a';
          var inp = '<label class="radio-field"> '+ inp +' <span>'+ label +'</span></label>';
      }
      gr = gr + 1;



      var starttag = '<p class="input-radio';
      var endtag = '</p>';

      //var finalinput = starttag + 'g'+gr+' ">'+ inp + endtag;
      var finalinput = inp;

      item.outerHTML = finalinput;

    })

// Checkbox FIELD
    Array.from(document.querySelectorAll('input[type=checkbox]:not(default)')).forEach((item) => {

/*
<p class="input-checkbox">
  <label> <input type="checkbox" label="Checkbox" class="default" name="s" value="">  <span>Checkbox</span> </label>
</p>
*/
      var label = item.getAttribute('label');

      var inp = '';
      var gr = '';

      inp = inp +  item.outerHTML;
      if(label){
          gr = gr + 'a';
          var inp = '<label>'+inp+'<span>'+label+'</span></label>';
      }
      gr = gr + 1;


      var starttag = '<p class="input-checkbox"> ';
      var endtag = '</p>';


      var finalinput = starttag+inp+endtag;
      //var finalinput = inp;
      item.outerHTML = finalinput;

    })


// INPUT FILE
Array.from(document.querySelectorAll('input[type=file]:not(default)')).forEach((item) => {

/*
<p class="input-file">
    <label> <span class="mdi mdi-folder-upload">File Upload</span>
    <input type="file" name="" label="File Upload" value="" ricon="mdi mdi-upload">
    </label>
</p>
*/
  var fileinput = item;
  var label = item.getAttribute('label');
  var licon = item.getAttribute('licon');
  var ricon = item.getAttribute('ricon');
  var inp = '';
  var rinp = "";
  var gr = 'g';
  if(licon){
      var linp = "<span class='"+licon+"' >";
      gr = gr + 'a';
  }
  else {
    licon = "mdi mdi-upload";
    var  linp = "<span class='"+licon+"' >";
    gr = gr + 'a';
  }

  gr = gr + '1';

  if(ricon){
      var rinp = '<i class="'+ ricon +'"></i>';
      gr = gr + 'a';
  }



  if(label){
      var lbinp = '<label class="'+ gr +'">'+ linp + label + "</span> <span class='filename'></span>";
  }
  else {
      var lbinp = '<label class="'+ gr +'">'+ linp + " File Upload " + "</span> <span class='filename'></span>";
  }

  inp = lbinp + item.outerHTML;

  einp = "<p class='input-file' >" +  inp + rinp + "</label>" +  "</p>";
  item.outerHTML = einp;
  //console.log(fileinput);
})

// FIle Input onchange
Array.from(document.querySelectorAll('input[type=file]:not(default)')).forEach((item) => {
    var label = item.previousSibling;
    var labelVal = item.getAttribute('label');
    item.addEventListener('change', function(e) {
                var fileName = '';
                console.log(this.files.length);
          		if( this.files && this.files.length > 1 ){
          			fileName = this.files.length + " ";
                fileName2 = labelVal.toLowerCase();
                fileName += fileName2.replace('upload','uploaded');
              }
          		else
              {
          			if(e.target.files[0].name)
                  fileName = e.target.files[0].name;
                else{
                  fileName = e.target.value.split('\/').pop();
                }
              }

          		if( fileName )
          			label.innerHTML = fileName;
          		else
          			label.innerHTML = labelVal;

          	})

})




// TEXTAREA

    Array.from(document.querySelectorAll('textarea:not(.default)')).forEach((item) => {

//console.log(item);

      var label = item.getAttribute('label');
      if(label){
          var inp = '<p class="input-field"> <label>'+ label +'</label> '+ item.outerHTML +'</p>';
      }
      else {
        var inp = '<p class="input-field">'+ item.outerHTML +'</p>';
      }

      item.outerHTML = inp;

    })




// SELECT


    Array.from(document.querySelectorAll('select:not(.default)')).forEach((item) => {

      var label = item.getAttribute('label');
      if(label){
          var inp = '<p class="input-field"> <label>'+ label +'</label> '+ item.outerHTML +'</p>';
      }
      else {
        var inp = '<p class="input-field">'+ item.outerHTML +'</p>';
      }

      item.outerHTML = inp;

    })




// MODAL

window.modal = function(modalid,action){
  if(modalid){
    switch(action){
      case "open":
        document.querySelector(modalid).classList.add('active');
          var modcont = document.querySelector(modalid).children[0];
          var modheight = modcont.offsetHeight;
          var winheight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
          console.log(modheight + ' - ' + winheight);
          if(modheight >= winheight){
              document.querySelector(modalid).classList.add('large');
          }
          closemodalon();
      break;
      case "close":
        document.querySelector(modalid).classList.remove('active');
      break;
      default:
        document.querySelector(modalid).classList.add('active');
      break;
    }
  }
}

window.closeAllModal = function(){
    document.querySelector('.modal.active').classList.remove('active');
}

window.closemodalon = function(){
  document.querySelector('.modal.active').addEventListener('click', function (e) {
    var mod = e.target.classList.contains('modal');
    if(mod == true){
      modal('#'+e.target.id,'close');
    }
  });

  document.addEventListener('keydown', function (e) {
  //  console.log(e);
    if(e.key === "Escape") {
            var mod = document.querySelector('.modal.active');
            if(mod){
              modal('#'+mod.id,'close');
            }
        }

  });
}

// Open Modal
Array.from(document.querySelectorAll('.modal-target')).forEach((item) => {
item.addEventListener('click', function (e) {
e.preventDefault();
  var href = item.getAttribute('href');
  var dtarget = item.getAttribute('modal-target');

  if(href){
    modal(href,'open');
    UpdateFields();
  }
  else if (dtarget) {
    modal(dtarget,'open');
    UpdateFields();
  }
  else {
    console.log('Unable to Specify Modal Target or href');
  }

  });
})



// Close Modal
Array.from(document.querySelectorAll('.modal .modalclosebtn')).forEach((item) => {
  item.addEventListener('click', function (e) {
    if(e.target.parentNode.parentNode.id){
      var modal = e.target.parentNode.parentNode.id;
      document.querySelector('#'+modal).classList.remove('active');
    }
  });
})



// Editable
Array.from(document.querySelectorAll('.editable')).forEach((item) => {
  item.setAttribute('readonly','true');


      item.addEventListener('keydown', function (e) {
          if(e.key === 'Enter'){
            item.setAttribute('readonly','true');
          }
      });

  item.addEventListener('dblclick', function (e) {
      if(e.target.hasAttribute('readonly')){
          e.target.removeAttribute('readonly');
      }
      else {
        e.target.setAttribute('readonly','true');
      }

  });
})



window.UpdateFields = function(){
// Input
Array.from(document.querySelectorAll('input:not(.default)')).forEach((item) => {

  if(item.value.length  > 0 || item.type == 'date'  || item.type == 'datetime'  || item.type == 'datetime-local' || item.type == 'time' ){
    if(item.previousElementSibling){
      item.previousElementSibling.classList.add('active');
    }
  }
  else if(item.previousElementSibling) {
    item.previousElementSibling.classList.remove('active');
  }

//console.log(item.type);

    item.addEventListener('keyup', function (e) {

      if(e.target.value.length > 0 && e.target.previousElementSibling !== null && e.target.previousElementSibling.nodeName == 'LABEL'){
        e.target.previousElementSibling.classList.add('active');
      }
      if(e.target.value.length < 1  &&  e.target.previousElementSibling !== null && e.target.previousElementSibling.nodeName == 'LABEL') {
        e.target.previousElementSibling.classList.remove('active');
      }

    });

})

// TEXTAREA

Array.from(document.querySelectorAll('textarea:not(.default)')).forEach((item) => {
console.log(item.value);
  if(item.value.length  > 0){
    item.previousElementSibling.classList.add('active');
  }
  else if(item.previousElementSibling) {
    item.previousElementSibling.classList.remove('active');
  }


    item.addEventListener('keyup', function (e) {

      if(e.target.value.length > 0 && e.target.previousElementSibling !== null && e.target.previousElementSibling.nodeName == 'LABEL'){
        e.target.previousElementSibling.classList.add('active');
      }
      if(e.target.value.length < 1  &&  e.target.previousElementSibling !== null && e.target.previousElementSibling.nodeName == 'LABEL') {
        e.target.previousElementSibling.classList.remove('active');
      }

    });

})

// Select

Array.from(document.querySelectorAll('select:not(.default)')).forEach((item) => {
  //console.log("Great");
  //console.log(item);
  if(item.previousElementSibling){
    item.previousElementSibling.classList.add('active');
  }
  else if(item.previousElementSibling) {
    item.previousElementSibling.classList.remove('active');
  }

    item.addEventListener('change', function (e) {

      if(e.target.value.length > 0 && e.target.previousElementSibling !== null && e.target.previousElementSibling.nodeName == 'LABEL'){
        e.target.previousElementSibling.classList.add('active');
      }
      if(e.target.value.length < 1  &&  e.target.previousElementSibling !== null && e.target.previousElementSibling.nodeName == 'LABEL') {
        e.target.previousElementSibling.classList.remove('active');
      }

    });

})
}

document.querySelectorAll('[charcount]').forEach((item) => {
  var apto = item.getAttribute('charcount');
  item.addEventListener('keyup', function(e) {
    var chrcount = item.value.length || item.innerHTML.length ;
    document.querySelector(apto).innerHTML = chrcount;
    document.querySelector(apto).classList.add('inbadge');
  });
})



UpdateFields();

//////////////
}

function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var systemZoom = width / window.screen.availWidth;
var left = (width - w) / 2 / systemZoom + dualScreenLeft
var top = (height - h) / 2 / systemZoom + dualScreenTop
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w / systemZoom + ', height=' + h / systemZoom + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) newWindow.focus();
}

function searchresult(field){
  var searchvalue = field.value;
  if(searchvalue.length > 0){
  var restapi = 'https://restcountries.eu/rest/v2/name/'+searchvalue;
  var ul = '<ul class="searchresult"></ul>';
  var cdiv = field.closest('div');
  if(Array.from(document.querySelectorAll('.searchresult')).length < 1){
    cdiv.innerHTML += ul;
  }

  //console.log(searchvalue);
// console.log(restapi);
  httpGetAsync(restapi,httpsuccess);
  //console.log(ret);
}
else {
  Array.from(document.querySelectorAll('.searchresult')).forEach((item) => {
    item.remove();
  })
}

}

function httpGetAsync(theUrl, callback)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    }
    xmlHttp.open("GET", theUrl, true); // true for asynchronous
    xmlHttp.send(null);
}

function httpsuccess(ev){
  var ev = JSON.parse(ev);
  if(ev.length  > 0){
    var li = "";
    ev.forEach((item) => {
      var countrycallingcode = item.callingCodes[0];
      var countryflag = item.flag;
        li = '<li value="'+ countrycallingcode +'"> <img src="'+ countryflag +'" height="10px" /> <strong> '+ countrycallingcode +' </strong></li>' + li;
        document.querySelector('.searchresult').innerHTML = li;
    })
  }
  else {
    console.log('No Data');
  }
}




window.addEventListener('load', init(), false );
