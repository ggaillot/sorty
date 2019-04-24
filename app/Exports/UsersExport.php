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

//        return DB::select('SELECT sorty.users.name, sorty.users.firstname, sorty.users.role, sorty.users.ajour, sorty.users.tel, sorty.users.email FROM sorty.users ORDER BY sorty.users.name,sorty.users.firstname');
        return DB::table('users')->select('name', 'firstname','email','tel','ajour')->orderBy('name')->orderBy('firstname')->get();
       // return User::orderBy('name','Asc')->get();
    }

    public function headings(): array
    {
        return [
            'name',
            'firstname',
            'email',
            'tel',
            'ajour'

        ];
    }
}
