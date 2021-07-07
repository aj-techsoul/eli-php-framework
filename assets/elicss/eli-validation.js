/// Form Validation

function phonenumber(inputtxt)
{
  var phoneno = /^\d{10}$/;
  if((inputtxt.value.match(phoneno)))
        {
          return true;
        }
      else
        {
          return false;
        }
}

function checkvalidity(inp){
  switch(inp.type){
    case "tel":
      var vvalid = phonenumber(inp);
    break;
    default:
      var vvalid = true;
    break;
  }

  return vvalid;
}


//Required eli_scripts
function validSubmit(formid){
      console.log('Analyzing '+formid);
      var form = document.querySelector(formid);
    var required =  document.querySelectorAll(formid+" [required] ");
  //  console.log(required);
    console.log(required.length +  " Required fields found");
  //  console.log(required);
    var checked = 0;
    if(required.length > 0){
      var i = 0;
      required.forEach((field) => {
        var x = field;

        console.log(required[i].validity.valid);
        if(required[i].validity.valid == false || checkvalidity(required[i]) == false ){
          required[i].validationMessage = " Please fill "+field.getAttribute('label');
          //console.log(i+" Please fill "+field.getAttribute('label'));
          if(required[i].offsetParent){
          required[i].offsetParent.style.borderColor = 'red';
          }
          x.addEventListener('change', function(e) {
            console.log(e.target.validity.valid);

            var inp = e.target;
            if(inp.validity.valid == false  || checkvalidity(inp) == false ){
                inp.validationMessage = " Please fill "+field.getAttribute('label');
                inp.offsetParent.style.borderColor = 'red';
              }
              else {
                  inp.offsetParent.style.borderColor = 'green';
              }
          });

        }
        else {
          //console.log("filled "+ field.value);
            if(required[i].offsetParent){
              required[i].offsetParent.style.borderColor = 'green';
            }

              checked = checked+1;
        }
        i++;
      })
      form.reportValidity();
    }

    console.log(required.length + " : " + checked);
    if(required.length == checked){
      eli(formid).submit();
    }

}
/* Validator */

/* No Validation */
function eliSubmit(formid){
  eli(formid).submit();
}
