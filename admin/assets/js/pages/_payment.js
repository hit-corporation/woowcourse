'use strict';

const form = document.forms['form-input'];
const formSearch = document.forms['form-search'];

// get all data
const getAll = async () => {
    try
    {
        const f = await fetch(BASE_URL + '/payment/get_all');
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
            url: BASE_URL + '/payment/get_all_paginated'
        },
        pageLength: 10,
        columns: [
            {
                data: 'id',
                visible: false
            },
            {
                data: 'created_at',
				render(data, type, row, _meta){
					return moment(data).format('D MMM Y, HH:mm')
				}
            },
            {
                data: 'transaction_dt',
				render(data, type, row, _meta){
					return moment(data).format('D MMM Y, HH:mm')
				}
            },
            {
                data: 'code'
            },
			{
				data: null,
				render(data, type, row, _meta){
					return row.first_name + ' ' + row.last_name
				}
			},
            {
                data: 'amount',
				render(data, type, row, _meta){
					return new Intl.NumberFormat("id-ID", {
						style: "currency",
						currency: "IDR"
					  }).format(data);
				}
            },
            {
                data: 'payment_method'
            },
            {
                data: 'status'
            },
            {
                data: 'status_message'
            },
            {
                data: null,
                render(data, type, row, _meta)
                {
                    const btn = '<span class="d-flex flex-nowrap">' +
                                '<button role="button" class="btn-circle btn-success rounded-circle border-0 view_data"><i class="fas fa-eye"></i></button>' + 
                                '</span>';

                    return btn;
                }
            }
       ]
    });
    
    // view
    $('#table-main').on('click', 'button.view_data', e => {
        let row = tableMain.row($(e.target).parents('tr')[0]).data();
        
		$.ajax({
			type: "POST",
			url: BASE_URL + "payment/get_payment",
			data: { id: row.id },
			dataType: "JSON",
			success: function (res) {

				$('.status-transaksi').html(res.data.status + ' - ' + res.data.status_message);
				$('.transaction-code').html(res.data.code);
				$('.created-at').html(moment(res.data.created_at).format('D MMM Y, HH:mm:ss'));
				$('.transaction-dt').html(moment(res.data.transaction_dt).format('D MMM Y, HH:mm:ss'));
				$('.payment-method').html(res.data.payment_method);

				let detailContent;
				let totalHargaKursus = 0;
				for(let i=0; i<res.details.length; i++){
					totalHargaKursus += res.details[i].price;
					detailContent += `<tr>
						<td><img src="${BASE_URL.replace('/admin/','/')+`assets/files/upload/courses/` + res.details[i].course_img}" alt="" width="100"></td>
						<td>${res.details[i].course_title}</td>
						<td>${res.details[i].first_name + ' ' + res.details[i].last_name}</td>
						<td>${res.details[i].price.toLocaleString("id-ID", {style:"currency", currency:"IDR"})}</td>
					</tr>`;
				}

				$('.total_harga_kursus').html(totalHargaKursus.toLocaleString("id-ID", {style:"currency", currency:"IDR"}));
				$('.total-ppn').html((totalHargaKursus*11/100).toLocaleString("id-ID", {style:"currency", currency:"IDR"}));
				$('.amount').html(res.data.amount.toLocaleString("id-ID", {style:"currency", currency:"IDR"}));

				$('#table-body').html(detailContent);
			}
		});

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
            window.location.href = BASE_URL + 'payment/erase/' + row.id;
        });
    });

	// Search submit
    formSearch.addEventListener('submit', e => {
        e.preventDefault();
		
        // if(formSearch['s_member_name'].value)
		tableMain.columns(1).search(formSearch['s_first_name'].value).draw();
		tableMain.columns(2).search(formSearch['s_start_dt'].value).draw();
		tableMain.columns(3).search(formSearch['s_end_dt'].value).draw();
		tableMain.columns(4).search(formSearch['s_payment_method'].value).draw();
		tableMain.columns(5).search(formSearch['s_status'].value).draw();
        
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

	$('#download').click(function(e){
		let start = $('input[name="s_start_dt"]').val();
		window.open('payment/download_payment?startdt='+start, '_blank');
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
