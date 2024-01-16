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
					timer: 3000
				});
				window.location.href = BASE_URL+'cart';
			}
		}
	});
}

let wishlistIcon = document.querySelectorAll('.wishlist-icon');
wishlistIcon.forEach(function(value, index){
	value.addEventListener('click', function(){
		$.ajax({
			type: "POST",
			url: BASE_URL+"wishlist/delete",
			data: {
				id: value.attributes.data.value
			},
			dataType: "JSON",
			success: function (res) {
				if(res.success == true){
					Swal.fire({
						icon: 'success',
						title: '<h5 class="text-success">Success</h5>',
						html: '<span class="text-success fw-semibold">Berhasil di hapus !!!</span>',
						timer: 1200
					});

					value.parentElement.parentElement.parentElement.parentElement.parentElement.remove(); // hapus card
				}
			}
		});
	});
});
