<?php $this->layout('layouts::main_template', ['title' => 'Course'])?>

<!-- SECTION CSS -->
<?php $this->start('css') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $this->stop() ?>

<!-- SECTION CONTENT -->
<?php $this->start('contents') ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">

				<div class="d-sm-flex align-items-center justify-content-between pb-2 mb-3 px-2 border-bottom">
					<h1 class="h3 mb-0 text-gray-800"><?=$this->e('Rating & Commands')?></h1>
					<div class="row">
						<button id="btn-add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2"  data-target="#modal-input" data-toggle="modal">
							<i class="fas fa-plus fa-sm text-white-50"></i> 
							Tambah Data
						</button>
						<div class="dropdown">
							<button id="btn-import" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<i class="fa fa-download" aria-hidden="true"></i> 
								Import Data
							</button>
							<div class="dropdown-menu">
								<a role="button" class="dropdown-item" href="<?=$this->e(base_url('assets/files/download/template/book_template.xlsx'))?>" download>Unduh Berkas Templat</a>
								<a role="button" class="dropdown-item" data-target="#modal-import" data-toggle="modal">Unggah Dari Templat Excel</a>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">

						<div class="col-xl-12 col-lg-12 col-md-12 float-right mb-3 pl-0">
							<form name="form-search">
								<div class="row" style="text-align: end;">
									<div class="col-xl-3 col-lg-3 col-md-4 mb-2">
										<input type="text" class="form-control form-control-sm" name="s_course_title" placeholder="Judul kursus">
									</div>
									<div class="col-xl-3 col-lg-3 col-md-4 mb-2">
										<input type="text" class="form-control form-control-sm" name="s_instructor" placeholder="Nama Instruktur">
									</div>
									<div class="col-xl-3 col-lg-3 col-md-4 mb-2">
										<select class="js-example-basic-single form-control form-control-sm" name="s_category" placeholder="Kategori">
											<?php foreach ($categories as $key => $value) : ?>
												<option value="<?=$value['id']?>"><?=$value['category_name']?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="col-xl-1 col-lg-1 col-md-1">
										<div class="btn-group btn-group-sm">
											<button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
											<button type="reset" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
										</div>
									</div>
								</div>
							</form>
						</div>

						<div class="table-responsive">
							<table id="table-main" class="table table-sm">
								<thead class="bg-indigo text-white">
									<tr>
										<th>ID</th>
										<th>Kode</th>
										<th>Gambar Kursus</th>
										<th>Judul</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Kategori</th>
										<th>Tanggal Dibuat</th>
										<th>Rating</th>
										<th>comment</th>
										<th>Action</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
<?php $this->stop() ?>

<!-- SECTION JS -->
<?php $this->start('js') ?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="<?=base_url('assets/js/pages/_rating.js')?>"></script>
<?php $this->stop() ?>
