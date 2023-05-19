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
                <a href="<?= base_url('/admin/pdf_pembayaran') ?>" class="btn btn-dark mb-3">Export PDF</a>
                <a href="<?= base_url('/admin/excel_pembayaran') ?>" class="btn btn-success mb-3">Export Excel</a>
                <div class="row">
                    <p class="text-danger fst-italic"><small>* Mohon untuk menginputkan data pembayaran dengan benar.</small></p>
                    <p class="text-danger fst-italic"><small>* Mohon untuk tidak menghapus data pembayaran, jika terjadi kesalahan input, disarankan edit data pembayaran.</small></p>
                </div>
                <div class="row pb-3 table-responsive">
                    <table class="table table-bordered" id="table1">
                        <thead>
                            <tr style="width: 1%; white-space: nowrap;">
                                <th>No</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Jam</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Tagihan</th>
                                <th>Bulan</th>
                                <th>Jumlah Bayar</th>
                                <th>Sisa Tagihan</th>
                                <th>Kembalian</th>
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
                                    <td><?= $p['jam']; ?></td>
                                    <td><?= $p['nis']; ?></td>
                                    <td><?= $p['nama_siswa']; ?></td>
                                    <td><?= $p['kelas']; ?></td>
                                    <td><?= "Rp " . number_format($p['tagihan'], 0, ',', '.'); ?></td>
                                    <td><?= $p['bulan']; ?></td>
                                    <td><?= "Rp " . number_format($p['jumlah_bayar'], 0, ',', '.'); ?></td>
                                    <td><?= "Rp " . number_format($p['sisa_tagihan'], 0, ',', '.'); ?></td>
                                    <td><?= "Rp " . number_format($p['kembalian'], 0, ',', '.'); ?></td>
                                    <td><?= $p['status_pembayaran']; ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('/admin/edit_pembayaran/' . $p['id_pembayaran']) ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="<?= base_url('/admin/hapus_pembayaran/' . $p['id_pembayaran']) ?>" id="hapus_pembayaran" class="btn btn-sm btn-danger" id="hapus_pembayaran" onclick="hapusPembayaran(event)"><i class="bi bi-trash"></i></a>
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
    let hapus_pembayaran = document.getElementById('hapus_pembayaran');

    function hapusPembayaran(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data pembayaran yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#bb2d3b',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = hapus_pembayaran.href;
            }
        })
    }
</script>
<?= $this->endSection(); ?>