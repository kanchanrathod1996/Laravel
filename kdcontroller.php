<?php

namespace App\Http\Controllers;
use App\Models\Navin;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;


class kdcontroller extends Controller
{

    public function index()
    {
        $navins = Navin::paginate(5);
        return view ('fbnote.index',compact('navins'));
    }

    public function create()
    {
        return view('fbnote.create');
    }

    public function store(Request $request)
{


    $request->validate([
        'name' => 'required',
        'detail' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
           $input =$request->all(); //insert query
        if ($image = $request->file('image'))
            {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
            }


                Navin::create ($input);
                return redirect('fbnote/index');

    }
            public function show($id)
            {
                $navin = Navin::find($id);//select query
                return view('fbnote.show',compact('navin'));

            }

            public function edit($id)
            {
                $navin = Navin::find($id);//select query
                return view('fbnote.edit',compact('navin'));
            }

            public function update(Request $request,$id):RedirectResponse
            {
                $request->validate([
                    'name' => 'required',
                    'detail' => 'required'
                ]);
                $input =$request->all(); //insert query

                if ($image = $request->file('image'))
                 {
                    $destinationPath = 'images/';
                    $profileImage = date('YmdHis') . "." . $image->getClientOriginalName();
                    $image->move($destinationPath, $profileImage);
                    $input['image'] = "$profileImage";
                }else
                  {
                    unset($input['image']);
                   }
                   $navin = Navin::find($id);//select query
                   $navin->update($input);  //UPDATE QUERY
                   return redirect('fbnote/index')->with('flash_message', 'student Updated!');

}



// public function destroy($id)
//     {
//     	DB::table("products")->delete($id);
//     	return response()->json(['success'=>"Product Deleted successfully.", 'tr'=>'tr_'.$id]);
//     }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function deleteAll(Request $request)
    // {
    //     $ids = $request->ids;
    //     DB::table("products")->whereIn('id',explode(",",$ids))->delete();
    //     return response()->json(['success'=>"Products Deleted successfully."]);
    // }
    public function destroy($id)
    {
        // Employ::destroy($id);
        $navin =Navin::find($id);

        if(!empty($navin))
        {
          $destinationPath = 'images/'.$navin->image;

        //   $destinationPath ='images/';
        }

        if(Navin::exists($destinationPath))
        {
          unlink($destinationPath);
        }
          $navin->delete();
          return response()->json(['success'=>"Product Deleted successfully.", 'tr'=>'tr_'.$id]);
    }


public function deleteAll(Request $request)
{
    $ids = $request->ids;
    DB::table("navin")->whereIn('id',explode(",",$ids))->delete();
    return response()->json(['success'=>"navin Deleted successfully.", 'tr'=>'tr_'.$id]);
}


















// public function destroy($id)
// {
//     // Employ::destroy($id);
//     $navin =Navin::find($id);

//     if(!empty($navin))
//     {
//       $destinationPath = 'images/'.$navin->image;

//     //   $destinationPath ='images/';
//     }

//     if(Navin::exists($destinationPath))
//     {
//       unlink($destinationPath);
//     }
//       $navin->delete();
//       return redirect('fbnote');
// }


}
