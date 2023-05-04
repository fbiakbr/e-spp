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
            <h4>Data Siswa</h4>
            <p class="date">Tanggal : <?= date('d-m-Y'); ?></p>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>No. HP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($siswa as $s) : ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $s['nis']; ?></td>
                            <td><?= $s['nama_siswa']; ?></td>
                            <td><?= $s['kelas']; ?></td>
                            <td><?= $s['tempat_lahir']; ?></td>
                            <td><?= $s['tanggal_lahir']; ?></td>
                            <td><?= $s['no_hp']; ?></td>
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