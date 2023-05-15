<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembayaran</title>
</head>

<body>
    <div class="row">
        <div class="col-md-12">
            <h4>Data Pembayaran</h4>
            <p class="date">Tanggal : <?= date('d-m-Y'); ?></p>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pembayaran</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Bulan</th>
                        <th>Jam</th>
                        <th>Tagihan</th>
                        <th>Jumlah Bayar</th>
                        <th>Sisa Tagihan</th>
                        <th>Kembalian</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pembayaran as $p) : ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $p['tanggal_pembayaran']; ?></td>
                            <td><?= $p['nis']; ?></td>
                            <td><?= $p['nama_siswa']; ?></td>
                            <td><?= $p['kelas']; ?></td>
                            <td><?= $p['bulan']; ?></td>
                            <td><?= $p['jam']; ?></td>
                            <td><?= "Rp. " . number_format($p['tagihan'], 0, ',', '.'); ?></td>
                            <td><?= "Rp. " . number_format($p['jumlah_bayar'], 0, ',', '.'); ?></td>
                            <td><?= "Rp. " . number_format($p['sisa_tagihan'], 0, ',', '.'); ?></td>
                            <td><?= "Rp. " . number_format($p['kembalian'], 0, ',', '.'); ?></td>
                            <td><?= $p['status_pembayaran']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer>
        <p>SMK Ma'arif NU Tirto &copy; <?= date('Y'); ?></p>
    </footer>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        thead {
            /* border: 1px solid black; */
            border-collapse: collapse;
            background-color: #000;
            color: #fff;
        }

        td {
            border: 1px solid #000;
        }

        table {
            width: 100%;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
        }
    </style>
</body>

</html>