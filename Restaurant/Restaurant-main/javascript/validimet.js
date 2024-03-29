let name = document.getElementById('name');
let surname = document.getElementById('surname');
let number = document.getElementById('number');
let email = document.getElementById('email');
let password = document.getElementById('password');
let password2 = document.getElementById('password2');
let button = document.getElementById('sign');
let errorMsg = document.getElementById('errorMsg');


button.addEventListener("click", function(){

        if(areInputsEmpty()){
            highlightEmptyInputs();
    
            if(arePasswordsSame(password.value, password2.value) == false){
                errorMsg.innerHTML = "Passwords should include upper case and symbols or should be the same";
            }
        } else {
                window.location.href = "login.html";
            
        }

        
    
    
});

function validatePassword(password) {
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    return passwordRegex.test(password);
  }

function arePasswordsSame(password1, password2) {
    return validatePassword(password1) === password2;
  }
  
  
function highlightEmptyInputs() {
    const inputs = document.querySelectorAll("input");
    inputs.forEach(input => {
      if (input.value === "") {
        input.style.borderColor = "red";
      }
    });
 }
  
function areInputsEmpty() {
    const inputs = document.querySelectorAll("input");
    let counter = 0;
    inputs.forEach(input => {
        if(input.value === "") {
            counter++;
        }
    });
    if(counter>0){
        return true;
    }
}

