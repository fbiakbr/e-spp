<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="<?= base_url('/admin/save_pembayaran') ?>" method="post">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="nis">NIS</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="NIS" id="nis" name="nis" min="0" required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="nis">Nama Siswa</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Nama Siswa" id="nama_siswa" name="nama_siswa" readonly required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="nis">Kelas</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Kelas" id="kelas" name="kelas" readonly required />
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
                                        <label for="nis">Tagihan</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Tagihan" id="tagihan" name="tagihan" readonly required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="nis">Tanggal</label>
                                        <div class="position-relative">
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" readonly required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-calendar-date"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="nis">Jam</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" id="jam" name="jam" readonly required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-clock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="nis">Jumlah Bayar</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar" min="0" required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-icon-left">
                                        <label for="nis">Sisa Tagihan</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="0" id="sisa_tagihan" name="sisa_tagihan" readonly required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
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
    let date = new Date();
    let day = date.getDate();
    if (day < 10) {
        day = '0' + day;
    }
    let month = date.getMonth() + 1;
    if (month < 10) {
        month = '0' + month;
    }
    let year = date.getFullYear();
    let tanggal = year + '-' + month + '-' + day;
    let tanggalInput = document.getElementById('tanggal');
    tanggalInput.value = tanggal;
    setInterval(() => {
        let date = new Date();
        let hour = date.getHours();
        if (hour < 10) {
            hour = '0' + hour;
        }
        let minute = date.getMinutes();
        if (minute < 10) {
            minute = '0' + minute;
        }
        let second = date.getSeconds();
        if (second < 10) {
            second = '0' + second;
        }
        let jam = hour + ':' + minute + ':' + second;
        let jamInput = document.getElementById('jam');
        jamInput.value = jam;
    }, 100)

    let nis = document.getElementById('nis');
    let nama_siswa = document.getElementById('nama_siswa');
    let kelas = document.getElementById('kelas');

    let data_siswa = <?= json_encode($siswa) ?>;
    let data_kelas = <?= json_encode($kelas) ?>;

    let data = [];
    // change tagihan to idr format
    data_siswa.forEach((siswa) => {
        data_kelas.forEach((kelas) => {
            if (siswa.kelas == kelas.id_kelas) {
                kelas.tagihan = "Rp " + kelas.tagihan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                kelas.tagihan = kelas.tagihan.replace(",00", "");
                data.push({
                    nis: siswa.nis,
                    nama_siswa: siswa.nama_siswa,
                    kelas: kelas.nama_kelas,
                    tagihan: kelas.tagihan
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
        // convert to rupiah
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
    jumlah_bayar.addEventListener('keyup', () => {
        let jumlah_bayarValue = jumlah_bayar.value;
        let tagihanValue = tagihan.value;

        let jumlah_bayarValueIDR = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(jumlah_bayarValue);

        let tagihanValueNumber = tagihanValue.replace('Rp', '');
        tagihanValueNumber = tagihanValueNumber.replace('.', '');
        tagihanValueNumber = parseInt(tagihanValueNumber);

        let jumlah_bayarValueNumber = jumlah_bayarValue.replace('Rp', '');
        jumlah_bayarValueNumber = jumlah_bayarValueNumber.replace('.', '');
        jumlah_bayarValueNumber = parseInt(jumlah_bayarValueNumber);

        let sisa_tagihanValue = tagihanValueNumber - jumlah_bayarValueNumber;
        let sisa_tagihanValueIDR = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(sisa_tagihanValue);
        sisa_tagihanValueIDR = sisa_tagihanValueIDR.replace(",00", "");
        sisa_tagihan.value = sisa_tagihanValueIDR;
        if (nis.value == '') {
            sisa_tagihan.value = '';
        } else if (jumlah_bayarValue == '') {
            sisa_tagihan.value = '';
        }
    });
</script>
<?= $this->endSection(); ?>