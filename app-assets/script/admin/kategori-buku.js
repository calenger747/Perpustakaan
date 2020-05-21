$(document).ready(function(){
	var kategori = $('#kategori_buku').DataTable({
		"lengthMenu": [10, 20, 50],
		"pageLength": 10,
		"serverSide": true,
		"processing": true,
		"order": [[1, "asc" ]],
		"ajax":{
			url :  'http://localhost/Perpustakaan/DataTables/showKategori',
			type : 'POST'
		},
		"columnDefs": [
		{ 
	        "targets": [ 0 ], //first column / numbering column
	        "orderable": false, //set not orderable
	    },
	    { 
	        "targets": [ 2 ], //first column / numbering column
	        "orderable": false, //set not orderable
	    }],
	});

	// Untuk sunting Kategori
	$('#myEditKategori').on('show.bs.modal', function(event) {
	    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
	    var modal = $(this)

	    // Isi nilai pada field
	    modal.find('#edit_id').attr("value", div.data('id_kategori'));
	    modal.find('#edit_nama').attr("value", div.data('nama'));
	    // modal.find('#edit_remarks').attr("value", div.data('remarks'));
	    // modal.find('#edit_payment').attr("value", div.data('payment'));
	    // modal.find('#edit_date').attr("value", div.data('date'));
	    // modal.find('#email').attr("value", div.data('email'));
	    // modal.find('#no_telp').attr("value", div.data('no_telepon'));
	    // $('.select2_single option[value="'+level+'"]').attr('selected','selected');
	});

	// Add Kategori
	$('#addTextKategori').html('Save');
	$('#addKategori').on('submit', function(e){  
		e.preventDefault();  
		$('#addTextKategori').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');

		$.ajax({  
			url:"http://localhost/Perpustakaan/Dashboard_Admin/addKategori",   
			method:"POST",  
			data:new FormData(this),  
			contentType: false,  
			cache: false,  
			processData:false,  
			dataType: "json",
			success:function(res)  
			{  
				console.log(res.error);
				$('#addTextKategori').html('Save');
				if(res.error == false){  
					swal({
						title: "Success!",
						text: res.message,
						type: "success",
						timer: 1000,
						buttons: false,
					});
				}
				else if(res.error == true){
					swal({
						title: "Failed!",
						text: res.message,
						type: "error",
					});
				}
				$('#addKategori')[0].reset();
				$('#myAddkategori').modal('hide');
				kategori.ajax.reload();
			}  
		});  
	});

	// Edit Kategori
	$('#editTextKategori').html('Save');
	$('#editKategori').on('submit', function(e){  
		e.preventDefault();  
		$('#editTextKategori').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');

		$.ajax({  
			url:"http://localhost/Perpustakaan/Dashboard_Admin/editKategori",   
			method:"POST",  
			data:new FormData(this),  
			contentType: false,  
			cache: false,  
			processData:false,  
			dataType: "json",
			success:function(res)  
			{  
				console.log(res.error);
				$('#editTextKategori').html('Save');
				if(res.error == false){  
					swal({
						title: "Success!",
						text: res.message,
						type: "success",
						timer: 1000,
						buttons: false,
					});
				}
				else if(res.error == true){
					swal({
						title: "Failed!",
						text: res.message,
						type: "error",
					});
				}
				$('#editKategori')[0].reset();
				$('#myEditKategori').modal('hide');
				kategori.ajax.reload();
			}  
		});  
	});

	// Delete Kategori
	$('#kategori_buku').on('click','.hapus-kategori', function(){
		var id =  $(this).data('id_kategori');
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this data!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Delete',
		}).then(function(result) {
			if (result.value) {
				$.ajax({
					url: "http://localhost/Perpustakaan/Dashboard_Admin/deleteKategori/" + id,  
					method: "GET",
					beforeSend :function() {
						swal({
							title: 'Please Wait',
							html: 'Deleting data',
							onOpen: () => {
								swal.showLoading()
							}
						})      
					},
					success:function(data){
						swal({
							title: "Deleted!",
							type: "success",
							text: "Data has been deleted!",
							timer: 1000,
							buttons: false,
						});
						kategori.ajax.reload();
					}
				});
			}
		})
	});
});