<?php $this->layout('layouts::main_template', ['title' => 'Course']) ?>

<?php $this->start('css') ?>
<link rel="stylesheet" href="assets/css/teacher.min.css">
<?php $this->end() ?>

<?php $this->start('body') ?>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="offcanvas-lg offcanvas-start" id="filter-categories">
                <div class="offcanvas-header justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#filter-categories" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-flex flex-nowrap flex-column">
                    <div class="input-group input-group-sm mb-1">
                        <input type="search" class="form-control form-control-sm" placeholder="Cari Tutorial ...">
                        <button type="button" class="btn btn-sm btn-info text-white"><i class="fa-solid fa-search"></i></button>
                    </div>

                    <hr class="border border-dark mb-2" />
                    <h4 class="mb-2 text-shadow-sm">Kategori</h4>
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" value="category[1]" id="checkItAndComputer">
                        <label class="form-check-label" for="checkItAndComputer">IT Dan Komputer</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="category[2]" id="checkMusicAndInstruments">
                        <label class="form-check-label" for="checkMusicAndInstruments">Music</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="category[3]" id="checkGraphicDesign">
                        <label class="form-check-label" for="checkGraphicDesign">Graphic Design</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="category[4]" id="checkFinanceAndAccounting">
                        <label class="form-check-label" for="checkFinanceAndAccounting">Finance And Accounting</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="category[5]" id="checkPhotography">
                        <label class="form-check-label" for="checkPhotography">Photography</label>
                    </div>
                    <hr class="border border-dark mb-2" />
                    <h4 class="mb-2 text-shadow-sm">Rating</h4>
                    <div class="pt-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="rate[1]" id="rating1">
                            <label class="form-check-label" for="rating1">
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="rate[2]" id="rating2">
                            <label class="form-check-label" for="rating2">
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="rate[3]" id="rating3">
                            <label class="form-check-label" for="rating3">
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="rate[4]" id="rating4">
                            <label class="form-check-label" for="rating4">
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-secondary"></i>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="rate[5]" id="rating5">
                            <label class="form-check-label" for="rating5">
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-primary"></i>
                                <i class="fa fa-star text-primary"></i>
                            </label>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <button type="button" class="btn bg-cyan shadow-sm d-lg-none mb-3" data-bs-toggle="offcanvas" data-bs-target="#filter-categories">
                <i class="fa-solid fa-filter"></i>&nbsp;Filter
            </button>
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4 py-1">
                    <div class="card position-relative d-lg-flex flex-nowrap">
                        <img class="img-fluid" src="assets/images/sm2.jpg">
                        <div class="card-body">
                            <h5 class="text-uppercase text-shadow">Santet Buhul Cacing Abing</h5>
                            <div class="pt-1">
                                <span>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-nowrap py-3">
                                <div class="col border-right">
                                    <i class="fa-solid fa-clock text-warning"></i><span class="ms-1">1 Week</span>
                                </div>
                                <div class="col border-right">
                                    <i class="fa-solid fa-calendar text-warning"></i><span class="ms-1">3 Session</span>
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-12 d-flex flex-nowrap justify-content-end">
                                    <button type="button" class="btn btn-sm btn-success text-uppercase">
                                        <i class="fa-regular fa-handshake"></i>
                                        Subscribe !!!
                                    </button>
                                </div>
                            </div>
                        </div>
                        <span class="label-harga">Rp. 320K</span>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 py-1">
                    <div class="card position-relative d-lg-flex flex-nowrap">
                        <img class="img-fluid" src="assets/images/sm2.jpg">
                        <div class="card-body">
                            <h5 class="text-uppercase text-shadow">Santet Buhul Cacing Abing</h5>
                            <div class="pt-1">
                                <span>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-nowrap py-3">
                                <div class="col border-right">
                                    <i class="fa-solid fa-clock text-warning"></i><span class="ms-1">1 Week</span>
                                </div>
                                <div class="col border-right">
                                    <i class="fa-solid fa-calendar text-warning"></i><span class="ms-1">3 Session</span>
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-12 d-flex flex-nowrap justify-content-end">
                                    <button type="button" class="btn btn-sm btn-success text-uppercase">
                                        <i class="fa-regular fa-handshake"></i>
                                        Subscribe !!!
                                    </button>
                                </div>
                            </div>
                        </div>
                        <span class="label-harga">Rp. 320K</span>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 py-1">
                    <div class="card position-relative d-lg-flex flex-nowrap">
                        <img class="img-fluid" src="assets/images/sm2.jpg">
                        <div class="card-body">
                            <h5 class="text-uppercase text-shadow">Santet Buhul Cacing Abing</h5>
                            <div class="pt-1">
                                <span>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-nowrap py-3">
                                <div class="col border-right">
                                    <i class="fa-solid fa-clock text-warning"></i><span class="ms-1">1 Week</span>
                                </div>
                                <div class="col border-right">
                                    <i class="fa-solid fa-calendar text-warning"></i><span class="ms-1">3 Session</span>
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-12 d-flex flex-nowrap justify-content-end">
                                    <button type="button" class="btn btn-sm btn-success text-uppercase">
                                        <i class="fa-regular fa-handshake"></i>
                                        Subscribe !!!
                                    </button>
                                </div>
                            </div>
                        </div>
                        <span class="label-harga">Rp. 320K</span>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 py-1">
                    <div class="card position-relative d-lg-flex flex-nowrap">
                        <img class="img-fluid" src="assets/images/sm2.jpg">
                        <div class="card-body">
                            <h5 class="text-uppercase text-shadow">Santet Buhul Cacing Abing</h5>
                            <div class="pt-1">
                                <span>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-nowrap py-3">
                                <div class="col border-right">
                                    <i class="fa-solid fa-clock text-warning"></i><span class="ms-1">1 Week</span>
                                </div>
                                <div class="col border-right">
                                    <i class="fa-solid fa-calendar text-warning"></i><span class="ms-1">3 Session</span>
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-12 d-flex flex-nowrap justify-content-end">
                                    <button type="button" class="btn btn-sm btn-success text-uppercase">
                                        <i class="fa-regular fa-handshake"></i>
                                        Subscribe !!!
                                    </button>
                                </div>
                            </div>
                        </div>
                        <span class="label-harga">Rp. 320K</span>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 py-1">
                    <div class="card position-relative d-lg-flex flex-nowrap">
                        <img class="img-fluid" src="assets/images/sm2.jpg">
                        <div class="card-body">
                            <h5 class="text-uppercase text-shadow">Santet Buhul Cacing Abing</h5>
                            <div class="pt-1">
                                <span>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-nowrap py-3">
                                <div class="col border-right">
                                    <i class="fa-solid fa-clock text-warning"></i><span class="ms-1">1 Week</span>
                                </div>
                                <div class="col border-right">
                                    <i class="fa-solid fa-calendar text-warning"></i><span class="ms-1">3 Session</span>
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-12 d-flex flex-nowrap justify-content-end">
                                    <button type="button" class="btn btn-sm btn-success text-uppercase">
                                        <i class="fa-regular fa-handshake"></i>
                                        Subscribe !!!
                                    </button>
                                </div>
                            </div>
                        </div>
                        <span class="label-harga">Rp. 320K</span>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 py-1">
                    <div class="card position-relative d-lg-flex flex-nowrap">
                        <img class="img-fluid" src="assets/images/sm2.jpg">
                        <div class="card-body">
                            <h5 class="text-uppercase text-shadow">Santet Buhul Cacing Abing</h5>
                            <div class="pt-1">
                                <span>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                    <i class="fa fa-star text-primary"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-nowrap py-3">
                                <div class="col border-right">
                                    <i class="fa-solid fa-clock text-warning"></i><span class="ms-1">1 Week</span>
                                </div>
                                <div class="col border-right">
                                    <i class="fa-solid fa-calendar text-warning"></i><span class="ms-1">3 Session</span>
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="col-12 d-flex flex-nowrap justify-content-end">
                                    <button type="button" class="btn btn-sm btn-success text-uppercase">
                                        <i class="fa-regular fa-handshake"></i>
                                        Subscribe !!!
                                    </button>
                                </div>
                            </div>
                        </div>
                        <span class="label-harga">Rp. 320K</span>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?php $this->end() ?>


<?php $this->start('js') ?>
<script src="assets/js/teacher.js" async defer></script>
<?php $this->end() ?>