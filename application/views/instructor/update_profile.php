<?php $this->layout('layouts::main_template', ['title' => 'Update Instructor']); ?>

<?php $this->start('css') ?>
	<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<?php $this->end() ?>

<?php $this->start('body') ?>

<body class="min-100-vh bg-light-subtle">
	<!-- START SECTION BODY -->

	<div class="container">
		<div class="row">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
					<label for="email" class="form-label">Email</label>
					<input type="email" class="form-control" id="email" name="email" readonly value="<?=isset($data['email']) ? $data['email'] : '' ?>">
				</div>
				<div class="mb-3">
					<label for="phone" class="form-label">Phone</label>
					<input type="text" class="form-control" id="phone" name="phone" value="<?=isset($data['phone']) ? $data['phone'] : '' ?>">
				</div>
				<div class="form-floating mb-3">
					<textarea class="form-control" placeholder="Masukan Alamat Instruktor" id="address"><?=isset($data['address']) ? $data['address'] : '' ?></textarea>
					<label for="address">Alamat</label>
				</div>
				<!-- Create the editor container -->
				<label for="" class="mb-2">Tentang Penulis</label>
				<div id="editor" class="form-control mb-3"><?=isset($data['about']) ? $data['about'] : '' ?></div>
			</div>
			
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="text-center p-3">
					<img id="img-preview" class="d-inline-flex photo-profile" src="<?=base_url('assets/images/instructors/'.$data['photo'])?>" alt="photo profile">
					
					<label for="formFile" class="form-label"></label>
					<input id="filetag" type="file" class="mt-3 form-control">
					
					<br>
				</div>
			</div>

			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<button id="update" class="btn btn-primary text-white">Update</button>
			</div>

		</div>

		<div>

		</div>

	</div>

	<!-- END SECTION BODY -->
</body>

<?php $this->end() ?>

<?php $this->start('js') ?>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<!-- Include the Quill library -->
	<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
	<script>
		var quill = new Quill('#editor', {
			theme: 'snow'
		});

		document.getElementById('editor').style.height = '200px';
	</script>

	<!-- PREVIEW IMAGE -->
	<script>
		let fileTag = document.getElementById('filetag');
		let preview = document.getElementById('img-preview');
		fileTag.addEventListener('change', function(){
			changeImage(this);
		});

		function changeImage(input){
			var reader;

			if(input.files && input.files[0]){
				reader = new FileReader();

				reader.onload = function(e){
					preview.setAttribute('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}
	</script>

	<!-- SAVE / POST DATA -->
	<script>
		let id = document.getElementsByName('id')[0].value;
		let update = document.getElementById('update');

		const fileReader = new FileReader();
		
		update.addEventListener('click', function(){
			console.log(fileTag.files);
			$.ajax({
				type: "POST",
				url: BASE_URL+"instructor/update_profile/"+id,
				data: {
					type: 'update',
					first_name: document.getElementById('first_name').value,
					last_name: document.getElementById('last_name').value,
					email: document.getElementById('email').value,
					phone: document.getElementById('phone').value,
					address: document.getElementById('address').value,
					about: document.getElementById('editor').textContent,
				},
				dataType: "JSON",
				success: function (response) {
					
				}
			});
		});

		
	</script>
<?php $this->end() ?>
