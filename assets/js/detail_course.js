'use strict';
const detailId = document.querySelector('meta[name="detail_course"]');
const frmComment=document.forms['form-comment'];
const tableComment=document.getElementById('table-comment');
const rating = new StarRating('.star-rating');

if(frmComment !== undefined){
	frmComment.addEventListener('submit', async e => await addComment(e));
}

async function addComment(e) {
    e.preventDefault();

    try
    {
        const frmData = new FormData(e.target);
        const obj = Object.fromEntries(frmData.entries());
        
        obj['det_id'] = detailId.content; 

        const tbody = tableComment.tBodies[0];

        const f = await fetch(BASE_URL+'/rating/store', {
            method: 'POST',
            body: new URLSearchParams(obj).toString(),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });

        const j = await f.json();

        
        if(!f.ok)
        {
            Swal.fire({
                icon: 'error',
                title: '<h5 class="text-danger">ERROR</h5>',
                html: '<span class="text-danger fw-semibold">Komentar anda tidak dapat di masukan !!!</span>',
                timer: 1200
            });
            return false;
        }

		Swal.fire({
			icon: 'success',
			title: '<h5 class="text-success">Success</h5>',
			html: '<span class="text-success fw-semibold">Komentar anda berhasil di tambahkan !!!</span>',
			timer: 1200
		});

		let data = j.data;
        await setComment(tbody, data);

    }
    catch(err)
    {
        Swal.fire({
			icon: 'error',
			title: '<h5 class="text-danger">ERROR</h5>',
			html: '<span class="text-danger fw-semibold">Komentar anda tidak dapat di masukan !!!</span>',
			timer: 1200
		});
    }   
}


async function setComment(tbody, data=null) {
    const tr = tbody.insertRow();

    const td = tr.insertCell(0);
    let rateString = '';

    Array.from({ length: 5 }, (val, idx) => {
        const startLength = parseInt(data.rate);

        if((idx + 1) <= startLength)
            rateString += '<i class="fas fa-star" style="color: #FFB900"></i>';
        else
            rateString += '<i class="fas fa-star text-secondary"></i>';
    });

    const inner =   '<div class="row">' +
                        '<div class="col-12">' +
                            '<h4 class="mb-2">JAMED</h4>' +
                            '<span>' + rateString + '</span>' +
                            '<p class="my-0">'+data.comments+'</p>' +
                        '</div>' +
                    '</div>';
                    
    td.innerHTML = inner;
    rateString = null;

    // return row;
}

$.ajax({
	type: "GET",
	url: BASE_URL+"rating/get_data",
	data: {
		course_id : $('input[name="course_id"]').val()
	},
	dataType: "JSON",
	success: function (response) {
		if(response.success){
			const tr = tableComment.tBodies[0].insertRow();
			const td = tr.insertCell(0);
			let comment = '';
			$.each(response.data, function (index, value) { 
				comment += `<div class="row mb-3 border-bottom">
					<div class="col-12">
						<h4 class="mb-2">${value.first_name} - ${value.last_name}</h4>
						<span>${createStarRating(value.rate)}</span>
						<p class="my-0">${value.comments}</p>
					</div>
				</div>`;
			});

			td.innerHTML = comment;
		}
	}
});

function createStarRating(rating){
	let star = '';
	for(let i=1; i<=5; i++){
		star += (i <= rating) ? '<i class="fas fa-star" style="color: #FFB900"></i>' : '<i class="fas fa-star text-secondary"></i>';
	}
	return star;
}

// ADD TO CHART BUTTON
$('#add-to-chart').on('click', function(e){
	let courseId = $('input[name="course_id"]').val();
	let email = $('input[name="email"]').val();

	$.ajax({
		type: "POST",
		url: BASE_URL + 'cart/add',
		data: {course_id: courseId, email: email},
		dataType: "JSON",
		success: function (res) {
			if(res.success){
				Swal.fire({
					icon: 'success',
					title: '<h5 class="text-success">Success</h5>',
					html: '<span class="text-success fw-semibold">Berhasil di masukan ke daftar chart !!!</span>',
					timer: 1200
				});
			}
			location.reload();
		}
	});
});
