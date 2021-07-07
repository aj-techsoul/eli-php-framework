
// Collapse 


// Toggle element visibility
// Show an element
var show = async function (elem,timing) {
if(typeof elem === 'string'){
	elem = document.querySelector(elem);
}
if(typeof elem === 'object'){
var timing = timing || 350;
  // Get the natural height of the element
  var getHeight = function () {
    elem.style.display = 'block'; // Make it visible
    var height = elem.scrollHeight + 'px'; // Get it's height
    elem.style.display = ''; //  Hide it again
    return height;
  };

  var height = getHeight(); // Get the natural height
  elem.classList.add('is-visible'); // Make the element visible
  elem.style.height = height; // Update the max-height

  // Once the transition is complete, remove the inline max-height so the content can scale responsively
  window.setTimeout(function () {
    elem.style.height = '';
    elem.style.overflow = 'auto';
  }, timing);
}
};

// Hide an element
var hide = async function (elem,timing) {
// console.log(typeof elem);
if(typeof elem === 'string'){
	elem = document.querySelector(elem);
}
if(typeof elem === 'object'){
// console.log(typeof elem);	
var timing = timing || 350;

  // Give the element a height to change from
  elem.style.height = elem.scrollHeight + 'px';
  elem.style.overflow = 'hidden';


  // Set the height back to 0
  window.setTimeout(function () {
    elem.style.height = '0';
  }, 1);

  // When the transition is complete, hide it
  window.setTimeout(function () {
    elem.classList.remove('is-visible');
  }, timing);
}
};

// Toggle element visibility
var toggle = async function (elem, timing) {
	if(typeof elem === 'string'){
	elem = document.querySelector(elem);
}
if(typeof elem === 'object'){
	var timing = timing || 350;

  // If the element is visible, hide it
  if (elem.classList.contains('is-visible')) {
    await hide(elem,timing);
    return;
  }

  // Otherwise, show it
   await show(elem,timing);
}
};


// var ctoggle = async function (elem) {

//   elem2 = document.querySelector(elem);
//   elem3 = elem2.parentElement;
//   // If the element is visible, hide it
//   if (elem3.style.display == 'grid') {
//     elem3.style.display = 'none';
//     elem2.style.display = 'none';
//     return;
//   }
//   else
//   {
//     elem3.style.display = 'grid';
//     elem2.style.display = 'grid';
//   }

// };

// var btoggle = async function (field,elem) {

//   elem2 = document.querySelector(elem);
//   elem3 = elem2.parentElement;
//   // If the element is visible, hide it
//   if (field.value == 'no') {
//     elem3.style.display = 'none';
//     elem2.style.display = 'none';
//     return;
//   }
//   else
//   {
//     elem3.style.display = 'grid';
//     elem2.style.display = 'grid';
//   }

// };

// sidebar
// Show an element
var sbshow = async function (elem,timing) {
if(typeof elem === 'string'){
  elem = document.querySelector(elem);
}
if(typeof elem === 'object'){
var timing = timing || 350;
  // Get the natural height of the element
  var getWidth = function () {
    // elem.style.display = 'block'; // Make it visible
    var width = elem.clientWidth + 'px'; // Get it's width
    elem.style.display = ''; //  Hide it again
    return width;
  };

  var width = getWidth(); // Get the natural width
  elem.classList.add('is-visible'); // Make the element visible
  elem.style.width = width; // Update the max-height

  // Once the transition is complete, remove the inline max-height so the content can scale responsively
  window.setTimeout(function () {
    elem.style.width = '';
    elem.style.overflow = 'auto';
  }, timing);
}
// console.log("Show");
// console.log(elem);
};

// Hide an element
var sbhide = async function (elem,timing) {
// console.log(typeof elem);
if(typeof elem === 'string'){
  elem = document.querySelector(elem);
}
if(typeof elem === 'object'){
// console.log(typeof elem);  
var timing = timing || 350;

  // Give the element a width to change from
  elem.style.width = elem.clientWidth + 'px';
  elem.style.overflow = 'hidden';  


  // Set the width back to 0
  window.setTimeout(function () {
    elem.style.width = '0';
    elem.style.overflow = 'hidden';      
    elem.style.display = 'none';  
  }, 100);

  // When the transition is complete, hide it
  window.setTimeout(function () {
    elem.classList.remove('is-visible');
  }, timing);
}

// console.log("Hide");
// console.log(elem);
};

// Toggle element visibility
var sbtoggle = async function (elem, timing) {
  if(typeof elem === 'string'){
  elem = document.querySelector(elem);
}
if(typeof elem === 'object'){
  var timing = timing || 350;

  // If the element is visible, hide it
  if (elem.classList.contains('is-visible')) {
    sbhide(elem,timing);
    return;
  }

  // Otherwise, show it
   sbshow(elem,timing);
}

};


// Dropdown btn
var drpdwn = document.querySelectorAll(".btn-dropdown");
if(drpdwn.length > 0){
	drpdwn.forEach(btndp => {
		// console.log(btndp);
		var drp = btndp.querySelector(".dropdown");
		btndp.addEventListener('click',function(){
			//console.log(drp);
			toggle(drp,10);
			drp.addEventListener("mouseleave",function(){
				hide(drp,10);
			})
		})
	})
}



// Collapsible
var collapsible = document.querySelectorAll('.collapse-header');
if(collapsible.length > 0){
  collapsible.forEach(collapse => {
      collapse.addEventListener('click', async function(e){
          // console.log(collapse);
          ctarget = collapse.getAttribute('collapse-target');
          // alert(ctarget);
          if(ctarget){
            var cbody = document.querySelector(ctarget);
            if(cbody){
                await toggle(cbody);

                setTimeout(function(){
                    if(cbody.classList.contains('is-visible')){
                      // open                  
                      if(!collapse.classList.contains('active')){
                        collapse.classList.add('active');
                      }
                    }
                    else
                    {
                      //close
                      collapse.classList.remove('active');
                    }
                },350);
            }
          }
      })
  })
}

// Collapse End