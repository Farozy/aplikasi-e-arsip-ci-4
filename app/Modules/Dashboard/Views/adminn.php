<?= $this->section('content'); ?>

<style>
	.chart-container {
		padding: 0;
		margin: auto;
		display: block;
		position: relative;
	}
@media screen and (max-width: 780px) {
	.chart-container {
		position: relative;
		height: 100%;
		width: 100%;
	}
}
</style>
<div class="row">
    <div class="col-md-4">
        <div class="card mt-4">
            <div class="card border-primary mb-3">
              <div class="card-header bg-info text-center h5 font-weight-bold"><i class="fas fa-envelope-open-text"></i> Surat Masuk Hari Ini</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Np.</th>
                                <th>Unit Kerja</th>
                                <th>Sifat Surat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach( $data_masuk as $dm ) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?php if( $dm['unit_kerja_id'] != 0 ) : ?>
                                            <?php foreach( $unit as $un ) : ?>
                                                <?php if( $un['id_unit_kerja'] == $dm['unit_kerja_id'] ) : ?>
                                                    <?= ucwords($un['nama_unit_kerja']); ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="text-center">-</div>
                                        <?php endif ?>
                                    </td>
                                    <td><?= ucfirst($dm['sifat_surat']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="chart-container mt-4">
            <h4 class="text-center font-weight-bold">Statistik Jenis Dokumen</h4>
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>

<script>
const ctx = document.getElementById('myChart').getContext('2d');

const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Arsip Pidana', 'Arsip Internal', 'Arsip Umum', 'Arsip Surat', 'Dokumen Kesehatan', 'Surat Keputusan', 'Urusan Tenaga', 'Berkas Kerja'],
        datasets: [{
            label: 'Arsip Pidana',
            data: [<?= isset(array_count_values(array_column($dok, 'jenis_id'))[1]) ? array_count_values(array_column($dok, 'jenis_id'))[1] : 0 ?>, <?= isset(array_count_values(array_column($dok, 'jenis_id'))[2]) ? array_count_values(array_column($dok, 'jenis_id'))[2] : 0 ?>, <?= isset(array_count_values(array_column($dok, 'jenis_id'))[4]) ? array_count_values(array_column($dok, 'jenis_id'))[4] : 0 ?>, <?= isset(array_count_values(array_column($dok, 'jenis_id'))[5]) ? array_count_values(array_column($dok, 'jenis_id'))[5] : 0 ?>, <?= isset(array_count_values(array_column($dok, 'jenis_id'))[6]) ? array_count_values(array_column($dok, 'jenis_id'))[6] : 0 ?>, <?= isset(array_count_values(array_column($dok, 'jenis_id'))[7]) ? array_count_values(array_column($dok, 'jenis_id'))[7] : 0 ?>, <?= isset(array_count_values(array_column($dok, 'jenis_id'))[8]) ? array_count_values(array_column($dok, 'jenis_id'))[8] : 0 ?>, <?= isset(array_count_values(array_column($dok, 'jenis_id'))[11]) ? array_count_values(array_column($dok, 'jenis_id'))[11] : 0 ?>],
            backgroundColor: [
                '#4572a7',
                '#aa4643',
                '#89a54e',
                '#80699b',
                '#3d96ae',
                '#db843d',
                '#92a8cd',
                '#a47d7c',
                '#b5ca92'
            ],
            borderColor: [
                '#4572a7',
                '#aa4643',
                '#89a54e',
                '#80699b',
                '#3d96ae',
                '#db843d',
                '#92a8cd',
                '#a47d7c',
                '#b5ca92'
            ],
            borderWidth: 1
        }]
    },
    options: {
    	legend: {
    		display: false,
    		// position: 'top',
    		responsive: true,
    	},
    	scales: {
    		yAxes: [{
    			ticks: {
    				beginAtZero:true
    			}
    		}]
    	},
    }
});
</script>

<?= $this->endSection(); ?>
