<?php $this->layout('layouts::main_template', ['title' => 'Course History']) ?>

<?php $this->start('css') ?>
	<link rel="stylesheet" href="assets/css/teacher.min.css">
<?php $this->end() ?>

<?php $this->start('body') ?>

	<div class="container border rounded mt-5">
        <div class="row ">
            <div class="col-lg-12 pt-3 px-4">

				<div class="row mb-2">
					<div class="col-6">
						<h4>Detail Transaksi</h4>
					</div>
					<div class="col-6 text-end">
						<?php if($data['status'] == 'pending'): ?>
							<a href="<?=($data['pdf_url'])?>" class="btn btn-md btn-light border rounded">Cara Pembayaran</a>
						<?php endif ?>
					</div>
				</div>

				<div class="card p-4 mb-5">
					<div class="row">
						<div class="col-6">
							<h5>Status Transaksi</h5>
						</div>
						<div class="col-6">
							<h5 class="text-success text-end"><?=$data['status'].' - '.$data['status_message']?></h5>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-6">Kode Transaksi</div>
						<div class="col-6 text-success text-end"><?=$data['code']?></div>
					</div>

					<div class="row">
						<div class="col-6">Tanggal Dibuat</div>
						<div class="col-6 text-end"><?=date('d M Y, H:i', strtotime($data['created_at']))?></div>
					</div>

					<div class="row">
						<div class="col-6">Tanggal Pembayaran</div>
						<div class="col-6 text-end"><?=date('d M Y, H:i', strtotime($data['transaction_dt']))?></div>
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
					<tbody>
						<?php 
							$total_harga_kursus = 0;
							foreach($details as $key => $val):
								$total_harga_kursus += $val['price'];
						?>
							<tr>
								<td><img class="" src="<?=base_url('assets/files/upload/courses/'.$val['course_img'])?>" alt="" width="100"></td>
								<td><?=$val['course_title']?></td>
								<td><?=$val['first_name'].' '.$val['last_name']?></td>
								<td><?='Rp '.str_replace(',','.', number_format($val['price']))?></td>
							</tr>

						<?php endforeach ?>
					</tbody>
				</table>

				<div class="card p-4 mt-5 mb-5">
					<h5>Rincian Pembayaran</h5>

					<hr>

					<div class="row">
						<div class="col-6">Metode Pembayaran</div>
						<div class="col-6 text-end"><?= $data['payment_method'] ?></div>
					</div>

					<div class="row">
						<div class="col-6">Total Harga Kursus</div>
						<div class="col-6 text-end"><?='Rp '.str_replace(',','.', number_format($total_harga_kursus))?></div>
					</div>

					<div class="row">
						<div class="col-6">PPN (11%)</div>
						<div class="col-6 text-end"><?='Rp '.str_replace(',','.', number_format($total_harga_kursus*11/100))?></div>
					</div>

					<div class="row">
						<div class="col-6">Total Transaksi</div>
						<div class="col-6 text-end"><?='Rp '.str_replace(',','.', number_format($data['amount']))?></div>
					</div>
				</div>
            </div>
            
        </div>
    </div>
</section>

<?php $this->end() ?>

<?php $this->start('js')?>

<?php $this->end()?>
