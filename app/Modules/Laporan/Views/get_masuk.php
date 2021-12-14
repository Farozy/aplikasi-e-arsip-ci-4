<div class="card-body">
	<table class="table table-bordered" id="tPemasukan">
		<thead class="thead-dark">
			<tr>
				<th width="5%">No.</th>
				<th>Tanggal & jam</th>
				<th>No. Surat</th>
				<th>Sifat Surat</th>
				<th>Pengirim</th>
				<th>Disposisi Saat Ini</th>
			</tr>
		</thead>
		<tbody>
			<?php if( $unit != null ) : ?>
				<?php
				$no = 1;
				foreach( $masuk as $row ) : ?>
					<tr>
						<td class="text-center"><?= $no++; ?></td>
						<td><?= date("d-m-Y", strtotime($row['tanggal'])); ?>/<?= date('H:i:s', strtotime($row['created_date'])); ?></td>
						<td><?= ucwords($row['no_surat']); ?></td>
						<td><?= ucfirst($row['sifat_surat']); ?></td>
						<td><?= ucwords($row['pengirim']); ?></td>
						<td>
							<?php if( $row['unit_kerja_id'] == false ) : ?>
								<button type="button" class="btn btn-secondary btn-sm rounded-circle" style=" padding: .30rem .30rem; font-size: .725rem; line-height: .5;"><i class="fas fa-location-arrow"></i></button> Menunggu Disposisi
							<?php else: ?>
								<button type="button" class="btn btn-success btn-sm rounded-circle" style=" padding: .30rem .30rem; font-size: .725rem; line-height: .5;"><i class="far fa-check-circle"></i></button> <?= ucwords($unit['nama_unit_kerja']); ?>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<?php
				$no = 1;
				foreach( $data_masuk as $row ) : ?>
					<tr>
						<td class="text-center"><?= $no++; ?></td>
						<td><?= date("d-m-Y", strtotime($row['tanggal'])); ?>/<?= date('H:i:s', strtotime($row['created_date'])); ?></td>
						<td><?= ucwords($row['no_surat']); ?></td>
						<td><?= ucfirst($row['sifat_surat']); ?></td>
						<td><?= ucwords($row['pengirim']); ?></td>
						<td>
							<?php if( $row['unit_kerja_id'] == false ) : ?>
								<button type="button" class="btn btn-secondary btn-sm rounded-circle" style=" padding: .30rem .30rem; font-size: .725rem; line-height: .5;"><i class="fas fa-location-arrow"></i></button> Menunggu Disposisi
							<?php else: ?>
								<button type="button" class="btn btn-success btn-sm rounded-circle" style=" padding: .30rem .30rem; font-size: .725rem; line-height: .5;"><i class="far fa-check-circle"></i></button>
								<?php foreach( $unit_kerja as $un ) : ?>
									<?php if( $un['id_unit_kerja'] == $row['unit_kerja_id'] ) : ?>
										<?= ucwords($un['nama_unit_kerja']); ?>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<?php if(! empty( $masuk )) : ?>
		<!-- <button type="button" class="btn btn-sm btn-primary" id="printPemasukan" onclick="print_pemasukan('')"><i class="fas fa-print"></i> Cetak Data Pemasukan</button> -->
	<?php endif; ?>
</div>

<script>
	$(function() {
		var table = $('#tPemasukan').DataTable({
			"lengthMenu": [ [5, 10, 20, -1], [5, 10, 20, "All"] ],
			responsive: true,
			"info": false,
			oLanguage: {
				sProcessing: "<i class='fa fa-spinner fa-spin' style='font-size:24px; color: #34495e;'></i>",
				"sSearch": "",
				"sSearchPlaceholder": "Search...",
				"sLengthMenu": "Tampilkan _MENU_ data per halaman",
				"sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
				"sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
				"sZeroRecords": "Belum ada surat masuk",
				"sInfoFiltered": "(di filter dari _MAX_ total data)",
				"sInfoFiltered": "",
				"sLengthMenu": 'Tampilkan <select class="form-control-sm">'+
				'<option selected value="5">5</option>'+
				'<option value="10">10</option>'+
				'<option value="20">20</option>'+
				'<option value="-1">All</option>'+
				'</select> data',
			},
			drawCallback: function () {
		        $('a.paginate_button').addClass('btn btn-sm rounded');
			    $('#Gedung_paginate').addClass("mt-3 mt-md-2");
			    $('#tDataPembayaran_paginate').addClass("pagination-sm");
		    },
			'columnDefs': [
		        {"orderable": true, "targets": [0, 1, 2, 3] },
                {className: "text-center align-middle", targets: [0, 1, 2, 3]},
			],
		})

		$('div.dataTables_filter input').focus()

		table.buttons().container().addClass("justify-content-center justify-content-md-start mb-3");
		table.buttons().container().prependTo( '#tDataPembayaran_wrapper .col-12:eq(0)' );

		$('thead tr th').addClass("bg-dark text-white").css("font-size", "0.85rem");
		$('thead tr th').removeClass("pb-0");

		$('#tDataPembayaran_wrapper .col-md-6:eq(0)').addClass("align-self-end");

		$('#tDataPembayaran_wrapper .col-md-6:eq(1)').addClass("align-self-end");

		$('#tDataPembayaran_filter input').addClass('form-control-sm');
	})
</script>
