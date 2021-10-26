function login(formdata){

    var showNameError = true;
    var showPwdError = true;

    var name = formdata.uname.value;
    var pswd = formdata.password.value;

    if(name == ""){
        var name = document.getElementById('name');
        name.style.borderColor = 'red';
        showNameError = true;
    }
    else{
        showNameError = false;
    }

    
    if(pswd == ""){
        var password = document.getElementById('password');
        password.style.borderColor = 'red';
        showPwdError = true;
    }
    else{
        showPwdError = false;
    }

    if(showNameError == false && showPwdError == false){
        return true;
    }
    else{
        alert("Do fill all details");
        return false;
    }



}
function focusMe(x){
    x.style.backgroundColor = 'rgb(0,0,0,0.5)';
}

function blurMe(x){
    x.style.backgroundColor = 'transparent';
}

function checkBorder(x){
    if(x.style.borderColor == 'red'){
        x.style.borderColor = 'white'
    }
}