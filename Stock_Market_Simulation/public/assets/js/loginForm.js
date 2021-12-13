(function(){

    // to set errors msg
    function setErrorFor(input, message) {
        const formControl = input.parentElement;
       // console.log(formControl);

        const small = formControl.querySelector('small');
        formControl.id = 'form-error';
        //console.log(formControl);
        small.innerText = message;
        //console.log(small.innerText);
    }

    // set success msg
    function setSuccessFor(input) {
        const formControl = input.parentElement;
        console.log(formControl);
        formControl.id = 'form-success';
        console.log(formControl);
    }

    // validate the name input
    function checkName(){
        const username = document.getElementById('name');

        if(username.value === '') {
            setErrorFor(username, 'Username cannot be blank');
        } else {
            setSuccessFor(username);
            return true;
        }
    }

    //validate password 
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

    // validate form    
    function validateForm(){
        let valid = false;

        valid = checkName();

        if(valid){
            valid = checkPass();
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

        //form submission
        
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
                    url: 'http://127.0.0.1:8080/php/MVC_PROJECT/Stock_Market_Simulation/login/handelLogin',
                    data: registerData,
                    success: function(data){
                        let jsonData=JSON.parse(data)
                        console.log('this is json data'+jsonData.id);
                        
                        const showUser = document.getElementById('userCreated');
                        let msg="Welcome user";
                        let errUser="user is invalid";
                        let errPass="password is invalid";
                        
                        if(jsonData.status=='true'){
                            showUser.style.backgroundColor='green';
                            showUser.innerText=msg;
                            setTimeout(function(){window.location.replace(jsonData.url);
                            }, 2000);
                        }else if(jsonData.status=='false'){
                            showUser.style.backgroundColor='red';
                            showUser.innerText=errPass;
                        }else if(jsonData.status==''){
                            showUser.style.backgroundColor='red';
                            showUser.innerText=errUser;
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