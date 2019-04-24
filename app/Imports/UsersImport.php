<?php

namespace App\Imports;

use App\User;
use App\Models\Usertemp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class UsersImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Usertemp([
            'name'  => $row['name'],
            'firstname'  => $row['firstname'],
            'role'  => $row['role'],
            'ajour'  => $row['ajour'],
            'tel'  => $row['tel'],
            //'statut'  => $row['statut'],

            'email' => $row['email'],
           // 'password' => \Hash::make('123456'),
        ]);









    }

}
