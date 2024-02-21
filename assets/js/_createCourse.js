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
	const maxSizeUpload = (sizeMb) => {
		if(Math.floor(input.files[0].size / 1000000) > sizeMb){
			alert(`Video tidak boleh lebih dari ${sizeMb} MB`);
			input.value = '';
			return;
		}
	}
	maxSizeUpload(100);

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

// EDIT DATA CATEGORY
const categoryId = document.getElementById('category_id').value;

let tree = new Tree('.category', {
    data: get_all_category(),
    loaded: function () {
		if(categoryId != ''){
			this.values = [categoryId];
			this.selectedNodes;
		}
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
const updateButton 	= document.getElementById('update');
const form 			= document.querySelector('form');

formAdd.addEventListener('submit', handleSubmit);

function handleSubmit(event) {
	// console.log(event);
	event.preventDefault();
	showPendingState();
	uploadFiles(event);
}

fileInput.addEventListener('change', handleInputChange);

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
  
	// document.getElementById('save').disabled = false 
	// submitButton.disabled = false;
}

function resetFormState() {
	// submitButton.disabled = true;
	updateStatusMessage(`🤷‍♂ Nothing's uploaded`)
}

function uploadFiles(e){
	// CEK KATEGORY CHECKED
	if(checked == undefined && submitButton != null){
		alert('Harap pilh salah satu kategori!');
		return;
	}

	// ketika update data biasanya checked kategori tidak di klik maka akan di isi otomatis menggunakan dom dari kategori yang sudah terselect otomatis
	if(checked == undefined){
		checked = document.getElementsByClassName('treejs-node__checked')[0].nodeId;
	}

	// HITUNG TOTAL DURASI VIDEO
	let allVideo = document.querySelectorAll('video');
	let duration = countVideoDuration(allVideo);

	// XHR and FormData instance creation is here
	let videos = $('input[data="video"]');

	let url 		= BASE_URL+"course/store";

	if(submitButton == null) url = BASE_URL+"course/update";

	const method	= 'post';
	const xhr 		= new XMLHttpRequest();
	// const data 		= new FormData(form);
	const data 		= new FormData(e.target);
	// data.append("course_title", document.getElementById('course_title').value);
	data.append("category_id", checked);
	data.append("description", btoa(document.getElementById('editor').__quill.root.innerHTML));
	data.append("duration", duration);
	
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
				}, 1000);
			}

			if(res.success == false){
				Swal.fire({
					title: "Gagal!",
					text: res.message,
					icon: "error"
				});
				setInterval(() => {
					location.reload();
				}, 1000);
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
	// submitButton.disabled = true;
	updateStatusMessage('⏳ Pending...')
}

// BUTTON ADD MORE VIDEO
let btnAddMoreVideo = document.getElementById('add-more-video');
var counter = document.querySelectorAll('input[data="video"]').length;
btnAddMoreVideo.addEventListener('click', (e) => {
	e.preventDefault();
	if(counter == 5) {
		alert('Maksimal 5 Video'); return;
	}

	$('.course-video-container').append(`<video width="300" class="" poster="${BASE_URL}assets/images/no-video.png" id="video-preview[${counter}]" src="" controls></video>
		<input name="course_video[${counter}]" id="course_video[${counter}]" onchange="changeVideo(this)" type="file" class="form-control" data="video">`);
	counter++;
});

function countVideoDuration(videos){
	let panjang = 0;
	for(let i=0; i < videos.length; i++){
		panjang += videos[i].duration;
	}
	return panjang;
}
