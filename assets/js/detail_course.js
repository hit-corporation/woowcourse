'use strict';

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
        
        const tbody = tableComment.tBodies[0];

        const f = await fetch('/');

    }
    catch(err)
    {

    }   
}


async function setComment(tbody, data=null) {
    const tr = tbody.insertRow();

    const td = tr.insertCell(0);
    let rateString = '';

    Array.from({ length: 5 }, (val, idx) => {
        const startLength = parseInt(data.rating);

        if((idx + 1) <= startLength)
            rateString += '<i class="fas fa-star text-primary"></i>';
        else
            rateString += '<i class="fas fa-star text-secondary"></i>';
    });

    const inner =   '<div class="row">' +
                        '<div class="col-12">' +
                            '<h4 class="mb-2">JAMED</h4>' +
                            '<span>' + rateString + '</span>' +
                            '<p class="my-0">'+data['text-review']+'</p>' +
                        '</div>' +
                    '</div>';
                    
    td.innerHTML = inner;
    rateString = null;

    return row;
}


