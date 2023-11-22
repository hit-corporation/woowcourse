// QUILL JS TEXT EDITOR
var quill = new Quill('#editor', {
	theme: 'snow'
});

document.getElementById('editor').style.height = '200px';

// PREVIEW IMAGE
let fileTag = document.getElementById('filetag');
let preview = document.getElementById('img-preview');
fileTag.addEventListener('change', function(){
	changeImage(this);
});

function changeImage(input){
	var reader;

	if(input.files && input.files[0]){
		reader = new FileReader();

		reader.onload = function(e){
			preview.setAttribute('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
	}
}

// SAVE / POST DATA
let id = document.getElementsByName('id')[0].value;
let update = document.getElementById('update');

update.addEventListener('click', async () => {
	const formData = new FormData;
	formData.append("type", 'update');
	formData.append("first_name", document.getElementById('first_name').value);
	formData.append("last_name", document.getElementById('last_name').value);
	formData.append("phone", document.getElementById('phone').value);
	formData.append("email", document.getElementById('email').value);
	formData.append("address", document.getElementById('address').value);
	formData.append("about", btoa(document.getElementById('editor').__quill.root.innerHTML));
	formData.append("image", document.getElementById('filetag').files[0]);
	formData.append("as_instructor", document.getElementById('as_instructor').checked);

	const response = await fetch(BASE_URL+"member/detail/", {
		method: "POST",
		body: formData,
	});

	const respon = await response.json();

	if(respon.success == true){
		Swal.fire({
			title: "Sukses!",
			text: respon.message,
			icon: "success"
		});
	}else{
		Swal.fire({
			title: "Gagal!",
			text: respon.message,
			icon: "error"
		});
	}
});

