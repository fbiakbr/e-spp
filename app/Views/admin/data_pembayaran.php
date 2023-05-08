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
                <a href="<?= base_url('/admin/input_pembayaran') ?>" class="btn btn-primary mb-3">Input Pembayaran</a>
                <a href="<?= base_url('/admin/pdf_siswa') ?>" class="btn btn-dark mb-3">Export PDF</a>
                <div class="row table-responsive">
                    <table class="table table-bordered" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Jam</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Tagihan</th>
                                <th>Jumlah Bayar</th>
                                <th>Sisa Tagihan</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($pembayaran as $p) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= date('d-m-Y', strtotime($p['tanggal_pembayaran'])); ?></td>
                                    <td><?= $p['jam']; ?></td>
                                    <td><?= $p['nis']; ?></td>
                                    <td><?= $p['nama_siswa']; ?></td>
                                    <td><?= $p['kelas']; ?></td>
                                    <td><?= $p['tagihan']; ?></td>
                                    <td><?= $p['jumlah_bayar']; ?></td>
                                    <td><?= $p['sisa_tagihan']; ?></td>
                                    <td><?= $p['status_pembayaran']; ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('/admin/edit_pembayaran/' . $p['id_pembayaran']) ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="<?= base_url('/admin/hapus_pembayaran/' . $p['id_pembayaran']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="bi bi-trash"></i></a>
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