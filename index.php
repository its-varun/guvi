<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GUVI</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <!--sweetalert-->
    <script src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <body>
  <header class="header">
    <nav class="nav">
      <a  class="nav_logo" href="#">User Details</a>

      <button class="button" id="form-open">Login</button>
    </nav>
  </header>
  <section class="home">
    <div class="form_container">
      <i class="uil uil-times form_close"></i>
      <div class="form login_form">
        <form id="login-form"  method="post" >
          <h2>Login</h2>
          <div class="input_box">
            <input type="email" id="login-email" name="Login_Email" placeholder="Enter your email" />
            <i class="uil uil-envelope-alt email"></i>
          </div>
          <div class="input_box">
            <input type="password" id="login-password" name="Login_Password" placeholder="Enter your password"  />
            <i class="uil uil-lock password"></i>
            <i class="uil uil-eye-slash pw_hide"></i>
          </div>
          <input type="submit" class="button" id="login-button" value="Login Now" onclick="Login()">

          <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
        </form>
      </div>

      <!-- Signup Form -->
      <div class="form signup_form">
        <form id="signup-form" action="" method="post"  >
          <h2>Signup</h2>

          <div class="input_box">
            <input type="text"  placeholder="Enter your username" name="Fullname" />
            <div class="as">
              <i class="uil uil-user username"></i>
            </div>
            
          </div>
          <div class="input_box">
            <input type="text"  placeholder="Enter your email" name="Email"  />
            <div class="as">
              <i class="uil uil-envelope-alt email"></i>
            </div>
    
          </div>

          <div class="input_box">
            <input type="password"  placeholder="Create password" name="Password"/>
            <div class="as">
              <i class="uil uil-lock password"></i>
            </div>
            <i class="uil uil-eye-slash pw_hide"></i>
          </div>

          <div class="input_box">
            <input type="password"  placeholder="Re-enter password" name="pass1"/>
            <div class="as">
              <i class="uil uil-lock password"></i>
            </div>
            <i class="uil uil-eye-slash pw_hide"></i>
        
          </div><input type="submit" class="button" id="signup-button" value="Register Now" onclick="Registration()">
          <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>
        </form>
      </div>
    </div>
  </section>

<script>
const formOpenBtn = document.querySelector("#form-open");
const home = document.querySelector(".home");
const formContainer = document.querySelector(".form_container");
const formCloseBtn = document.querySelector(".form_close");
const signupBtn = document.querySelector("#signup");
const loginBtn = document.querySelector("#login");
const pwShowHide = document.querySelectorAll(".pw_hide");









function Registration(){
    var Fullname=$("input[name=Fullname]").val();
    var Email = $("input[name=Email]").val();
    var Password = $("input[name=Password]").val();
    var Confirm=$("input[name=pass1]").val();
    if(Email == '' || Password == ''||Fullname=='')
    {
        Swal.fire('Fill all the fields..');
    }
    else if(Password!=Confirm){
            Swal.fire('Password Should be matched..');
    }
    else
    {

        var user_info = {
            Fullname:Fullname,
            Email:Email,
            Password:Password,
        }

        $.ajax({
                type: "POST",
                url: 'register.php',
                data: user_info,
                success: function(response)
                {
                    var response = JSON.parse(response);
                    if(response)
                    {
                        // console.log(response.status);

                        if(response.status == 'success')
                        {
                            Swal.fire("Registered Successfully",'success');
                    Swal.fire({
                    icon: 'success',
                    title: 'Registered Successfully',
                    showConfirmButton: false,
                    timer: 1500
                        });
                 }
                     else if(response.status == 'failed' && response.error == 'Email_already_taken')
                    {
                            Swal.fire('Email Id is already taken. Try another one...','success');
                        }
                        else
                        {
                            alert(response.error,'error');
                        }  
                    }
                    else
                    {
                        console.log('Error');
                    }
            }
        });

    }

}

function Login(){

var Email = $("input[name=Login_Email]").val();
var Password = $("input[name=Login_Password]").val();
if(Email ==='' || Password ==='')
    {
        Swal.fire('Fill all the fields..');
    }else{
var user_login_info = {

    Email:Email,
    Password:Password
}

$.ajax({
        type: "POST",
        url: 'validation.php',
        data: user_login_info,
        success: function(response)
        {
            var response = JSON.parse(response);
            if(response)
            {
                // console.log(response.status);

              //  if(response.status == 'success')
               // {
                    // redirect to profiles
                    // Swal.fire({icon:"success",title:"Login Successfull",showConfirmButton:false,timer:1500});
                   // Swal.fire({title:"successful",timer:4000});
                //  window.location.href = 'profile.php';
                    
              //  }
                if (response.status == 'success') {
                 Swal.fire({
                 icon: 'success',
                 title: 'Login Successfully',
                showConfirmButton: false,
                 timer: 1500
            }).then(function () {
                     window.location.href = './index1.php';
                });
                }
                else if(response.status == 'Invalid')
                {
                    Swal.fire({
                 icon: 'error',
                 title: 'Invalid Email or Password',
                showConfirmButton: false,
                 timer: 1500
            });
                }
                else if(response.status == 'Error')
                {
                    Swal.fire(response.Error);
                }
            }
            else
            {
                console.log('Error');
            }
       }
   });

}
}
formOpenBtn.addEventListener("click", () => home.classList.add("show"));
formCloseBtn.addEventListener("click", () => home.classList.remove("show"));

pwShowHide.forEach((icon) => {
  icon.addEventListener("click", () => {
    let getPwInput = icon.parentElement.querySelector("input");
    if (getPwInput.type === "password") {
      getPwInput.type = "text";
      icon.classList.replace("uil-eye-slash", "uil-eye");
    } else {
      getPwInput.type = "password";
      icon.classList.replace("uil-eye", "uil-eye-slash");
    }
  });
});

signupBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.add("active");
});
loginBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.remove("active");
});




</script>
</body>
</html>