<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="<?= base_url('/admin/update_pembayaran/') ?><?= $pembayaran['id_pembayaran'] ?>" method="post">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="nis">NIS</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="NIS" id="nis" name="nis" min="0" value="<?= $pembayaran['nis'] ?>" required readonly />
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="nama_siswa">Nama Siswa</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Nama Siswa" id="nama_siswa" value="<?= $pembayaran['nama_siswa'] ?>" name="nama_siswa" readonly required />
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
                                            <input type="text" class="form-control" placeholder="Kelas" id="kelas" name="kelas" value="<?= $pembayaran['kelas'] ?>" readonly required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-building"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="tanggal">Tanggal Pembayaran</label>
                                        <div class="position-relative">
                                            <input type="date" class="form-control" id="tanggal" name="tanggal_pembayaran" value="<?= $pembayaran['tanggal_pembayaran'] ?>" readonly required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-calendar-date"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="bulan">Bulan</label>
                                        <div class="position-relative">
                                            <select name="bulan" class="form-control form-select" id="bulan" required>
                                                <?php
                                                $bulan = $pembayaran['bulan'];
                                                $arr_bulan = array(
                                                    'JANUARI',
                                                    'FEBRUARI',
                                                    'MARET',
                                                    'APRIL',
                                                    'MEI',
                                                    'JUNI',
                                                    'JULI',
                                                    'AGUSTUS',
                                                    'SEPTEMBER',
                                                    'OKTOBER',
                                                    'NOVEMBER',
                                                    'DESEMBER'
                                                );
                                                for ($i = 0; $i < count($arr_bulan); $i++) {
                                                    if ($arr_bulan[$i] == $bulan) {
                                                        echo "<option value='$arr_bulan[$i]' selected>$arr_bulan[$i]</option>";
                                                    } else {
                                                        echo "<option value='$arr_bulan[$i]'>$arr_bulan[$i]</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <div class="form-control-icon">
                                                <i class="bi  bi-calendar-week"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="jam">Jam</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" id="jam" name="jam" readonly required value="<?= $pembayaran['jam'] ?>" />
                                            <div class="form-control-icon">
                                                <i class="bi bi-clock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group has-icon-left">
                                        <label for="tagihan">Tagihan</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Tagihan" id="tagihan" name="tagihan" value="<?= 'Rp ' . number_format($pembayaran['tagihan'], 0, ',', '.') ?>" readonly required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-icon-left">
                                        <label for="jumlah_bayar">Jumlah Bayar</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar" min="0" required autofocus />
                                            <div class="form-control-icon">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-icon-left">
                                        <label for="sisa_tagihan">Sisa Tagihan</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="0" id="sisa_tagihan" name="sisa_tagihan" readonly required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-icon-left">
                                        <label for="kembalian">Kembalian</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="0" id="kembalian" name="kembalian" readonly required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Bayar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let nis = document.getElementById('nis');
    let nama_siswa = document.getElementById('nama_siswa');
    let kelas = document.getElementById('kelas');

    let data_siswa = <?= json_encode($siswa) ?>;
    let data_kelas = <?= json_encode($kelas) ?>;

    let data = [];
    data_siswa.forEach((siswa) => {
        data_kelas.forEach((kelas) => {
            if (siswa.kelas == kelas.id_kelas) {
                kelas.tagihan = kelas.tagihan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                kelas.tagihan = kelas.tagihan.replace(",00", "");
                data.push({
                    nis: siswa.nis,
                    nama_siswa: siswa.nama_siswa,
                    kelas: kelas.nama_kelas,
                    tagihan: "Rp " + kelas.tagihan
                });
            }
        });
    });
    console.log(data);

    nis.addEventListener('keyup', () => {
        let nisValue = nis.value;
        let dataSiswaFiltered = data.filter((siswa) => {
            return siswa.nis == nisValue;
        });
        if (dataSiswaFiltered.length > 0) {
            nama_siswa.value = dataSiswaFiltered[0].nama_siswa;
            kelas.value = dataSiswaFiltered[0].kelas;
            tagihan.value = dataSiswaFiltered[0].tagihan;
        } else {
            nama_siswa.value = '';
            kelas.value = '';
            tagihan.value = '';
        }
    });

    let jumlah_bayar = document.getElementById('jumlah_bayar');
    jumlah_bayar.addEventListener('keyup', () => {
        jumlah_bayar.value = formatRupiah(jumlah_bayar.value, 'Rp ');
    });

    function formatRupiah(angka, prefix) {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? 'Rp ' + rupiah : '';
    }

    let sisa_tagihan = document.getElementById('sisa_tagihan');
    let kembalian = document.getElementById('kembalian');
    jumlah_bayar.addEventListener('keyup', () => {
        let jumlah_bayarValue = jumlah_bayar.value;
        let tagihanValue = tagihan.value;

        let tagihanValueNumber = tagihanValue.replace('Rp', '');
        tagihanValueNumber = tagihanValueNumber.replace(/\./g, '');
        console.log(tagihanValueNumber);

        let jumlah_bayarValueNumber = jumlah_bayarValue.replace('Rp', '');
        jumlah_bayarValueNumber = jumlah_bayarValueNumber.replace(/\./g, '');
        console.log(jumlah_bayarValueNumber);

        let sisa_tagihanValue = tagihanValueNumber - jumlah_bayarValueNumber;
        console.log(sisa_tagihanValue);

        sisa_tagihanValue = "Rp " + sisa_tagihanValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        sisa_tagihan.value = sisa_tagihanValue;

        let kembalianValue = jumlah_bayarValueNumber - tagihanValueNumber;
        let kembalianValueIDR = "Rp " + kembalianValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        kembalian.value = kembalianValueIDR;

        if (nis.value == '') {
            sisa_tagihan.value = '';
        } else if (jumlah_bayarValue == '') {
            sisa_tagihan.value = 'Rp 0';
            kembalian.value = 'Rp 0';
        } else if (sisa_tagihanValue < 0) {
            sisa_tagihan.value = 'Rp 0';
        } else if (kembalianValue < 0) {
            kembalian.value = 'Rp 0';
        } else if (jumlah_bayarValue >= tagihanValueNumber) {
            sisa_tagihan.value = 'Rp 0';
            kembalian.value = kembalianValueIDR;
        }
    });
</script>
<?= $this->endSection(); ?>