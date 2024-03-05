<?php $this->layout('layouts::main_template', ['title' => 'All Instructors']); ?>

<?php $this->start('css') ?>
	<style>
		#about{
			display: -webkit-box;
			max-width: 200px;
			-webkit-line-clamp: 5;
			-webkit-box-orient: vertical;
			overflow: hidden;
		}
	</style>
<?php $this->end() ?>

<?php $this->start('body') ?>
	<!-- start instructures -->
	<section id="instructures" class="container my-3 pt-5">
		<h3 class="text-center text-uppercase w-100 m-0 mb-5">Course Instructors</h3>
		<!-- <h5 class="text-center fs-5 fw-normal w-100 mb-4">sample of teachers</h5> -->
		<div class="row">

			<?php foreach($instructors as $key => $val):?>	
				<div id="instructor-card" class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12 text-center">
					<figure class="figure material-shadow-1">
						<img class="img-fluid" src="<?=!empty($val['photo']) ? base_url('assets/images/members/').$val['photo'] : ''; ?>">
						<div class="overlay py-2 px-3">
							<a class="text-decoration-none" href="<?=base_url('instructor/detail/'.$val['id'])?>">
								<h4 class="mb-0 w-100 text-uppercase text-shadow"><?=$val['first_name'].' '.$val['last_name']?></h4>
							</a>
							<figcaption class="figcaption mb-3 text-capitalize text-shadow-sm text-secondary fw-semibold">machine learning</figcaption>
							<p id="about" class="text-justify text-shadow-sm mt-1">
								<?= strip_tags($val['about']) ?>
							</p>
							<div class="row flex-nowrap">
								<div class="col fw-bold">
									<i class="fa-solid fa-users-line text-warning"></i> <?=$val['total_sub']?> Students
								</div>
								<div class="col fw-bold">
									<i class="fa-solid fa-book text-warning"></i> <?=$val['total_course']?> Courses
								</div>
							</div>
						</div>

					</figure>
				</div>
			<?php endforeach ?>
			
		</div>
	</section>
	<!-- end instructures -->
<?php $this->end() ?>

<?php $this->start('js') ?>

<?php $this->end() ?>
