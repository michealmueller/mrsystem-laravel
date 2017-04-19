<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class RandomSelectionController extends MembersController
{

    public function Randomindex()
    {
        if($pools = GetPools()){
            return view('members.random')->with('pools', $pools);
        }

    }

    public function getRandom($num, $pool)
    {

        $count = DB::table('members')->where('excluded', 0)->count();
        dd($count);
        if(!$memcount = $mysqli->query($count)){

            die('There was an error running the query [' . $mysqli->error . ']');
        }
        //check if the entered number is able to be fetched.
        foreach($memcount as $item){
            $users = $item;
        }
        if($num > $users){

            die('you must go back and select a number equal to or less then '.$memcount);
        }

        $sql = 'SELECT * 
                FROM users
                WHERE excluded = 0 AND drug_pool="'.$pool.'" LIMIT '.$num;
        if(!$results = $mysqli->query($sql)){

            die('There was an error running this query [' . $mysqli->error . ']');
        }
        foreach($results as $row)
        {
            $selected[] = $row;
        }
        return $selected;
    }
}
