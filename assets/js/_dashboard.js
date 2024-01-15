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

