// =================================== QUILL JS TEXT EDITOR ===================================
var quill = new Quill('#editor', {
	theme: 'snow'
});

const formAdd = document.forms['formJamet'];

document.getElementById('editor').style.height = '200px';

// PREVIEW IMAGE COURSE
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

// PREVIEW VIDEO COURSE
let courseVideo = document.getElementById(`course_video[0]`);
// let previewVideo = document.getElementById(`video-preview[0]`);

courseVideo.addEventListener('change', function(){
	changeVideo(this);
});

function changeVideo(input){
	var reader;

	if(input.files && input.files[0]){
		reader = new FileReader();

		reader.onload = function(e){
			input.previousElementSibling.setAttribute('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
	}
}

function get_all_category(){
	let data = [];
	$.ajax({
		type: "GET",
		url: BASE_URL+"kategori/get_all",
		dataType: "JSON",
		async: false,
		success: function (res) {
			// category level 0
			$.each(res, function (index, value) { 
				if(value.parent_category == 0){
					data.push({
						id: value.id,
						text:value.category_name,
						children: []
					});
				}
			});
	
			// category level 1
			if(data[0].id != undefined){
				$.each(res, function (index, value) {
					if(data[0].id == value.parent_category){
						data[0].children.push({
							id: value.id,
							text:value.category_name,
							children: []
						});
					}
				});
			}

			// category level 2
			if(data[0].children[0].id != undefined){
				$.each(data[0].children, function (index, value) { 
					$.each(res, function (index2, value2) { 
						 if(value.id == value2.parent_category){
							data[0].children[index].children.push({
								id: value2.id,
								text: value2.category_name,
								children: []
							});
						 }
					});
				});
			}
			
		}
	});
	return data;
}

let tree = new Tree('.category', {
    data: get_all_category(),
    loaded: function () {
    }
});

// minimize treejs
let treeRoot = document.querySelector('.treejs > .treejs-nodes > .treejs-node');
treeRoot.classList.add("treejs-node__close");

// jika treejs di klik
let category = document.getElementsByClassName('treejs-placeholder');
let checked;
$.each(category, function (i, val) { 
	val.addEventListener('click', ()=>{
		checked = this.nodeId;
		let checkOne = document.querySelector('.treejs-node.treejs-placeholder.treejs-node__checked');
		if(checkOne != null){
			checkOne.classList.remove('treejs-node__checked');
		}
	});
});

// =================================== PROSES SIMPAN ===================================
const statusMessage = document.getElementById('statusMessage');
const fileInput 	= document.getElementById('course_video[0]');
const progressBar 	= document.querySelector('progress');
const submitButton 	= document.getElementById('save');
const form 			= document.querySelector('form');

formAdd.addEventListener('submit', handleSubmit);

function handleSubmit(event) {
	console.log(event);
	event.preventDefault();
	showPendingState();
	uploadFiles(event);
}

fileInput.addEventListener('change', handleInputChange);

// document.getElementById('save').addEventListener('click', async (e) => {
// 	e.preventDefault();



	
// 	form.append("course_title", document.getElementById('course_title').value);
// 	form.append("category_id", checked);
// 	form.append("description", btoa(document.getElementById('editor').__quill.root.innerHTML));
// 	form.append("image", document.getElementById('filetag').files[0]);
// 	form.append("video", document.getElementById('course_video').files[0]);
	
	// const response = await fetch(BASE_URL+"course/store", {
	// 	method: "POST",
	// 	body: formData,
	// });

	// const respon = await response.json();
	// if(respon.success == true){
	// 	Swal.fire({
	// 		title: "Sukses!",
	// 		text: "Data berhasil di simpan!",
	// 		icon: "success"
	// 	});
	// 	setInterval(() => {
	// 		window.location.href = BASE_URL+'course';
	// 	}, 2000);
	// }

// 	const url = BASE_URL+"course/store";
// 	const method = 'post';

// 	const xhr = new XMLHttpRequest();

// 	xhr.open(method, url);
// 	xhr.send(form);

// });

function updateStatusMessage(text) {
  statusMessage.textContent = text;
}

function assertFilesValid(fileList) {
	const allowedTypes = ['video/mp4'];
  
	for (const file of fileList) {
	  const { name: fileName } = file;
  
	  if (!allowedTypes.includes(file.type)) {
		throw new Error(`❌ File "${fileName}" could not be uploaded. Only images with the following types are allowed: MP4.`);
	  }
	}
}

function handleInputChange() {
	resetFormState();
	
	try {
	  assertFilesValid(fileInput.files);
	} catch (err) {
	  updateStatusMessage(err.message);
	  return;
	}
  
	document.getElementById('save').disabled = false 
	// submitButton.disabled = false;
}

function resetFormState() {
	submitButton.disabled = true;
	updateStatusMessage(`🤷‍♂ Nothing's uploaded`)
}

function uploadFiles(e){
	// CEK KATEGORY CHECKED
	if(checked == undefined){
		alert('Harap pilh salah satu kategori!');
		return;
	}

	// XHR and FormData instance creation is here
	let videos = $('input[data="video"]');

	const url 		= BASE_URL+"course/store";
	const method	= 'post';
	const xhr 		= new XMLHttpRequest();
	// const data 		= new FormData(form);
	const data 		= new FormData(e.target);
	// data.append("course_title", document.getElementById('course_title').value);
	data.append("category_id", checked);
	data.append("description", btoa(document.getElementById('editor').__quill.root.innerHTML));
	// data.append("image", document.getElementById('filetag').files[0]);
	// data.append("video", document.getElementById('course_video').files[0]);
	

	// $.each(videos, function (i, val) { 
	// 	 data.append("course_video[]", val.files[i]);
	// });
	
	// XHR and FormData instance creation along with 'loadend' listener are here
	xhr.addEventListener('loadend', () => {
		if (xhr.status === 200) {
		  updateStatusMessage('✅ Success');
		} else {
		  updateStatusMessage('❌ Error');
		}

		updateProgressBar(0);
	});

	
	xhr.upload.addEventListener('progress', event => {
		console.log(event);
		updateStatusMessage(`⏳ Uploaded ${event.loaded} bytes of ${event.total}`);
		updateProgressBar(event.loaded / event.total);
	});

	xhr.onreadystatechange = () => {
		if (xhr.readyState === 4) {
			let res = JSON.parse(xhr.response);
		  	if(res.success == true){
				Swal.fire({
					title: "Sukses!",
					text: "Data berhasil di simpan!",
					icon: "success"
				});
				setInterval(() => {
					window.location.href = BASE_URL+'course';
				}, 2000);
			}
		}
	};
	
	// XHR opening and sending is here
	xhr.open(method, url);
	xhr.send(data);
}

function updateProgressBar(value) {
	const percent = value * 100;
	progressBar.value = Math.round(percent);
}

function showPendingState() {
	submitButton.disabled = true;
	updateStatusMessage('⏳ Pending...')
}

// function handleSubmit(event) {
// 	event.preventDefault();
  
// 	// ↓ here ↓
// 	showPendingState();
  
// 	uploadFiles(event);
// }



// BUTTON ADD MORE VIDEO
let btnAddMoreVideo = document.getElementById('add-more-video');
var i = 1;
btnAddMoreVideo.addEventListener('click', (e) => {
	e.preventDefault();
	$('.course-video-container').append(`<video width="300" class="" poster="${BASE_URL}assets/images/no-video.png" id="video-preview[${i}]" src="" controls></video>
		<input name="course_video[${i}]" id="course_video[${i}]" onchange="changeVideo(this)" type="file" class="form-control" data="video">`);
	i++;
});