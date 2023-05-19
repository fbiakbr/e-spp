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
                <a href="<?= base_url('/admin/pdf_angsuran') ?>" class="btn btn-dark mb-3">Export PDF</a>
                <a href="<?= base_url('/admin/excel_angsuran') ?>" class="btn btn-success mb-3">Export Excel</a>
                <div class="row pb-3 table-responsive">
                    <table class="table table-bordered" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pembayaran</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Bulan</th>
                                <th>Sisa Tagihan</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($pembayaran as $p) : ?>
                                <tr style="width: 1%; white-space: nowrap;">
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= date('d-m-Y', strtotime($p['tanggal_pembayaran'])); ?></td>
                                    <td><?= $p['nis']; ?></td>
                                    <td><?= $p['nama_siswa']; ?></td>
                                    <td><?= $p['kelas']; ?></td>
                                    <td><?= $p['bulan']; ?></td>
                                    <td><?= "Rp " . number_format($p['sisa_tagihan'], 0, ',', '.'); ?></td>
                                    <td><?= $p['status_pembayaran']; ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('/admin/angsuran/' . $p['id_pembayaran']) ?>" id="angsuran" class="btn btn-sm btn-primary"><i class="bi bi-check-all"></i> Penuhi Angsuran</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let angsuran = document.getElementById('angsuran');
    angsuran.addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan memenuhi angsuran pembayaran ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#435ebe',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, saya yakin!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = angsuran.href;
            }
        })
    })
</script>
<?= $this->endSection(); ?>