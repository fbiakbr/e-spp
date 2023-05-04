<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="<?= base_url() ?>/admin/update_siswa/<?= $siswa['nis'] ?>" method="post">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="nis">NIS</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control" placeholder="NIS" id="nis" name="nis" value="<?= $siswa['nis'] ?>" min="0" readonly required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="nama">Nama</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama_siswa" value="<?= $siswa['nama_siswa'] ?>" required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="kelas">Kelas</label>
                                        <div class="position-relative">
                                            <select class="form-select" id="kelas" name="kelas" required>
                                                <option value="">Pilih Kelas</option>
                                                <?php $kelas = json_decode(json_encode($kelas), true); ?>
                                                <?php foreach ($kelas as $k) : ?>
                                                    <?php if ($k['id_kelas'] == $siswa['kelas']) : ?>
                                                        <option value="<?= $k['id_kelas'] ?>" selected><?= $k['nama_kelas'] ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $k['id_kelas'] ?>"><?= $k['nama_kelas'] ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Tempat Lahir" id="tempat_lahir" name="tempat_lahir" value="<?= $siswa['tempat_lahir'] ?>" required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-geo-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <div class="position-relative">
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $siswa['tanggal_lahir'] ?>" required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-calendar-week"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="no_hp">No HP</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control" placeholder="No HP" id="no_hp" name="no_hp" value="<?= $siswa['no_hp'] ?>" required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 mb-3">
                                <div class="col-md-12">
                                    <div class="form">
                                        <textarea class="form-control" id="alamat" name="alamat" placeholder="<?= $siswa['alamat'] ?>" required></textarea>
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
    document.getElementById('alamat').value = "<?= $siswa['alamat'] ?>";
</script>
<?= $this->endSection(); ?>