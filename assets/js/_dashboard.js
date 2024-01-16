function isiKategori(id){
	localStorage.setItem('category', id);
}

// $('#btn-chart').click(function(e){
// 	let listChart = $('#list-chart');
// 	if(listChart.hasClass('d-none')){
// 		listChart.addClass('d-block');
// 		listChart.removeClass('d-none')
// 	}else{
// 		listChart.removeClass('d-block');
// 		listChart.addClass('d-none');
// 	}
// });

$('#btn-search').on('click', function(){
	window.location.href = 'course/index';
});

let wishlistIcon = document.querySelectorAll('.wishlist-icon');
wishlistIcon.forEach(function(value, key, arr){
	
	value.addEventListener('click', function(){
		$.ajax({
			type: "POST",
			url: BASE_URL + "wishlist/store",
			data: {
				id: value.attributes.data.value
			},
			dataType: "JSON",
			success: function (res) {
				if(res.success == false){
					Swal.fire({
						icon: 'warning',
						title: '<h5 class="text-success">Warning</h5>',
						html: `<span class="text-success fw-semibold">${res.message}</span>`,
						timer: 3000
					});
				}

				if(res.success == true){
					Swal.fire({
						icon: 'success',
						title: '<h5 class="text-success">Sukses</h5>',
						html: `<span class="text-success fw-semibold">${res.message}</span>`,
						timer: 3000
					});
				}

				setInterval(function(){
					location.reload();
				}, 1500);
			}
		});
	});
});
