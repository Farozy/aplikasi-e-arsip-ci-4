<div class="card">
	<div class="card-header">
		<div class="card-title h2 font-weight-bold">Data <?= $title; ?></div>
	</div>
	<div class="card-body">
		<button type="button" class="btn btn-primary btn-sm btn-icon-split mb-3 btnTambah">
			<span class="icon">
				<i class="far fa-plus-square"></i>
			</span>
			<span class="text">Tambah Data</span>
		</button>
		<table class="table table-bordered" cellspacing="0" width="100%" id="tJenis">
			<thead>
				<tr>
					<th width="5%">No.</th>
					<th>Jenis Dokumen</th>
					<th width="10%">Status</th>
					<th width="15%">Aksi</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
		var table = $('#tJenis').on( 'draw.dt', function () {
    		$('[data-toggle="tooltip"]').tooltip();
    	}).DataTable({
			"lengthMenu": [ [5, 10, 20, -1], [5, 10, 20, "All"] ],
			responsive: true,
			oLanguage: {
				sProcessing: "<i class='fa fa-spinner fa-spin' style='font-size:24px; color: #34495e;'></i>",
				"sSearch": "",
				"sSearchPlaceholder": "Search...",
				"sLengthMenu": "Tampilkan _MENU_ data per halaman",
				"sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
				"sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
				"sZeroRecords": "Tidak ada data yang ditemukan",
				"sInfoFiltered": "(di filter dari _MAX_ total data)",
				"sLengthMenu": 'Tampilkan <select class="form-control-sm">'+
				'<option value="5">5</option>'+
				'<option value="10">10</option>'+
				'<option value="20">20</option>'+
				'<option value="-1">All</option>'+
				'</select> data',
			},
			drawCallback: function () {
		        $('a.paginate_button').addClass('btn btn-sm rounded');
			    $('#tJenis_paginate').addClass("mt-3 mt-md-2");
			    $('#tJenis').addClass("pagination-sm");
		    },
			'processing': true,
			'serverSide': true,
			'order': [],
			'ajax': {
				'url': '<?= base_url('jenis/listData');?>',
				'type': 'post'
			},
			'columnDefs': [
				{ "orderable": false, "targets": [0, 3] },
		        { "orderable": true, "targets": [1, 2]},
                {className: "text-center align-middle", targets: [0, 1]},
                {className: "text-center align-middle pb-0", targets: [2, 3]},
			],
			drawCallback: function (settings) {
		      $('[data-toggle="tooltip"]').tooltip({
		      	"html": true,
	            "delay": {"show": 500, "hide": 0},
		      });
		    }
		})

		$('.tooltip').not(this).tooltip('hide');
		$('div.dataTables_filter input').focus()

		$('thead tr th').addClass("bg-dark text-white").css("font-size", "0.85rem");
		$('thead tr th').removeClass("pb-0");

		$('tfoot tr th').addClass("bg-dark text-white").css("font-size", "0.85rem");
		$('tfoot tr th').removeClass("pb-0");

		$('#tJenis_wrapper .col-md-6:eq(0)').addClass("align-self-end");

		$('#tJenis_wrapper .col-md-6:eq(1)').addClass("align-self-end");

		$('#tJenis_filter input').addClass('form-control-sm');

		$('.btnTambah').click(function() {
			$.ajax({
				url: '<?= base_url('jenis/create');?>',
				dataType: 'json',
				success: function(response) {
					$('.viewModal').html(response.data);
					$('#addModal').modal({backdrop: "static"});
					$('#addModal').modal('show');
				},
				error: function( xhr, ajaxOptions, thrownError ) {
					alert( xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
				}
			})
		})
	})

	function edit(id) {
		$.ajax({
			url: '<?= base_url('jenis/edit');?>',
			type: 'post',
			data: {
				id: id
			},
			dataType: 'json',
			success: function(response) {
				$('.viewModal').html(response.data);
				$('#editModal').modal({backdrop: "static"});
				$('#editModal').modal('show');
			},
			error: function( xhr, ajaxOptions, thrownError ) {
				alert( xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
			}
		})
	}

	function hapus(id) {
		Swal.fire({
			icon: 'warning',
			title: 'Yakin... ?',
			text: "Data akan dihapus secara permanen !",
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus data ini!',
			cancelButtonText: 'Batal',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '<?= base_url('jenis/hapus');?>',
					type: 'post',
					data: {
						id: id
					},
					dataType: 'json',
					success: function(response) {
						Swal.fire({
							icon: 'success',
							title: 'Data berhasil dihapus',
							showConfirmButton: false,
							timer: 1500
						})
						$('.viewData').html(response.data);
					},
					error: function( xhr, ajaxOptions, thrownError ) {
						alert( xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
					}
				})
			}
		})
	}

	function nonActive(id) {
		$.ajax({
			url: '<?= base_url('jenis/toggle');?>',
			type: 'post',
			data: {
				id: id
			},
			dataType: 'json',
			success: function(response) {
				$('.viewData').html(response.data);
			},
			error: function( xhr, ajaxOptions, thrownError ) {
				alert( xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
			}
		})
	}

	function active(id) {
		$.ajax({
			url: '<?= base_url('jenis/toggle');?>',
			type: 'post',
			data: {
				id: id
			},
			dataType: 'json',
			success: function(response) {
				$('.viewData').html(response.data);
			},
			error: function( xhr, ajaxOptions, thrownError ) {
				alert( xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
			}
		})
	}
</script>
