function validateForm(formdata){

    var showErrorName = true; 
    var showErrorEmail = true;
    var showErrorPhone = true;
    var showErrorPassword = true;
    var showErrorCnfrmPassword = true;
    var showErrorMatch = true;
    var showErrorGender = true;

    var name = formdata.uname.value;
    var gender = formdata.gender.value;
    var email = formdata.email.value;
    var phone = formdata.phone.value;
    var pswd = formdata.password.value;
    var cnfrmPswd = formdata.cnfrm_password.value;

    if(name == ""){
        var name = document.getElementById('name');
        name.style.borderColor = 'red';
        showErrorName = true; 
    }
    else{
        showErrorName = false; 
    }

    if(gender == "" ){
        var Usergender = document.getElementById('gender');
        Usergender.style.border= '1px solid red';  
    }
    else{
        showErrorGender = false;
    }

    if(email == ""){
        var name = document.getElementById('email');
        name.style.borderColor = 'red';
        showErrorEmail = true;
    }
    else{
        showErrorEmail = false;
    }

   
    if(phone == "" || phone.length != 10){
        var number = document.getElementById('number');
        number.style.borderColor = 'red';
        showErrorPhone = true;
    }
    else{
        showErrorPhone = false;
    }

    if(pswd == ""){
        var password = document.getElementById('password');
        password.style.borderColor = 'red';
        showErrorPassword = true;
    }
    else{
        showErrorPassword = false;
    }
   
    if(cnfrmPswd == ""){
        var cnfrm_password = document.getElementById('cnfrm_password');
        cnfrm_password.style.borderColor = 'red';
        showErrorCnfrmPassword = true;
    }
    else{
        showErrorCnfrmPassword = false;
    }

    if(pswd != cnfrmPswd){
        alert("Password not Match!!!");
        showErrorMatch = true;
    }
    else{
        showErrorMatch = false;
    }

    if(showErrorName == false && showErrorEmail == false && showErrorPhone == false 
        && showErrorPassword == false && showErrorCnfrmPassword == false && 
         showErrorMatch == false && showErrorGender==false){
            return true;
    }
    else{
            // alert("Please Fill all details..."); 
            return false;   
    }
}

function focusMe(x){
    x.style.backgroundColor = 'rgb(0,0,0,0.5)';
}

function blurMe(x){
    x.style.backgroundColor = 'transparent';
}

function checkInput(x){
    var key;
    if(x.name == 'uname'){
        if(window.event){
            key= window.event.keyCode;
            if((key >=65 && key <=90) || (key >=97 && key<=122)){
                return true
            }
            else{
                return false
            }
        }
    }
    else{
        if(window.event){
            key= window.event.keyCode;
            if(key >=48 && key <=57){
                return true
            }
            else{
                return false
            }
        }

    }
   
}

function checkBorder(x){
    if(x.style.borderColor == 'red'){
        x.style.borderColor = 'white'
    }
}


function checkEmailAndPassword(x){
    if(x.name=='email'){
        if(!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(x.value)) {
            alert("Invalid Email");
        }
    }
    else{
        var e =  /(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})/
        if(!e.test(x.value)) {
            alert("The password is at least 8 characters long \n The password has at least one uppercase letter \n The password has at least one lowercase letter \n The password has at least one digit \n The password has at least one special character");
        }
    }
    
}

// function checkPassword(){
//     var d = document.getElementById('password').value;
    
// }

