<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Models\Kelas;
use App\Models\Saldo;
use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;

class Admin extends BaseController
{
    public function index()
    {
        $kelas = new Kelas();
        $siswa = new Siswa();
        $pembayaran = new Pembayaran();
        $data = [
            'title' => 'Dashboard',
            'jumlah_kelas' => $kelas->countAllResults(),
            'jumlah_siswa' => $siswa->countAllResults(),
            'jumlah_pembayaran' => $pembayaran->countAllResults(),
            'jumlah_angsuran' => $pembayaran->where('status_pembayaran', 'BELUM LUNAS')->countAllResults(),
            'kelas' => $kelas->findAll(),
            'siswa' => $siswa->findAll(),
            'pembayaran' => $pembayaran->findAll(),
        ];
        return view('admin/index', $data);
    }
    public function data_siswa()
    {
        $siswa = new Siswa();
        $kelas = new Kelas();
        $data = [];
        $siswa = $siswa->findAll();
        foreach ($siswa as $s) {
            $data[] = [
                'nis' => $s['nis'],
                'nama_siswa' => $s['nama_siswa'],
                'kelas' => $kelas->where('id_kelas', $s['kelas'])->first()['nama_kelas'],
                'tempat_lahir' => $s['tempat_lahir'],
                'tanggal_lahir' => $s['tanggal_lahir'],
                'no_hp' => $s['no_hp'],
                'alamat' => $s['alamat'],
            ];
        }
        $data = [
            'title' => 'Data Siswa',
            'siswa' => $data,
        ];
        return view('admin/data_siswa', $data);
    }
    public function tambah_siswa()
    {
        $siswa = new Siswa();
        $kelas = new Kelas();
        $data = [
            'title' => 'Tambah Siswa',
            'siswa' => $siswa->findAll(),
            'kelas' => $kelas->findAll(),
        ];
        return view('admin/tambah_siswa', $data);
    }
    public function save_siswa()
    {
        $siswa = new Siswa();
        $data = [
            'nis' => $this->request->getVar('nis'),
            'rfid' => $this->request->getVar('rfid'),
            'nama_siswa' => $this->request->getVar('nama_siswa'),
            'kelas' => $this->request->getVar('kelas'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'no_hp' => $this->request->getVar('no_hp'),
            'alamat' => $this->request->getVar('alamat'),
        ];
        $siswa->insert($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to(base_url('admin/data_siswa'));
    }
    public function hapus_siswa($nis)
    {
        $siswa = new Siswa();
        $siswa->where('nis', $nis);
        $siswa->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('admin/data_siswa'));
    }
    public function edit_siswa($nis)
    {
        $siswa = new Siswa();
        $kelas = new Kelas();
        $data = [
            'title' => 'Edit Siswa',
            'siswa' => $siswa->where('nis', $nis)->first(),
            'kelas' => $kelas->findAll(),
        ];
        return view('/admin/edit_siswa', $data);
    }
    public function update_siswa($nis)
    {
        $siswa = new Siswa();
        $siswa->save([
            'nis' => $nis,
            'rfid' => $this->request->getVar('rfid'),
            'nama_siswa' => $this->request->getVar('nama_siswa'),
            'kelas' => $this->request->getVar('kelas'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'no_hp' => $this->request->getVar('no_hp'),
            'alamat' => $this->request->getVar('alamat'),
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to(base_url('admin/data_siswa'));
    }
    public function import_siswa()
    {
        $data = [
            'title' => 'Import Siswa',
        ];
        return view('/admin/import_siswa', $data);
    }
    public function format_excel()
    {
        $file = './format/format_siswa.xlsx';
        return $this->response->download($file, null);
    }
    public function import_excel_siswa()
    {
        $excel = $this->request->getFile('file_excel');
        $ext = $excel->getExtension();
        if ($ext == 'xlsx') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }
        $spreadsheet = $reader->load($excel);
        $sheet = $spreadsheet->getActiveSheet()->toArray();
        unset($sheet[0]);
        $data = [];
        foreach ($sheet as $s) {
            $data[] = [
                'nis' => $s[0],
                'rfid' => $s[1],
                'nama_siswa' => $s[2],
                'kelas' => $s[3],
                'tempat_lahir' => $s[4],
                'tanggal_lahir' => $s[5],
                'alamat' => $s[6],
                'no_hp' => $s[7],
            ];
        }
        $kelas = new Kelas();
        foreach ($data as $d) {
            $d['kelas'] = $kelas->where('nama_kelas', $d['kelas'])->first()['id_kelas'];
            $d['tanggal_lahir'] = date('Y-m-d', strtotime($d['tanggal_lahir']));
            $siswa = new Siswa();
            $check = $siswa->where('nis', $d['nis'])->first();
            if ($check) {
                $siswa->save([
                    'nis' => $d['nis'],
                    'rfid' => $d['rfid'],
                    'nama_siswa' => $d['nama_siswa'],
                    'kelas' => $d['kelas'],
                    'tempat_lahir' => $d['tempat_lahir'],
                    'tanggal_lahir' => $d['tanggal_lahir'],
                    'no_hp' => $d['no_hp'],
                    'alamat' => $d['alamat'],
                ]);
            } else {
                $siswa->insert($d);
            }
        }
        session()->setFlashdata('pesan', 'Data berhasil diimport.');
        return redirect()->to(base_url('admin/data_siswa'));
    }
    public function pdf_siswa()
    {
        $siswa = new Siswa();
        $kelas = new Kelas();
        $data = [];
        $siswa = $siswa->findAll();
        foreach ($siswa as $s) {
            $data[] = [
                'nis' => $s['nis'],
                'nama_siswa' => $s['nama_siswa'],
                'kelas' => $kelas->where('id_kelas', $s['kelas'])->first()['nama_kelas'],
                'tempat_lahir' => $s['tempat_lahir'],
                'tanggal_lahir' => $s['tanggal_lahir'],
                'no_hp' => $s['no_hp'],
                'alamat' => $s['alamat'],
            ];
        }
        $data = [
            'title' => 'Data Siswa',
            'siswa' => $data,
        ];
        $filename = 'Data Siswa ' . date('d-m-Y') . '.pdf';
        $dompdf = new \Dompdf\Dompdf();
        $html = view('admin/pdf_siswa', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename, ['Attachment' => false]);
    }
    public function excel_siswa()
    {
        $siswa = new Siswa();
        $kelas = new Kelas();
        $data = [];
        $siswa = $siswa->findAll();
        foreach ($siswa as $s) {
            $data[] = [
                'nis' => $s['nis'],
                'nama_siswa' => $s['nama_siswa'],
                'kelas' => $kelas->where('id_kelas', $s['kelas'])->first()['nama_kelas'],
                'tempat_lahir' => $s['tempat_lahir'],
                'tanggal_lahir' => $s['tanggal_lahir'],
                'no_hp' => $s['no_hp'],
                'alamat' => $s['alamat'],
            ];
        }
        $data = [
            'title' => 'Data Siswa',
            'siswa' => $data,
        ];
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NIS')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'Kelas')
            ->setCellValue('D1', 'Tempat Lahir')
            ->setCellValue('E1', 'Tanggal Lahir')
            ->setCellValue('F1', 'No HP')
            ->setCellValue('G1', 'Alamat');

        $column = 2;
        foreach ($data['siswa'] as $s) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $s['nis'])
                ->setCellValue('B' . $column, $s['nama_siswa'])
                ->setCellValue('C' . $column, $s['kelas'])
                ->setCellValue('D' . $column, $s['tempat_lahir'])
                ->setCellValue('E' . $column, date('d-m-Y', strtotime($s['tanggal_lahir'])))
                ->setCellValue('F' . $column, $s['no_hp'])
                ->setCellValue('G' . $column, $s['alamat']);
            $column++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'data_siswa_' . date('d-m-Y');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    public function data_kelas()
    {
        $kelas = new Kelas();
        $data = [
            'title' => 'Data Kelas',
            'kelas' => $kelas->findAll(),
        ];
        return view('admin/data_kelas', $data);
    }
    public function tambah_kelas()
    {
        $data = [
            'title' => 'Tambah Kelas',
        ];
        return view('admin/tambah_kelas', $data);
    }
    public function save_kelas()
    {
        $kelas = new Kelas();
        $data = [
            'nama_kelas' => $this->request->getVar('nama_kelas'),
            'tagihan' => $this->request->getVar('tagihan'),
        ];
        $kelas->insert($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to(base_url('admin/data_kelas'));
    }
    public function hapus_kelas($id_kelas)
    {
        $kelas = new Kelas();
        $kelas->where('id_kelas', $id_kelas);
        $kelas->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('admin/data_kelas'));
    }
    public function edit_kelas($id_kelas)
    {
        $kelas = new Kelas();
        $data = [
            'title' => 'Edit Kelas',
            'kelas' => $kelas->where('id_kelas', $id_kelas)->first(),
        ];
        return view('/admin/edit_kelas', $data);
    }
    public function update_kelas($id_kelas)
    {
        $kelas = new Kelas();
        $kelas->save([
            'id_kelas' => $id_kelas,
            'nama_kelas' => $this->request->getVar('nama_kelas'),
            'tagihan' => $this->request->getVar('tagihan'),
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to(base_url('admin/data_kelas'));
    }
    public function pdf_kelas()
    {
        $filename = 'data_kelas_' . date('Y-m-d') . '.pdf';
        $kelas = new Kelas();
        $data = [
            'kelas' => $kelas->findAll(),
            'title' => 'Data Kelas',
        ];
        $dompdf = new Dompdf();
        $html = view('admin/pdf_kelas', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($filename, ['Attachment' => false]);
    }
    public function excel_kelas()
    {
        $kelas = new Kelas();
        $data = [
            'kelas' => $kelas->findAll(),
            'title' => 'Data Kelas',
        ];
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama Kelas')
            ->setCellValue('B1', 'Tagihan');

        $column = 2;
        foreach ($data['kelas'] as $k) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $k['nama_kelas'])
                ->setCellValue('B' . $column, $k['tagihan']);
            $column++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'data_kelas_' . date('Y-m-d');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    public function input_pembayaran()
    {
        $siswa = new Siswa();
        $kelas = new Kelas();
        $pembayaran = new Pembayaran();
        $saldo = new Saldo();
        $data = [
            'title' => 'Input Pembayaran',
            'siswa' => $siswa->findAll(),
            'kelas' => $kelas->findAll(),
            'pembayaran' => $pembayaran->findAll(),
            'saldo' => $saldo->findAll(),
        ];
        return view('admin/input_pembayaran', $data);
    }
    public function data_pembayaran()
    {
        $pembayaran = new Pembayaran();
        $data = [
            'title' => 'Data Pembayaran',
            'pembayaran' => $pembayaran->findAll(),
        ];
        return view('admin/data_pembayaran', $data);
    }
    public function save_pembayaran()
    {
        $pembayaran = new Pembayaran();
        $saldo = new Saldo();
        $pengeluaran = new Pengeluaran();
        $data = [
            'nis' => $this->request->getVar('nis'),
            'nama_siswa' => $this->request->getVar('nama_siswa'),
            'kelas' => $this->request->getVar('kelas'),
            'tagihan' => $this->request->getVar('tagihan'),
            'bulan' => $this->request->getVar('bulan'),
            'tanggal_pembayaran' => $this->request->getVar('tanggal_pembayaran'),
            'jam' => $this->request->getVar('jam'),
            'jumlah_bayar' => $this->request->getVar('jumlah_bayar'),
            'sisa_tagihan' => $this->request->getVar('sisa_tagihan'),
            'status_pembayaran' => $this->request->getVar('status_pembayaran'),
        ];

        $data['tagihan'] = str_replace('Rp ', '', $data['tagihan']);
        $data['tagihan'] = str_replace('.', '', $data['tagihan']);

        $data['jumlah_bayar'] = str_replace('Rp ', '', $data['jumlah_bayar']);
        $data['jumlah_bayar'] = str_replace('.', '', $data['jumlah_bayar']);

        $data['sisa_tagihan'] = str_replace('Rp ', '', $data['sisa_tagihan']);
        $data['sisa_tagihan'] = str_replace('.', '', $data['sisa_tagihan']);

        $data['tagihan'] = (int)$data['tagihan'];
        $data['jumlah_bayar'] = (int)$data['jumlah_bayar'];
        $data['sisa_tagihan'] = (int)$data['sisa_tagihan'];

        if ($data['sisa_tagihan'] !== 0) {
            $data['status_pembayaran'] = 'BELUM LUNAS';
        } else {
            $data['status_pembayaran'] = 'LUNAS';
        }
        // dd($data);
        $pembayaran->insert($data);
        $jenis_pembayaran = $this->request->getVar('jenis_pembayaran');
        // dd($jenis_pembayaran);
        if ($jenis_pembayaran == 'NON-TUNAI') {
            $data_pengeluaran = [
                'tgl_pengeluaran' => $this->request->getVar('tanggal_pembayaran'),
                'jam' => $this->request->getVar('jam'),
                'nis' => $this->request->getVar('nis'),
                'nama_siswa' => $this->request->getVar('nama_siswa'),
                'kelas' => $this->request->getVar('kelas'),
                'jumlah' => $this->request->getVar('jumlah_bayar'),
                'keterangan' => 'PEMBAYARAN SPP',
            ];
            $data_pengeluaran['jumlah'] = str_replace('Rp ', '', $data_pengeluaran['jumlah']);
            $data_pengeluaran['jumlah'] = str_replace('.', '', $data_pengeluaran['jumlah']);
            $data_pengeluaran['jumlah'] = (int)$data_pengeluaran['jumlah'];
            $pengeluaran->insert($data_pengeluaran);

            $saldo_siswa = $saldo->where('nis', $data['nis'])->first();
            $id_saldo = $saldo_siswa['id_saldo'];
            $saldo_siswa = $saldo_siswa['saldo'];
            $jumlah_bayar = $data['jumlah_bayar'];
            $saldo_siswa = $saldo_siswa - $jumlah_bayar;
            $saldo->save([
                'id_saldo' => $id_saldo,
                'saldo' => $saldo_siswa,
            ]);
        }
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to(base_url('admin/data_pembayaran'));
    }
    public function hapus_pembayaran($id_pembayaran)
    {
        $pembayaran = new Pembayaran();
        $pembayaran->where('id_pembayaran', $id_pembayaran);
        $pembayaran->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('admin/data_pembayaran'));
    }
    public function edit_pembayaran($id_pembayaran)
    {
        $pembayaran = new Pembayaran();
        $siswa = new Siswa();
        $kelas = new Kelas();
        $data = [
            'title' => 'Edit Pembayaran',
            'pembayaran' => $pembayaran->where('id_pembayaran', $id_pembayaran)->first(),
            'siswa' => $siswa->findAll(),
            'kelas' => $kelas->findAll(),
        ];
        return view('/admin/edit_pembayaran', $data);
    }
    public function update_pembayaran($id_pembayaran)
    {
        $pembayaran = new Pembayaran();
        $data = [
            'id_pembayaran' => $id_pembayaran,
            'nis' => $this->request->getVar('nis'),
            'nama_siswa' => $this->request->getVar('nama_siswa'),
            'kelas' => $this->request->getVar('kelas'),
            'tagihan' => $this->request->getVar('tagihan'),
            'bulan' => $this->request->getVar('bulan'),
            'tanggal_pembayaran' => $this->request->getVar('tanggal_pembayaran'),
            'jam' => $this->request->getVar('jam'),
            'jumlah_bayar' => $this->request->getVar('jumlah_bayar'),
            'sisa_tagihan' => $this->request->getVar('sisa_tagihan'),
            'status_pembayaran' => $this->request->getVar('status_pembayaran'),
        ];
        $data['tagihan'] = str_replace('Rp ', '', $data['tagihan']);
        $data['tagihan'] = str_replace('.', '', $data['tagihan']);

        $data['jumlah_bayar'] = str_replace('Rp ', '', $data['jumlah_bayar']);
        $data['jumlah_bayar'] = str_replace('.', '', $data['jumlah_bayar']);

        $data['sisa_tagihan'] = str_replace('Rp ', '', $data['sisa_tagihan']);
        $data['sisa_tagihan'] = str_replace('.', '', $data['sisa_tagihan']);

        $data['tagihan'] = (int)$data['tagihan'];
        $data['jumlah_bayar'] = (int)$data['jumlah_bayar'];
        $data['sisa_tagihan'] = (int)$data['sisa_tagihan'];

        if ($data['sisa_tagihan'] !== 0) {
            $data['status_pembayaran'] = 'BELUM LUNAS';
        } else {
            $data['status_pembayaran'] = 'LUNAS';
        }
        // dd($data);
        $pembayaran->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to(base_url('admin/data_pembayaran'));
    }
    public function pdf_pembayaran()
    {
        $filename = 'data_pembayaran_' . date('Y-m-d') . '.pdf';
        $pembayaran = new Pembayaran();
        $data = [
            'pembayaran' => $pembayaran->findAll(),
            'title' => 'Data Pembayaran',
        ];
        $dompdf = new Dompdf();
        $html = view('admin/pdf_pembayaran', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename, ['Attachment' => false]);
    }
    public function excel_pembayaran()
    {
        $pembayaran = new Pembayaran();
        $data = [
            'pembayaran' => $pembayaran->findAll(),
            'title' => 'Data Pembayaran',
        ];
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal Pembayaran')
            ->setCellValue('B1', 'Jam')
            ->setCellValue('C1', 'NIS')
            ->setCellValue('D1', 'Nama Siswa')
            ->setCellValue('E1', 'Kelas')
            ->setCellValue('F1', 'Tagihan')
            ->setCellValue('G1', 'Bulan')
            ->setCellValue('H1', 'Jumlah Bayar')
            ->setCellValue('I1', 'Sisa Tagihan')
            ->setCellValue('K1', 'Status Pembayaran');

        $column = 2;
        foreach ($data['pembayaran'] as $p) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, date('d-m-Y', strtotime($p['tanggal_pembayaran'])))
                ->setCellValue('B' . $column, $p['jam'])
                ->setCellValue('C' . $column, $p['nis'])
                ->setCellValue('D' . $column, $p['nama_siswa'])
                ->setCellValue('E' . $column, $p['kelas'])
                ->setCellValue('F' . $column, $p['tagihan'])
                ->setCellValue('G' . $column, $p['bulan'])
                ->setCellValue('H' . $column, $p['jumlah_bayar'])
                ->setCellValue('I' . $column, $p['sisa_tagihan'])
                ->setCellValue('K' . $column, $p['status_pembayaran']);
            $column++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'data_pembayaran_' . date('Y-m-d');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    public function data_angsuran()
    {
        $pembayaran = new Pembayaran();
        $data = [
            'title' => 'Data Angsuran',
            'pembayaran' => $pembayaran->where('status_pembayaran', 'BELUM LUNAS')->findAll(),
        ];
        return view('/admin/data_angsuran', $data);
    }
    public function angsuran($id_pembayaran)
    {
        $pembayaran = new Pembayaran();
        $data = $pembayaran->where('id_pembayaran', $id_pembayaran)->first();
        $pembayaran->save([
            'id_pembayaran' => $id_pembayaran,
            'jumlah_bayar' => $data['jumlah_bayar'] + $data['sisa_tagihan'],
            'sisa_tagihan' => 0,
            'status_pembayaran' => 'LUNAS',
        ]);
        session()->setFlashdata('pesan', 'Angsuran berhasil dipenuhi.');
        return redirect()->to(base_url('admin/data_angsuran'));
    }
    public function pdf_angsuran()
    {
        $filename = 'data_angsuran_' . date('Y-m-d') . '.pdf';
        $pembayaran = new Pembayaran();
        $data = [
            'pembayaran' => $pembayaran->where('status_pembayaran', 'BELUM LUNAS')->findAll(),
            'title' => 'Data Angsuran',
        ];
        $dompdf = new Dompdf();
        $html = view('admin/pdf_angsuran', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename, ['Attachment' => false]);
    }
    public function excel_angsuran()
    {
        $pembayaran = new Pembayaran();
        $data = [
            'pembayaran' => $pembayaran->where('status_pembayaran', 'BELUM LUNAS')->findAll(),
            'title' => 'Data Angsuran',
        ];
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal Pembayaran')
            ->setCellValue('B1', 'NIS')
            ->setCellValue('C1', 'Nama Siswa')
            ->setCellValue('D1', 'Bulan')
            ->setCellValue('E1', 'Sisa Tagihan')
            ->setCellValue('F1', 'Status Pembayaran');

        $column = 2;
        foreach ($data['pembayaran'] as $p) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, date('d-m-Y', strtotime($p['tanggal_pembayaran'])))
                ->setCellValue('B' . $column, $p['nis'])
                ->setCellValue('C' . $column, $p['nama_siswa'])
                ->setCellValue('D' . $column, $p['bulan'])
                ->setCellValue('E' . $column, $p['sisa_tagihan'])
                ->setCellValue('F' . $column, $p['status_pembayaran']);
            $column++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'data_angsuran_' . date('Y-m-d');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    public function data_pembayaran_lunas()
    {
        $pembayaran = new Pembayaran();
        $data = [
            'title' => 'Data Pembayaran Lunas',
            'pembayaran' => $pembayaran->where('status_pembayaran', 'LUNAS')->findAll(),
        ];
        return view('/admin/data_pembayaran_lunas', $data);
    }
    public function pdf_pembayaran_lunas()
    {
        $filename = 'data_pembayaran_lunas_' . date('Y-m-d') . '.pdf';
        $pembayaran = new Pembayaran();
        $data = [
            'pembayaran' => $pembayaran->where('status_pembayaran', 'LUNAS')->findAll(),
        ];
        $dompdf = new Dompdf();
        $html = view('admin/pdf_pembayaran_lunas', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename, ['Attachment' => false]);
    }
    public function excel_pembayaran_lunas()
    {
        $pembayaran = new Pembayaran();
        $data = [
            'pembayaran' => $pembayaran->where('status_pembayaran', 'LUNAS')->findAll(),
        ];
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal Pembayaran')
            ->setCellValue('B1', 'NIS')
            ->setCellValue('C1', 'Nama Siswa')
            ->setCellValue('D1', 'Kelas')
            ->setCellValue('E1', 'Bulan')
            ->setCellValue('F1', 'Sisa Tagihan')
            ->setCellValue('G1', 'Status Pembayaran');

        $column = 2;
        foreach ($data['pembayaran'] as $p) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, date('d-m-Y', strtotime($p['tanggal_pembayaran'])))
                ->setCellValue('B' . $column, $p['nis'])
                ->setCellValue('C' . $column, $p['nama_siswa'])
                ->setCellValue('D' . $column, $p['kelas'])
                ->setCellValue('E' . $column, $p['bulan'])
                ->setCellValue('F' . $column, $p['sisa_tagihan'])
                ->setCellValue('G' . $column, $p['status_pembayaran']);
            $column++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'data_pembayaran_lunas_' . date('Y-m-d');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    public function invoice($id_pembayaran)
    {
        $pembayaran = new Pembayaran();
        $data = [
            'title' => 'Invoice-' . $id_pembayaran,
            'pembayaran' => $pembayaran->where('id_pembayaran', $id_pembayaran)->first(),
        ];
        $dompdf = new Dompdf();
        $html = view('admin/invoice', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A5', 'potrait');
        $dompdf->render();
        $dompdf->stream('invoice-' . $id_pembayaran . '.pdf', ['Attachment' => false]);
    }
    public function tagihan_siswa()
    {
        $kelas = new Kelas();
        $siswa = new Siswa();
        $pembayaran = new Pembayaran();
        $data = [
            'title' => 'Tagihan Siswa',
            'kelas' => $kelas->findAll(),
            'siswa' => $siswa->findAll(),
            'pembayaran' => $pembayaran->findAll(),
        ];
        return view('admin/tagihan_siswa', $data);
    }
    public function login()
    {
        $data = [
            'title' => 'Login',
            'session' => session(),
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/login', $data);
    }
    public function logout()
    {
        $auth = service('authentication');
        $auth->logout();
        return redirect()->to(base_url('/admin'));
    }
}
