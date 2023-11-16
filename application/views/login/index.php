<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <base href="<?=base_url()?>">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
        <link rel="stylesheet" href="assets/css/style.min.css">
        <link rel="stylesheet" href="assets/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="assets/css/login.min.css">
		<link rel="stylesheet" href="<?=base_url('assets/node_modules/sweetalert2/dist/sweetalert2.min.css')?>">
        <style>
            /*
            .custom-float {
                padding-top: .7rem;
            }

            .custom-float > input {
                padding-bottom: .35rem;
            }

            .custom-float > label {
                position: absolute;
                top: 12px;
                left: 5px;
                font-size: .9rem;
                transition: all 200ms linear;
            }

            .custom-float > input[type="text"]:focus-visible,
            .custom-float > input[type="password"]:focus-visible {
                outline: none;
                border: none;
            } 

            .custom-float > input[type="text"]:not(:placeholder-shown) ~ label,
            .custom-float > input[type="password"]:not(:placeholder-shown) ~ label, 
            .custom-float > input[type="text"]:focus ~ label,
            .custom-float > input[type="password"]:focus ~ label, 
            .custom-float > input[type="text"]:focus-visible ~ label,
            .custom-float > input[type="password"]:focus-visible ~ label {
                top: -2px;
                left: 0px;
                font-size: .7rem;
                transition: all 200ms linear;
            }
            */

            .icon-container {
                width: 32px;
                height: 32px;
                display: flex;
                flex-wrap: nowrap; 
                justify-content: center;
                align-items: center;
            }
        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div id="login-body" class="vh-100 vw-100 d-flex justify-content-center align-items-center">
            <div class="row w-100 justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="card position-relative border-0 material-shadow-1 flex-row" id="login-card">
                        <img class="overflow-hidden" src="assets/images/5514.jpg">
                        <div class="card-body bg-primary">
                            <div class="d-flex flex-nowrap mb-2 justify-content-center">
                                <a href="<?=$facebook_link?>" class="icon-container rounded-circle border border-white text-white me-1"><i class="fa-brands fa-facebook fs-5"></i></a>
                                <a href="<?=$google_link?>" class="icon-container rounded-circle border border-white text-white"><i class="fa-brands fa-google fs-5"></i></a>
                            </div>
                            <div class="position-relative d-flex flex-nowrap justify-content-center align-items-center mt-3" id="login-separator">
                                <span class="border border-light position-absolute w-100"></span>
                                <h6 class="bg-primary top-0 m-0 p-1 z-2 text-white">OR</h6>
                            </div>
                            <form name="frm-login" class="mt-3" method="post" action="<?=base_url('login')?>">
                                <div class="input-group position-relative custom-float bg-transparent mb-2">
                                <span class="input-group-text" id="username-icon"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" class="form-control" placeholder='Username' id="txt-username" name="email">
                                    <!--<label class="text-white fw-semibold" for="txt-password"></label>-->
                                </div>
                                <div class="input-group position-relative custom-float bg-transparent mb-3">
                                <span class="input-group-text" id="username-icon"><i class="fa-solid fa-key"></i></span>
                                    <input type="password" class="form-control" placeholder='Password' id="txt-password" name="password">
                                    <!--<label class="text-white fw-semibold" for="txt-password"></label>-->
                                </div>
                                
                                <div class="d-flex flex-wrap mb-3 mt-4 justify-content-center">
                                    <button type="submit" name="submit" class="btn bg-white text-dark w-100"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
                                </div>
                                
                            </form>

							<div class="position-relative text-center left-0 w-100 py-3">
                                <a href="<?=base_url('login/register')?>" class="text-white fw-semibold text-decoration-none mx-auto">Register</a>
                            </div>

                            <div class="position-absolute bottom-0 left-0 w-100 py-3">
                                <small class="text-white fw-semibold text-decoration-none mx-auto">Forgot Password</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.js" async defer></script>
		<script src="<?=base_url('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')?>"></script>

		<?php if(isset($_SESSION['error']['message'])): ?>
			<script>
				Swal.fire({
					icon: 'error',
					title: '<h4 class="text-danger">ERROR</h4>',
					html: '<h5 class="text-dange"><?=$_SESSION['error']['message']?></h5>',
					timer: 3000
				});
			</script>
		<?php endif ?>
		
		<?php if(isset($_SESSION['success']['message'])): ?>
			<script>
				Swal.fire({
					icon: 'success',
					title: '<h4 class="text-success">SUCCESS</h4>',
					html: '<h5 class="text-success"><?=$_SESSION['success']['message']?></h5>',
					timer: 3000
				});
			</script>
		<?php endif ?>


    </body>
</html>
