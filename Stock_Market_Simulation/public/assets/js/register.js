(function(){

    function setErrorFor(input, message) {
        const formControl = input.parentElement;
       // console.log(formControl);

        const small = formControl.querySelector('small');
        formControl.id = 'form-error';
        //console.log(formControl);
        small.innerText = message;
        //console.log(small.innerText);
    }

    function setSuccessFor(input) {
        const formControl = input.parentElement;
        console.log(formControl);
        formControl.id = 'form-success';
        console.log(formControl);
    }

    function checkName(){
        const username = document.getElementById('name');

        if(username.value === '') {
            setErrorFor(username, 'Username cannot be blank');
        } else {
            setSuccessFor(username);
            return true;
        }
    }

    function checkEmail(){
        const email = document.getElementById('email');

        if(email.value === '') {
            setErrorFor(email, 'Email cannot be blank');
            return false;
        } else if (!isEmail(email.value)) {
            setErrorFor(email, 'Not a valid email');
            return false;
        } else {
            setSuccessFor(email);
            return true;
        }
    }

    function checkPass(){
        const password =document.getElementById('password');

        if(password.value === '') {
            setErrorFor(password, 'Password cannot be blank');
            return false;
        } else {
            setSuccessFor(password);
            return true;
        }
    }

    function checkPass2(){
        const password =document.getElementById('password');
        const password2 = document.getElementById('confirm-password');

        if(password2.value === '') {
            setErrorFor(password2, 'Password2 cannot be blank');
            return false;
        } else if(password2.value !== password.value) {
            setErrorFor(password2, 'Passwords does not match');
            return false;
        } else{
            setSuccessFor(password2);
            return true;
        }
    }

    function isEmail(email){
        let regex=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return regex.test(email);
    }

    function validateForm(){
        let valid = false;

        valid = checkName();

        if(valid){
            valid = checkEmail();
        }
        if(valid){
            valid = checkPass();
        }
        if(valid){
            valid = checkPass2();
        }

        if(valid){
            document.getElementById('submitForm').disabled = false;
            return true;
        }else{
            document.getElementById('submitForm').disabled = true;
            return false;
        }
    }

    function setEventListeners(){
        Array.from(document.getElementsByTagName("input")).forEach(form_input =>{
            form_input.addEventListener('focusout', function(){
                validateForm();
            });
        });

        $('#registerForm').on('submit',function(e){
            e.preventDefault();
            console.log('we are getting the input');
            if(validateForm()){
                console.log('do the call');

                let registerData = new FormData(document.getElementById('registerForm'));
                console.log(registerData);
                $.ajax({
                    cache: false,
                    processData: false,
                    contentType: false,
                    type: "POST",
                    url: 'http://127.0.0.1:8080/php/MVC_PROJECT/Stock_Market_Simulation/register/handelRegister',
                    data: registerData,
                    success: function(data){
                        const username = document.getElementById('name');
                        const showUser = document.getElementById('userCreated');
                        console.log(data);
                        if(data){
                            let msg=username.value+" Created";
                            showUser.style.backgroundColor='green';
                            showUser.innerText=msg;
                            setTimeout(function(){window.location.replace('http://127.0.0.1:8080/php/MVC_PROJECT/Stock_Market_Simulation/login/index');
                            }, 2000);
                        }
                        
                    },
                    error: function(xhr, status, error){
                        console.error(xhr);
                    }
                });

            }else{
                console.log('do not do the call');
            }
        });
    }

    function init(){
        setEventListeners();
    }

    document.addEventListener("DOMContentLoaded", function (){
        init();
    });
})();