// =================================== QUILL JS TEXT EDITOR ===================================
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

// =================================== TREE JS ===================================
	// let data = [{ 
	//     "id": "1", 
	//     "text": "node-1", 
	//     "children": [
	// 		{ 
	// 			"id": "1-1", 
	// 			"text": "node-1-1", 
	// 			"children": [
	// 				{ 
	// 					"id": "1-1-1", 
	// 					"text": "node-1-1-1" 
	// 				},{ 
	// 					"id": "1-1-2", 
	// 					"text": "node-1-1-2" 
	// 				}] 
	// 		}]
	// 	}]

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
    // root data
    // data: [{ id: '0', text: 'root', children: data }],
    data: get_all_category(),
    loaded: function () {
      	// pre-selected nodes
    	// this.values = ['1-1-1', '1-1-2'];
      	// output selected nodes and values
      	// console.log(this.selectedNodes)
      	// console.log(this.values)
      	// disabled nodes
    	// this.disables = ['1-1-1', '1-1-1', '1-1-2']
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
