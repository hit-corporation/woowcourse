<?php $this->layout('layouts::main_template', ['title' => 'Shopping Cart']) ?>

<?php $this->start('css') ?>
	<link rel="stylesheet" href="<?=base_url('assets/css/custom.min.css')?>">
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
										<input type="hidden" value="<?=$value['course_id']?>" name="course_id">
										<input type="hidden" value="<?=$value['price']?>" name="price">
                                        <h4 class="mb-1"><strong><?=$value['course_title']?></strong></h4>
                                        <p class="text-secondary">8 lessons</p>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-sm btn-primary shadow-sm ms-2 remove_cart" onclick="hapusList(<?=$value['id']?>)" >
                                                <i class="fa-solid fa-trash text-white"></i>
                                            </button>
                                        </div>
                                        
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
						<?php $course_price = array_sum(array_column($carts, 'price')); 
							$ppn = $course_price * 11 / 100;
						?>

                        <h5 class="fw-semibold text-uppercase">ringkasan</h5>
                        <hr class="border border-secondary mt-1"/>
                        <dl class="row">
                            <dd class="col-6 text-capitalize mb-0 fs-6">total harga</dd>
                            <dt class="col-6 text-end fs-6">Rp <?=number_format($course_price) ?></dt>
                            <dd class="col-6 text-capitalize mb-0 fs-6">pajak</dd>
                            <dt class="col-6 text-end fs-6">Rp <?=number_format($ppn) ?></dt>
                        </dl>
                        <hr class="text-secondary my-2" />
                        <div class="d-flex w-100">
                            <h5 class="ms-auto fw-semibold total-pembelian">Rp <?=number_format($course_price + $ppn) ?></h5>
                        </div>

                        <button id="checkoutBtn" type="button" class="btn btn-primary w-100 text-center text-capitalize text-white fw-semibold mt-3">
                            checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="snap-container"></div>
<pre class="d-none"><div id="result-json">JSON result will appear here after payment:<br></div></pre>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<Set your ClientKey here>"></script>

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

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-vaoPLqzIF6aDGQX9"></script>

<script>
	let checkoutBtn = document.querySelector('#checkoutBtn');
	let totalPembelian = document.querySelector('.total-pembelian');

	checkoutBtn.addEventListener('click', function(){
		// nominalTransfer.innerHTML = totalPembelian.innerHTML;
		$('#checkoutModal').modal('show');

		let inputCourseId = document.querySelectorAll('input[name="course_id"]');
		let inputPrice = document.querySelectorAll('input[name="price"]');

		let courseIds = [];
		let coursePrices = [];
		for(let j=0; j < inputCourseId.length; j++){
			courseIds.push(inputCourseId[j].value);
			coursePrices.push(inputPrice[j].value);
		}

		$.ajax({
			type: "POST",
			url: BASE_URL + "transaction/store",
			data: {
				total_bayar: totalPembelian.innerHTML,
				discount: 0,
				courses_ids: courseIds,
				course_prices: coursePrices
			},
			dataType: "JSON",
			success: function (res) {
				$('#checkoutModal').modal('hide');

				// SnapToken acquired from previous step
				snap.pay(res.data.snap_token, {
					// Optional
					onSuccess: function(result){
						/* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
						$.ajax({
							type: "POST",
							url: BASE_URL+"Transaction/midtrans_update",
							data: result,
							dataType: "JSON",
							success: function (response) {
							}
						});
						return;
					},
					// Optional
					onPending: function(result){
						console.log(result);
						$.ajax({
							type: "POST",
							url: BASE_URL+"Transaction/midtrans_update",
							data: result,
							dataType: "JSON",
							success: function (response) {
								
							}
						});

						/* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
						return;
					},
					// Optional
					onError: function(result){
						/* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
					}
				});
			}
		});

	});

</script>

<?php $this->end() ?>
