function eli(selector){
    const self =
    {
        element: document.querySelectorAll(selector),
        length : document.querySelectorAll(selector).length,
        do: (callback) => self.element.forEach((el) => {
            callback(el);
        }),
        on: (event,callback) => self.element.forEach((el) => {
            el.addEventListener(event, callback);
        }),
        append: (htmlelement) => self.element.forEach((el) => {
            el.insertAdjacentHTML('beforeend', htmlelement);
        }),
        prepend: (htmlelement) => self.element.forEach((el) => {
            el.insertAdjacentHTML('afterbegin', htmlelement);
        }),
        appendafter: (htmlelement) => self.element.forEach((el) => {
            el.insertAdjacentHTML('afterend', htmlelement);
        }),
        appendbefore: (htmlelement) => self.element.forEach((el) => {
            el.insertAdjacentHTML('beforebegin', htmlelement);
        }),
        submit : (callback) => esend(selector,function(){
          //  console.log(data);
          //  document.querySelector('.result').innerHTML = data;
            var tag = 'Success';

            document.querySelector('.result').innerHTML = "";
            //document.querySelector('.result').innerHTML = "<script> window.location.reload(); </script>";
///////
//
var temp = document.createElement("div");
temp.innerHTML = data;
var script = temp.getElementsByTagName("script");
if(script[0]){
scriptcontent = script[0].innerHTML;

if(scriptcontent){
  RunScript('.result',scriptcontent);
}
}
///////


        //    var title = data.match("<script>(.*?)</script>")[1];
        //     console.log(title);


            if(callback){
              callback(data);
            }


            if(data.indexOf(tag) !== -1){
              //  console.log(data);
                            //   Materialize.toast(data, 5000,'green');
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })

                Toast.fire({
                icon: 'success',
                title: data
                })

            }
            else
            {
              //    Materialize.toast(data, 5000,'red');
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'error',
                title: data
              })

            }


          })


    }

    return self;
}


 function eget(url,format,callback)
 {
       var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
      //return this.responseText;
      format = format.toUpperCase();
          switch(format){
            case "JSON":
              data = JSON.parse(this.responseText);
            break;
            default:
              data = this.responseText;
            break;
          }
          callback(data);
     }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
 }

  function epost(url,senddata,callback)
 {

       var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
          data = this.responseText;
          if(callback){
          //  data = JSON.parse(data);
            callback(data);
          }
     }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(senddata);
 }



function esend(formid,callback){

      const form = document.querySelector(formid);
      const url = form.action;
      const files = document.querySelectorAll('[type=file]');
      const formData = new FormData(form);
      const progressbar = document.querySelector('.progress');

      if(files.length > 0){
        files.forEach((input) => {
          var fileinputname = input.attributes.name.value;
          for (let i = 0; i < input.files.length; i++) {
            let file = input.files[i];

            formData.append(fileinputname+'[]', file);
          }
        })
      }
      else {
        console.log("No Files");
      }



       var xhttp = new XMLHttpRequest();
       xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
             data = this.responseText;
             if(callback){
             //  data = JSON.parse(data);
               callback(data);
             }
          }
        };
       //xhttp.onprogress = updateProgress;
       xhttp.open("POST", url, true);

       if(progressbar){
         xhttp.onprogress = function (e) {
           console.log(e);
             if (e.lengthComputable) {
              total = progressbar.attributes.max.value;
              var cdiff = total / e.total;
              var progressvalue = e.loaded * cdiff;

                progressbar.attributes.value.value = progressvalue;
                  console.log(progressvalue);
                // console.log(e.loaded+  " / " + e.total);
             }
         }
       }

       xhttp.onloadstart = function (e) {
          // console.log("start")
       }
       xhttp.onloadend = function (e) {
          // console.log("end")
       }

    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //  console.log(formData);
       xhttp.send(formData);
}

function delrow(field,row){
  Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: '',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {

    var did = field.getAttribute('data-id');  
    var tbl = field.getAttribute('data-action');
    var action = "p/delrow/"+field.getAttribute('data-action');
    epost(action,'id='+did,function(data){
        //console.log(data);
        var tag = 'Success';

                  // $('.result').html("");
                    
 if(data.indexOf(tag) !== -1){
              //  console.log(data);
              // hide the row
                    if(row){
                      document.querySelector(row+did).style.display = 'none';
                    }

                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })

                Toast.fire({
                icon: 'success',
                title: data
                })

            }
            else
            {
              //    Materialize.toast(data, 5000,'red');
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })

              Toast.fire({
                icon: 'error',
                title: data
              })

            }


    })
  }
  else
  {
   // console.log("You cancelled");
  }
});
}


/* Status Update */
function statusupdate(field){
  var dvalue = field.getAttribute('data-value');
  var id = field.getAttribute('data-id');
  var tbl = field.getAttribute('data-action');


  var action =  "p/STATUS_UPDATE/"+tbl;
  var senddata = 'id='+id+'&status='+dvalue;
  //alert(action);
  epost(action,senddata, function(data){

    data = JSON.parse(data);
    if(data.success){
      var tag = 'Successfully';
      //console.log(data);
        if(data.message.indexOf(tag) != -1){
            switch(dvalue){
                case '1':
                  // make it inactive
                  field.innerHTML = 'Inctive';
                  field.classList.add('red');
                  field.classList.remove('green');
                  field.setAttribute('data-value',0);
                break;
                case '0':
                  // make it active
                  field.innerHTML = 'Active';
                  field.classList.add('green');
                  field.classList.remove('red');
                  field.setAttribute('data-value',1);
                break;
            }
        }
    }    

  });
}


  function editData(field,modal,action){
      var id = field.getAttribute('data-id');
      var uid = field.getAttribute('data-uid');
      var csrf = field.getAttribute('csrf');
      var tbl = field.getAttribute('data-t');
      var editform = document.querySelector(modal+' form');
      editform.reset();

      var senddata = "id="+id+"&csrf="+csrf+"&tbl="+tbl+"&uid="+uid;
     // alert(action);
      epost("API/"+action,senddata, function(data){
          if(data)
          {
              var data = data;
              data.trim();
              data = data.replace(/\u0/,'');
           //   console.log(data);
              data = JSON.parse(data);
            //  console.log(data.id);
              // reset form values from json object
              if(data.id){
               for (const [name, valu] of Object.entries(data)) {
              //      console.log(name, valu);

                  var el = editform.querySelectorAll('[name="'+name+'"]');
                 // console.log(el[0]);
                      if(el.length > 0){                        
                          type = el[0].type;

                  switch(type){
                      case 'checkbox':
                          el[0].setAttribute('checked', 'checked');
                          break;
                      case 'radio':
                          for (var i = 0; i < el.length; ++i) {
                              if (el[i].value == valu) {
                                el[i].setAttribute('checked','checked');
                              }
                            } 
                          break;
                      default:
                          el[0].value = valu;
                        break;
                  }
                 }                   
                }
              }

              document.querySelector(modal).classList.add('active');
              UpdateFields();

          }
          else
          {
            Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: 'Unable to load data',
                  showConfirmButton: false,
                  timer: 1500
                })
          }
        });
    }

function getData(action,senddata='',embedtoid,processto){
    document.querySelector(processto).innerHTML = "<i class='mdi mdi-loading mdi-spin'></i>";
    epost(action,senddata,function(data){
        document.querySelector(embedtoid).innerHTML = data;
        document.querySelector(processto).innerHTML = "";
        //dtables.refresh();
    })
}


  function setFormData(action,formid){
      var form = document.querySelector(formid);
      var id = form.getAttribute('data-id');
      var csrf = form.getAttribute('csrf');
      var tbl = form.getAttribute('data-t');
      var editform = form;
      editform.reset();

      var senddata = "id="+id+"&csrf="+csrf+"&tbl="+tbl;
     // alert(action);
      epost("API/"+action,senddata, function(data){
          if(data)
          {
              var data = data;
              data.trim();
              data = data.replace(/\u0/,'');
           //   console.log(data);
              data = JSON.parse(data);
            //  console.log(data.id);
              // reset form values from json object
              if(data.id){
               for (const [name, valu] of Object.entries(data)) {
              //      console.log(name, valu);

                  var el = editform.querySelectorAll('[name="'+name+'"]');
                 // console.log(el[0]);
                      if(el.length > 0){                        
                          type = el[0].type;

                  switch(type){
                      case 'checkbox':
                          el[0].setAttribute('checked', 'checked');
                          break;
                      case 'radio':
                          for (var i = 0; i < el.length; ++i) {
                              if (el[i].value == valu) {
                                el[i].setAttribute('checked','checked');
                              }
                            } 
                          break;
                      default:
                          el[0].value = valu;
                        break;
                  }
                 }                   
                }
              }

            //  document.querySelector(modal).classList.add('active');
              UpdateFields();

          }
          else
          {
            Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: 'Unable to load data',
                  showConfirmButton: false,
                  timer: 1500
                })
          }
        });
    }