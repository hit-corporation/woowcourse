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

						<div class="row mt-3 mb-3">
							<dd class="col-6 text-capitalize mb-0 fs-6">Pilih Pembayaran</dd>
                            <dt class="col-6 text-end fs-6 pilih-pembayaran">silahkan pilih ></dt>
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

<div id="myModal" class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Pilih Pembayaran</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>

		
		<div class="mb-3 ms-3 mt-3 pe-3">
			<label for="rek-member" class="form-label">Masukan Nomor Rekening Anda <span class="text-red">*</span></label>
			<input type="text" class="form-control" id="rek-member" placeholder="123xxx">
		</div>
		

		<div class="modal-body">
			<p class="fw-bold" style="cursor: pointer;" data-bs-dismiss="modal" data="transfer bank bca" rek="437163682">Transfer bank BCA - 437163682 ></p>
			<p class="fw-bold" style="cursor: pointer;" data-bs-dismiss="modal" data="transfer bank mandiri" rek="392864272">Transfer bank Mandiri - 392864272 ></p>
			<p class="fw-bold" style="cursor: pointer;" data-bs-dismiss="modal" data="transfer bank bni" rek="239828343432">Transfer bank BNI - 2398282 ></p>
		</div>

		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		</div>
		</div>
	</div>
</div>

<div id="checkoutModal" class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Checkout Pembayaran</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>

		<div class="modal-body">
			<p class="" style="cursor: pointer;" data-bs-dismiss="modal">
				Harap melakukan pembayaran
				<span class="fw-bold bank-name"> </span>
				<span class="rek_number"> </span> a/n Woowcourse
			</p>
			<p>Nominal Transfer: <span class="nominal-transfer"></span></p>
		</div>

		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" id="save" class="btn btn-primary text-white">Save</button>
		</div>
		</div>
	</div>
</div>

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

<script>
	let pilihPembayaran = document.querySelector('.pilih-pembayaran');
	let checkoutBtn = document.querySelector('#checkoutBtn');
	let modalBody = document.querySelector('.modal-body').children;
	let bankName = document.querySelector('.bank-name');
	let rekNumber = document.querySelector('.rek_number');
	let totalPembelian = document.querySelector('.total-pembelian');
	let nominalTransfer = document.querySelector('.nominal-transfer');
	let save = document.querySelector('#save');

	pilihPembayaran.addEventListener('click', function(e){
		$('#myModal').modal('show');
	});

	// looping modal body jenis pembayaran
	for(let i=0; i < modalBody.length; i++){
		modalBody[i].addEventListener('click', function(){
			pilihPembayaran.innerHTML = this.attributes.data.value;
			rekNumber.innerHTML = this.attributes.rek.value;
		});
	}

	checkoutBtn.addEventListener('click', function(){
		bankName.innerHTML = pilihPembayaran.innerHTML;
		nominalTransfer.innerHTML = totalPembelian.innerHTML;
		$('#checkoutModal').modal('show');
	});

	save.addEventListener('click', function(){
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
				total_bayar: nominalTransfer.innerHTML,
				discount: 0,
				jenis_pembayaran: pilihPembayaran.innerHTML,
				no_rekening_member: $('#rek-member').val(),
				no_rekening_tujuan: rekNumber.innerHTML,
				courses_ids: courseIds,
				course_prices: coursePrices
			},
			dataType: "JSON",
			success: function (res) {
				
			}
		});
	});
</script>

<?php $this->end() ?>
