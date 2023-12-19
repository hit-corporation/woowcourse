<?php

$this->layout('layouts::main_template', ['title' => 'Course']) ?>

<?php $this->start('css') ?>
	<link rel="stylesheet" href="assets/css/teacher.min.css">
	<link rel="stylesheet" href="assets/css/detail_course.min.css">
<?php $this->end() ?>

<?php $this->start('body') ?>

<body class="min-100-vh bg-light-subtle">
	
	<!-- START SECTION BODY -->
	
	<div class="container">
		<div class="row">
			<div class="col-8">
				<h1 class="text-uppercase text-shadow mb-1"><?=$data['course_title']?></h1>
				<div class="separator"></div>
				<div class="row mb-5 mt-4">
					<div class="col">
						<figure class="figure d-flex align-items-top">
							<img class="profile rounded-circle" src="<?=base_url('assets/images/members/'.$data['photo'])?>" alt="">
							<figcaption class="ms-3 mt-3">
								<h5 class="text-capitalize text-shadow text-secondary mb-1">instructure</h5>
								<a class="text-decoration-none" href="<?=base_url('instructor/detail/').$data['instructor_id']?>">
									<h4 class="text-capitalize text-shadow"><?=$data['first_name'].' '.$data['last_name']?></h4>
								</a>
							</figcaption>
						</figure>
					</div>
					<div class="col align-items-center mt-3">
						<h5 class="text-capitalize text-shadow text-secondary mb-1">rating</h5>
						<span>
							<i class="fa fa-star text-primary"></i>
							<span><?=$data['rating'].' / 5'?></span>
						</span>
					</div>
				</div>
				<ul class="nav nav-tabs" id="description-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" role="button" href="javascript:void(0)" data-bs-toggle="tab" data-bs-target="#deskripsi">
							Deskripsi
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="javascript:void(0)" role="button" data-bs-toggle="tab" data-bs-target="#topic">Kurikulum</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="javascript:void(0)" role="button" data-bs-toggle="tab" data-bs-target="#review">Review</a>
					</li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<!-- TAB 1-->
					<div class="tab-pane fade show active" id="deskripsi" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
						<p class="text-justify mt-2">
							<?=$data['description']?>
						</p>
						<!-- <h4 class="text-uppercase mb-1">what will you learn</h4>
						<div class="separator mb-3"></div>
						<ul>
							<li>Lorem ipsum dolor sit amet.</li>
							<li>consectetur adipiscing elit.</li>
							<li>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
						</ul> -->
					</div>
					<!-- TAB 2 -->
					<div class="tab-pane fade" id="topic" role="tabpanel" tabindex="0">
						<!-- ACCORDION -->
						<div class="accordion" id="accordion-lesson">
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										Accordion Item #1
									</button>
								</h2>
								<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
									<div class="accordion-body">
										<?php foreach ($videos as $key => $value) : ?>
											<video width="500" src="<?=!empty($value['video']) ? base_url('assets/files/upload/courses/').$value['video'] : '' ?>" controls></video>
										<?php endforeach ?>
									</div>
								</div>
							</div>
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										Accordion Item #2
									</button>
								</h2>
								<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
									<div class="accordion-body">
										<strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
									</div>
								</div>
							</div>
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
										Accordion Item #3
									</button>
								</h2>
								<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
									<div class="accordion-body">
										<strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
									</div>
								</div>
							</div>
						</div>
							<!-- END ACCOURDIUON -->
					</div>
					<!-- TAB 3 -->
					<div class="tab-pane fade" id="review" role="tabpanel" tabindex="0">
						<div class="row p-4">
							<div class="col-4">
								<div class="card">
									<div class="card-body">
										<h1 id="total-score"><?=$data['rating']?></h1>
									</div>
								</div>
							</div>
							<div class="col-8">
								<div class="row">
									<div class="col-1"><h4 class="text-end">5</h4></div>
									<div class="col-9">
										<div class="progress" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
											<div class="progress-bar bg-warning" style="width: 95%"></div>
										</div>
									</div>
									<div class="col-1"></div>
								</div>
								<div class="row">
									<div class="col-1"><h4 class="text-end">4</h4></div>
									<div class="col-9">
										<div class="progress" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
											<div class="progress-bar bg-warning" style="width: 0%"></div>
										</div>
									</div>
									<div class="col-1"></div>
								</div>
								<div class="row">
									<div class="col-1"><h4 class="text-end">3</h4></div>
									<div class="col-9">
										<div class="progress" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
											<div class="progress-bar bg-warning" style="width: 0%"></div>
										</div>
									</div>
									<div class="col-1"></div>
								</div>
								<div class="row">
									<div class="col-1"><h4 class="text-end">2</h4></div>
									<div class="col-9">
										<div class="progress" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
											<div class="progress-bar bg-warning" style="width: 0%"></div>
										</div>
									</div>
									<div class="col-1"></div>
								</div>
								<div class="row">
									<div class="col-1"><h4 class="text-end">1</h4></div>
									<div class="col-9">
										<div class="progress" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
											<div class="progress-bar bg-warning" style="width: 0%"></div>
										</div>
									</div>
									<div class="col-1"></div>
								</div>

								
                            </div>
							</div>
						</div>

						<form class="row mt-3" name="form-comment">
							<div class="col-12 mb-2">
								<h6 class="mb-0">Rating</h6>
								<div class="w-100">
									<select class="star-rating" name="rating">
										<option value="">Select a rating</option>
										<option value="5">Excellent</option>
										<option value="4">Very Good</option>
										<option value="3">Average</option>
										<option value="2">Poor</option>
										<option value="1">Terrible</option>
									</select>
								</div>
							</div>
							<div class="col-12 mb-4">
								<label class="h6 mb-0">Review</label>
								<textarea id="text-review" name="text-review" rows="4" 
											class="form-control w-100" 
											placeholder="Tulis review atau komentar anda"
											required></textarea>
								<button type="submit" class="btn btn-primary mt-2">Kirim</button>
							</div>
						</form>
						<table class="table w-100" id="table-comment">
							<tbody></tbody>
						</table>
					</div>
					
				</div>
			</div>
			<div class="col-4">
			<div class="card border-primary shadow-sm" id="card-details">
				<div class="card-header bg-primary text-white text-uppercase">
					<h4 class="m-0 text-shadow">details</h4>
				</div>
				<div class="card-body">
					<dl class="row align-items-center">
						<dt class="col-6 py-1">
							<span class="text-secondary"><i class="fa-solid fa-tag me-1 text-warning"></i> Harga</span>
						</dt>
						<dd class="col-6 py-1"><strong>Rp. <?=number_format($data['price'])?></strong></dd>
						<dt class="col-6 mb-1">
							<span class="text-secondary"><i class="fa-solid fa-clock me-1 text-warning"></i> Durasi</span>
						</dt>
						<dd class="col-6 py-1"><strong>3 Bulan</strong></dd>
						<dt class="col-6 py-1">
							<span class="text-secondary"><i class="fa-solid fa-users me-1 text-warning"></i> Murid</span>
						</dt>
						<dd class="col-6 py-1"><strong>240 Orang</strong></dd>
					</dl>
					<div class="row">
						<div class="col-12 d-flex flex-column">
							<button type="button" class="btn btn-primary text-uppercase text-light fw-semibold">
								<i class="fa-solid fa-cash-register"></i> ikuti kursus ini
							</button>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
	
	<!-- END SECTION BODY -->
	
<?php $this->end() ?>

<?php $this->start('js') ?>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="assets/js/detail_course.js" async defer></script>
<?php $this->end() ?>
