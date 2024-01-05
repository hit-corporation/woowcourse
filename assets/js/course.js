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

	$.ajax({
		type: "GET",
		url: BASE_URL+"course/get_all",
		async: false,
		data: {
			page: page,
			limit: limit,
			title: title,
			categories: checked,
			ratingChecked: ratingCheck()
		},
		success: function (response) {
			$('#list-course').html('');
			if(response.data.length !== 0){
				$.each(response.data, function (key, value){
					$('#list-course').append(`
						<div class="col-12 col-md-4 col-lg-4 py-1">
							<div class="card position-relative flex-nowrap" id="card-course">
								<img height="150" class="" src="${BASE_URL+'assets/files/upload/courses/'+value.course_img}">
								<div class="card-body">
									<h5 class="text-uppercase text-shadow title-card"><a class="text-decoration-none" href="${BASE_URL+'course/detail/'+value.id}">${value.course_title}</a></h5>
									
									<div class="row w-100 d-flex flex-nowrap align-items-center mb-2">
										<span class="col-4 border-end pe-2">
											<img width="35" class=" teacher-icon rounded-circle border-1 shadow-sm" src="${BASE_URL+`assets/images/members/`+value.photo_instructor}" style="">
										</span>
										<span class="col-8 ms-2">
											<h6 class="text-capitalize text-secondary fw-normal text-shadow">${value.first_name+` `+value.last_name}</h6>
										</span>
									</div>
									
									<div class="pt-1">
										<span>
											<i class="fa fa-star text-primary"></i>
											<span>${(value.rating != null) ? value.rating : 0}</span>
										</span>
									</div>
									<span class="mt-3 label-harga">${new Intl.NumberFormat('id-ID', {style: "currency", currency: "IDR"}).format(value.price)}</span>
									<div class="d-flex flex-nowrap py-3">
										<div class="col border-right">
											<i class="fa-solid fa-clock text-warning"></i><span class="ms-1">1 Week</span>
										</div>
										<div class="col border-right">
											<i class="fa-solid fa-calendar text-warning"></i><span class="ms-1">${value.total_video} Videos</span>
										</div>
										
									</div>
									
									<div class="row px-2">
										<div class="col-12 d-flex flex-nowrap justify-content-end ps-2">
											<button id="btn-subscribe" type="button" class="btn btn-sm btn-success text-uppercase">
												<i class="fa-regular fa-handshake"></i>
												Subscribe !!!
											</button>
										</div>
									</div>
								</div>
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
	return checked;
}

// CHECKED RATING
function ratingCheck(){
	let rating = document.querySelectorAll('.form-check-input.rating-check');
	let ratingChecked = [];
	rating.forEach((val, key) => {
		if(val.checked == true){
			ratingChecked.push(val.value);
		}
	});
	return ratingChecked;
}
