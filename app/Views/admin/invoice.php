<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <h2>SMART <br>INVOICE</h2>
                            </td>
                            <td>
                                Invoice: <b>#INVSMRT<?= $pembayaran['id_pembayaran']; ?></b><br> Tanggal: <b><?= $pembayaran['tanggal_pembayaran']; ?></b><br> Status: <b><?= $pembayaran['status_pembayaran']; ?></b> <br> Jam: <b><?= $pembayaran['jam']; ?></b>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                Nama : <b><?= $pembayaran['nama_siswa']; ?></b><br> NIS : <b><?= $pembayaran['nis']; ?></b><br> Kelas : <b><?= $pembayaran['kelas']; ?></b><br> Bulan : <b><?= $pembayaran['bulan']; ?></b> <br> Tagihan : <b><?= "Rp. " . number_format($pembayaran['tagihan'], 0, ',', '.'); ?></b> <br> Jumlah Bayar : <b><?= "Rp. " . number_format($pembayaran['jumlah_bayar'], 0, ',', '.'); ?></b> <br> Sisa Tagihan : <b><?= "Rp. " . number_format($pembayaran['sisa_tagihan'], 0, ',', '.'); ?></b> <br> Kembalian : <b><?= "Rp. " . number_format($pembayaran['kembalian'], 0, ',', '.'); ?></b>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 22px;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
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

        .invoice-box table tr td:nth-child(n + 2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 20px;
            color: #333;
            line-height: 25px;
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

        .invoice-box table tr.item input {
            padding-left: 5px;
        }

        .invoice-box table tr.item td:first-child input {
            margin-left: -5px;
            width: 100%;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .invoice-box input[type="number"] {
            width: 60px;
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
        .rtl {
            direction: rtl;
            font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial,
                sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</body>

</html>