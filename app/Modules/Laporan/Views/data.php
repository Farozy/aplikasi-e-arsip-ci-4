<style>
	table.dataTable th {
		font-size: 14px;
	}
	table.dataTable td {
		font-size: 12px;
	}
	#detail {
		cursor: pointer;
		text-transform: uppercase;
		transition: .5;
	}
	#detail:hover {
		color:  blue;
		text-decoration: underline;
	}
</style>

<div class="card">
	<div class="card-header">
		<div class="card-title h2 font-weight-bold">Data <?= $title; ?></div>
	</div>
	<div class="card-body">
		<a href="<?= base_url('dokumen/create'); ?>" class="btn btn-primary btn-sm btn-icon-split mb-3">
			<span class="icon">
				<i class="far fa-plus-square"></i>
			</span>
			<span class="text">Tambah Data</span>
		</a>
		<table class="table table-bordered" cellspacing="0" width="100%" id="tDokumen">
			<thead>
				<tr>
					<th width="5%">No.</th>
					<th>Jenis</th>
					<th>No. Dokumen</th>
					<th>Tahun</th>
					<th>Nama</th>
					<th>Ukuran (Kb)</th>
					<th>Tgl Upload</th>
					<th>Total Download</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
		var table = $('#tDokumen').on( 'draw.dt', function () {
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
				$('#tDokumen_paginate').addClass("mt-3 mt-md-2");
				$('#tDokumen').addClass("pagination-sm");
			},
			'processing': true,
			'serverSide': true,
			'order': [],
			'ajax': {
				'url': '<?= base_url('laporan/listData');?>',
				'type': 'post'
			},
			'columnDefs': [
			{ "orderable": false, "targets": [0, 1, 5, 7] },
			{ "orderable": true, "targets": [2, 3, 4, 6]},
			{className: "text-center align-middle", targets: '_all'},
                // {className: "text-center align-middle pb-0", targets: [2, 3]},
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

		$('#tDokumen_wrapper .col-md-6:eq(0)').addClass("align-self-end");

		$('#tDokumen_wrapper .col-md-6:eq(1)').addClass("align-self-end");

		$('#tDokumen_filter input').addClass('form-control-sm');
	})
</script>
