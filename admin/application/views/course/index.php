<?php $this->layout('layouts::main_template', ['title' => 'Course'])?>

<!-- SECTION CSS -->
<?php $this->start('css') ?>
<?php $this->stop() ?>

<!-- SECTION CONTENT -->
<?php $this->start('contents') ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">

				<div class="d-sm-flex align-items-center justify-content-between pb-2 mb-3 px-2 border-bottom">
					<h1 class="h3 mb-0 text-gray-800"><?=$this->e('Buku')?></h1>
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

						<div class="col-xl-12 col-lg-12 col-md-12 float-right">
							<form name="form-search">
								<div class="row" style="text-align: end;">
									<div class="col-xl-3 col-lg-3 col-md-4 mb-2">
										<input type="text" class="form-control form-control-sm" name="s_book_author" placeholder="Nama Penulis">
									</div>
									<div class="col-xl-3 col-lg-3 col-md-4 mb-2">
										<input type="text" class="form-control form-control-sm" name="s_book_publisher" placeholder="Nama Penerbit">
									</div>
									<div class="col-xl-3 col-lg-3 col-md-4 mb-2">
										<input type="text" class="form-control form-control-sm" name="s_book_name" placeholder="Nama Buku">
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
										<th>Instruktur</th>
										<th>Kategori</th>
										<th>Tanggal Dibuat</th>
										<th>Rating</th>
										<th>Harga</th>
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
<?php $this->stop() ?>
