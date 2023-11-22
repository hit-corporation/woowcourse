const BASE_URL = document.querySelector('base').href;

let items = document.querySelectorAll('.nav-item[data]');
items.forEach((value, key) => {
	value.addEventListener('click', function(e){
		e.preventDefault();

		if(value.nextElementSibling.style.display === 'none'){
			value.nextElementSibling.style.display = 'block';
		}else{
			value.nextElementSibling.style.display = 'none';
		}
	});
});

function categoryClick(id){
	localStorage.setItem('category', id);
}

function logout(){
	Swal.fire({
		title: "Anda yakin keluar aplikasi?",
		// text: "You won't be able to revert this!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes"
	  }).then((result) => {
		if (result.isConfirmed) {
		  Swal.fire({
			title: "Logout!",
			text: "Anda berhasil keluar aplikasi.",
			icon: "success"
		  });
		  setInterval(()=>{
			  window.location.href = BASE_URL+'login/logout';
		  }, 3000);
		}
	  });
}
