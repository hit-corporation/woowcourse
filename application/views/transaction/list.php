<?php $this->layout('layouts::main_template', ['title' => 'Course History']) ?>

<?php $this->start('css') ?>
	<link rel="stylesheet" href="assets/css/teacher.min.css">
	<link href="https://cdn.datatables.net/v/bs5/dt-2.0.1/datatables.min.css" rel="stylesheet">
<?php $this->end() ?>

<?php $this->start('body') ?>

	<div class="container">
        <div class="row">
            <div class="col-lg-12">
				<table id="myTable" class="display table">
					<thead>
						<tr>
							<th>No</th>
							<th>No Transaksi</th>
							<th>Nominal</th>
							<th>Tanggal Dibuat</th>
							<th>Tanggal Pembayaran</th>
							<th>Status</th>							
							<th>Status Message</th>							
						</tr>
					</thead>
					<tbody>
						<?php 
							$no = 1;
							foreach($transactions as $key => $val): 
						?>
							<tr>
								<td><?=$no?></td>
								<td><a href="<?=base_url('Transaction/detail?code='.urlencode($val['code']))?>"><?=$val['code']?></a></td>
								<td><?="Rp ".str_replace(',','.',number_format($val['amount']))?></td>
								<td><?=date('d M Y H:i', strtotime($val['created_at']))?></td>
								<td><?=date('d M Y H:i', strtotime($val['transaction_dt']))?></td>
								<td><?=$val['status']?></td>
								<td><?=$val['status_message']?></td>
							</tr>

						<?php 
							$no++;
							endforeach 
						?>
					</tbody>
				</table>
            </div>
            
        </div>
    </div>
</section>

<?php $this->end() ?>

<?php $this->start('js')?>
<script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/datatables.min.js"></script>

<script>
	$(document).ready( function () {
		$('#myTable').DataTable();
	} );
</script>
<?php $this->end()?>
