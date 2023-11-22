<?php $this->layout('layouts::main_template', ['title' => 'Profile Member']); ?>

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
						<label for="first_name" class="form-label">First Name</label>
						<input type="hidden" name="id" value="<?=isset($data['id']) ? $data['id'] : '' ?>">
						<input type="text" class="form-control" id="first_name" name="first_name" value="<?=isset($data['first_name']) ? $data['first_name'] : '' ?>">
					</div>
					<div class="mb-3">
						<label for="last_name" class="form-label">Last Name</label>
						<input type="text" class="form-control" id="last_name" name="last_name" value="<?=isset($data['last_name']) ? $data['last_name'] : '' ?>">
					</div>
					<div class="mb-3">
						<input hidden type="email" class="form-control" id="email" name="email" readonly value="<?=isset($data['email']) ? $data['email'] : $_SESSION['user']['email'] ?>">
					</div>
					<div class="mb-3">
						<label for="phone" class="form-label">Phone</label>
						<input type="text" class="form-control" id="phone" name="phone" value="<?=isset($data['phone']) ? $data['phone'] : '' ?>">
					</div>
					<div class="form-floating mb-3">
						<textarea class="form-control" placeholder="Masukan Alamat Instruktor" id="address"><?=isset($data['address']) ? $data['address'] : '' ?></textarea>
						<label for="address">Alamat</label>
					</div>

					<div class="mb-3 form-check">
						<input id="as_instructor" type="checkbox" class="form-check-input" id="exampleCheck1" style="width: 20px; height: 20px; cursor:pointer;" <?=isset($data['as_instructor']) ? 'checked' : '' ?>>
						<label class="form-check-label mx-2 mt-1" for="exampleCheck1">Daftar Sebagai Pengajar</label>
					</div>

					<!-- Create the editor container -->
					<label for="" class="mb-2">Tentang Penulis</label>
					<div id="editor" class="form-control mb-3"><?=isset($data['about']) ? $data['about'] : '' ?></div>
				</div>
				
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="text-center p-3">
						<img id="img-preview" class="d-inline-flex photo-profile" src="<?=isset($data['photo']) ? base_url('assets/images/members/'.$data['photo']) : ''?>" alt="photo profile">
						
						<label for="formFile" class="form-label"></label>
						<input id="filetag" type="file" class="mt-3 form-control">
						
						<br>
					</div>
				</div>
			

				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<a id="update" class="btn btn-primary text-white">Update</a>
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
	<script src="<?=base_url('assets/js/_member.js')?>"></script>
	
<?php $this->end() ?>
