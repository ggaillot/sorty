<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return User::all();

//        return DB::select('SELECT SELECT users.name, users.firstname, users.role, users.ajour, users.tel, users.email FROM users ORDER BY users.name,users.firstname');
        return DB::table('users')->select('name', 'firstname','email','tel','ajour')->orderBy('name')->orderBy('firstname')->get();
       // return User::orderBy('name','Asc')->get();
    }

    public function headings(): array
    {
        return [
           'nom',
            'prenom',
            'email',
            'tel'

        ];
    }
}
