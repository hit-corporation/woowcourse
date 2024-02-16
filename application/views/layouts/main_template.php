<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>

<head>
	<base	 href="<?= base_url() ?>">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $title ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
	<link rel="stylesheet" href="assets/css/style.min.css">
	<link rel="stylesheet" href="assets/css/custom.min.css">
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
						<?php if (!isset($_SESSION['user'])) : ?>
							<a class="link-offset-2 link-underline link-underline-opacity-0 text-white me-3 mb-1 mb-lg-0" href="<?=base_url('login')?>">
								<i class="fa-solid fa-right-to-bracket"></i><span class="ms-2">Login</span>
							</a>
							<a class="link-offset-2 link-underline link-underline-opacity-0 text-white mb-1 mb-lg-0" href="<?=base_url('login/register')?>">
								<i class="fa-solid fa-user-plus"></i><span class="ms-1">Register</span>
							</a>
						<?php endif ?>

						<?php if (isset($_SESSION['user'])) : ?>
							<a class="link-offset-2 link-underline link-underline-opacity-0 text-white me-3 mb-1 mb-lg-0 text-decoration-none" onclick="logout()">
								<i class="fa-solid fa-right-to-bracket"></i><span class="ms-2">Logout</span>
							</a>
						<?php endif ?>
					</li>
				</ul>
			</div>
		</nav>
	</header>

	<main id="content">
		<nav id="nav-bottom" class="navbar bg-white text-dark navbar-expand-lg sticky-top" data-bs-theme="light">
			<div class="container">
				<a class="navbar-brand text-secondary" href="#">
					<h1 class="fs-4 m-0">WoowCourse</h1>
				</a>
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
								<li class="nav-item"><a class="nav-link" href="<?= base_url('course') ?>" data="1" onclick="categoryClick('1')">All</a></li>
								<?php if(!empty($categories) && count($categories) > 0): ?>
									<?php foreach ($categories as $key => $val) : ?>
										<li class="nav-item" data="<?= $val['id'] ?>"><a class="nav-link"><?= $val['category_name'] ?></a></li>

										<div class="child-1" style="display: none;">
											<?php foreach ($val['child'] as $val2) : ?>
												<li class="child-item"><a class="nav-link" href="<?= base_url('course') ?>" data="<?= $val2['id'] ?>" onclick="categoryClick('<?= $val2['id'] ?>')"><?= $val2['category_name'] ?></a></li>
											<?php endforeach ?>
										</div>
									<?php endforeach ?>
								<?php endif; ?>					
							</ul>
						</li>

						<li class="nav-item rounded">
							<?php if (isset($_SESSION['user'])) : ?>
								<a class="nav-link" aria-current="page" href="<?= base_url('member/detail') ?>">Profile</a>
							<?php endif ?>
						</li>

						<li class="nav-item rounded">
							<?php if (isset($_SESSION['user'])) : ?>
								<a class="nav-link" aria-current="page" href="<?= base_url('Instructor/detail') ?>">Instruktur</a>
							<?php endif ?>
						</li>

						<form class="d-flex" role="search">
							<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="width: 200px;">
							<button class="btn btn-outline-success" type="submit">Search</button>
						</form>
					</ul>

					
						
					<button type="button" class="btn btn-primary position-absolute" id="btn-heart">
						<i class="fa fa-heart text-white"></i>
						<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
							<?=count($wishlists)?>
						</span>
					</button>
					<div class="bg-white p-2 rounded position-absolute text-secondary d-none" id="list-wishlist">
						
						<?php foreach($wishlists as $wishlist):?>
							<div class="row mb-1">
								<div class="col-2">
									<img onerror="this.onerror=null;this.src='assets/images/default-course.jpeg';" src="<?=base_url('assets/files/upload/courses/').$wishlist['course_img']?>" alt="" width="40" height="40" class="d-inline-block">
								</div>
								<div class="col-7">
									<a href="wishlist"><?=$wishlist['course_title']?></a><br>
									<span><?=$wishlist['first_name']?> <?=$wishlist['last_name']?></span>
								</div>
								<div class="col-3">
									<span>Rp <?=number_format($wishlist['price'])?></span>
								</div>
							</div>
							<hr>
						<?php endforeach?>
						
					</div>
				
				
					<button type="button" class="btn btn-primary position-absolute" id="btn-chart">
						<i class="fa fa-shopping-cart text-white"></i>
						<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
							<?=count($carts)?>
							<span class="visually-hidden">unread messages</span>
						</span>
					</button>
				
					

					<div class="bg-white p-2 rounded position-absolute text-secondary d-none" id="list-chart">
						
						<?php foreach($carts as $cart): ?>
							<div class="row mb-1">
								<div class="col-2">
									<img src="<?=base_url('assets/files/upload/courses/').$cart['course_img'] ?>" alt="" width="40" height="40" class="d-inline-block">
								</div>
								<div class="col-7">
									<a href="Cart"><?=$cart['course_title']?></a><br>
									<span><?=$cart['first_name']?> <?=$cart['last_name']?></span>
								</div>
								<div class="col-3">
									<span>Rp <?=$cart['price']?></span>
								</div>
							</div>
							<hr>
						<?php endforeach ?>
						
					</div>
				</div>
			</div>
		</nav>
		<div id="jumbotron" class="container py-4">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-header">
					<li class="breadcrumb-item active" aria-current="page">Home</li>
					<li class="breadcrumb-item" aria-current="page"><?= ucfirst($title) ?? trim('') ?></li>
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
                                     shadow pb-2">&#8679;</a>

	<script src="<?=base_url('assets/js/jquery-3.7.1.js')?>"></script>	
	<script>
		const CATEGORIES = <?= json_encode(isset($categories)) ?? '' ?>;
	</script>
	<script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" async defer></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="assets/js/main.js" defer></script>
	<?= $this->section('js') ?>

</body>

</html>
