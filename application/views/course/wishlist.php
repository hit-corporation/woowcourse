<?php $this->layout('layouts::main_template', ['title' => 'Wishlist']) ?>

<?php $this->start('css') ?>
	<style>
		.wishlist-icon{
			cursor: pointer;
		}
	</style>
<?php $this->end() ?>

<?php $this->start('body') ?>

<div class="container">
        <div class="row">

			<?php foreach ($wishlists as $key => $val): ?>
				  <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
                    <div class="card" id="card-course">
                        <img class="img-fluid" src="<?=base_url('assets/files/upload/courses/'.$val['course_img']); ?>" style="height:200px" onerror="imgError(this);">
                        <div class="card-body">
                            <h5 class="w-100 text-start text-capitalize mt-1 title-card"><a class="text-decoration-none" href="<?=base_url('course/detail/'.$val['id'])?>"><?=$val['course_title']?></a></h5>
                            <div class="w-100 d-flex flex-nowrap align-items-center mb-2">
                                <span class="border-end pe-2">
                                    <img  class=" teacher-icon rounded-circle border-1 shadow-sm" src="<?=!empty($val['photo']) ? base_url('assets/images/members/').$val['photo'] : base_url('assets/images/image.png'); ?>" width="30">
                                </span>
                                <span class="ms-2">
                                    <h6 class="text-capitalize text-secondary fw-normal text-shadow"><?=$val['first_name'].' '.$val['last_name']?></h6>
                                </span>
                            </div>
							<div class="row">
								<div class="col-6">
									<span class="w-100">
										<span class="fw-semibold me-2"><?=($val['rating']) ? $val['rating'] : 0 ?></span>

										<?php if($val['rating']): ?>
											<i class="fa-solid fa-star text-primary"></i>
										<?php else: ?>
											<i class="fa-solid fa-star text-secondary"></i>
										<?php endif ?>

									</span>
								</div>
								<div class="col-6 text-end">
									<i class="fa fa-heart text-red fs-4 me-4 wishlist-icon" data="<?=$val['id']?>"></i>
								</div>
							</div>
                            
                            <h5 class="mt-1">Rp <?=number_format($val['price'])?></h5>
                            <div class="d-flex flex-nowrap w-100" id="checkout-button">
                                <a href="<?=base_url('course/detail/'.$val['id'])?>" class="btn btn-primary text-white w-100 mt-3">
									Detail
								</a>
                            </div>
                           
                        </div>
                    </div>
                </div>
			<?php endforeach ?>

		
           
        </div>
    </div>
</section>

<script src="assets/js/_wishlist.js"></script>

<script>
	function imgError(image) {
		image.onerror = "";
		image.src = "assets/images/default-course.jpeg";
		return true;
	}
</script>

<?php $this->end() ?>
