'use strict';
const navBottom = document.querySelector('#nav-bottom');
var checked = [];

var arrPage = [];
$(document).ready(function () {
	load_data(1,10);
	// ########################## PAGINATION JS ##############################
	$('#demo').pagination({
		// dataSource: [1, 2, 3, 4, 5, 6, 7, 8,9,10,11,12,13,14,15,16,17,18,19,20],
		dataSource: arrPage,
		className: 'paginationjs-theme-blue paginationjs-big',
		callback: function(data, pagination) {
			// template method of yourself
			// var html = template(data);
			// dataContainer.html(html);
			load_data(pagination.pageNumber);
		}
	})
});

// KETIKA BUTTON CARI DI KLIK
$('#btn-search').on('click', function(e){
	checkCategory(); // untuk mengisi kategori yang di centang
	load_data();
});

// create function load data
function load_data(page = 1, limit = 10){
	let title = $('input[name="cari"]').val();
	let categoryMenuClick = [];

	// JIKA MENU KATEGORY DI KLIK MAKA AMBIL DATA ID KATEGORY DARI LOCAL STORAGE
	categoryMenuClick = localStorage.getItem('category');

	if(categoryMenuClick){
		checked.push(categoryMenuClick);
		localStorage.removeItem('category');
	}

	console.log(checked);

	$.ajax({
		type: "GET",
		url: BASE_URL+"course/get_all",
		async: false,
		data: {
			page: page,
			limit: limit,
			title: title,
			categories: checked,
		},
		success: function (response) {
			$('#list-course').html('');
			if(response.data.length !== 0){
				$.each(response.data, function (key, value){
					$('#list-course').append(`
						<div class="col-12 col-md-4 col-lg-4 py-1">
							<div class="card position-relative d-lg-flex flex-nowrap">
								<img class="img-fluid" src="assets/images/sm2.jpg">
								<div class="card-body">
									<h5 class="text-uppercase text-shadow">${value.course_title}</h5>
									<div class="pt-1">
										<span>
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
								<span class="label-harga">Rp. <?=number_format($val['price'])?></span>
							</div>
						</div>`);
				});
			}else{
				$('#list-course').append(`<h4 class="text-center">Data Tidak Ditemukan</h4>`);
			}

			// ########################## PAGINATION JS ##############################
			for(let i=1; i<=response.total_records; i++){
				arrPage.push(i);
			}
		}
	});
}

// GET CATEGORY CHECK
function checkCategory(){
	checked = [];
	let categoriesCheck = document.querySelector('#categories-check');
	[...categoriesCheck.children].forEach((item, index) => {
		if(item.firstElementChild.checked == true){
			checked.push(parseInt(item.firstElementChild.value));
		}
	});
}


