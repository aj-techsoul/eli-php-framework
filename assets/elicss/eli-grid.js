let headers = document.querySelectorAll('header');
//console.log(headers.length);
if(headers.length > 0){
headers.forEach((header) => {
let menubtn = header;
let nav = header.querySelector('nav:not(.social)');
menubtn.addEventListener('click', function(e) {
  if(e.target.nodeName == 'HEADER')
  {
    nav.classList.add('active');
  }

});

if(nav){

nav.addEventListener('click', function(e) {
  //console.log(e.target.nodeName);
  if(e.target.nodeName == 'NAV')
  {
    nav.classList.remove('active');
  }
});
}
});
}
