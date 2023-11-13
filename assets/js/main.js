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
