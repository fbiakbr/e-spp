<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>
                <p class="text-danger fst-italic">* Pastikan file yang diupload adalah file .xlsx.</p>
                <p class="text-danger fst-italic">* Untuk tanggal, pastikan format telah benar yaitu <span class="fw-bold">mm/dd/yyyy</span>. <span class="fw-bold">Contoh : 02/12/2002</span></p>
                <p class="text-danger fst-italic">* Untuk kelas, pastikan nama kelas sama seperti yang ada pada sistem.</p>
                <p class="text-danger fst-italic">* Pastikan format file yang diupload sesuai dengan format yang telah ditentukan. <span class="fw-bold">Contoh : X AKL 1</span></p>
                <p class="text-danger fst-italic">* Jika <span class="fw-bold">NIS</span> siswa sudah ada, maka data siswa akan di update sesuai dengan data yang diupload.</p>
                <a href="/admin/format_excel" class="btn btn-primary">Download Format Excel</a>
                <form action="/admin/import_excel_siswa" method="post" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
                        <label for="file" class="form-label">File Excel</label>
                        <input class="form-control" type="file" id="file_excel" name="file_excel" accept=".xlsx" required>
                    </div>
                    <button type="submit" class="btn btn-success">Import</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>