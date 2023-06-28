<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\m_user;
use App\Models\m_role;
use App\Models\m_purchasingOrder;
use DB;
use File;
use Auth;
use Carbon\Carbon;

class c_purchasingOrder extends Controller
{
    public function __construct()
    {
        $this->user = new m_user();
        $this->role = new m_role();
        $this->PO = new m_purchasingOrder();
       
    }

    // PO SUPPLIER
    public function tampilPO_Supplier()
    {
        $data =[
            'PO' => $this->PO->tampilPO_Supplier(),
        ];
        return view ('hki.po.supplier.index', $data);
    }

    public function createPO_Supplier()
    {
        $data =[
            'supplier' => $this->user->supplierData(),
            'subcon' => $this->user->subconData(),
        ];
        return view ('hki.po.supplier.create', $data);
    }

    public function storePO_Supplier(Request $request)
    {
        $part_no = $request->part_no;
        $no = 0;
        if($part_no == NULL){
            return redirect()->route('hki.po.supplier.index')->with('fail','Silakan lengkapi data terlebih dahulu!');
        }else{
            $parts = [];
            foreach ($part_no as $index) {

                $parts[] = [
                    "po_number" => $request->po_number,
                    "id_tujuan" => $request->id_tujuan,
                    "id_destination" => $request->destination,
                    "default_supplier_id" => $request->default_id,
                    "issue_date" => $request->issue_date,
                    "class" => $request->classname,
                    "currency_code" => $request->currency,
                    "part_no" => $request->part_no[$no],
                    "part_name" => $request->part_name[$no],
                    "unit_price" => $request->unit_price[$no],
                    "composition" => $request->composition[$no],
                    "order_qty" => $request->qty[$no],
                    "unit" => $request->unit[$no],
                    "amount" => $request->amount[$no],
                    "delivery_time" => $request->delivery_date[$no],
                    "order_number" => $request->order_number[$no],
                    "status" => 'On Progress'
                ];
                $no++;
            }
            $this->PO->addData($parts);
            return redirect()->route('hki.po.supplier.index')->with('success','PO berhasil ditambahkan');
        }

    }

    public function editPO_Supplier($id,$id_subcon,$id_supplier)
    {
        $data =[
            'PO' => $this->PO->detailData($id),
            'subcon' => $this->user->subconData(),
            'subconBy' => $this->user->subconDataById($id_subcon),
            'supplier' => $this->user->supplierData(),
            'supplierBy' => $this->user->supplierDataById($id_supplier) 
        ];
        return view ('hki.po.supplier.edit', $data);
    }

    public function updatePO_Supplier(Request $request, $id_po)
    {
        $part_no = $request->part_no;

        if($part_no == NULL){
            return redirect()->route('hki.po.supplier.index')->with('fail','Silakan lengkapi data terlebih dahulu!');
        }else{
                $part = [
                    "po_number" => $request->po_number,
                    "id_tujuan" => $request->id_tujuan,
                    "id_destination" => $request->destination,
                    "default_supplier_id" => $request->default_id,
                    "issue_date" => $request->issue_date,
                    "class" => $request->classname,
                    "currency_code" => $request->currency,
                    "part_no" => $request->part_no,
                    "part_name" => $request->part_name,
                    "unit_price" => $request->unit_price,
                    "composition" => $request->composition,
                    "order_qty" => $request->qty,
                    "unit" => $request->unit,
                    "amount" => $request->amount,
                    "delivery_time" => $request->delivery_date,
                    "order_number" => $request->order_number,
                    "status" => 'On Progress'
                ];
            }
           
        $this->PO->editData($id_po, $part);
        return redirect()->route('hki.po.supplier.index')->with('success', 'User Berhasil diupdate.');
           
        }
         
        // END HKI PO SUPPLIER

        // HKI PO SUBCON
        public function tampilPO_Subcon()
    {
        $data =[
            'PO' => $this->PO->tampilPO_Subcon(),
        ];
        return view ('hki.po.subcon.index', $data);
    }

    public function createPO_Subcon()
    {
        $data =[
            'subcon' => $this->user->subconData(),
        ];
        return view ('hki.po.subcon.create', $data);
    }

    public function storePO_Subcon(Request $request)
    {
        $now = Carbon::now()->format('d-m-Y');
        $request->validate([
            'part_no' => 'required',
            'id_tujuan' => 'required',
            'part_name' => 'required',
            'order_qty' => 'required',
            'weight' => 'required',
            'order_no' => 'required',
            'po_number' => 'required',
            'delivery_time' => 'required',
            'payment' => 'required',
        ],[
            'part_no.required'=>'Part Nomor Wajib terisi',
            'id_tujuan.unique'=>'Supplier Wajib Diisi',
            'part_name.required'=>'Part Name Wajib terisi',
            'order_qty.required'=>'Order QTY Wajib terisi',
            'weight.required'=>'Weight Wajib terisi',
            'order_no.required'=>'Order No Wajib terisi',
            'po_number.required'=>'PO Number Wajib terisi',
            'delivery_time.required'=>'Delivery Time Wajib terisi',
            'payment.required'=>'Payment Wajib terisi',
        ]);

        $id = $this->PO->checkID();
        if($id == null)
        {
            $id_baru = $id+1;
            $data =[
                'no'=> $id_baru,
                'part_no' => $request->part_no,
                'id_tujuan' => $request->id_tujuan,
                'id_hki' => Auth::user()->id,
                'part_name' => $request->part_name,
                'order_qty' => $request->order_qty,
                'weight' => $request->weight,
                'order_no' => $request->order_no,
                'po_number' => $request->po_number,
                'payment' => $request->payment,
                'issue_date' => $now,
                'delivery_time' => $request->delivery_time,
                'status'=> "On Progress",
            ];
          
        }else{
            $idMax = $this->PO->maxIditem();
            $id_baru = $idMax+1;
            $data =[
                'no'=> $id_baru,
                'part_no' => $request->part_no,
                'id_tujuan' => $request->id_tujuan,
                'id_hki' => Auth::user()->id,
                'part_name' => $request->part_name,
                'order_qty' => $request->order_qty,
                'weight' => $request->weight,
                'order_no' => $request->order_no,
                'po_number' => $request->po_number,
                'payment' => $request->payment,
                'issue_date' => $now,
                'delivery_time' => $request->delivery_time,
                'status'=> "On Progress",
            ];
        }
        $this->PO->addData($data);
        return redirect()->route('hki.po.subcon.index')->with('success','PO berhasil ditambahkan');
    }

    public function editPO_Subcon($no)
    {
        $data =[
            'PO' => $this->PO->detailData($no),
            'subcon' => $this->user->subconData(),
        ];
        return view ('hki.po.subcon.edit', $data);
    }

    public function updatePO_Subcon(Request $request, $no)
    {

        $request->validate([
            'part_no' => 'required',
            'id_tujuan' => 'required',
            'part_name' => 'required',
            'order_qty' => 'required',
            'weight' => 'required',
            'order_no' => 'required',
            'po_number' => 'required',
            'delivery_time' => 'required',
        ],[
            'part_no.required'=>'Part Nomor Wajib terisi',
            'id_tujuan.unique'=>'Supplier Wajib Diisi',
            'part_name.required'=>'Part Name Wajib terisi',
            'order_qty.required'=>'Order QTY Wajib terisi',
            'weight.required'=>'Weight Wajib terisi',
            'order_no.required'=>'Order No Wajib terisi',
            'po_number.required'=>'PO Number Wajib terisi',
            'delivery_time.required'=>'Delivery Time Wajib terisi',
        ]);

            $data = [
                'part_no' => $request->part_no,
                'id_tujuan' => $request->id_tujuan,
                'id_hki' => Auth::user()->id,
                'part_name' => $request->part_name,
                'order_qty' => $request->order_qty,
                'weight' => $request->weight,
                'order_no' => $request->order_no,
                'po_number' => $request->po_number,
                'payment' => $request->payment,
                'delivery_time' => $request->delivery_time,
            ];

           
           
        $this->PO->editData($no, $data);
        return redirect()->route('hki.po.subcon.index')->with('success', 'PO Berhasil diupdate.');
           
        }
         

        // END HKI PO SUBCON
    
        




    // Ajax
    function ubahStatus(Request $request)
    {
        $no = $request->no;
        $status = $request->status;
        $data = [
            'status'=> $status,
        ];
        $this->PO->editData($no, $data);

    }

    public function destroyPO_Supplier($id_po)
    {
        $this->PO->deleteData($id_po);
        return redirect()->route('hki.po.supplier.index')->with('success','Berhasil Dihapus');
    }

    public function destroyPO_Subcon($no)
    {
        $this->PO->deleteData($no);
        return redirect()->route('hki.po.subcon.index')->with('success','Berhasil Dihapus');
    }

    function detailPO_Supplier($no)
    {
        $data = [
            'PO'=> $this->PO->detailData($no)
        ];
        
        return view('hki.po.supplier.detail', $data);

    }

    public function myPO_Download($no)
    {
        $data =[
            'from'=> $this->PO->download($no),
            'hki'=> $this->user->detailHKI(),
        ];
        // return view('subcon.po.pdf', $data);
        $pdf = PDF::loadview('po.supplier.download', $data)->setPaper('legal', 'potrait');;
	    return $pdf->download('laporan-PO.pdf');
    }
    
}
