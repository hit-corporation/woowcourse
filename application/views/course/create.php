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
						<label for="course_title" class="form-label">Course Title</label>
						<input type="hidden" name="id" value="<?=isset($data['id']) ? $data['id'] : '' ?>">
						<input type="text" class="form-control" name="course_title" id="course_title" name="course_title" value="<?=isset($data['course_title']) ? $data['course_title'] : '' ?>">
					</div>

					<div class="mb-3">
						<label for="course_category" class="form-label">Course Category</label>
						<input id="category_id" type="hidden" value="<?=isset($data['category_id']) ? $data['category_id'] : ''?>">
						<div class="category border rounded pt-2"></div>
					</div>

					<div class="mb-3">
						<label for="formVideo" class="form-label">Course Video</label>
						<br>
						<div class="course-video-container">
							<?php if(isset($videos[0]['video'])){?>
								<?php foreach ($videos as $key => $value) : ?>
									<video width="300" class="" poster="<?=base_url('assets/images/no-video.png')?>" id="video-preview[<?=$key?>]" src="<?=isset($value['video']) ? base_url('assets/files/upload/courses/').$value['video'] : '' ?>" controls></video>
									<input name="course_video[<?=$key?>]" id="course_video[<?=$key?>]" type="file" data="video" class="form-control" value="">
								<?php endforeach ?>
							<?php } ?>

							<?php if(!isset($videos[0]['video'])){?>
								<video width="300" class="" poster="<?=base_url('assets/images/no-video.png')?>" id="video-preview[0]" src="<?=isset($value['video']) ? base_url('assets/files/upload/courses/').$value['video'] : '' ?>" controls></video>
								<input name="course_video[0]" id="course_video[0]" type="file" data="video" class="form-control" value="">
							<?php } ?>
						</div>

					</div>
					<span class="btn btn-primary btn-sm text-white mb-3" id="add-more-video">+ Add more video</span>
					<br>

					<!-- Create the editor container -->
					<label for="" class="mb-2">Description</label>
					<div id="editor" class="form-control mb-3"><?=isset($data['about']) ? $data['about'] : '' ?></div>
				</div>
				
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="text-center p-3">
						<img id="img-preview" class="d-inline-flex rounded border" width="250" src="<?=isset($data['course_img']) ? base_url('assets/files/upload/courses/'.$data['course_img']) : base_url('assets/images/no-image.jpg')?>" alt="photo profile">
						<br>
						<label for="formFile" class="form-label">Course Image</label>
						<input id="filetag" name="image" type="file" class="mt-3 form-control">
						
						<br>
					</div>
				</div>
			

				<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<progress style="width: 100%;" value="0" max="100"></progress>
					<p>
						<strong>Uploading status:</strong>
						<span id="statusMessage">🤷‍♂ Nothing's uploaded</span>
					</p>
					<button id="save" class="btn btn-primary text-white">Save</button>
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
	<script src="<?=base_url('assets/js/_createCourse.js')?>"></script>
<?php $this->end() ?>
