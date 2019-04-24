<?php

namespace App\Http\Controllers;

use App\Models\Item;
use DB;
use Excel;
use Illuminate\Http\Request;

class MaatwebsiteDemoController extends Controller
{

    public function importExport()
    {
        return view('importExport');
    }

    public function downloadExcel($type)
    {
        $data = Item::get()->toArray();

        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);

        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();

        if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = ['name' => $value->name, 'firstname' => $value->firstname, 'role' => $value->role, 'ajour' => $value->ajour, 'tel' => $value->tel, 'statut' => $value->statut, 'tel' => $value->tel, 'email' => $value->email ];
            }

            if(!empty($arr)){
                Item::insert($arr);
            }
        }

        return back()->with('success', 'Insert Record successfully.');
    }
}

