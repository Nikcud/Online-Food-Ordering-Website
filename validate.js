function validateForm(formdata){

    var showNameError = true; 
    var showGenderError = true; 
    var showEmailError = true;
    var showPhoneError = true;
    // var showCountryError = true;
    var showStateError = true;
    var showCityError = true;
    var showPincodeError = true
    var showAddressError = true
 

    var name = formdata.uname.value;
    var gender = formdata.gender.value;
    var email = formdata.email.value;
    var phone = formdata.phone.value;
    // var country = formdata.country.value;
    var state = formdata.state_name.value;
    var city = formdata.city.value;
    var pincode = formdata.pincode.value;
    var address = formdata.address.value;

    if(name == ""){
        var uname = document.getElementById('name');
        uname.style.borderColor = 'red';
        showNameError = true; 
    }
    else{
        showNameError = false; 
    }

    if(gender == "" ){
        var Usergender = document.getElementById('user_gender');
        Usergender.style.border= '1px solid red';
        showGenderError = true; 
    }
    else{
        showGenderError = false;
    }

    if(email == ""){
        var uemail = document.getElementById('user_email');
        uemail.style.borderColor = 'red';
        showEmailError = true;
    }
    else{
        showEmailError = false;
    }

   
    if(phone == "" || phone.length != 10){
        var number = document.getElementById('user_number');
        number.style.borderColor = 'red';
        showPhoneError = true;
    }
    else{
        showPhoneError = false;
    }

    // if(country == ""){
    //     var ctry = document.getElementById('user_country');
    //     ctry.style.borderColor = 'red';
    //     showCountryError = true;
    // }
    // else{
    //     showCountryError = false;
    // }
   
    if(state == ""){
        var user_state = document.getElementById('state_name');
        user_state.style.borderColor = 'red';
        showStateError = true;
    }
    else{
        showStateError = false;
    }

    if(city == ""){
        var user_city = document.getElementById('city_name');
        user_city.style.borderColor = 'red';
        showCityError = true;
    }
    else{
        showCityError = false;
    }

    if(pincode == ""){
        var user_pincode = document.getElementById('user_pincode');
        user_pincode.style.borderColor = 'red';
        showPincodeError = true;
    }
    else{
        showPincodeError = false;
    }

    if(address == ""){
        var user_address = document.getElementById('user_address');
        user_address.style.borderColor = 'red';
        showAddressError = true;
    }
    else{
        showAddressError = false;
    }
  

    

    if(showNameError == false && showEmailError == false && showPhoneError == false
       && showStateError == false && showCityError == false && 
       showGenderError==false && showPincodeError==false && showAddressError==false){
            // call();
            return true;
    }
    else{
            // alert("Please Fill all details..."); 
            return false;   
    }
}



// function checkInput(){
//     var key;
//     if(window.event){
//         key= window.event.keyCode;
//         if((key >=65 && key <=90) || (key >=97 && key<=122)){
//             return true
//         }
//         else{
//             return false
//         }
//     }
// }

function checkBorder(x){
    if(x.style.borderColor == 'red'){
        x.style.borderColor = 'black'
    }
}


