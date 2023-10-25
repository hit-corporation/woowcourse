<?php $this->layout('layouts::main_template', ['title' => 'Dashboard'])?>

<!-- SECTION CSS -->
<?php $this->start('css') ?>
	
<?php $this->stop() ?>


<!-- SECTION CONTENT -->
<?php $this->start('contents') ?>

	<!-- Begin Page Content -->

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center mb-4">
			<div class="btn-group" role="group" aria-label="Basic example">
				<a href="dashboard" class="btn bg-info text-light">Dashboard 1</a>
				<a href="dashboard/dashboard2" class="btn btn-secondary">Dashboard 2</a>
			</div>
		</div>

	</div>
	<!-- /.container-fluid -->

<?php $this->stop() ?>

<!-- SECTION JS -->
<?php $this->start('js') ?>

<?php $this->stop() ?>
