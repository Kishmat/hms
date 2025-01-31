let form = document.getElementById("authentication");
let email = document.getElementById("email");
let password = document.getElementById("password");
let password2 = document.getElementById("password2");
let error = document.getElementById("error");

function login()
{
    if(validate())
        form.submit();
}

function validate()
{
    const email_regex = /^[a-zA-Z]+[0-9a-zA-Z]*@[a-z]+\.[a-z]{2,3}$/;
    if(email.value == '' || password.value == '')
    {
        show_error("Email or password cannot be empty!");
        return false;
    }
    else if(!email_regex.test(email.value))
    {
        show_error("Invalid email format!");
        return false;
    }
    else if(password.value.length < 8)
    {
        show_error("Password is too short!");
        return false;
    }
    else{
        if(password2)
        {
            if(password.value != password2.value)
            {
                show_error("Passwords donot match!");
                return false;
            }
        }
        return true;
    }
}
function accepted_terms(ele)
{
    let button = document.querySelector(".button1");
    if(!ele.checked)
        button.disabled = true;
    else
        button.disabled = false;
}
function signup()
{
    if(validate())
        form.submit();
}
function show_error(text)
{
    error.textContent = text;
    error.style.display = "block";
}