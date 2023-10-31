'use strict';

const form = document.forms['form-input'];
const formSearch = document.forms['form-search'];

// get all data
const getAll = async () => {
    try
    {
        const f = await fetch(BASE_URL + '/user/get_all');
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
            url: BASE_URL + '/user/get_all_paginated'
        },
        pageLength: 10,
        columns: [
            {
                data: 'userid',
                visible: false
            },
            {
                data: 'first_name',
            },
            {
                data: 'last_name',
            },
            {
                data: 'email',
                className: 'align-middle pl-2'
            },
            {
                data: 'user_level',
                visible: false
            },
            {
                data: 'password',
				visible: false
            },
            {
                data: 'last_login',
				visible: false
            },
			{
				data: 'active',
				render(data, type, row, _meta){
					let status = (row.active == 1) ? 'Active' : 'Inactive';
					return status
				}
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
        form.action = BASE_URL + 'user/store';

		// CREATE OPTION USER ROLE
		$.ajax({
			type: "GET",
			url: BASE_URL + "user/get_role",
			dataType: "JSON",
			success: function (response) {
				// CLEAR OPTION
				$('#role_id').empty();

				$.each(response, function (indexInArray, valueOfElement) { 
					let option = document.createElement('option');
					option.value = valueOfElement.id;
					option.text = valueOfElement.rolename;
					form['role_id'].appendChild(option);
				});
			}
		});
    });

    // update
    $('#table-main').on('click', 'button.edit_data', e => {
		// CLEAR OPTION
		$('#user_level_id').empty();

        let row = tableMain.row($(e.target).parents('tr')[0]).data();
        
        form.reset();
        form['user_id'].value = row.userid;
        form['first_name'].value = row.first_name;
        form['last_name'].value = row.last_name;
        form['email'].value = row.email;
        form['user_pass'].value = row.password;
        form['status'].value = row.active;
        form['user_level'].value = row.user_level;

		document.getElementsByName('status').forEach(el => {
			if(el.value == row.status) el.checked = true;
		});

		// CREATE OPTION USER ROLE
		// $.ajax({
		// 	type: "GET",
		// 	url: BASE_URL + "user/get_role",
		// 	dataType: "JSON",
		// 	success: function (response) {
		// 		$.each(response, function (i, val) {
		// 			let option = document.createElement('option');
		// 			option.value = val.id;
		// 			option.text = val.rolename;
		// 			form['role_id'].appendChild(option);
		// 		});

		// 		// SELECTED OPTION
		// 		$('#role_id').val(row.role_id);
		// 	}
		// });


        form.action = BASE_URL + 'user/edit';

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
            window.location.href = BASE_URL + 'user/erase/' + row.userid;
        });
    });

	// Search submit
    formSearch.addEventListener('submit', e => {
        e.preventDefault();

        // if(formSearch['s_user_name'].value) 
			tableMain.columns(1).search(formSearch['s_user_name'].value).draw();
        
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
