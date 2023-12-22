<?php $this->layout('layouts::main_template', ['title' => 'Shopping Cart']) ?>

<?php $this->start('css') ?>
<link rel="stylesheet" href="assets/css/teacher.min.css">

<?php $this->end() ?>

<?php $this->start('body') ?>

<div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- START CARD-->
                <div class="panel shadow-sm bg-white text-dark mb-3">
                    <div class="panel-body p-2">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <img class="img-fluid" src="assets/images/sm2.jpg">
                            </div>
                            <div class="col-12 col-lg-8 position-relative top-0 left-0">
                                <div class="row h-75">
                                    <div class="col-lg-9">
                                        <h4 class="mb-1"><strong>MODEL JAMED</strong></h4>
                                        <p class="text-secondary">8 lessons</p>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-sm btn-primary shadow-sm ms-2 remove_cart">
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
                                            <h5 class="fw-semibold text-end py-1 ms-auto text-shadow">Rp. 100.000</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CARD -->

                <!-- START CARD-->
                <div class="panel shadow-sm bg-white text-dark mb-3">
                    <div class="panel-body p-2">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <img class="img-fluid" src="assets/images/sm2.jpg">
                            </div>
                            <div class="col-12 col-lg-8 position-relative top-0 left-0">
                                <div class="row h-75">
                                    <div class="col-lg-9">
                                        <h4 class="mb-1"><strong>MODEL JAMED</strong></h4>
                                        <p class="text-secondary">8 lessons</p>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-sm btn-primary shadow-sm ms-2 remove_cart">
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
                                            <h5 class="fw-semibold text-end py-1 ms-auto text-shadow">Rp. 100.000</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CARD -->

                <!-- START CARD -->
                <div class="panel shadow-sm bg-white text-dark mb-3">
                    <div class="panel-body p-2">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <img class="img-fluid" src="assets/images/sm2.jpg">
                            </div>
                            <div class="col-12 col-lg-8 position-relative top-0 left-0">
                                <div class="row h-75">
                                    <div class="col-lg-9">
                                        <h4 class="mb-1"><strong>MODEL JAMED</strong></h4>
                                        <p class="text-secondary">8 lessons</p>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-sm btn-primary shadow-sm ms-2 remove_cart">
                                                <i class="fa-solid fa-trash text-white"></i>
                                            </button>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <hr class="m-0 p-0 text-secondary">
                                        <div class="w-100 d-flex">
                                            <a href="javascript:void(0)" class="text-secondary text-capitalize mt-1">simpan ke <i>Wishlist</i> </a>
                                            <h5 class="fw-semibold text-end py-1 ms-auto text-shadow">Rp. 100.000</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CARD -->
                
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="fw-semibold text-uppercase">ringkasan</h5>
                        <hr class="border border-secondary mt-1"/>
                        <dl class="row">
                            <dd class="col-6 text-capitalize mb-0 fs-6">total harga</dd>
                            <dt class="col-6 text-end fs-6">300.000</dt>
                            <dd class="col-6 text-capitalize mb-0 fs-6">pajak</dd>
                            <dt class="col-6 text-end fs-6">12.400</dt>
                        </dl>
                        <hr class="text-secondary my-2" />
                        <div class="d-flex w-100">
                            <h5 class="ms-auto fw-semibold">312.000</h5>
                        </div>
                        <button type="button" class="btn btn-primary w-100 text-center text-capitalize text-white fw-semibold mt-3">
                            checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->end() ?>