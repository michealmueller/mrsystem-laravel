<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;
use Session;


class MembersController extends Controller
{

    public $members;


    public function index(Request $request)
    {
        if(!$request->pool){
            $pool = 'all';
        }else{
            $pool = $request->pool;
        }
        if($members = $this->Getmembers($pool)){
            if($pools = $this->GetPools()){
                return view('welcome')->with(compact('members','pools'));
            }
        }
    }

    public function EditMember($id)
    {
        if($member = self::GetMemberInfo($id)){
            return view('members.edit')->with('member', $member);
        }
    }


    public function GetMemberInfo($id)
    {
        $result = DB::table('members')->where('id', $id)->get()->first();
        return $result;
    }

    public function Getmembers($pool='all')
    {
        if($pool !== 'all')
        {
            $result = DB::table('members')->where('drug_pool', $pool)->get();
        }else{
            $result = DB::table('members')->where('excluded', 0)->get();
        }

        return $result;
    }

    public function RemoveMember($id)
    {
        DB::table('members')->where('id', $id)->delete();
        return true;
    }

    public function RandomIndex(Request $request)
    {
        if(!$request->pool){
            $pool = 'all';
        }else{
            $pool = $request->pool;
        }
        if($members = self::Getmembers($pool)){
            if($pools = $this->GetPools()){
                return view('members.random')->with('pools', $pools);
            }
        }
    }
    public function GetRandom(Request $request)
    {
        //dd($request);
        $count = DB::table('members')->where('excluded', 0)->count();
        if($request->rand_num <= $count){
            if($request->pool == 'all'){
                $members = DB::table('members')
                    ->where('excluded', 0)
                    ->take($request->rand_num)
                    ->inRandomOrder()
                    ->get();
            }else{
                $members = DB::table('members')
                    ->where('excluded', 0)
                    ->where('drug_pool', $request->pool)
                    ->inRandomOrder()
                    ->get();
            }

            $pools = self::GetPools($request->pool);
            //put the selected members in a session for later use.
            Session::put('members', $members);
            return view('members.random')->with(compact('members', 'pools'));
        }else{
            $pools = self::GetPools($request->pool);
            $custErrors = 'All users are selected or there are no users in the DB.';
            return view('members.random')->with(compact('pools', 'custErrors'));
        }

    }

    public function MarkSelected($id)
    {
        DB::table('members')
            ->where('id', $id)
            ->update([
            'excluded'=> 1
        ]);
    }

    public function ViewSelected()
    {

        $selected = DB::table('members')->where('excluded', 1)->get();

        return view('members.selected')->with('members', $selected);
    }

    public function GetPools()
    {
        $result = DB::table('members')
            ->select('drug_pool')
            ->groupby('drug_pool')
            ->distinct()
            ->get();
        return $result;
    }

    public function UpdateMember(Request $request)
    {
        DB::table('members')
            ->where('id', $request->id)
            ->update([
                'personel_number' => $request->personel_number,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' =>  $request->last_name,
                'ssn' =>  $request->ssn,
                'job_location' =>  $request->job_location,
                'manager' =>  $request->manager,
                'hr_rep' =>  $request->hr_rep,
                'field_admin' =>  $request->field_admin,
                'drug_pool' =>  $request->drug_pool,
                'excluded' =>  $request->excluded,
                'role' =>  $request->role
                ]);
        $member = self::GetMemberInfo($request->id);
        return view('members.edit')->with('member', $member);
    }

    public function Exportmembers(Request $request)
    {
        //mark as selected
        $members = Session::get('members');
        foreach($members as $member){
            self::MarkSelected($member->id);
        }
        //export PDF
        $html = '<table border="1">
        <tr>
            <th>Personel Number</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>LastName</th>
            <th>SSN</th>
            <th>Job Location</th>
            <th>Field Admin</th>
            <th>Drug Pool</th>
        </tr>';
               foreach($members as $member) {
                   $html .= '<tr>
                    <td>' .
                       $member->personel_number . '
                    </td>
                    <td>' .
                       $member->first_name . ' 
                    </td>
                    <td>' .
                       $member->middle_name . '
                    </td>
                    <td>' .
                       $member->last_name . '
                    </td>
                    <td>' .
                       $member->ssn . ' 
                    </td>
                    <td>' .
                       $member->job_location . ' 
                    </td>
                    <td>' .
                       $member->field_admin . ' 
                    </td>
                    <td>' .
                       $member->drug_pool . ' 
                    </td>
                </tr>
                ';
               }
               $html = $html.'</table>';
         $pdf = PDF::loadHTML($html);
         return $pdf->setPaper('a4', 'landscape')->save('pdfs/'.date('m-d-Y').'-SelectedMembers.pdf')->stream(date('m-d-Y').'-SelectedMembers.pdf');
    }
}