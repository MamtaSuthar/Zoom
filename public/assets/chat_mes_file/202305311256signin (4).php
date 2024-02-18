<?php
   require_once(dirname(__FILE__).'/manager/session_manager.php');
   if(isSessionValid() == true){
      header("Location: index.php");
      die();
  }

   
  if (!empty($_POST['contact_mail']) && !empty($_POST['password'])) {
   
      if(validateLogin($_POST['contact_mail'],$_POST['password']) == true){
          $getloginde = getlogindetails($_POST['contact_mail'],$_POST['password']);
          if(!empty($getloginde) && $getloginde["user_role"] == "1"){
                createAdminSession(true,$_POST['contact_mail']);
                header("Location: admin.php");
            }else{
                createSession(true,$_POST['contact_mail']);
                header("Location: index.php");
        }
         
         die();
      }  
   }
?>

<?php 
require_once (dirname(__FILE__).'/includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include(dirname(__FILE__).'/components/header.php'); ?>
</head>
<style>
    #to-recover:hover {
        color:#805dca;
    }
    #to-recover{
        font-style:italic;
    }
</style>
   <body>

      <!-- BEGIN LOADER -->
      <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

<div class="container mx-auto align-self-center">

    <div class="row">

        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
            <div class="card mt-5 mb-3">
                <div class="card-body">

                    <form class="form-horizontal m-t-20" id="loginform"  method="post" onsubmit="doLogin()">

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            
                            <h2>Sign In</h2>
                            <p>Enter your email and password to login</p>
                            
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="contact_mail" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label">Password</label>
                                <input type="password" name="password"  class="form-control" required>
                            </div>
                            <?php 
                      if(isset($_POST['contact_mail']) || isset($_POST['password']))
                         echo '<div class="text-danger">
                                  email or password is incorrect.
                               </div>';
                   ?>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-check form-check-primary form-check-inline d-flex justify-content-end">
                                    <!--<input class="form-check-input me-3" type="checkbox" id="form-check-default">-->
                                    <!--<label class="form-check-label" for="form-check-default">-->
                                    <!--    Remember me-->
                                    <!--</label>-->
                                    <a class="" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Forget password?</a>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="mb-4">
                                <button name="login" type="submit" class="btn btn-secondary w-100">SIGN IN</button>
                            </div>
                        </div>
                        
                        <!--<div class="col-12 mb-4">-->
                        <!--    <div class="">-->
                        <!--        <div class="seperator">-->
                        <!--            <hr>-->
                        <!--            <div class="seperator-text"> <span>Or continue with</span></div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <!--<div class="col-sm-4 col-12">-->
                        <!--    <div class="mb-4">-->
                        <!--        <button class="btn  btn-social-login w-100 ">-->
                        <!--            <img src="<?php echo url?>/src/assets/img/google-gmail.svg" alt="" class="img-fluid">-->
                        <!--            <span class="btn-text-inner">Google</span>-->
                        <!--        </button>-->
                        <!--    </div>-->
                        <!--</div>-->

                        <!--<div class="col-sm-4 col-12">-->
                        <!--    <div class="mb-4">-->
                        <!--        <button class="btn  btn-social-login w-100">-->
                        <!--            <img src="<?php echo url?>/src/assets/img/github-icon.svg" alt="" class="img-fluid">-->
                        <!--            <span class="btn-text-inner">Github</span>-->
                        <!--        </button>-->
                        <!--    </div>-->
                        <!--</div>-->

                        <!--<div class="col-sm-4 col-12">-->
                        <!--    <div class="mb-4">-->
                        <!--        <button class="btn  btn-social-login w-100">-->
                        <!--            <img src="<?php echo url?>/src/assets/img/twitter.svg" alt="" class="img-fluid">-->
                        <!--            <span class="btn-text-inner">Twitter</span>-->
                        <!--        </button>-->
                        <!--    </div>-->
                        <!--</div>-->

                        <div class="col-12">
                            <div class="text-center">
                                <p class="mb-0">Dont't have an account ? <a href="./signup.php" class="text-warning">Sign Up</a></p>
                            </div>
                        </div>
                        
                    </div>
                    
                </form>
                
                <form class="form-horizontal m-t-20" id="recoverform" >

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            
                            <h2>Forget Password</h2>

                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control form-control-lg" id="tb_recoverymail" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1" required>
                            </div>
                            <div class="text-danger" id="email-error">
                                        </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-check form-check-primary form-check-inline">
                                    <!--<input class="form-check-input me-3" type="checkbox" id="form-check-default">-->
                                    <!--<label class="form-check-label" for="form-check-default">-->
                                    <!--    Remember me-->
                                    <!--</label>-->
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="mb-4">
                                <button name="login" type="submit" class="btn btn-secondary w-100">Send</button>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="text-center">
                                <p class="mb-0">Dont't have an account ? <a href="#" class="text-warning" id="to-login">Sign in</a></p>
                            </div>
                        </div>
                        
                    </div>
                    
                </form>

                </div>
            </div>
        </div>
       
    </div>
    
</div>

</div>
<!-- <script src="js/libs/jquery/jquery-3.6.0.min.js"></script> -->
<?php include(dirname(__FILE__).'/components/script.php'); ?>

      <script>
      $(document).ready(function(){
          $("#recoverform").hide();
      })
         $(".preloader").fadeOut();
         // ============================================================== 
         // Login and Recover Password 
         // ============================================================== 
         $('#to-recover').on("click", function() {
             $("#loginform").hide();
             $("#recoverform").fadeIn();
         });
         $('#to-login').click(function(){             
             $("#recoverform").hide();
             $("#loginform").fadeIn();

         });

         function doLogin(){
            e= $('[name ="login"]');
            if($('[name ="contact_mail"]').val()=='' || $('[name ="password"]').val()=='')
               return;
             if(!e.is('[disabled=disabled]'))
                 e.attr('disabled', true);
             else
                 e.attr('disabled', false);
             e.children(":first").toggleClass('fa-spinner fa-spin');
         }

        $("#recoverform").submit(function(e) {
            e.preventDefault();
            $("#email-error").html("");
            $('[name ="recovery"]').children(":first").toggleClass('fa-spinner fa-spin');
              var contact_mail= $("#tb_recoverymail").val();
            $.post({
                url: "./manager/pwd_manager.php",
                contentType: 'application/json; charset=utf-8',
                data: JSON.stringify({ 
                    action_type: "send_pwd_reset",
                    contact_mail: contact_mail
                })
            }).done(function (data) {
                $('[name ="recovery"]').children(":first").toggleClass('fa-spinner fa-spin');
                if(data.result == "success"){
                    $("#email-error").html('<span class="text-success">If the contact_mail is valid, you will receive a password reset link now. Please note the link is valid for 48hrs only.</span>');
                    $("#tb_recoverymail").val('');
                }
                else
                    $("#email-error").html('<span class="text-danger">' + data.msg + '</span>');
              });
            }); 
      </script>
   </body>
</html>