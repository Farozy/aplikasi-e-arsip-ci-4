<style>
	table tr td {
		color:  black;
	}
</style>
<div class="card">
	<div class="card-header">
		<div class="card-title h2 font-weight-bold">Data <?= $title; ?></div>
	</div>
	<div class="card-body">
<!-- 		<a href="user/create" class="btn btn-primary btn-sm btn-icon-split mb-3">
			<span class="icon">
				<i class="fa fa-plus-circle"></i>
			</span>
			<span class="text">Tambah Data</span>
		</a> -->
		<table class="table table-striped table-bordered display compact nowrap" cellspacing="0" width="100%" id="tUser">
			<thead>
				<tr>
					<th>No.</th>
					<th>Username</th>
					<th>Email</th>
					<th>Role</th>
					<th>Status</th>
					<th width="18%">Aksi</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>No.</th>
					<th>Username</th>
					<th>Email</th>
					<th>Role</th>
					<th>Status</th>
					<th width="18%">Aksi</th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
		var table = $('#tUser').on( 'draw.dt', function () {
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
			    $('#tUser_paginate').addClass("mt-3 mt-md-2");
			    $('#tUser').addClass("pagination-sm");
		    },
			'processing': true,
			'serverSide': true,
			'order': [],
			'ajax': {
				'url': '<?= base_url('user/listData');?>',
				'type': 'post'
			},
			'columnDefs': [
				{ "orderable": false, "targets": [0, 3, 4, 5] },
		        { "orderable": true, "targets": [1, 2]},
                {className: "text-center align-middle", targets: '_all'},
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

		$('#tUser_wrapper .col-md-6:eq(0)').addClass("align-self-end");

		$('#tUser_wrapper .col-md-6:eq(1)').addClass("align-self-end");

		$('#tUser_filter input').addClass('form-control-sm');

	})

	function detail(id) {
		$.ajax({
			url: '<?= base_url('user/detail');?>',
			type: 'post',
			data: {
				id: id
			},
			dataType: 'json',
			success: function(response) {
				$('.viewModal').html(response.data);
				$('#detailModal').modal({backdrop: "static"});
				$('#detailModal').modal('show');
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
					url: '<?= base_url('user/hapus');?>',
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
						.then((result) => {
							if( result ) {
								$('.viewData').html(response.data);
							} 
						})
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
			url: '<?= base_url('user/toggle');?>',
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
			url: '<?= base_url('user/toggle');?>',
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
