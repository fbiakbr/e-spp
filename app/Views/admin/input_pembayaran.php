<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <p class="fst-italic font-semibold text-danger"><small>* Jika pembayaran menggunakan tunai, maka ganti jenis pembayaran menjadi tunai dan isi jumlah bayar sesuai dengan tagihan.</small></p>
                    <p class="fst-italic font-semibold text-danger"><small>* Jika pembayaran menggunakan non-tunai, maka ganti jenis pembayaran menjadi non-tunai dan isi jumlah bayar sesuai dengan tagihan.</small></p>
                    <p class="fst-italic font-semibold text-danger"><small>* Jika pembayaran menggunakan non-tunai, tetapi saldo tidak mencukupi, mohon untuk melakukan isi saldo terlebih dahulu.</small></p>
                    <p class="fst-italic font-semibold text-danger"><small>* Pastikan input jumlah bayar sesuai dengan tagihan.</small></p>
                    <form class="form form-vertical" action="<?= base_url('/admin/save_pembayaran') ?>" method="post">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group has-icon-left">
                                        <label for="nis">ID Card</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control" placeholder="Scan ID Card" id="rfid" name="rfid" min="0" autofocus />
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-icon-left">
                                        <label for="nis">NIS</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Masukkan NIS" id="nis" name="nis" min="0" autofocus required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-icon-left">
                                        <label for="nama_siswa">Nama Siswa</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Nama Siswa" id="nama_siswa" name="nama_siswa" readonly required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-icon-left">
                                        <label for="kelas">Kelas</label>
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
                                <div class="col-md-3">
                                    <div class="form-group has-icon-left">
                                        <label for="jenis_pembayaran">Jenis Pembayaran</label>
                                        <div class="position-relative">
                                            <select name="jenis_pembayaran" class="form-control form-select" id="jenis_pembayaran" required>
                                                <option value="NON-TUNAI" id="non-tunai">NON-TUNAI</option>
                                                <option value="TUNAI" id="tunai">TUNAI</option>
                                            </select>
                                            <div class="form-control-icon">
                                                <i class="bi bi-cash"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" id="saldo_card">
                                    <div class="form-group has-icon-left">
                                        <label for="tanggal">Saldo</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" id="saldo" name="saldo" placeholder="Saldo" readonly required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                            <p class="text-danger"><small id="saldotext"></small></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2" id="tgl_pembayaran_card">
                                    <div class="form-group has-icon-left">
                                        <label for="tanggal">Tanggal Pembayaran</label>
                                        <div class="position-relative">
                                            <input type="date" class="form-control" id="tanggal" name="tanggal_pembayaran" readonly required />
                                            <div class="form-control-icon">
                                                <i class="bi bi-calendar-date"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2" id="bulan_card">
                                    <div class="form-group has-icon-left">
                                        <label for="bulan">Bulan</label>
                                        <div class="position-relative">
                                            <select name="bulan" class="form-control form-select" id="bulan" required>
                                                <option value="">Pilih Bulan</option>
                                                <option value="JANUARI">JANUARI</option>
                                                <option value="FEBRUARI">FEBRUARI</option>
                                                <option value="MARET">MARET</option>
                                                <option value="APRIL">APRIL</option>
                                                <option value="MEI">MEI</option>
                                                <option value="JUNI">JUNI</option>
                                                <option value="JULI">JULI</option>
                                                <option value="AGUSTUS">AGUSTUS</option>
                                                <option value="SEPTEMBER">SEPTEMBER</option>
                                                <option value="OKTOBER">OKTOBER</option>
                                                <option value="NOVEMBER">NOVEMBER</option>
                                                <option value="DESEMBER">DESEMBER</option>
                                            </select>
                                            <div class="form-control-icon">
                                                <i class="bi  bi-calendar-week"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2" id="jam_card">
                                    <div class="form-group has-icon-left">
                                        <label for="jam">Jam</label>
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
                                <div class="col-md-3">
                                    <div class="form-group has-icon-left">
                                        <label for="tagihan">Tagihan</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Tagihan" id="tagihan" name="tagihan" readonly required />
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
                                            <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar" min="0" required />
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
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button id="bayarButton" type="submit" class="btn btn-primary me-1 mb-1">Bayar</button>
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

    let nama_siswa = document.getElementById('nama_siswa');
    let kelas = document.getElementById('kelas');
    let saldo = document.getElementById('saldo');

    let data_siswa = <?= json_encode($siswa) ?>;
    let data_kelas = <?= json_encode($kelas) ?>;
    let data_saldo = <?= json_encode($saldo) ?>;

    let data = [];
    data_siswa.forEach((siswa) => {
        data_kelas.forEach((kelas) => {
            if (siswa.kelas == kelas.id_kelas) {
                kelas.tagihan = kelas.tagihan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                kelas.tagihan = kelas.tagihan.replace(",00", "");
                data.push({
                    nis: siswa.nis,
                    rfid: siswa.rfid,
                    nama_siswa: siswa.nama_siswa,
                    kelas: kelas.nama_kelas,
                    tagihan: "Rp " + kelas.tagihan,
                    saldo: data_saldo.saldo
                });
            }
        });
    });

    // console.log(data);

    data.forEach((data) => {
        data_saldo.forEach((saldo) => {
            if (data.nis == saldo.nis) {
                let saldoValue = saldo.saldo.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                saldoValue = saldoValue.replace(",00", "");
                data.saldo = "Rp " + saldoValue;
            } else if (data.saldo == undefined) {
                data.saldo = "Rp 0";
            }
        });
    });

    // console.log(data);

    let nis = document.getElementById('nis');
    let rfid = document.getElementById('rfid');

    nis.addEventListener('keyup', () => {
        let nisValue = nis.value;
        let dataFiltered = data.filter((data) => {
            return data.nis == nisValue;
        });
        if (dataFiltered.length > 0) {
            rfid.value = dataFiltered[0].rfid;
            nama_siswa.value = dataFiltered[0].nama_siswa;
            kelas.value = dataFiltered[0].kelas;
            tagihan.value = dataFiltered[0].tagihan;
            saldo.value = dataFiltered[0].saldo;
        } else {
            rfid.value = '';
            nama_siswa.value = '';
            kelas.value = '';
            tagihan.value = '';
            saldo.value = '';
        }
        let saldoValue = saldo.value;
        saldoValue = saldoValue.replace('Rp', '');
        saldoValue = saldoValue.replace(/\./g, '');
        saldoValue = parseInt(saldoValue);

        let tagihanValue = tagihan.value;
        tagihanValue = tagihanValue.replace('Rp', '');
        tagihanValue = tagihanValue.replace(/\./g, '');
        tagihanValue = parseInt(tagihanValue);

        if (saldoValue < tagihanValue) {
            saldo.style.color = 'red';
            let saldoText = document.getElementById('saldotext');
            saldoText.innerHTML = 'Silahkan isi saldo terlebih dahulu!';
        } else {
            saldo.style.color = 'blue';
            let saldoText = document.getElementById('saldotext');
            saldoText.innerHTML = '';
        }
        if (saldo.style.color == 'red') {
            let bayarButton = document.getElementById('bayarButton');
            bayarButton.disabled = true;
        } else {
            let bayarButton = document.getElementById('bayarButton');
            bayarButton.disabled = false;
        }
    });

    rfid.addEventListener('keyup', () => {
        let rfidValue = rfid.value;
        let dataFiltered = data.filter((data) => {
            return data.rfid == rfidValue;
        });
        if (dataFiltered.length > 0) {
            nis.value = dataFiltered[0].nis;
            nama_siswa.value = dataFiltered[0].nama_siswa;
            kelas.value = dataFiltered[0].kelas;
            tagihan.value = dataFiltered[0].tagihan;
            saldo.value = dataFiltered[0].saldo;
        } else {
            nis.value = '';
            nama_siswa.value = '';
            kelas.value = '';
            tagihan.value = '';
            saldo.value = '';
        }
        let saldoValue = saldo.value;
        saldoValue = saldoValue.replace('Rp', '');
        saldoValue = saldoValue.replace(/\./g, '');
        saldoValue = parseInt(saldoValue);

        let tagihanValue = tagihan.value;
        tagihanValue = tagihanValue.replace('Rp', '');
        tagihanValue = tagihanValue.replace(/\./g, '');
        tagihanValue = parseInt(tagihanValue);

        if (saldoValue < tagihanValue) {
            saldo.style.color = 'red';
            let saldoText = document.getElementById('saldotext');
            saldoText.innerHTML = 'Silahkan isi saldo terlebih dahulu!';
        } else {
            saldo.style.color = 'blue';
            let saldoText = document.getElementById('saldotext');
            saldoText.innerHTML = '';
        }
        if (saldo.style.color == 'red') {
            let bayarButton = document.getElementById('bayarButton');
            bayarButton.disabled = true;
        } else {
            let bayarButton = document.getElementById('bayarButton');
            bayarButton.disabled = false;
        }
    });

    let jenis_pembayaran = document.getElementById('jenis_pembayaran');
    jenis_pembayaran.addEventListener('change', () => {
        let jenis_pembayaranValue = jenis_pembayaran.value;
        if (jenis_pembayaranValue == 'TUNAI') {
            let saldo_card = document.getElementById('saldo_card');
            saldo_card.style.display = 'none';

            let tgl_pembayaran_card = document.getElementById('tgl_pembayaran_card');
            tgl_pembayaran_card.classList.remove('col-md-2');
            tgl_pembayaran_card.classList.add('col-md-3');

            let bulan_card = document.getElementById('bulan_card');
            bulan_card.classList.remove('col-md-2');
            bulan_card.classList.add('col-md-3');

            let jam_card = document.getElementById('jam_card');
            jam_card.classList.remove('col-md-2');
            jam_card.classList.add('col-md-3');

            let bayarButton = document.getElementById('bayarButton');
            bayarButton.disabled = false;
        } else {
            let saldo_card = document.getElementById('saldo_card');
            saldo_card.style.display = 'block';

            let tgl_pembayaran_card = document.getElementById('tgl_pembayaran_card');
            tgl_pembayaran_card.classList.remove('col-md-3');
            tgl_pembayaran_card.classList.add('col-md-2');

            let bulan_card = document.getElementById('bulan_card');
            bulan_card.classList.remove('col-md-3');
            bulan_card.classList.add('col-md-2');

            let jam_card = document.getElementById('jam_card');
            jam_card.classList.remove('col-md-3');
            jam_card.classList.add('col-md-2');

            let saldoValue = saldo.value;
            saldoValue = saldoValue.replace('Rp', '');
            saldoValue = saldoValue.replace(/\./g, '');
            saldoValue = parseInt(saldoValue);

            let tagihanValue = tagihan.value;
            tagihanValue = tagihanValue.replace('Rp', '');
            tagihanValue = tagihanValue.replace(/\./g, '');
            tagihanValue = parseInt(tagihanValue);

            if (saldoValue < tagihanValue) {
                let bayaButton = document.getElementById('bayarButton');
                bayaButton.disabled = true;
            }
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

    jumlah_bayar.addEventListener('keyup', () => {
        let jumlah_bayarValue = jumlah_bayar.value;
        let tagihanValue = tagihan.value;

        let tagihanValueNumber = tagihanValue.replace('Rp', '');
        tagihanValueNumber = tagihanValueNumber.replace(/\./g, '');
        // console.log(tagihanValueNumber);

        let jumlah_bayarValueNumber = jumlah_bayarValue.replace('Rp', '');
        jumlah_bayarValueNumber = jumlah_bayarValueNumber.replace(/\./g, '');
        // console.log(jumlah_bayarValueNumber);

        let sisa_tagihan = document.getElementById('sisa_tagihan');
        let sisa_tagihanValue = tagihanValueNumber - jumlah_bayarValueNumber;
        sisa_tagihanValue = sisa_tagihanValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        sisa_tagihanValue = sisa_tagihanValue.replace(",00", "");
        sisa_tagihan.value = "Rp " + sisa_tagihanValue;

        let saldoValue = saldo.value;
        let saldoValueNumber = saldoValue.replace('Rp', '');
        saldoValueNumber = saldoValueNumber.replace(/\./g, '');
        console.log(saldoValueNumber);

        if (nis.value == '' || nama_siswa.value == '' || kelas.value == '') {
            sisa_tagihan.value = "Rp 0";
        } else if (sisa_tagihanValue == 0) {
            sisa_tagihan.value = "Rp 0";
        } else if (sisa_tagihanValue < 0) {
            sisa_tagihan.value = "Rp 0";
        } else if (sisa_tagihanValue > 0) {
            sisa_tagihan.value = "Rp " + sisa_tagihanValue;
        } else {
            sisa_tagihan.value = "Rp 0";
        }
    });


    let saldoValue = saldo.value;
    let saldoValueNumber = saldoValue.replace('Rp', '');
    saldoValueNumber = saldoValueNumber.replace(/\./g, '');

    let tagihanValue = tagihan.value;
    let tagihanValueNumber = tagihanValue.replace('Rp', '');
    tagihanValueNumber = tagihanValueNumber.replace(/\./g, '');

    let jumlah_bayarValue = jumlah_bayar.value;
    let jumlah_bayarValueNumber = jumlah_bayarValue.replace('Rp', '');
    jumlah_bayarValueNumber = jumlah_bayarValueNumber.replace(/\./g, '');


    let form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        if (nis.value == '' || nama_siswa.value == '' || kelas.value == '') {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data siswa tidak ditemukan!',
                confirmButtonColor: '#3950a2',
            });
        } else if (jumlah_bayarValueNumber > saldoValueNumber || saldoValueNumber < tagihanValueNumber) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Saldo tidak mencukupi!',
                confirmButtonColor: '#3950a2',
            });
        } else {
            e.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data pembayaran berhasil ditambahkan!',
                confirmButtonColor: '#3950a2',
            }).then((result) => {
                form.submit();
            });
        }
        let bulan = document.getElementById('bulan');
        let bulanValue = bulan.value;
        let dataBulan = <?= json_encode($pembayaran) ?>;
        let dataSiswa = <?= json_encode($siswa) ?>;
        dataBulan.forEach((data) => {
            dataSiswa.forEach((siswa) => {
                if (siswa.nis == nis.value) {
                    if (data.nis == siswa.nis) {
                        if (data.bulan == bulanValue) {
                            e.preventDefault();
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Siswa sudah membayar!',
                                confirmButtonColor: '#3950a2',
                            });
                        }
                    }
                }
            });
        });
        dataBulan.forEach((data) => {
            if (data.bulan == bulanValue) {
                if (data.nis == nis.value) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Bulan ' + bulanValue + ' sudah dibayar!',
                        confirmButtonColor: '#3950a2',
                    });
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>