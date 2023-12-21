'use strict';
const detailId = document.querySelector('meta[name="detail_course"]');
const frmComment=document.forms['form-comment'];
const tableComment=document.getElementById('table-comment');
const rating = new StarRating('.star-rating');

frmComment.addEventListener('submit', async e => await addComment(e));

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


