<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <button type="button" id="export_excel" class="btn btn-success mb-3">Export Excel</button>
                <div class=" row pb-3 table-responsive">
                    <table class="table table-bordered" id="table1">
                        <thead>
                            <tr style="width: 1%; white-space: nowrap; text-transform: uppercase;">
                                <th>No</th>
                                <th>NIS</th>
                                <th>NAMA SISWA</th>
                                <th>KELAS</th>
                                <th>JANUARI</th>
                                <th>FEBRUARI</th>
                                <th>MARET</th>
                                <th>APRIL</th>
                                <th>MEI</th>
                                <th>JUNI</th>
                                <th>JULI</th>
                                <th>AGUSTUS</th>
                                <th>SEPTEMBER</th>
                                <th>OKTOBER</th>
                                <th>NOVEMBER</th>
                                <th>DESEMBER</th>
                                <th>TOTAL TAGIHAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            array_multisort(
                                array_column($pembayaran, 'kelas'),
                                SORT_ASC,
                                array_column($pembayaran, 'nama_siswa'),
                                SORT_ASC,
                                $pembayaran
                            );
                            $nis = [];
                            foreach ($pembayaran as $p) : ?>
                                <?php if (!in_array($p['nis'], $nis)) : ?>
                                    <tr style="width: 1%; white-space: nowrap;">
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $p['nis']; ?></td>
                                        <td><?= $p['nama_siswa']; ?></td>
                                        <td><?= $p['kelas']; ?></td>
                                        <?php $sisa_tagihan = [];
                                        $bulan = ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'];
                                        for ($i = 0; $i < count($bulan); $i++) {
                                            $sisa_tagihan[$bulan[$i]] = $p['tagihan'];
                                        }
                                        foreach ($pembayaran as $p2) {
                                            if ($p['nis'] == $p2['nis']) {
                                                $sisa_tagihan[$p2['bulan']] = $p2['sisa_tagihan'];
                                            }
                                        }
                                        ?>
                                        <?php foreach ($bulan as $b) : ?>
                                            <td><?= "Rp " . number_format($sisa_tagihan[$b], 0, ',', '.'); ?></td>
                                        <?php endforeach; ?>
                                        <?php $total = 0;
                                        foreach ($sisa_tagihan as $st) {
                                            $total += $st;
                                        } ?>
                                        <td class="fw-bold"><?= "Rp " . number_format($total, 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php array_push($nis, $p['nis']); ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script lang="javascript" src="<?= base_url('/assets/xlsx.full.min.js') ?>"></script>
<script type="module">
    let export_excel = document.getElementById('export_excel');
    export_excel.addEventListener("click", async function() {
        let table = document.getElementById('table1');
        let ws = XLSX.utils.table_to_sheet(table);
        let wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Data Tagihan Siswa");
        let d = new Date();
        let date = d.getDate();
        let month = d.getMonth() + 1;
        let year = d.getFullYear();
        let file = XLSX.writeFile(wb, `Data Tagihan Siswa ${date}-${month}-${year}.xlsx`);
    });

    // if tagihan siswa !=0, change background color to red
    let table = document.getElementById('table1');
    let tr = table.getElementsByTagName('tr');
    for (let i = 0; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName('td');
        for (let j = 4; j < td.length - 1; j++) {
            if (td[j].innerHTML != "Rp 0") {
                td[j].style.backgroundColor = "#cc303f";
                td[j].style.color = "white";
            } else if (td[j].innerHTML == "Rp 0") {
                td[j].style.backgroundColor = "#435ebe";
                td[j].style.color = "white";
            }
        }
    }
</script>
<?= $this->endSection(); ?>