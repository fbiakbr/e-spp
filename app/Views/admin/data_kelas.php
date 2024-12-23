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
                <a href="<?= base_url('/admin/tambah_kelas') ?>" class="btn btn-primary mb-3">Tambah Kelas</a>
                <a href="<?= base_url('/admin/pdf_kelas') ?>" class="btn btn-dark mb-3">Export PDF</a>
                <a href="<?= base_url('/admin/excel_kelas') ?>" class="btn btn-success mb-3">Export Excel</a>
                <div class="row table-responsive">
                    <table class="table table-bordered" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Tagihan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($kelas as $k) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $k['nama_kelas']; ?></td>
                                    <td><?= "Rp " . number_format($k['tagihan'], 0, ',', '.'); ?></td>
                                    <td class="text-center" width="10%">
                                        <a href="<?= base_url('/admin/edit_kelas/' . $k['id_kelas']) ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="<?= base_url('/admin/hapus_kelas/' . $k['id_kelas']) ?>" id="hapus_kelas" class="btn btn-sm btn-danger" onclick="hapusKelas(event)"><i class="bi bi-trash"></i></a>
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
    let hapus_kelas = document.getElementById('hapus_kelas');

    function hapusKelas(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data kelas akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#bb2d3b',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = hapus_kelas.href;
            }
        })
    }
</script>
<?= $this->endSection(); ?>