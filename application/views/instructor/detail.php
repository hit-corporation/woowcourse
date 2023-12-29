<?php

$this->layout('layouts::main_template', ['title' => 'Instructor']) ?>

<?php $this->start('css') ?>
	<link rel="stylesheet" href="assets/css/teacher.min.css">
	<style>
		#description{
			display: -webkit-box;
			max-width: 200px;
			-webkit-line-clamp: 4;
			-webkit-box-orient: vertical;
			overflow: hidden;
		}
	</style>
<?php $this->end() ?>

<?php $this->start('body') ?>

<body class="min-100-vh bg-light-subtle">
	
	<!-- START SECTION BODY -->
	
	<div class="container">
		<a href="<?=base_url('course/create')?>" id="btn-create-new-course" class="btn btn-lg btn-primary text-white">Create New Course</a>
		<h4 class="text-uppercase text-shadow">about me</h4>
		<span class="d-block bg-primary pt-1 mb-4 separator"></span>
		<div class="row py-3">
			<div class="col-12 col-lg-3 text-center text-lg-left">
				<img class="img-fluid mx-auto mx-lg-0 shadow-sm" src="<?=($data['photo']) ? base_url('assets/images/members/'.$data['photo']) : base_url('assets/images/instructors/profile-icon.png')?>"/>
			</div>
			<div class="col-12 col-lg-9 mt-4 mt-lg-0">
				<h1 class="text-uppercase text-shadow mb-0 txt-teacher-name"><?=$data['first_name'].' '.$data['last_name']?></h1>
				<h4 class="text-capitalize text-secondary text-shadow txt-teacher-subject">Instructor</h4>
				
				<p class="text-justify mt-3 fs-5">
					<?=isset($data['about']) ? $data['about'] : ''?>
				</p>
				<div class="col-12">
				
					<div class="row align-items-center mb-1">
						<div class="col-1"><i class="fa-solid fa-location-dot fs-4 text-primary text-shadow"></i></div>
						<div class="col-11 fw-semibold"><?=isset($data['address']) ? $data['address'] : ''?></div>
					</div>
					<div class="row align-items-center mb-1">
						<div class="col-1"><i class="fa-solid fa-phone fs-4 text-primary text-shadow"></i></div>
						<div class="col-11 fw-semibold"><?=isset($data['phone']) ? $data['phone'] : ''?></div>
					</div>
					<div class="row align-items-center">
						<div class="col-1"><i class="fa-solid fa-envelope fs-4 text-primary text-shadow"></i></div>
						<div class="col-11 fw-semibold"><?=$data['email']?></div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-12 d-flex flex-nowrap">
						<a role="button" class="btn btn-sm btn-icon bg-red shadow-sm d-flex flex-nowrap align-items-center justify-content-center">
							<i class="fa-brands fa-google fs-4 align-middle"></i>
						</a>
						<a role="button" class="btn btn-sm btn-icon bg-cyan shadow-sm d-flex flex-nowrap align-items-center justify-content-center ms-2">
							<i class="fa-brands fa-twitter fs-4 align-middle"></i>
						</a>
						<a role="button" class="btn btn-sm bg-blue btn-icon shadow-sm d-flex flex-nowrap align-items-center justify-content-center ms-2">
							<i class="fa-brands fa-facebook fs-4 align-middle"></i>
						</a>
					</div>
				</div>
							
			</div>
		</div>
		<div class="row py-3 mt-3">
			
			<div class="col-12 mt-4 mt-lg-0">
				<h4 class="text-uppercase text-shadow">My Courses</h4>
				<span class="d-block bg-primary pt-1 mb-4 separator"></span>
				<div class="row">
					<?php foreach($courses as $key => $val): ?>

						<div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-2">
							<div class="card position-relative d-lg-flex flex-nowrap">
								<img class="img-fluid" src="<?=base_url('assets/files/upload/courses/'.$val['course_img'])?>">
								<div class="card-body">
									<h5 class="text-uppercase text-shadow"><?=$val['course_title']?></h5>
									<div class="pt-1">
										<span>
											<i class="fa fa-star text-primary"></i>
											<span><?=$val['rating']?></span>
										</span>
									</div>
									<div class="d-flex flex-nowrap py-3">
										<div class="col border-right">
											<i class="fa-solid fa-clock text-warning"></i><span class="ms-1">1 Week</span>
										</div>
										<div class="col border-right">
											<i class="fa-solid fa-calendar text-warning"></i><span class="ms-1">3 Session</span>
										</div>
										
									</div>
									<p class="text-justiy" id="description">
										<?=strip_tags($val['description'])?>
									</p>
									<div class="row">
										<div class="col-12 d-flex flex-nowrap justify-content-end">

											<?php if($is_instructor):?>
												<a href="<?=base_url('Course/edit/').$val['id']?>" class="btn btn-sm btn-success text-uppercase me-1">
													<i class="fa-regular fa-edit"></i>
												</a>
											<?php endif ?>

											<button type="button" class="btn btn-sm btn-success text-uppercase">
												<i class="fa-regular fa-handshake"></i>
												Subscribe !!!
											</button>
										</div>
									</div>
								</div>
								<span class="label-harga">Rp. <?=number_format($val['price'])?></span>
							</div>
							
						</div>

					<?php endforeach ?>
					<!-- <div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-2">
						<div class="card position-relative d-lg-flex flex-nowrap">
							<img class="img-fluid" src="assets/images/sm2.jpg">
							<div class="card-body">
								<h5 class="text-uppercase text-shadow">Santet Buhul Cacing Abing</h5>
								<div class="pt-1">
									<span>
										<i class="fa fa-star text-primary"></i>
										<i class="fa fa-star text-primary"></i>
										<i class="fa fa-star text-primary"></i>
										<i class="fa fa-star text-primary"></i>
										<i class="fa fa-star text-primary"></i>
									</span>
								</div>
								<div class="d-flex flex-nowrap py-3">
									<div class="col border-right">
										<i class="fa-solid fa-clock text-warning"></i><span class="ms-1">1 Week</span>
									</div>
									<div class="col border-right">
										<i class="fa-solid fa-calendar text-warning"></i><span class="ms-1">3 Session</span>
									</div>
									
								</div>
								<p class="text-justiy">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit
								</p>
								<div class="row">
									<div class="col-12 d-flex flex-nowrap justify-content-end">
										<button type="button" class="btn btn-sm btn-success text-uppercase">
											<i class="fa-regular fa-handshake"></i>
											Subscribe !!!
										</button>
									</div>
								</div>
							</div>
							<span class="label-harga">Rp. 320K</span>
						</div>
						
					</div>
					<div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-2">
						<div class="card position-relative d-lg-flex flex-nowrap">
							<img class="img-fluid" src="assets/images/sm2.jpg">
							<div class="card-body">
								<h5 class="text-uppercase text-shadow">Santet Buhul Cacing Abing</h5>
								<div class="pt-1">
									<span>
										<i class="fa fa-star text-primary"></i>
										<i class="fa fa-star text-primary"></i>
										<i class="fa fa-star text-primary"></i>
										<i class="fa fa-star text-primary"></i>
										<i class="fa fa-star text-primary"></i>
									</span>
								</div>
								<div class="d-flex flex-nowrap py-3">
									<div class="col border-right">
										<i class="fa-solid fa-clock text-warning"></i><span class="ms-1">1 Week</span>
									</div>
									<div class="col border-right">
										<i class="fa-solid fa-calendar text-warning"></i><span class="ms-1">3 Session</span>
									</div>
									
								</div>
								<p class="text-justiy">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit
								</p>
								<div class="row">
									<div class="col-12 d-flex flex-nowrap justify-content-end">
										<button type="button" class="btn btn-sm btn-success text-uppercase">
											<i class="fa-regular fa-handshake"></i>
											Subscribe !!!
										</button>
									</div>
								</div>
							</div>
							<span class="label-harga">Rp. 320K</span>
						</div>
						
					</div>
					<div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-2">
						<div class="card position-relative d-lg-flex flex-nowrap">
							<img class="img-fluid" src="assets/images/sm2.jpg">
							<div class="card-body">
								<h5 class="text-uppercase text-shadow">Santet Buhul Cacing Abing</h5>
								<div class="pt-1">
									<span>
										<i class="fa fa-star text-primary"></i>
										<i class="fa fa-star text-primary"></i>
										<i class="fa fa-star text-primary"></i>
										<i class="fa fa-star text-primary"></i>
										<i class="fa fa-star text-primary"></i>
									</span>
								</div>
								<div class="d-flex flex-nowrap py-3">
									<div class="col border-right">
										<i class="fa-solid fa-clock text-warning"></i><span class="ms-1">1 Week</span>
									</div>
									<div class="col border-right">
										<i class="fa-solid fa-calendar text-warning"></i><span class="ms-1">3 Session</span>
									</div>
									
								</div>
								<p class="text-justiy">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit
								</p>
								<div class="row">
									<div class="col-12 d-flex flex-nowrap justify-content-end">
										<button type="button" class="btn btn-sm btn-success text-uppercase">
											<i class="fa-regular fa-handshake"></i>
											Subscribe !!!
										</button>
									</div>
								</div>
							</div>
							<span class="label-harga">Rp. 320K</span>
						</div>
						
					</div> -->
					
					
				</div>
			</div>
		</div>
	</div>
	
	<!-- END SECTION BODY -->
	
</body>

<?php $this->end() ?>

<?php $this->start('js') ?>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<!-- <script src="assets/js/teacher.js" async defer></script> -->
<?php $this->end() ?>
