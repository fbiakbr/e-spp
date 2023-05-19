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
                <a href="<?= base_url('/admin/tambah_siswa') ?>" class="btn btn-primary mb-3">Tambah Siswa</a>
                <a href="<?= base_url('/admin/import_siswa') ?>" class="btn btn-success mb-3">Import Siswa</a>
                <a href="<?= base_url('/admin/pdf_siswa') ?>" class="btn btn-dark mb-3">Export PDF</a>
                <a href="<?= base_url('/admin/excel_siswa') ?>" class="btn btn-success mb-3">Export Excel</a>
                <div class="row">
                    <p class="fst-italic"><small class="text-danger">* Mohon untuk tidak menghapus data siswa yang sudah ada, karena data siswa yang sudah ada. digunakan untuk pembayaran.</small></p>
                    <p class="fst-italic"><small class="text-danger">* Jika ada kesalahan dalam penginputan data siswa, silahkan edit data siswa yang bersangkutan.</small></p>
                </div>
                <div class="row table-responsive pb-3">
                    <table class="table table-bordered" id="table1">
                        <thead>
                            <tr style="width: 1%; white-space: nowrap;">
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>No HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($siswa as $s) : ?>
                                <tr style="width: 1%; white-space: nowrap;">
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $s['nis']; ?></td>
                                    <td><?= $s['nama_siswa']; ?></td>
                                    <td><?= $s['kelas']; ?></td>
                                    <td><?= $s['tempat_lahir']; ?></td>
                                    <td><?= date('d-m-Y', strtotime($s['tanggal_lahir'])); ?></td>
                                    <td><?= $s['no_hp']; ?></td>
                                    <td class="text-center" width="10%">
                                        <a href="<?= base_url('/admin/edit_siswa/' . $s['nis']) ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="<?= base_url('/admin/hapus_siswa/' . $s['nis']) ?>" id="hapus_siswa" class="btn btn-sm btn-danger" onclick="hapusSiswa(event)"><i class="bi bi-trash"></i></a>
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
    let hapus_siswa = document.getElementById('hapus_siswa');

    function hapusSiswa(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data siswa akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#bb2d3b',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = hapus_siswa.href;
            }
        })
    }
</script>
<?= $this->endSection(); ?>