<?php $this->layout('layouts::main_template', ['title' => 'Has Verified']) ?>

<?php $this->start('css') ?>
<link rel="stylesheet" href="assets/css/teacher.min.css">
<?php $this->end() ?>


<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <p class="fs-5 text-shadow">
                Email berhasil di kirim ke alamat email user. silahkan masuk ke kontak masuk email user dan tekan tombol aktivasi.
            </p>
            <div class="d-flex flex-nowrap mt-3 align-items-center">
                <a class="btn btn-sm btn-primary text-white fs-6" href="<?=base_url()?>">Homepage</a>
                <span class="fs-6 mx-2">Or</span>
                <!-- <a href="javascript:void(0)" class="fs-6">Resend activation mail</a> -->
            </div>
        </div>
    </div>
</div>
<?php $this->end() ?>
