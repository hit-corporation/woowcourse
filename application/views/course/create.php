<?php

$this->layout('layouts::main_template', ['title' => 'Create New Course']) ?>

<?php $this->start('css') ?>
	<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<?php $this->end() ?>

<?php $this->start('body') ?>

	<!-- START SECTION BODY -->

	<div class="container">
		<form name="formJamet">
			<div class="row">
				<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="mb-3">
						<label for="course_title" class="form-label">Course Title <span class="text-red">*</span></label>
						<input type="hidden" name="id" value="<?=isset($data['id']) ? $data['id'] : '' ?>">
						<input required type="text" class="form-control" name="course_title" id="course_title" maxlength="50" name="course_title" value="<?=isset($data['course_title']) ? $data['course_title'] : '' ?>">
						
						<span class="text-red mb-2">
							<?= (isset($_SESSION['course_title'])) ? $_SESSION['course_title'] : '' ?>
						</span>
					</div>

					<div class="mb-3">
						<label for="course_category" class="form-label">Course Category <span class="text-red">*</span></label>
						<input id="category_id" type="hidden" value="<?=isset($data['category_id']) ? $data['category_id'] : ''?>">
						<div class="category border rounded pt-2"></div>
					</div>
					
					<div class="mb-3">
						<label for="price" class="form-label">Price (IDR) <span class="text-red">*</span></label>
						<input required type="text" name="price" class="form-control" id="price" value="<?=isset($data['price']) ? $data['price'] : ''; ?>">

						<span class="text-red mb-2">
							<?= (isset($_SESSION['price'])) ? $_SESSION['price'] : '' ?>
						</span>

					</div>

					<div class="mb-3">
						<div class="col-2">
							<label for="course_duration" class="form-label">Duration (Day) <span class="text-red">*</span></label>
							<input type="number" required name="course_duration" class="form-control" value="<?=isset($data['duration']) ? $data['duration'] : ''; ?>">
						</div>
					
					</div>

					<div class="mb-3">
						<label for="formVideo" class="form-label">Course Video <span class="text-red">*</span></label>
						<br>
						<span>Video format upload must .MP4</span>
						<br>
						<div class="course-video-container border rounded p-3">
							<?php if(isset($videos[0]['video'])){?>
								<?php foreach ($videos as $key => $value) : ?>
									<video width="300" class="" poster="<?=base_url('assets/images/no-video.png')?>" id="video-preview[<?=$key?>]" src="<?=isset($value['video']) ? base_url('assets/files/upload/courses/').$value['video'] : '' ?>" controls></video>
									<input name="course_video[<?=$key?>]" id="course_video[<?=$key?>]" type="file" data="video" class="form-control" value="">
								<?php endforeach ?>
							<?php } ?>

							<?php if(!isset($videos[0]['video'])){?>
								<video width="300" class="" poster="<?=base_url('assets/images/no-video.png')?>" id="video-preview[0]" src="<?=isset($value['video']) ? base_url('assets/files/upload/courses/').$value['video'] : '' ?>" controls></video>
								<input name="course_video[0]" id="course_video[0]" type="file" data="video" class="form-control" value="">
								<input type="text" name="video_description" class="form-control mt-2" placeholder="Masukan Deskripsi Video">
							<?php } ?>
						</div>

					</div>
					<span class="btn btn-primary btn-sm text-white mb-3" id="add-more-video">+ Add more video</span>
					<br>

					<!-- Create the editor container -->
					<label for="" class="mb-2">Description <span class="text-red">*</span></label>
					<div id="editor" class="form-control mb-3"><?=isset($data['description']) ? $data['description'] : '' ?></div>
				</div>
				
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="text-center p-3">
						<img id="img-preview" class="d-inline-flex rounded border" width="250" src="<?=isset($data['course_img']) ? base_url('assets/files/upload/courses/'.$data['course_img']) : base_url('assets/images/no-image.jpg')?>" alt="photo profile">
						<br>
						<label for="formFile" class="form-label">Course Image <span class="text-red">*</span></label>
						<input <?=isset($data['course_img']) ? '' : 'required'?> id="filetag" name="image" type="file" class="mt-3 form-control">
						<br>
					</div>
				</div>
			

				<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<progress style="width: 100%;" value="0" max="100"></progress>
					<p>
						<strong>Uploading status:</strong>
						<span id="statusMessage">🤷‍♂ Nothing's uploaded</span>
					</p>
					<?php if(!isset($data['id'])): ?>
						<button id="save" class="btn btn-primary text-white">Save</button>
					<?php endif ?>

					<?php if(isset($data['id'])): ?>
						<button id="update" class="btn btn-primary text-white">Update</button>
					<?php endif ?>
				</div>
			

			</div>
		</form>

		<div>

		</div>

	</div>

	<!-- END SECTION BODY -->

<?php $this->end() ?>

<?php $this->start('js') ?>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- Include the Quill library -->
	<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
	<script src="<?=base_url('assets/node_modules/@widgetjs/tree/dist/tree.min.js')?>"></script>
	<script src="<?=base_url('assets/js/_createCourse.js')?>" defer></script>

	<script>
		function numberWithCommas(x) {
			return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
		}

		let price = document.querySelector('input[name="price"]');
		price.addEventListener('focusout', function(){
			price.value = numberWithCommas(price.value);
		});
	</script>
<?php $this->end() ?>
