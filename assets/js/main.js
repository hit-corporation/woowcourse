const BASE_URL = document.querySelector('base').href;

let items = document.querySelectorAll('.nav-item[data]');
items.forEach((value, key) => {
	value.addEventListener('click', function(e){
		//let valueOnHover = value.attributes.data.value;

		// [...CATEGORIES].forEach((val) => {
		// 	if(valueOnHover == val.id){
		// 		console.log(val.child);
		// 	}
		// });
		e.preventDefault();

		if(value.nextElementSibling.style.display === 'none'){
			value.nextElementSibling.style.display = 'block';
		}else{
			value.nextElementSibling.style.display = 'none';
		}
	});
});
