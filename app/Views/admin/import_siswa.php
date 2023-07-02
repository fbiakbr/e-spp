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
                <p class="text-danger fst-italic">* Untuk kelas, pastikan nama kelas sama seperti yang ada pada sistem. <span class="fw-bold">Contoh : X TJKT 1</span></p>
                <p class="text-danger fst-italic">* Pastikan format file yang diupload sesuai dengan format yang telah ditentukan.</p>
                <p class="text-danger fst-italic">* Jika <span class="fw-bold">NIS</span> siswa sudah ada, maka data siswa akan di update sesuai dengan data yang diupload.</p>
                <a href="<?= base_url('/admin/format_excel') ?>" class="btn btn-primary">Download Format Excel</a>
                <form action="<?= base_url('/admin/import_excel_siswa') ?>" method="post" enctype="multipart/form-data">
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
<script>
    let form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data siswa akan diimport ke sistem!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3950a2',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Import',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Loading',
                    html: 'Mohon tunggu sebentar',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                setTimeout(function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data siswa berhasil diimport.',
                        confirmButtonColor: '#3950a2',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.querySelector('form').submit();
                        }
                    })
                }, 3000);
            }
        })
    })
</script>
<?= $this->endSection(); ?>