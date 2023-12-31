'use strict';

const form = document.forms['form-input'];
const formSearch = document.forms['form-search'];

// get all data
const getAll = async () => {
    try
    {
        const f = await fetch(BASE_URL + '/member/get_all');
        const j = await f.json();

        return j;
    }   
    catch(err)
    {
        console.log(err);
    }    
}

// INIT
(async ($) => {
    const allData = await getAll();

    // Datatable
    const tableMain = $('#table-main').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: BASE_URL + '/member/get_all_paginated'
        },
        pageLength: 10,
        columns: [
            {
                data: 'id',
                visible: false
            },
            {
                data: 'first_name'
            },
            {
                data: 'last_name'
            },
            {
                data: 'email'
            },
            {
                data: 'phone'
            },
            {
                data: 'last_login_date'
            },
            {
                data: null,
                render(data, type, row, _meta)
                {
                    const btn = '<span class="d-flex flex-nowrap">' +
                                '<button role="button" class="btn-circle btn-success rounded-circle border-0 edit_data"><i class="fas fa-edit"></i></button>' + 
                                '<button role="button" class="btn-circle btn-danger rounded-circle border-0 delete_data"><i class="fas fa-trash"></i></button>' + 
                                '</span>';

                    return btn;
                }
            }
       ]
    });
    

    // store
    document.getElementById('btn-add').addEventListener('click', e => {
        form.reset();
        form.action = BASE_URL + 'member/store';

    });

    // update
    $('#table-main').on('click', 'button.edit_data', e => {
        let row = tableMain.row($(e.target).parents('tr')[0]).data();
        
        form.reset();
        form['id'].value = row.id;
        form['first_name'].value = row.first_name;
        form['last_name'].value = row.last_name;
        form['email'].value = row.email;
        form['phone'].value = row.phone;

        form.action = BASE_URL + 'member/edit';

        $('#modal-input').modal('show');
    });

	// delete
    $('#table-main').on('click', 'button.delete_data', e => {

        Swal.fire({
            icon: 'warning',
            title: '<h4 class="text-warning">Apakah anda yakin !?</h4>',
            html: '<h5 class="text-warning">Data yang di hapus tidak dapat di kembalikan.</h5>',
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        })
        .then(t => {
          
            if(!t.value) 
                return;

            let row = tableMain.row($(e.target).parents('tr')[0]).data();
            loading();
            window.location.href = BASE_URL + 'member/erase/' + row.id;
        });
    });

	// Search submit
    formSearch.addEventListener('submit', e => {
        e.preventDefault();
		
        // if(formSearch['s_member_name'].value)
		tableMain.columns(1).search(formSearch['s_first_name'].value).draw();
		tableMain.columns(2).search(formSearch['s_email'].value).draw();
        
    });

	// search reset
	formSearch.addEventListener('reset', e => {
		e.preventDefault();
		tableMain.columns(1).search('').draw();
		formSearch['s_member_name'].value = '';

		tableMain.columns(2).search('').draw();
		formSearch['s_card_number'].value = '';

		tableMain.columns(3).search('').draw();
		formSearch['s_no_induk'].value = '';

	});

})(jQuery);

const loading = () => {
    Swal.fire({
        html: 	'<div class="d-flex flex-column align-items-center">'
        + '<span class="spinner-border text-primary"></span>'
        + '<h3 class="mt-2">Loading...</h3>'
        + '<div>',
        showConfirmButton: false,
        width: '10rem'
    });
}

// Prevent Automatic Submit when press enter
window.addEventListener('keypress', e => {
    const el = e.target;

    if(e.code.toLowerCase() == 'enter')
        e.preventDefault();
});
