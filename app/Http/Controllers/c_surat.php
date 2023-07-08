<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\m_user;
use App\Models\m_role;
use App\Models\m_purchasingOrder;
use App\Models\m_surat;
use App\Models\m_detail_surat;

use DB;
use File;
use Auth;
use PDF;
use Validator;
use Carbon\Carbon;

class c_surat extends Controller
{
    public function __construct()
    {
        $this->user = new m_user();
        $this->role = new m_role();
        $this->PO = new m_purchasingOrder();
        $this->surat = new m_surat();
    }

    // Surat HKI

    public function tampilSurat_HKI()
    {
        $data = [
            'surat' => $this->surat->allData(),
        ];
        return view('hki.surat.index', $data);
    }

    // END Surat HKI


    // Surat Subcon

    public function tampilSurat_subcon()
    {
        $nama = Auth::user()->nama;
        $data = [
            'surat' => $this->surat->mySurat_Subcon($nama),
        ];
        return view('subcon.surat.index', $data);
    }

    public function createSurat_subcon()
    {
        $id = Auth::user()->id;
        $data = [
            'po' => $this->PO->myPO_Subcon($id),
            'tujuan'=> $this->user->hkiData(),
        ];
        return view('subcon.surat.create', $data);
    }

    public function ambilData($selectedValue){
        $id = Auth::user()->id;
        $data = $this->PO->ambilData($selectedValue,$id);
        return response()->json(['data' => $data]);
    }

    public function storeSurat_subcon(Request $request) {
        // Validasi input jika diperlukan
        $request->validate([ 
            'po_number'=> 'required',
            'tanggal'=> 'required|date',
            'partNoInput'=> 'required|array',
            'partNameInput'=> 'required|array',
            'qtyInput'=> 'required|array',
            'unitInput'=> 'required|array',
            ]);

        // Mengambil data dari input utama
        $poNumber=$request->input('po_number');
        $pengirim=$request->input('pengirim');
        $penerima=$request->input('penerima');
        $tanggal=$request->input('tanggal');
        $partNoInputs=$request->input('partNoInput');
        $partNameInputs=$request->input('partNameInput');
        $qtyInputs=$request->input('qtyInput');
        $unitInputs=$request->input('unitInput');
        $id=$this->surat->checkID();

        if ($id==null) {
            $id_baru=$id+1;
            $Surat=new m_surat();
            $Surat->no_surat=$id_baru;
            $Surat->po_number=$poNumber;
            $Surat->pengirim=$pengirim;
            $Surat->penerima=$penerima;
            $Surat->tanggal=$tanggal;
            $Surat->status="On Progress";
            $Surat->save();

            foreach ($partNoInputs as $index=> $partNoInputs) {
                $detailSurat=new m_detail_surat();
                $detailSurat->no_surat=$id_baru;
                $detailSurat->part_no=$partNoInputs;
                $detailSurat->part_name=$partNameInputs[$index];
                $detailSurat->qty=$qtyInputs[$index];
                $detailSurat->unit=$unitInputs[$index];
                $detailSurat->save();
            }
        }
        else {
            $idMax=$this->surat->maxIditem();
            $id_baru=$idMax+1;
            $Surat=new m_surat();
            $Surat->no_surat=$id_baru;
            $Surat->po_number=$poNumber;
            $Surat->pengirim=$pengirim;
            $Surat->penerima=$penerima;
            $Surat->tanggal=$tanggal;
            $Surat->status="On Progress";
            $Surat->save();

            foreach ($partNoInputs as $index=> $partNoInputs) {
                $detailSurat=new m_detail_surat();
                $detailSurat->no_surat=$id_baru;
                $detailSurat->part_no=$partNoInputs;
                $detailSurat->part_name=$partNameInputs[$index];
                $detailSurat->qty=$qtyInputs[$index];
                $detailSurat->unit=$unitInputs[$index];
                $detailSurat->save();
            }
        }
        return redirect()->route('subcon.surat.index')->with('success', 'success');
    }

    public function editSurat_Subcon($no)
    {
        $data = [
            'surat' => $this->surat->headSurat($no),
            'detail'=> $this->surat->detailSurat($no)
        ];
        return view('subcon.surat.edit', $data);
    }

    public function readSurat_Subcon($no)
    {
        $data = [
            'perusahaan' => $this->surat->detailPengirim($no),
            'surat' => $this->surat->headSurat($no),
            'detail'=> $this->surat->detailSurat($no)
        ];
        return view('subcon.surat.read', $data);
    }

    public function updateSurat_Subcon(Request $request, $no_surat)
    {
        // Validasi data yang diinputkan
        $request->validate([
            'tanggal' => 'required|date',
        ]);

        // Mengambil data surat jalan berdasarkan nomor surat
        $surat = m_surat::where('no_surat', $no_surat)->first();

        // Mengupdate tanggal pengiriman
        $surat->tanggal = $request->tanggal;
        $surat->save();

        // Mengembalikan pengguna ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('subcon.surat.index')->with('success', 'Surat jalan berhasil diperbarui.');
    }

    public function destroySurat_Subcon($no)
    {
        $this->surat->deleteData($no);
        return redirect()->route('subcon.surat.index')->with('success', 'Berhasil Dihapus');
    }


    // surat supplier
    public function tampilSurat_supplier()
    {
        $id = Auth::user()->nama;
        $data = [
            'surat' => $this->surat->mySurat_supplier($nama),
        ];
        return view('supplier.surat.index', $data);
    }

    public function createSurat_supplier()
    {
        $data = [
            'supplier' => $this->user->supplierData(),
        ];
        return view('supplier.surat.create', $data);
    }


    // tambah surat supplier
    public function storeSurat_supplier(Request $request)
    {
        $now = Carbon::now()->format('d-m-Y');
        $validator = Validator::make($request->all(), [
            'part_no' => 'required',
            'id_tujuan' => 'required',
            'part_name' => 'required',
            'order_qty' => 'required',
            'weight' => 'required',
            'order_no' => 'required',
            'po_number' => 'required',
            'delivery_time' => 'required',
            'payment' => 'required',
        ]);

        if ($validator->fails()) {
            session()->flash('error', 'error');
            return redirect()->back();
        } else {
            $id = $this->surat->checkID();
            if ($id == null) {
                $id_baru = $id + 1;
                $data = [
                    'no_surat' => $id_baru,
                    'part_no' => $request->part_no,
                    'id_tujuan' => $request->id_tujuan,
                    'id_supplier' => Auth::user()->id,
                    'part_name' => $request->part_name,
                    'order_qty' => $request->order_qty,
                    'weight' => $request->weight,
                    'order_no' => $request->order_no,
                    'po_number' => $request->po_number,
                    'delivery_time' => $request->delivery_time,
                    'payment' => $request->payment,
                    'dibuat' => $now,
                    'status' => "On Progress",
                ];
            } else {
                $idMax = $this->surat->maxIditem();
                $id_baru = $idMax + 1;
                $data = [
                    'no_surat' => $id_baru,
                    'part_no' => $request->part_no,
                    'id_tujuan' => $request->id_tujuan,
                    'id_supplier' => Auth::user()->id,
                    'part_name' => $request->part_name,
                    'order_qty' => $request->order_qty,
                    'weight' => $request->weight,
                    'order_no' => $request->order_no,
                    'po_number' => $request->po_number,
                    'delivery_time' => $request->delivery_time,
                    'payment' => $request->payment,
                    'dibuat' => $now,
                    'status' => "On Progress",
                ];
            }

            $this->surat->addDo($data);
            return redirect()->route('supplier.surat.index')->with('success', 'success');
        }
    }








    // Ajax
    public function detailPO($no)
    {
        $data = [
            'PO' => $this->PO->detailData($no)
        ];

        return view('subcon.po.detail', $data);
    }

    public function ubahStatus(Request $request)
    {
        $no_surat = $request->no_surat;
        $data = [
            'status' => "Finish",
        ];
        $this->surat->editData($no_surat, $data);
    }

    public function hki_lihatSurat(Request $request)
    {
        $no_surat = $request->no_surat;
        $data = [
            'surat' => $this->surat->detailSurat($request->no_surat),
        ];
        return view('hki.surat.read', $data);
    }

    public function subcon_lihatSurat(Request $request)
    {
        $no_surat = $request->no_surat;
        $data = [
            'surat' => $this->surat->detailSuratInSubcon($request->no_surat),
        ];
        return view('subcon.surat.read', $data);
    }
}
