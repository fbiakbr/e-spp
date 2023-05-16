<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                        <div class="stats-icon purple mb-2">
                            <i class="iconly-boldDiscovery"></i>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">
                            Data Kelas
                        </h6>
                        <h6 class="font-extrabold mb-0"><?= $jumlah_kelas ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                        <div class="stats-icon blue mb-2">
                            <i class="iconly-boldProfile"></i>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">
                            Data Siswa
                        </h6>
                        <h6 class="font-extrabold mb-0"><?= $jumlah_siswa ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                        <div class="stats-icon green mb-2">
                            <i class="iconly-boldPaper"></i>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">
                            Data Pembayaran
                        </h6>
                        <h6 class="font-extrabold mb-0"><?= $jumlah_pembayaran ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                        <div class="stats-icon red mb-2">
                            <i class="iconly-boldDocument"></i>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Data Angsuran</h6>
                        <h6 class="font-extrabold mb-0"><?= $jumlah_angsuran ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Jumlah Siswa Berdasarkan Kelas</h4>
            </div>
            <div class="card-body">
                <canvas id="chartKelas"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Jumlah Pembayaran Berdasarkan Bulan</h4>
            </div>
            <div class="card-body">
                <canvas id="chartPembayaran"></canvas>
            </div>
        </div>
    </div>
</div>
<div>
    <script src="<?= base_url('/assets/chart.js') ?>"></script>
    <script>
        let ckls = document.getElementById('chartKelas');
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

        let kelas = [];
        let jumlah = [];
        data.forEach((item) => {
            if (kelas.includes(item.kelas)) {
                let index = kelas.indexOf(item.kelas);
                jumlah[index] += 1;
            } else {
                kelas.push(item.kelas);
                jumlah.push(1);
            }
        });

        let chartKelas = new Chart(ckls, {
            type: 'bar',
            data: {
                labels: kelas,
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: jumlah,
                    backgroundColor: [
                        'rgb(150, 148, 255)',
                        'rgb(255, 121, 118)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5
                        }
                    }
                }
            }
        });

        let cpmb = document.getElementById('chartPembayaran');
        let data_pembayaran = <?= json_encode($pembayaran) ?>;
        console.log(data_pembayaran);

        let bulan = [
            "JANUARI",
            "FEBRUARI",
            "MARET",
            "APRIL",
            "MEI",
            "JUNI",
            "JULI",
            "AGUSTUS",
            "SEPTEMBER",
            "OKTOBER",
            "NOVEMBER",
            "DESEMBER"
        ];
        let jumlah_pembayaran = [];
        bulan.forEach((item) => {
            let jumlah = 0;
            data_pembayaran.forEach((pembayaran) => {
                if (pembayaran.bulan == item) {
                    jumlah += 1;
                }
            });
            jumlah_pembayaran.push(jumlah);
        });

        let chartPembayaran = new Chart(cpmb, {
            type: 'line',
            data: {
                labels: bulan,
                datasets: [{
                    label: 'Jumlah Pembayaran',
                    data: jumlah_pembayaran,
                    backgroundColor: [
                        'rgb(67, 94, 190)'
                    ],
                    borderColor: [
                        'rgba(67, 94, 190, 0.5)'
                    ],
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5
                        }
                    }
                }
            }
        });
    </script>

    <?= $this->endSection() ?>