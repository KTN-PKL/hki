<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_masterpart;
use App\Models\m_user;
use App\Models\m_role;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use App\Imports\PartImport;

class c_masterpart extends Controller
{
    public function __construct()
    {
        $this->user = new m_user();
        $this->role = new m_role();
        $this->part = new m_masterpart();
       
    }
    public function index()
    {
        $data =[
            'part' => $this->part->datapart(),
            'produser' => $this->user->produserData(),
        ];
        return view ('hki.managePart.index',$data);
    }
    public function create()
    {
        $data =[
            'produser' => $this->part->Dataproduser(),
            'perusahaan' => $this->part->dataSupplier(),
        ];
        return view ('hki.managePart.create',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'part_no' => 'required',
            'part_name' => 'required',
            'composition' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'drawing_no' => 'required',
            'class_part' => 'required',
            'effective_date' => 'required',
        ]);
        $id=$this->part->checkID();
        if ($id==null) {
            $id_baru=$id+1;
        // Simpan data ke database berdasarkan request yang diterima
        m_masterpart::create([
            'id_part' => $id_baru,
            'id_user' => $request->id_user,
            'part_no' => $request->part_no,
            'part_name' => $request->part_name,
            'composition' => $request->composition,
            'unit_price' => $request->unit_price,
            'drawing_no' => $request->drawing_no,
            'class_part' => $request->class_part,
            'effective_date' => $request->effective_date,
        ]);
        } else{
            $idMax=$this->part->maxIditem();
            $id_baru=$idMax+1;
            m_masterpart::create([
                'id_part' => $id_baru,
                'id_user' => $request->id_user,
                'part_no' => $request->part_no,
                'part_name' => $request->part_name,
                'composition' => $request->composition,
                'unit_price' => $request->unit_price,
                'drawing_no' => $request->drawing_no,
                'class_part' => $request->class_part,
                'effective_date'=> $request->effective_date,
            ]);
        }
        return redirect()->route('hki.part.index')->with('success', 'Part berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data =[
            'produser' => $this->part->Dataproduser(),
            'part'=>$this->part->ambil_datapart($id),
        ];
        return view ('hki.managePart.edit', $data);
    }

    public function update(Request $request, $id_part)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'id_user' => 'required', // Assuming 'users' table is where 'id_user' comes from
            'part_no' => 'required|string',
            'part_name' => 'required|string',
            'composition' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'drawing_no' => 'required',
            'class_part' => 'required',
            'effective_date' => 'required',
        ]);
        
        // Find the part to be updated
        $part = m_masterpart::findOrFail($id_part);

        // Update the part attributes
        $part->id_user = $validatedData['id_user'];
        $part->part_no = $validatedData['part_no'];
        $part->part_name = $validatedData['part_name'];
        $part->composition = $validatedData['composition'];
        $part->unit_price = $validatedData['unit_price'];
        $part->drawing_no = $validatedData['drawing_no'];
        $part->class_part = $validatedData['class_part'];
        $part->effective_date = $validatedData['effective_date'];
        // Save the updated part
        $part->save();

        return redirect()->route('hki.part.index')->with('success', 'Data Part berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->part->deleteData($id);
        return redirect()->route('hki.part.index')->with('success','Berhasil Dihapus');
    }

    public function import(Request $request){
        $data = Excel::toArray([], $request->file('excel')->store('files'));
     
        if ($data[0][1][1] <> $request->nama){
            return redirect()->route('hki.part.index')->with('success','Terjadi Perbedaan Produser Part');
        }else{
            $data = Excel::import(new PartImport($request->id_user), $request->file('excel')->store('files'));
            return redirect()->route('hki.part.index')->with('success','Import Part');
        }
    }


    // js
    public function getNama($id)
    {
        $getNama = $this->user->getName_Perusahaan($id);
        $data = [
            'id' => $getNama->id_perusahaan,
            'nama' => $getNama->nama,
        ];
    
        return response()->json($data);
        
    }
    
}
