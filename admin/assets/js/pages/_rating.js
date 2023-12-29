const formSearch = document.forms['form-search'];

let table = $('#table-main').DataTable({
	serverSide: true,
	processing: true,
	ajax: {
		url: BASE_URL + 'rating/get_all_paginated'
	},
	columns: [
		{data: 'id', visible: false},
		{data: 'course_code'},
		{
			data: 'course_img',
			render(data, type, row, _meta){
				return `<img src="${BASE_URL.replace('/admin/','/')+`assets/files/upload/courses/`+data}" width="100" >`;
			}
		},
		{data: 'course_title'},
		{data: 'first_name'},
		{data: 'last_name'},
		{data: 'category_name'},
		{data: 'tanggal_rating'},
		{data: 'rate'},
		{data: 'comments'},
		{
			data: false,
			render(data, type, row, _meta){
				return `<button class="btn btn-sm btn-danger" onClick="hapus(${row.id}, '${row.course_code}')"><i class="fa fa-trash"></i></button>`;
			}
		},
	]
});

// Search submit
formSearch.addEventListener('submit', e => {
	e.preventDefault();
	// if(formSearch['s_member_name'].value)
	table.columns(0).search(formSearch['s_course_title'].value).draw();
	table.columns(1).search(formSearch['s_instructor'].value).draw();
	table.columns(2).search(formSearch['s_category'].value).draw();
});

function hapus(id, code){
	$.ajax({
		type: "POST",
		url: BASE_URL + "rating/delete",
		data: {
			comment_id: id,
			course_code: code,
		},
		dataType: "JSON",
		success: function (res) {
			if(res.success == true){
				Swal.fire({
					title: "Sukses!",
					text: res.message,
					icon: "success"
				});
				setInterval(() => {
					window.location.href = BASE_URL+'rating';
				}, 2000);
			}
		}
	});
}

// HIDE DEFAULT SEARCH DATA TABLE
document.querySelector('.dataTables_filter').style.display = 'none';

// SELECT 2 CATEGORY
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
