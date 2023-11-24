<?php

$this->layout('layouts::main_template', ['title' => 'Create New Course']) ?>

<?php $this->start('css') ?>
	<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<?php $this->end() ?>

<?php $this->start('body') ?>

	<!-- START SECTION BODY -->

	<div class="container">
		<form>
			<div class="row">
				<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="mb-3">
						<label for="course_title" class="form-label">Course Title</label>
						<input type="hidden" name="id" value="<?=isset($data['id']) ? $data['id'] : '' ?>">
						<input type="text" class="form-control" id="course_title" name="course_title" value="<?=isset($data['course_title']) ? $data['course_title'] : '' ?>">
					</div>

					<div class="mb-3">
						<label for="course_title" class="form-label">Course Category</label>
						<div class="category border rounded pt-2"></div>
					</div>
					<!-- Create the editor container -->
					<label for="" class="mb-2">Tentang Penulis</label>
					<div id="editor" class="form-control mb-3"><?=isset($data['about']) ? $data['about'] : '' ?></div>
				</div>
				
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="text-center p-3">
						<img id="img-preview" class="d-inline-flex rounded border" width="250" src="<?=isset($data['photo']) ? base_url('assets/images/members/'.$data['photo']) : base_url('assets/images/no-image.jpg')?>" alt="photo profile">
						
						<label for="formFile" class="form-label"></label>
						<input id="filetag" type="file" class="mt-3 form-control">
						
						<br>
					</div>
				</div>
			

				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<a id="save" class="btn btn-primary text-white">Save</a>
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
