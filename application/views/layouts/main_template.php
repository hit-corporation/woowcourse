<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <base href="<?= base_url() ?>">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $title ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
        <link rel="stylesheet" href="assets/css/style.min.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <link rel="stylesheet" href="assets/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
        <?= $this->section('css') ?>
    </head>
    <body class="min-100-vh bg-light-subtle">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <header>
            <nav id="nav-top" class="navbar bg-primary">
                <div class="container">
                    <ul class="w-100 list-unstyled row align-items-center mb-0">
                        <li class="col-12 col-md-6 d-flex flex-column flex-sm-row flex-nowrap">
                            <a class="link-offset-2 link-underline link-underline-opacity-0 text-white mb-1 mb-lg-0" href="tel:+81289617462">
                                <span class="me-1">&#9742;</span>081289617462
                            </a>
                            <a class="ms-0 ms-sm-4 link-offset-2 link-underline link-underline-opacity-0 text-white mb-1 mb-lg-0" href="mailto:admin@admin.com">
                                <span class="me-1">&#9993;</span>admin@admin.com
                            </a>
                        </li>
                        <li class="col-12 col-md-6 d-flex flex-column flex-sm-row flex-nowrap justify-content-end">
                            <a class="link-offset-2 link-underline link-underline-opacity-0 text-white me-3 mb-1 mb-lg-0" href="#">
                                <i class="fa-solid fa-right-to-bracket"></i><span class="ms-2">Login</span>
                            </a>
                            <a class="link-offset-2 link-underline link-underline-opacity-0 text-white mb-1 mb-lg-0" href="#">
                                <i class="fa-solid fa-user-plus"></i><span class="ms-1">Register</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        
        <main id="content">
            <nav id="nav-bottom" class="navbar bg-white text-dark navbar-expand-lg sticky-top" data-bs-theme="light">
                <div class="container">
                    <a class="navbar-brand text-secondary" href="#"><h1 class="fs-4 m-0">WoowCourse</h1></a>
                    <button class="navbar-toggler" type="button" id="btn-opennav" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item rounded">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                          </li>
                          <li class="nav-item position-relative rounded">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="collapse" data-bs-target="#collapse_1" aria-expanded="false">
                              Categories
                            </a>
                            <ul class="list-unstyled custom-dropdown collapse" id="collapse_1">
                                <li class="nav-item"><a class="nav-link">All</a></li>

								<?php foreach ($categories as $key => $val) : ?>
									<li class="nav-item" data="<?=$val['id']?>"><a class="nav-link"><?=$val['category_name']?></a></li>
									
									<div class="child-1" style="display: none;">
										<?php foreach($val['child'] as $val2): ?>
											<li class="child-item"><a class="nav-link" href="<?=base_url('course')?>" data="<?=$val2['id']?>" onclick="categoryClick('<?=$val2['id']?>')"><?=$val2['category_name']?></a></li>
										<?php endforeach ?>
									</div>
								<?php endforeach ?>

                            </ul>
                          </li>
                        </ul>
                        <form class="d-flex" role="search">
                          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
            <div id="jumbotron" class="container py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-header">
                      <li class="breadcrumb-item active" aria-current="page">Home</li>
                      <li class="breadcrumb-item" aria-current="page"><?=ucfirst($uri1)?></li>
                    </ol>
                </nav>
            </div>
        </main>
        
        <!-- START SECTION BODY -->
        <section id="body" class="mt-5 bg-light py-5">
            <?= $this->section('body') ?>
        </section>
        <!-- END SECTION BODY -->
       

        <!-- START FOOTER -->
        <footer class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3"></div>
                    <div class="col-12 col-lg-3"></div>
                    <div class="col-12 col-lg-3"></div>
                </div>
                <div class="row"></div>
            </div>
        </footer>
        <!-- END FOOTER -->
        <a role="button" href="#" class="btn btn-primary p-0 m-0 
                                     floating-button rounded-circle 
                                     text-white 
                                     text-shadow 
                                     shadow pb-2" >&#8679;</a>

		<script>const CATEGORIES = <?=json_encode($categories)?>;</script>
        <script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" async defer></script>
        <script src="assets/js/main.js" async defer></script>
        <?= $this->section('js') ?>
        
    </body>
</html>
