<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Query\QueryException;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use SplFileObject;

class MembersImportController extends Controller
{
    public $filePath;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('import.memberimport');
    }

    public function uploadFile(Request $request)
    {
        $file = $request->File;

        //make the directory if it does not exist already
        if(!File::isDirectory('uploads')){
            File::makeDirectory('uploads');
        }

        $file->move('uploads', $file->getClientOriginalName());
        $this->filePath = 'uploads/'.$file->getClientOriginalName();

        //then import the users to the DB
        if(self::store($request)) {
            return view('import.memberimport')->with('success', true);
        }else{
            return view('import.memberimport')->withErrors('import');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $records = array();
        //rad the file line by line to get each record
        $file = new SplFileObject($this->filePath);

        while (!$file->eof()) {
            if (!$file->fgets() == ''){
                $contents[] = $file->fgets();
            }
        }
        //sanity check
        if (isset($contents)) {
            //clean the input
            foreach ($contents as $content) {
                $content = str_replace("\r\n", '', $content);
                $content = str_replace("\\r\n", '', $content);
                $contentsNew[] = $content;
            }
            //explode each record with delimiter
            foreach ($contentsNew as $content) {
                $records[] = explode(',', $content);
            }
            //drop the first array as its the fields.
            unset($records[0]);

        } else {
            die('there was an issue with reading the file.');
        }
        //check if the user want to clear the DB before they import more users.
//dd($request);
        if ($request->deleteall == 1) {
            DB::table('members')->truncate();
        }

        foreach ($records as $record) {
            //clean the input.

            $insert = DB::table('members')->insert([
                [
                    'personel_number' => $record[0],
                    'first_name' => $record[1],
                    'middle_name' => $record[2],
                    'last_name' => $record[3],
                    'ssn' => $record[4],
                    'job_location' => $record[5],
                    'manager' => $record[6],
                    'hr_rep' => $record[7],
                    'field_admin' => $record[8],
                    'drug_pool' => $record[9],
                    'excluded' => 0,
                    'role' => 1
                ]
            ]);
        }
        return $insert;
    }
}

