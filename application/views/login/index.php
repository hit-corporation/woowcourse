<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perpustakaan - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?=base_url('assets/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?=base_url('assets/node_modules/sweetalert2/dist/sweetalert2.min.css')?>">


    <!-- Custom styles for this template-->
    <link href="<?=base_url('assets/css/sb-admin-2.min.css')?>" rel="stylesheet">

	<!-- Load the JS SDK asynchronously -->
	<script crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

</head>

<body class="bg-gradient-primary">

	

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    <form class="user" method="POST" action="<?=base_url('login')?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user <?php if(isset($_SESSION['error']['errors']['email'])): ?> is-invalid <?php endif ?>"
                                                id="email" name="email" value="<?=$_SESSION['error']['old']['email'] ?? '' ?>"
                                                placeholder="Masukan email...">
                                                <?php if(isset($_SESSION['error']['errors']['email'])): ?>
                                                <small class="text-danger"><?=$_SESSION['error']['errors']['email']?></small>
                                                <?php endif ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user <?php if(isset($_SESSION['error']['errors']['password'])): ?> is-invalid <?php endif ?>"
                                                id="password" name="password" placeholder="Password">
                                            <?php if(isset($_SESSION['error']['errors']['password'])): ?>
                                                <small class="text-danger"><?=$_SESSION['error']['errors']['password']?></small>
                                            <?php endif ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" type="submit" name="submit">
                                            Login
										</button>
                            
                                       
                                    </form>
                                    <hr>

									<div class="row justify-content-center mt-2 mb-2">
										<a href="<?=$google_link?>" class="mr-1 pt-1 pr-2 pb-1 pl-2 border rounded"><img src="<?=base_url('assets/img/icon-google.png')?>" alt="" width="25"></a>
										<a href="<?=$facebook_link?>" class="ml-1 pt-1 pr-2 pb-1 pl-2 border rounded"><img src="<?=base_url('assets/img/icon-fb.png')?>" alt="" width="25"></a>
										<!-- <fb:login-button class="ml-1 pt-1 pr-2 pb-1 pl-2 border rounded" scope="public_profile,email" onlogin="checkLoginState();"> -->
										<!-- <fb:login-button class="ml-1 pt-1 pr-2 pb-1 pl-2 border rounded" scope="public_profile,email" onlogin="checkLoginState();">
										</fb:login-button> -->

										<div id="status">
										</div>
									</div>

                                    <div class="text-center">
                                        <a class="small" href="<?=base_url('login/forgot_password')?>">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?=base_url('login/register')?>">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
    <script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?=base_url('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?=base_url('assets/vendor/jquery-easing/jquery.easing.min.js')?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url('assets/js/sb-admin-2.min.js')?>"></script>

	

    <?php if(isset($_SESSION['error']['message'])): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: '<h4 class="text-danger">ERROR</h4>',
                html: '<h5 class="text-dange"><?=$_SESSION['error']['message']?></h5>',
                timer: 1500
            });
        </script>
    <?php endif ?>
    
	<?php if(isset($_SESSION['success']['message'])): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: '<h4 class="text-success">SUCCESS</h4>',
                html: '<h5 class="text-success"><?=$_SESSION['success']['message']?></h5>',
                timer: 1500
            });
        </script>
    <?php endif ?>

	<script>

		// window.fbAsyncInit = function() {
			// FB.init({
			// 	appId            : '1341891983366621',
			// 	xfbml            : true,
			// 	version          : 'v18.0'
			// });
		// };

		// function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
		// 	console.log('statusChangeCallback');
		// 	console.log(response);                   // The current login status of the person.
		// 	if (response.status === 'connected') {   // Logged into your webpage and Facebook.
		// 		// testAPI(); 
		// 		FB.api('/me?limit=3&fields=email', function(response) {
		// 			console.log(response);
		// 			console.log('Successful login for: ' + response.email);
		// 			document.getElementById('status').innerHTML =
		// 			'Thanks for logging in, ' + response.email + '!';

		// 			$.ajax({
		// 				type: "POST",
		// 				url: '<?=base_url()?>' + "login/check_facebook_email",
		// 				data: {
		// 					email: response.email
		// 				},
		// 				dataType: "JSON",
		// 				success: function (response) {
		// 					if(response.success == true){
		// 						console.log(response.message);
		// 						setInterval(function(){
		// 							window.location.href = '<?=base_url('dashboard')?>';
		// 						}, 3000);
		// 					}else{
		// 						console.log(response.message);
		// 					}
		// 				}
		// 			});

		// 			// window.location.href = '<?//=base_url()?>' + "login/facebook_sign_in_2?email=" + response.email;
		// 		});
		// 	} else {                                 // Not logged into your webpage or we are unable to tell.
		// 		document.getElementById('status').innerHTML = 'Please log ' +
		// 		'into this webpage.';
		// 	}
		// }

		// function checkLoginState() {               // Called when a person is finished with the Login Button.
		// 	FB.getLoginStatus(function(response) {   // See the onlogin handler
		// 		statusChangeCallback(response);
		// 	});
		// }

		// FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
		// 	statusChangeCallback(response);        // Returns the login status.
		// });

		// function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
			// console.log('Welcome!  Fetching your information.... ');
			
		// }

		// FB.login(function(response){
		// }, {scope: 'public_profile, email'});

		// const logout = FB.logout(function(response) {
   		// 	// Person is now logged out
		// });

	</script>

</body>

</html>
