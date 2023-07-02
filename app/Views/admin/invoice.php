<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 12px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <?php
    $bulan = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];
    ?>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <!-- <img src="https://www.sparksuite.com/images/logo.png" style="width: 100%; max-width: 300px" /> -->
                                <h4>SMART <br>INVOICE</h4>
                            </td>

                            <td>
                                Invoice #: SMART<?= $pembayaran['id_pembayaran'] ?><br />
                                Created: <?= date_format(date_create($pembayaran['tanggal_pembayaran']), "d") . " " . $bulan[date_format(date_create($pembayaran['tanggal_pembayaran']), "m")] . " " . date_format(date_create($pembayaran['tanggal_pembayaran']), "Y") ?><br />
                                Due: <?= date_format(date_add(date_create($pembayaran['tanggal_pembayaran']), date_interval_create_from_date_string("1 month")), "d") . " " . $bulan[date_format(date_add(date_create($pembayaran['tanggal_pembayaran']), date_interval_create_from_date_string("1 month")), "m")] . " " . date_format(date_add(date_create($pembayaran['tanggal_pembayaran']), date_interval_create_from_date_string("1 month")), "Y") ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                SMK MA'ARIF NU TIRTO<br />
                                Jl. Wonoprojo No.19<br />
                                Pacar, Tirto 51151
                            </td>

                            <td>
                                <?= $pembayaran['nama_siswa'] ?><br />
                                <?= $pembayaran['nis'] ?><br />
                                <?= $pembayaran['kelas'] ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">

            </tr>

            <tr class="item">
                <td>Tanggal</td>

                <td><?= date_format(date_create($pembayaran['tanggal_pembayaran']), "d") . " " . $bulan[date_format(date_create($pembayaran['tanggal_pembayaran']), "m")] . " " . date_format(date_create($pembayaran['tanggal_pembayaran']), "Y") ?></td>
            </tr>
            <tr class="item">
                <td>Jam</td>

                <td><?= $pembayaran['jam'] ?></td>
            </tr>
            <tr class="item">
                <td>Jumlah</td>

                <td style="font-weight: bold;"><?= "Rp " . number_format($pembayaran['jumlah_bayar'], 0, ',', '.') ?></td>
            </tr>
            <tr class="item">
                <td>Keterangan</td>

                <td>PEMBAYARAN SPP <?= $pembayaran['bulan'] ?></td>
            </tr>
            <tr class="item last">
                <td>Status</td>

                <td><?= $pembayaran['status_pembayaran'] ?></td>
            </tr>
        </table>
    </div>
</body>

</html>