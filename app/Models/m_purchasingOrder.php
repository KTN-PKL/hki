<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class m_purchasingOrder extends Model
{
    use HasFactory;

    public function allData()
    {
        return DB::table('purchasing')->get();
    }

    public function getData($table){
        return DB::table($table)->get();
    }

    public function getSisaBarang(){
        return DB::table('purchasing')
        ->join('stocks','purchasing.id_po','=','stocks.id_po')
        ->join('users','purchasing.id_tujuan_po','=','users.id')
        ->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')
        ->get();
    }


    public function tampilPO_Supplier()
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.role_id')->where('purchasing.class', 'SUPPLIER')->get();
    }

    public function getIdPO(){
        return DB::table('purchasing')->max('id_po');
    }

    public function tampilPO_Subcon()
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.role_id')->where('purchasing.class', 'SUBCON')->get();
    }

    public function addData($table,$data)
    {
        DB::table($table)->insert($data);
    }
    
    public function editData($table,$key,$id,$data)
    {
        return DB::table($table)->where($key,$id)->update($data);
    }

    public function detailData($id)
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.id')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('purchasing_details.id_po', $id)->get();
    }

    public function detailPOSubcon()
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.role_id')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('purchasing.class', 'SUBCON')->get();
    }

    public function detailPOSupplier()
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.id')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('users.role_id', '3')->get();
    }

    public function getPOById($table,$id){
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.id')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('purchasing_details.id_po',$id)->first();
    }

    public function getDetailsByIdPO($id){
        return DB::table('purchasing_details')->where('id_po',$id)->get();
    }

    public function deleteData($table,$no)
    {
        return DB::table($table)->where('id_po', $no)->delete();
    }

    public function checkID()
    {
        return DB::table('purchasing')->count();
    }

    public function maxIditem()
    {
        return DB::table('purchasing')->max('no');
    }

    // PO DI HALAMAN SUBCON
    public function myPO_Subcon($id)
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.id')->where('id_tujuan_po', $id)->get();
    }

    public function fromPO($no)
    {
        return DB::table('purchasing')->join('users','purchasing.id_hki','=','users.id')->where('no', $no)->first();
    }

    public function listGroup($id_po)
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.id')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->join('users_detail','users.id','=','users_detail.id_user')->where('purchasing.id_po', $id_po)->get();
    }

    public function download($id_po)
    {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.id')->join('users_detail','users.id','=','users_detail.id_user')->where('purchasing.id_po', $id_po)->first();
    }

    public function sumAmount($id_po){
        return DB::table('purchasing_details')->where('purchasing_details.id_po',$id_po)->sum('purchasing_details.amount');
    }
    // bantu isi data tambah surat jalan
    public function ambilData_posubcon($selectedValue,$id){
        return DB::table('purchasing')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('po_number', $selectedValue)->where('id_tujuan_po', $id)->get();
    }
    public function ambilData_posupp($selectedValue,$id){
        return DB::table('purchasing')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->join('users','purchasing.id_tujuan_po','=','users.id')->where('po_number', $selectedValue)->where('id_tujuan_po', $id)->get();
    }
    public function ambilData_posupp_tujuan($selectedValue,$id){
        return DB::table('purchasing')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->join('users','purchasing.id_destination','=','users.id')->where('po_number', $selectedValue)->first();
    }


    public function sisaData(){
        return DB::table('purchasing')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->join('users','purchasing.id_destination','=','users.id')->get();
    }

    public function sumSisa(){
        return DB::table('purchasing')
        ->select('po_number',DB::raw('COUNT(*) as `count`'))
        ->groupBy('po_number')
        ->havingRaw('COUNT(*) > 1')
        ->get();
    }

    public function qtyPO(){
        return DB::table('purchasing')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')
        ->where('purchasing.class','=','SUBCON')
        ->where('purchasing.class','=','SUPPLIER')
        ->select('purchasing.po_number')
        ->groupBy('purchasing.po_number')
        ->get();
    }





    // END PO DI HALAMAN SUBCON

     // PO DI HALAMAN SUBCON

     public function myPO_Supplier($id)
     {
        return DB::table('purchasing')->join('users','purchasing.id_tujuan_po','=','users.id')->where('id_tujuan_po', $id)->get();
     }
      // END PO DI HALAMAN SUBCON


    //   Kondisi Ketika User dihapus dan User masih punya PO, maka PO akan dijadikan Log
    public function jadiLOG($id, $data)
    {
        return DB::table('purchasing')->where('id_tujuan', $id)->update($data);
    }
    
    public function validatePO($id_destination,$class){
        return DB::table('purchasing')
        ->where('purchasing.id_destination',$id_destination)
        ->where('purchasing.class',$class)
        ->first();
    }

    public function validatePOWithSurat($no_surat){
        return DB::table('purchasing')->join('surat','purchasing.po_number','=','surat.po_number')->where('surat.no_surat', $no_surat)->first();
    }

    public function getPOWithSurat($no_surat){
        return DB::table('surat')->join('purchasing','surat.po_number','=','purchasing.po_number')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('surat.no_surat',$no_surat)->get();
    }

    public function getSenderSurat($no_surat){
        return DB::table('surat')->join('purchasing','surat.po_number','=','purchasing.po_number')->join('purchasing_details','purchasing.id_po','=','purchasing_details.id_po')->where('surat.no_surat',$no_surat)->first();
    }
    // END Kondisi
}
