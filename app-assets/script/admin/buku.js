$(document).ready(function(){
	App.init();

	$("#add_kategori").select2({
		dropdownParent: $('#myAddBuku')
	});

	var buku = $('#buku').DataTable({
		"lengthMenu": [10, 20, 50],
		"pageLength": 10,
		"serverSide": true,
		"processing": true,
		"order": [[1, "asc" ]],
		"ajax":{
			url :  'http://localhost/Perpustakaan/DataTables/showBuku',
			type : 'POST'
		},
		"columnDefs": [
		{ 
	        "targets": [ 0 ], //first column / numbering column
	        "orderable": false, //set not orderable
	    },
	    { 
	        "targets": [ 1 ], //first column / numbering column
	        "orderable": false, //set not orderable
	    },
	    { 
	        "targets": [ 5 ], //first column / numbering column
	        "orderable": false, //set not orderable
	    },
	    ],
	});

	// Validasi file upload
	$(".gambar").change(function() {
		if (this.files && this.files[0] && this.files[0].name.match(/\.(jpg|jpeg|png|JPG|JPEG|PNG)$/) ) {
			if(this.files[0].size>10485760) {
				$('.gambar').val('');
				alert('Batas Maximal Ukuran File 10MB !');
			}
			else {
				var reader = new FileReader();
				reader.readAsDataURL(this.files[0]);
			}
		} else{
			$('.gambar').val('');
			alert('Hanya File jpg/png Yang Diizinkan !');
		}
	});

	// Untuk sunting Kategori
	$('#myEditBuku').on('show.bs.modal', function(event) {
	    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
	    var modal = $(this)

	    // Isi nilai pada field
	    modal.find('#edit_id').attr("value", div.data('id_buku'));
	    modal.find('#edit_kode').attr("value", div.data('kode'));
	    // modal.find('#edit_remarks').attr("value", div.data('remarks'));
	    // modal.find('#edit_payment').attr("value", div.data('payment'));
	    // modal.find('#edit_date').attr("value", div.data('date'));
	    // modal.find('#email').attr("value", div.data('email'));
	    // modal.find('#no_telp').attr("value", div.data('no_telepon'));
	    // $('.select2_single option[value="'+level+'"]').attr('selected','selected');
	});

	// Add Kategori
	$('#addTextBuku').html('Save');
	$('#addBuku').on('submit', function(e){  
		e.preventDefault();  
		$('#addTextBuku').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');

		$.ajax({  
			url:"http://localhost/Perpustakaan/Dashboard_Admin/addBuku",   
			method:"POST",  
			data:new FormData(this),  
			contentType: false,  
			cache: false,  
			processData:false,  
			dataType: "json",
			success:function(res)  
			{  
				console.log(res.error);
				$('#addTextBuku').html('Save');
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
				$('#addBuku')[0].reset();
				$('#myAddBuku').modal('hide');
				buku.ajax.reload();
			}  
		});  
	});

	// Edit Kategori
	$('#editTextBuku').html('Save');
	$('#editBuku').on('submit', function(e){  
		e.preventDefault();  
		$('#editTextKategori').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');

		$.ajax({  
			url:"http://localhost/Perpustakaan/Dashboard_Admin/editBuku",   
			method:"POST",  
			data:new FormData(this),  
			contentType: false,  
			cache: false,  
			processData:false,  
			dataType: "json",
			success:function(res)  
			{  
				console.log(res.error);
				$('#editTextBuku').html('Save');
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
				$('#editBuku')[0].reset();
				$('#myEditBuku').modal('hide');
				buku.ajax.reload();
			}  
		});  
	});

	// Delete Kategori
	$('#buku').on('click','.hapus-buku', function(){
		var id =  $(this).data('id_buku');
		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this data!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Delete',
		}).then(function(result) {
			if (result.value) {
				$.ajax({
					url: "http://localhost/Perpustakaan/Dashboard_Admin/deleteBuku/" + id,  
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
						buku.ajax.reload();
					}
				});
			}
		})
	});
});