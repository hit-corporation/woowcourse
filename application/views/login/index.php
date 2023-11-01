<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
        <link rel="stylesheet" href="assets/css/style.min.css">
        <link rel="stylesheet" href="assets/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="assets/css/login.min.css">
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
                            <form name="frm-login">
                                <div class="form-floating bg-transparent border-0 border-bottom border-white mb-2">
                                    <input type="text" class="form-control bg-transparent border-0 text-white" id="txt-username" placeholder="Username OR Email">
                                    <label class="text-white"  for="txt-username">Email Address Or Username</label>
                                </div>
                                <div class="form-floating bg-transparent border-0 border-bottom border-white">
                                    <input type="password" class="form-control bg-transparent border-0 text-white" id="txt-password" placeholder="Password">
                                    <label class="text-white" for="txt-password">Password</label>
                                </div>
                                <div class="d-flex flex-nowrap mt-3">
                                    <div class="form-check text-white me-2 fw-semibold text-decoration-none">
                                        <input type="checkbox" class="form-check-input">
                                        <label class="form-check-label"> Remember Me</label>
                                    </div>
                                   
                                </div>
                                <div class="d-flex flex-wrap mt-3 align-items-center">
                                    <button type="submit" class="btn bg-white text-dark w-100"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
                                </div>
                            </form>
                            <div class="position-absolute bottom-0 left-0 w-100 py-3">
                                <small class="text-white fw-semibold text-decoration-none mx-auto">Forgot Password</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.js" async defer></script>
    </body>
</html>