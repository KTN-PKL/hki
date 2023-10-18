<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use app\Models\m_masterpart;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Http\Request;

class PartImport implements ToCollection,WithStartRow
{
    private $id;
    public function __construct($id)
    {
        $this->part = new m_masterpart();
        $this->id = $id;

    }

    /**
    * @param Collection $collection
    */
    public function startRow(): int
    {
        return 5;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        { 
            if($row[1]==NULL){
                echo 'gagal upload';
            }else{
                $data = [
                    'id_user' =>  $this->id,
                    'part_no' => $row[1],
                    'part_name' => $row[2],
                    'composition' => $row[3],
                    'unit_price' => $row[4],
                    'class_part' => $row[5],
                    'drawing_no' => $row[6],
                    'effective_date' => Date::excelToDateTimeObject($row[7]),
                ];
                $this->part->addData($data);
            }
        }

    }
}
