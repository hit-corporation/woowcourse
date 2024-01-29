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
	<link rel="stylesheet" href="assets/css/custom.min.css">
	<link rel="stylesheet" href="assets/css/dashboard.min.css">
	<link rel="stylesheet" href="assets/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="assets/css/index.min.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

	<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>	 -->
	<base href="<?=base_url()?>" >

	<style>
		/* style custom animasi jumbotron */
		.ml2 .letter {
			display: inline-block;
			line-height: 1em;
		}

		.letter {
			color: white;
		}
	</style>
</head>

<body class="min-100-vh bg-light-subtle">
	<!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
	<header>
		<nav id="nav-top" class="navbar bg-primary">
			<div class="container">
				<ul class="w-100 list-unstyled row align-items-center mb-0">
					<li class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-6 d-flex flex-column flex-sm-row flex-nowrap">
						<a class="link-offset-2 link-underline link-underline-opacity-0 text-white mb-1 mb-lg-0" href="tel:+81289617462">
							<span class="me-1">&#9742;</span>081289617462
						</a>
						<a class="ms-0 ms-sm-4 link-offset-2 link-underline link-underline-opacity-0 text-white mb-1 mb-lg-0" href="mailto:admin@admin.com">
							<span class="me-1">&#9993;</span>admin@admin.com
						</a>
					</li>

					<?php if(!isset($_SESSION['user'])): ?>
						<li class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-6 d-flex flex-column flex-sm-row flex-nowrap justify-content-end">
							<a class="link-offset-2 link-underline link-underline-opacity-0 text-white me-3 mb-1 mb-lg-0" href="<?= base_url('login') ?>">
								<i class="fa-solid fa-right-to-bracket"></i><span class="ms-2">Login</span>
							</a>
							<a class="link-offset-2 link-underline link-underline-opacity-0 text-white mb-1 mb-lg-0" href="#">
								<i class="fa-solid fa-user-plus"></i><span class="ms-1">Register</span>
							</a>
						</li>
					<?php endif ?>

					<?php if(isset($_SESSION['user'])): ?>
						<li class="col-12 col-md-6 d-flex flex-column flex-sm-row flex-nowrap justify-content-end">
							<a class="link-offset-2 link-underline link-underline-opacity-0 text-white me-3 mb-1 mb-lg-0" href="<?= base_url('login/logout') ?>">
								<i class="fa-solid fa-right-to-bracket"></i><span class="ms-2">Logout</span>
							</a>
						</li>
					<?php endif ?>

				</ul>
			</div>
		</nav>
	</header>

	<main id="content">
		<nav id="nav-bottom" class="navbar navbar-expand-lg sticky-top">
			<div class="container">
				<a class="navbar-brand" href="#">
					<h1 class="fs-4 m-0">WoowCourse</h1>
				</a>
				<button class="navbar-toggler" type="button" id="btn-opennav" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
					<i class="fa-solid fa-bars"></i>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mb-2 mb-lg-0">
						<li class="nav-item rounded">
							<a class="nav-link active" aria-current="page" href="#">Home</a>
						</li>
						<li class="nav-item position-relative rounded">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="collapse" data-bs-target="#collapse_1" aria-expanded="false">
								Categories
							</a>
							<!-- <ul class="list-unstyled custom-dropdown collapse" id="collapse_1">
								<li class="nav-item"><a class="nav-link">Pelajaran</a></li>
								<li class="nav-item"><a class="nav-link">IT Dan Komputer</a></li>
							</ul> -->
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
						<li class="nav-item rounded">
							<?php if(isset($_SESSION['user'])):?>
								<a class="nav-link" aria-current="page" href="<?=base_url('member/detail')?>">Profile</a>
							<?php endif ?>		
						</li>

						<li class="nav-item rounded">
							<?php if (isset($_SESSION['user'])) : ?>
								<a class="nav-link" aria-current="page" href="<?= base_url('Instructor/detail') ?>">Instruktur</a>
							<?php endif ?>
						</li>
						
					</ul>
					<form class="d-flex" role="search">
						<input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
						<a class="btn btn-outline-success" id="btn-search" type="submit">Search</a>
					</form>

					<button type="button" class="btn btn-primary position-absolute" id="btn-heart">
						<i class="fa fa-heart text-white"></i>
						<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
							<?=count($wishlists)?>
						</span>
					</button>
					<div class="p-2 rounded position-absolute text-secondary d-none" id="list-wishlist">
						
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
						
						<?php foreach($carts as $cart):?>
							<div class="row mb-1">
								<div class="col-2">
									<img src="<?=base_url('assets/files/upload/courses/').$cart['course_img']?>" alt="" width="40" height="40" class="d-inline-block">
								</div>
								<div class="col-7">
									<a href="Cart"><?=$cart['course_title']?></a><br>
									<span><?=$cart['first_name']?> <?=$cart['last_name']?></span>
								</div>
								<div class="col-3">
									<span>Rp <?=number_format($cart['price'])?></span>
								</div>
							</div>
							<hr>
						<?php endforeach?>
						
					</div>

				</div>


			</div>
		</nav>
		<div id="jumbotron" class="container py-4">
			<div class="row py-4 mt-4 position-relative">
				<div class="col-12">
					<h1 class="top text-center text-uppercase mt-4 pt-5 ml2">
						<span class="text-primary">Woow</span>
						<span class="text-white">Course</span>
					</h1>
					<h3 class="text-center text-white text-shadow ml3 letters">
						<i>We provides always our best educational services for our all students</i>
					</h3>
				</div>
			</div>
		</div>
	</main>


	<section id="popular-courses" class="container py-5 my-3">
		<h3 class="text-center w-100 m-0 mb-4">POPULAR COURSES</h3>
		<!-- <h5 class="text-center fs-5 fw-normal w-100 mb-4">sample of popular courses</h5> -->
		<div class="row">
			
			<?php foreach ($courses as $key => $val): ?>
				  <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
                    <div class="card" id="card-course">
                        <img onerror="this.onerror=null;this.src='assets/images/default-course.jpeg';" class="img-fluid" src="<?=base_url('assets/files/upload/courses/'.$val['course_img']); ?>" style="height:200px">
                        <div class="card-body">
                            <h5 class="w-100 text-start text-capitalize mt-1 title-card"><a class="text-decoration-none" href="<?=base_url('course/detail/'.$val['id'])?>"><?=$val['course_title']?></a></h5>
                            <div class="w-100 d-flex flex-nowrap align-items-center mb-2">
                                <span class="border-end pe-2">
                                    <img class=" teacher-icon rounded-circle border-1 shadow-sm" src="<?=!empty($val['photo']) ? base_url('assets/images/members/').$val['photo'] : base_url('assets/images/images.jpg'); ?>" style="">
                                </span>
                                <span class="ms-2">
                                    <h6 class="text-capitalize text-secondary fw-normal text-shadow"><?=$val['first_name'].' '.$val['last_name']?></h6>
                                </span>
                            </div>
							<div class="row">
								<div class="col-6">
									<span class="w-100">
										<span class="fw-semibold me-2"><?=($val['rating']) ? $val['rating'] : 0 ?></span>

										<?php if($val['rating']): ?>
											<i class="fa-solid fa-star text-primary"></i>
										<?php else: ?>
											<i class="fa-solid fa-star text-secondary"></i>
										<?php endif ?>

									</span>
										
									<span class="fw-semibold ms-2">
										| 
										<?= $val['total_subscriber'].' Subs' ?>
									</span>
								</div>
								<div class="col-6 text-end">
									<?php if($val['is_wishlist']): ?>
										<i class="fa fa-heart text-red fs-4 me-4 wishlist-icon" data="<?=$val['id']?>"></i>
									<?php else: ?>
										<i class="fa fa-heart text-secondary fs-4 me-4 wishlist-icon" data="<?=$val['id']?>"></i>
									<?php endif ?>
								</div>
							</div>
                            
                            <h5 class="mt-1">Rp <?=number_format($val['price'])?></h5>
                            <div class="d-flex flex-nowrap w-100" id="checkout-button">
                                <a href="<?=base_url('course/detail/'.$val['id'])?>" class="btn btn-primary text-white w-100 mt-3">
									Detail
								</a>
                            </div>
                           
                        </div>
                    </div>
                </div>
			<?php endforeach ?>

		</div>
	</section>

	<section id="popular-courses" class="container py-2 my-3">
		<h3 class="text-center w-100 m-0 mb-4">NEW COURSES</h3>
		<!-- <h5 class="text-center fs-5 fw-normal w-100 mb-4">sample of popular courses</h5> -->
		<div class="row">
			
			<?php foreach ($new_courses as $key => $val): ?>
				  <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
                    <div class="card" id="card-course">
                        <img onerror="this.onerror=null;this.src='assets/images/default-course.jpeg';" class="img-fluid" src="<?=base_url('assets/files/upload/courses/'.$val['course_img']); ?>" style="height:200px">
                        <div class="card-body">
                            <h5 class="w-100 text-start text-capitalize mt-1 title-card"><a class="text-decoration-none" href="<?=base_url('course/detail/'.$val['id'])?>"><?=$val['course_title']?></a></h5>
                            <div class="w-100 d-flex flex-nowrap align-items-center mb-2">
                                <span class="border-end pe-2">
                                    <img  class=" teacher-icon rounded-circle border-1 shadow-sm" src="<?=!empty($val['photo']) ? base_url('assets/images/members/').$val['photo'] : base_url('assets/images/image.png'); ?>" style="">
                                </span>
                                <span class="ms-2">
                                    <h6 class="text-capitalize text-secondary fw-normal text-shadow"><?=$val['first_name'].' '.$val['last_name']?></h6>
                                </span>
                            </div>

							<div class="row">
								<div class="col-6">
									<span class="w-100">
										<span class="fw-semibold me-1"><?=($val['rating']) ? $val['rating'] : 0 ?></span>

										<?php if($val['rating']) : ?>
											<i class="fa-solid fa-star text-primary"></i>
										<?php else : ?>
											<i class="fa-solid fa-star text-secondary"></i>
										<?php endif ?>

									</span>
								</div>
								
								<div class="col-6 text-end">
									<?php if($val['is_wishlist']): ?>
										<i class="fa fa-heart text-red fs-4 me-4 wishlist-icon" data="<?=$val['id']?>"></i>
									<?php else: ?>
										<i class="fa fa-heart text-secondary fs-4 me-4 wishlist-icon" data="<?=$val['id']?>"></i>
									<?php endif ?>
								</div>
								
							</div>
                            
                            <h5 class="mt-1">Rp <?=number_format($val['price'])?></h5>
                            <div class="d-flex flex-nowrap w-100" id="checkout-button">
                                <a href="<?=base_url('course/detail/'.$val['id'])?>" class="btn btn-primary text-white w-100 mt-3">
									Detail
								</a>
                            </div>
                           
                        </div>
                    </div>
                </div>
			<?php endforeach ?>

		</div>
	</section>

	<section id="popular-category" class="container py-2 my-3">
		<h3 class="text-center w-100 m-0 mb-4">Popular Category</h3>
		<div class="row">
			<?php foreach($popular_categories as $val): ?>
				<div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-xs-6 pb-3">
					<a onclick="isiKategori(<?=$val['id']?>)" href="<?=base_url('course/index')?>" class="btn btn-lg w-100 border rounded-0 h-100"><?=$val['category_name']?></a>
				</div>
			<?php endforeach ?>
		</div>
	</section>


	<!-- start instructures -->
	<section id="instructures" class="container py-5 my-3">
		<h3 class="text-center text-uppercase w-100 m-0 mb-4">Popular Instructor</h3>
		<!-- <h5 class="text-center fs-5 fw-normal w-100 mb-4">sample of teachers</h5> -->
		<div class="row">
			<?php foreach($instructors as $val):?>
				<div class="col-12 col-md-6 col-lg-3 text-center">
					<figure class="figure material-shadow-1">
						<img class="img-fluid" src="<?=!empty($val['member_photo']) ? base_url('assets/images/members/').$val['member_photo'] : ''; ?>">
						<div class="overlay py-2 px-3">
							<a class="text-decoration-none" href="<?=base_url('instructor/detail/'.$val['member_id'])?>">
								<h6 class="mb-0 w-100 text-uppercase text-shadow"><?=$val['first_name'].' '.$val['last_name']?></h6>
							</a>
							<figcaption class="figcaption mb-3 text-capitalize text-shadow-sm text-secondary fw-semibold"></figcaption>
							<p><?=$val['job']?></p>
							<p class="text-justify text-shadow-sm mt-1">
								<?=strip_tags($val['about']) ?>
							</p>
							<div class="row flex-nowrap">
								<div class="col fw-bold">
									<i class="fa-solid fa-users-line text-warning"></i> 24 Students
								</div>
								<div class="col fw-bold">
									<i class="fa-solid fa-book text-warning"></i> 3 Courses
								</div>
							</div>
						</div>

					</figure>
				</div>
			<?php endforeach ?>
			
		</div>
	</section>
	<!-- end instructures -->

	<!-- SECTION TESTIMONIAL -->
	<section class="container py-5 my-3">
		
		<section class="testimonials">
			<div class="container">
				<div class="section-header">
					<h2 class="title">What Our Client Say</h2>
				</div>
				<div class="testimonials-content">
					<div class="swiper testimonials-slider js-testimonials-slider">
						<div class="swiper-wrapper">
							<?php foreach($ratings as $rating): ?>
								<div class="swiper-slide testimonials-item">
									<div class="info">
										<img src="<?=base_url('assets/images/members/').$rating['photo']?>" width="100" height="100" alt="">
										<div class="text-box">
											<h3 class="name"><?=$rating['first_name']?></h3>
											<span class="job"><?=$rating['last_name']?></span>
										</div>
									</div>
									<p><?=$rating['comments']?></p>
									<div class="rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
								</div>
							<?php endforeach ?>
						</div>
					</div>
					<div class="swiper-pagination js-testimonials-pagination"></div>
				</div>
			</div>
		</section>

	</section>


	<!-- IMAGE DRAGABLE SLIDER - TEMUKAN GURU KURSUS YANG TEPAT -->
	<section class="container py-5 my-3">
		<h3 class="text-center w-100 m-0 mb-5">Temukan Instuktur Kursus yang tepat untuk anda</h3>
		<h5 class="text-center w-100 m-0 mb-5">Dengan lebih dari 1000 Instruktur kursus dan 1 juta+ member, kami memahami pembelajaran terbaik untuk anda</h5>
		<div class="wrapper">
			<i id="left" class="fa-solid fa-angle-left"></i>
			<ul class="carousel">
				<?php // var_dump($instructors) ?>
				<?php foreach($new_instructors as $key => $val): ?>
					<li class="card p-2">
						<div class="img mb-2"><img src="<?=!empty($val['photo']) ? base_url('assets/images/members/').$val['photo'] : ''; ?>" alt="img" draggable="false"></div>
						<h5><?=$val['first_name'].' '.$val['last_name']?></h5>
						<span><?=$val['job']?></span>
					</li>
				<?php endforeach ?>
			</ul>
			<i id="right" class="fa-solid fa-angle-right"></i>
		</div>
	</section>

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
									 
	<script src="assets/js/jquery.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" async defer></script>
	<script src="assets/js/main.js" async defer></script>
	<script src="assets/js/index.js" async defer></script>
	<script src="assets/js/_dashboard.js" async defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
	
	<!-- untuk slider testimonial -->
	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> 

	

	<script>
		// SCRIPT ANIMATED JUMBOTRON HEADER
		// Wrap every letter in a span
		var textWrapper = document.querySelector('.ml2');
		textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

		anime.timeline({loop: false})
		.add({
			targets: '.ml2 .letter',
			scale: [9,1],
			opacity: [0,1],
			translateZ: 0,
			easing: "easeOutExpo",
			duration: 3000,
			delay: (el, i) => 50*i
		}).add({
			
		});

		let letters = document.querySelectorAll('.letter');
		letters[0].style.color = '#20c997';
		letters[1].style.color = '#20c997';
		letters[2].style.color = '#20c997';
		letters[3].style.color = '#20c997';

		// Wrap every letter in a span
		var textWrapper = document.querySelector('.ml3');
		textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

		anime.timeline({loop: false})
		.add({
			targets: '.ml3 .letter',
			opacity: [0,1],
			easing: "easeInOutQuad",
			duration: 1000,
			delay: (el, i) => 40 * (i+1)
		}).add({
		});

	</script>

	<script>
		const swiper = new Swiper('.js-testimonials-slider', {
			grabCursor: true,
			spaceBetween: 30,
			pagination: {
				el: '.js-testimonials-pagination',
				clickable: true
			}, 
			breakpoints: {
				767: {
					slidesPerView: 2
				}
			}
		});
	</script>

</body>

</html>
