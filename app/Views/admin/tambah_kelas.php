<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="<?= base_url('/admin/save_kelas') ?>" method="post">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-icon-left">
                                        <label for="nis">Nama Kelas</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Nama Kelas" id="nama_kelas" name="nama_kelas" required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-building"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-icon-left">
                                        <label for="nama">Tagihan</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control" placeholder="Tagihan" id="tagihan" name="tagihan" min="0" required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        Submit
                                    </button>
                                    <button type="reset" id="reset" class="btn btn-light-secondary me-1 mb-1">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('reset').addEventListener('click', function() {
        document.querySelector('form').reset();
    });
</script>
<?= $this->endSection(); ?>