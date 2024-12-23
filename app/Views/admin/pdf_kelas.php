<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas</title>
</head>

<body>
    <div class="row">
        <div class="col-md-12">
            <h4>Data Kelas</h4>
            <p class="date">Tanggal : <?= date('d-m-Y'); ?></p>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Tagihan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    usort($kelas, function ($a, $b) {
                        return $a['nama_kelas'] <=> $b['nama_kelas'];
                    });
                    foreach ($kelas as $k) : ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $k['nama_kelas']; ?></td>
                            <td><?= "Rp " . number_format($k['tagihan'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
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
    </style>
</body>

</html>