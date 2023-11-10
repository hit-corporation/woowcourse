<?php

use PhpOffice\PhpSpreadsheet\Calculation\Information\Value;

$this->layout('layouts::main_template', ['title' => 'Course']) ?>

<?php $this->start('css') ?>
<link rel="stylesheet" href="https://pagination.js.org/dist/2.6.0/pagination.css">
<link rel="stylesheet" href="assets/css/teacher.min.css">
<?php $this->end() ?>

<?php $this->start('body') ?>
<div class="container">
	<div class="row">
		<div class="col-lg-3">
			<div class="offcanvas-lg offcanvas-start" id="filter-categories">
				<div class="offcanvas-header justify-content-end">
					<button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#filter-categories" aria-label="Close"></button>
				</div>
				<div class="offcanvas-body d-flex flex-nowrap flex-column">
					<div class="input-group input-group-sm mb-1">
						<input type="search" class="form-control form-control-sm" placeholder="Cari Tutorial ..." name="cari">
						<button id="btn-search" type="button" class="btn btn-sm btn-info text-white"><i class="fa-solid fa-search"></i></button>
					</div>

					<hr class="border border-dark mb-2" />
					<h4 class="mb-2 text-shadow-sm">Kategori</h4>

					<div id="categories-check">
						<?php foreach ($categories as $key => $value) : ?>
							<div class="form-check mt-2">
								<input class="form-check-input" type="checkbox" value="<?=$value['id']?>" id="category_<?=$value['id']?>">
								<label class="form-check-label" for="category_<?=$value['id']?>"><?=$value['category_name']?></label>
							</div>
						<?php endforeach ?>
					</div>

					<hr class="border border-dark mb-2" />
					<h4 class="mb-2 text-shadow-sm">Rating</h4>
					<div class="pt-1">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="rate[1]" id="rating1">
							<label class="form-check-label" for="rating1">
								<i class="fa fa-star text-primary"></i>
								<i class="fa fa-star text-secondary"></i>
								<i class="fa fa-star text-secondary"></i>
								<i class="fa fa-star text-secondary"></i>
								<i class="fa fa-star text-secondary"></i>
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="rate[2]" id="rating2">
							<label class="form-check-label" for="rating2">
								<i class="fa fa-star text-primary"></i>
								<i class="fa fa-star text-primary"></i>
								<i class="fa fa-star text-secondary"></i>
								<i class="fa fa-star text-secondary"></i>
								<i class="fa fa-star text-secondary"></i>
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="rate[3]" id="rating3">
							<label class="form-check-label" for="rating3">
								<i class="fa fa-star text-primary"></i>
								<i class="fa fa-star text-primary"></i>
								<i class="fa fa-star text-primary"></i>
								<i class="fa fa-star text-secondary"></i>
								<i class="fa fa-star text-secondary"></i>
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="rate[4]" id="rating4">
							<label class="form-check-label" for="rating4">
								<i class="fa fa-star text-primary"></i>
								<i class="fa fa-star text-primary"></i>
								<i class="fa fa-star text-primary"></i>
								<i class="fa fa-star text-primary"></i>
								<i class="fa fa-star text-secondary"></i>
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="rate[5]" id="rating5">
							<label class="form-check-label" for="rating5">
								<i class="fa fa-star text-primary"></i>
								<i class="fa fa-star text-primary"></i>
								<i class="fa fa-star text-primary"></i>
								<i class="fa fa-star text-primary"></i>
								<i class="fa fa-star text-primary"></i>
							</label>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-8">
			<button type="button" class="btn bg-cyan shadow-sm d-lg-none mb-3" data-bs-toggle="offcanvas" data-bs-target="#filter-categories">
				<i class="fa-solid fa-filter"></i>&nbsp;Filter
			</button>
			<div class="row" id="list-course">

			</div>

			<nav aria-label="Page navigation example" class="d-flex justify-content-center mt-5">
				<!-- <ul class="pagination">
					
				</ul> -->
				<div id="demo"></div>
			</nav>
		</div>
	</div>
</div>

<?php $this->end() ?>

<?php $this->start('js') ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://pagination.js.org/dist/2.6.0/pagination.js"></script>
<script src="assets/js/course.js" async defer></script>
<?php $this->end() ?>
