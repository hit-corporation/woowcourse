<?php $this->layout('layouts::main_template', ['title' => 'Course History']) ?>

<?php $this->start('css') ?>
<link rel="stylesheet" href="assets/css/teacher.min.css">

<?php $this->end() ?>

<?php $this->start('body') ?>

	<div class="container">
        <div class="row">
            <div class="col-lg-8">
				<?php foreach($carts as $value) : ?>
                <!-- START CARD-->
                <div class="panel shadow-sm bg-white text-dark mb-3">
                    <div class="panel-body p-2">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <img class="img-fluid" src="assets/files/upload/courses/<?=$value['course_img']?>">
                            </div>
                            <div class="col-12 col-lg-8 position-relative top-0 left-0">
                                <div class="row h-75">
                                    <div class="col-lg-9">
                                        <h4 class="mb-1"><strong><?=$value['course_title']?></strong></h4>
                                        <p class="text-secondary">8 lessons</p>
										<p>Tanggal dibuat: <?=date('d M Y H:i',strtotime($value['created_at']))?></p>
										<p>Tanggal berakhir: <?=date('d M Y H:i',strtotime($value['created_at']))?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <hr class="m-0 p-0 text-secondary">
                                        <div class="w-100 d-flex mt-1">
                                            <a href="javascript:void(0)" class="text-secondary text-capitalize mt-1">simpan ke <i>Wishlist</i> </a>
                                            <h5 class="fw-semibold text-end py-1 ms-auto text-shadow">Rp. <?=number_format($value['price'])?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CARD -->
				<?php endforeach ?>
                
            </div>
            
        </div>
    </div>
</section>

<script>
	function hapusList(id){
		$.ajax({
			type: "POST",
			url: BASE_URL+"cart/delete",
			data: {id: id},
			dataType: "JSON",
			success: function (res) {
				if(res.success){
					Swal.fire({
						icon: 'success',
						title: '<h5 class="text-success">Success</h5>',
						html: '<span class="text-success fw-semibold">Berhasil di masukan ke daftar chart !!!</span>',
						timer: 1200
					});
					window.location.href = BASE_URL+'cart';
				}
			}
		});
	}
</script>

<?php $this->end() ?>
