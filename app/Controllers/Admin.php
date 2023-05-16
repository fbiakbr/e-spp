<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pembayaran;
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
        $kelas = new Kelas();
        $data = [
            'title' => 'Tambah Siswa',
            'kelas' => $kelas->findAll(),
        ];
        return view('admin/tambah_siswa', $data);
    }
    public function save_siswa()
    {
        $siswa = new Siswa();
        $data = [
            'nis' => $this->request->getVar('nis'),
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
                'nama_siswa' => $s[1],
                'kelas' => $s[2],
                'tempat_lahir' => $s[3],
                'tanggal_lahir' => $s[4],
                'no_hp' => $s[6],
                'alamat' => $s[5],
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
    public function input_pembayaran()
    {
        $siswa = new Siswa();
        $kelas = new Kelas();
        $data = [
            'title' => 'Input Pembayaran',
            'siswa' => $siswa->findAll(),
            'kelas' => $kelas->findAll(),
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
            'kembalian' => $this->request->getVar('kembalian'),
            'status_pembayaran' => $this->request->getVar('status_pembayaran'),
        ];
        $data['tagihan'] = str_replace('Rp ', '', $data['tagihan']);
        $data['tagihan'] = str_replace('.', '', $data['tagihan']);

        $data['jumlah_bayar'] = str_replace('Rp ', '', $data['jumlah_bayar']);
        $data['jumlah_bayar'] = str_replace('.', '', $data['jumlah_bayar']);

        $data['sisa_tagihan'] = str_replace('Rp ', '', $data['sisa_tagihan']);
        $data['sisa_tagihan'] = str_replace('.', '', $data['sisa_tagihan']);

        $data['kembalian'] = str_replace('Rp ', '', $data['kembalian']);
        $data['kembalian'] = str_replace('.', '', $data['kembalian']);

        $data['tagihan'] = (int)$data['tagihan'];
        $data['jumlah_bayar'] = (int)$data['jumlah_bayar'];
        $data['sisa_tagihan'] = (int)$data['sisa_tagihan'];
        $data['kembalian'] = (int)$data['kembalian'];

        if ($data['sisa_tagihan'] !== 0) {
            $data['status_pembayaran'] = 'BELUM LUNAS';
        } else {
            $data['status_pembayaran'] = 'LUNAS';
        }
        // dd($data);
        $pembayaran->insert($data);
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
            'kembalian' => $this->request->getVar('kembalian'),
            'status_pembayaran' => $this->request->getVar('status_pembayaran'),
        ];
        $data['tagihan'] = str_replace('Rp ', '', $data['tagihan']);
        $data['tagihan'] = str_replace('.', '', $data['tagihan']);

        $data['jumlah_bayar'] = str_replace('Rp ', '', $data['jumlah_bayar']);
        $data['jumlah_bayar'] = str_replace('.', '', $data['jumlah_bayar']);

        $data['sisa_tagihan'] = str_replace('Rp ', '', $data['sisa_tagihan']);
        $data['sisa_tagihan'] = str_replace('.', '', $data['sisa_tagihan']);

        $data['kembalian'] = str_replace('Rp ', '', $data['kembalian']);
        $data['kembalian'] = str_replace('.', '', $data['kembalian']);

        $data['tagihan'] = (int)$data['tagihan'];
        $data['jumlah_bayar'] = (int)$data['jumlah_bayar'];
        $data['sisa_tagihan'] = (int)$data['sisa_tagihan'];
        $data['kembalian'] = (int)$data['kembalian'];

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
        $customPaper = array(0, 0, 400, 400);
        $dompdf->setPaper($customPaper);
        $dompdf->render();
        $dompdf->stream('invoice-' . $id_pembayaran . '.pdf', ['Attachment' => false]);
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
