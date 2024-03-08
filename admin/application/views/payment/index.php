<?php $this->layout('layouts::main_template', ['title' => 'Payment'])?>

<!-- SECTION CSS -->
<?php $this->start('css') ?>
<link href="<?=$this->e(base_url('assets/vendor/jstree/dist/themes/default/style.min.css'))?>" rel="stylesheet">
<link rel="stylesheet" href="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.min.css'))?>">
<link rel="stylesheet" href="<?=$this->e(base_url('assets/css/main.min.css'))?>">
<style>
#tree-container {
    height: 240px;
    overflow: auto;
}
</style>
<?php $this->stop() ?>

<!-- SECTION CONTENT -->
<?php $this->start('contents') ?>

<div class="row">
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between pb-2 mb-3 px-2 border-bottom">
			<h1 class="h3 mb-0 text-gray-800">Payment</h1>
			
			<div class="row">
				<div class="col-12">
					<button id="download" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Download</button>
				</div>
			</div>
			
		</div>

        <div class="card">
			<div class="card-header py-3">
				
				<form name="form-search">
					<div class="row">
						<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
							<input type="text" class="form-control form-control-sm" name="s_first_name" placeholder="Nama Instruktur">
						</div>
						<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
							<div class="input-group">
								<div class="input-group-prepend" style="height: 29px">
									<div class="input-group-text">start</div>
								</div>
								<input type="date" class="form-control" name="s_start_dt" style="height:29px">
							</div>

						</div>
						<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
							<div class="input-group">
								<div class="input-group-prepend" style="height: 29px">
									<div class="input-group-text">end</div>
								</div>
								<input type="date" class="form-control" name="s_end_dt" style="height:29px">
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
							<select class="form-control form-control-sm" name="s_payment_method">
								<option value="">-- Pilih Payment Method --</option>
								<?php foreach($payment_methods as $val): ?>
									<option value="<?=$val['payment_method']?>"><?=$val['payment_method']?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-2">
							<select class="form-control form-control-sm" name="s_status">
								<option value="">-- Pilih status --</option>
								<?php foreach($status as $val): ?>
									<option value="<?=$val['status']?>"><?=$val['status']?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-2">
							<div class="btn-group btn-group-sm">
								<button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
								<button type="reset" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
							</div>
						</div>
					</div>
				</form>
					
			</div>

            <div class="card-body">
                <div class="table-reponsive" style="overflow:auto">
					<table id="table-main" class="table table-sm table-striped" width="100%">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Tanggal Transaksi</th>
                                <th>Tanggal Bayar</th>
                                <th>No Transaksi</th>
                                <th>Nama Member</th>
                                <th>Amount</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Status Message</th>
                                <th>#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<div id="modal-input" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container rounded mt-5">
					<div class="row ">
						<div class="col-lg-12 pt-3 px-4">

							<div class="row mb-2">
							
								<div class="col-6 text-end">
									<?php // if($data['status'] == 'pending'): ?>
										<!-- <a href="<?//=($data['pdf_url'])?>" class="btn btn-md btn-light border rounded">Cara Pembayaran</a> -->
									<?php // endif ?>
								</div>
							</div>

							<div class="card p-4 mb-5">
								<div class="row">
									<div class="col-6">
										<h5>Status Transaksi</h5>
									</div>
									<div class="col-6">
										<h5 class="text-success text-end status-transaksi"></h5>
									</div>
								</div>

								<hr>

								<div class="row">
									<div class="col-6">Kode Transaksi</div>
									<div class="col-6 text-success text-end transaction-code"></div>
								</div>

								<div class="row">
									<div class="col-6">Tanggal Dibuat</div>
									<div class="col-6 text-end created-at"></div>
								</div>

								<div class="row">
									<div class="col-6">Tanggal Pembayaran</div>
									<div class="col-6 text-end transaction-dt"></div>
								</div>
							</div>

							<table id="myTable" class="display table">
								<thead>
									<tr>
										<th>Image</th>
										<th>Nama Kursus</th>
										<th>Instruktur</th>	
										<th>Harga</th>						
									</tr>
								</thead>
								<tbody id="table-body">
								</tbody>
							</table>

							<div class="card p-4 mt-5 mb-5">
								<h5>Rincian Pembayaran</h5>

								<hr>

								<div class="row">
									<div class="col-6">Metode Pembayaran</div>
									<div class="col-6 text-end payment-method" data-id="payment-method"></div>
								</div>

								<div class="row">
									<div class="col-6">Total Harga Kursus</div>
									<div class="col-6 text-end total_harga_kursus"></div>
								</div>

								<div class="row">
									<div class="col-6">PPN (11%)</div>
									<div class="col-6 text-end total-ppn"></div>
								</div>

								<div class="row">
									<div class="col-6">Total Transaksi</div>
									<div class="col-6 text-end amount"></div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
            </div>
        </div>
    </div>
</div>

<?php $this->stop() ?>

<!-- SECTION JS -->
<?php $this->start('js') ?>
<script src="<?=$this->e(base_url('assets/node_modules/moment/moment.js'))?>"></script>
<script src="<?=$this->e(base_url('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js'))?>"></script>

<?php if(isset($_SESSION['error'])): ?>
<script>
   $('#modal-input').modal('show');
</script>
<?php endif; ?>

<?php if(isset($_SESSION['success'])): ?>
<script>
   
    Swal.fire({
        icon: 'success',
        title: '<h4 class="text-success">SUKSES</h4>',
        html: '<h5 class="text-success"><?=$_SESSION['success']['message']?></h5>',
        timer: 1500
    });

</script>
<?php endif; ?>

<script src="<?=$this->e(base_url('assets/js/pages/_payment.js'))?>"></script>

<?php $this->stop() ?>
