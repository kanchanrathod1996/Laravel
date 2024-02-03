<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class asiyacontroller extends Controller
{

    public function index()
    {
        $data = DB::table('pops')->get();
        return view('osiya.index',compact('data'));



    }
    public function create()
    {
        return view('osiya.create');
    }

    public function store(Request $request)
    {

        $array  = [];
        $array['fname'] =$request->fname;
        $array['lname']= $request->lname;
        $array['email'] = $request->email;
        $array['password']=$request->password;
        // dd($array);
        DB::table('pops')->insert($array);
        return redirect('osiya/index');
    }




    public function action(Request $request )
    {
        $ids = $request->id;

        $result = pops::whereIn('id', explode(",", $ids))->delete();
        if ($result != null) {

            return 1;

        } else {

            return 0;

        }
    }
    // public function destroy($id)
    // {
    //     DB::table("pops")->delete($id);
    //     return response()->json(['success'=>"Product Deleted successfully.", 'tr'=>'tr_'.$id]);
    // }


    // public function deleteAll(Request $request)
    // {
    //     $ids = $request->ids;
    //     DB::table("pops")->whereIn('id',explode(",",$ids))->delete();
    //     return response()->json(['success'=>"Products Deleted successfully."]);
    // }
}
