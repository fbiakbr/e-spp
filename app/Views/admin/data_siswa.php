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
                <div class="row table-responsive">
                    <table class="table table-bordered" id="table1">
                        <thead>
                            <tr>
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
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $s['nis']; ?></td>
                                    <td><?= $s['nama_siswa']; ?></td>
                                    <td><?= $s['kelas']; ?></td>
                                    <td><?= $s['tempat_lahir']; ?></td>
                                    <td><?= date('d-m-Y', strtotime($s['tanggal_lahir'])); ?></td>
                                    <td><?= $s['no_hp']; ?></td>
                                    <td class="text-center" width="10%">
                                        <a href="<?= base_url('/admin/edit_siswa/' . $s['nis']) ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="<?= base_url('/admin/hapus_siswa/' . $s['nis']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="bi bi-trash"></i></a>
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
<?= $this->endSection(); ?>