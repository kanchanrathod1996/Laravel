<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Hash;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Student;
use Illuminate\View\View;
// use DB;

class studentcontroller extends Controller
 {




    public function index()

    {
         $students = Student::all();
        return view('student.index',compact('students'));
    }

    public function create()

    {
        return view('student.create');
    }

    public function store(Request $request)

    {
        $input = $request->all();

        $request->validate([
            'title' => 'required',
            'name' => 'required|max:255',
            'bday' => 'required|date',
            'age' => 'required|numeric',
            'gender' => 'required',
            'phone' => 'required|min:10',
            'address' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:255',
            'category' => 'required|min:2',
        ]);

        $input['password'] = bcrypt($input['password']);
        // $input->categories =json-encode ($request->category);
        Student::create($input);


        return redirect()->route('student.index')->with('success','Successfully registered a new student!');

    }


    public function show($id): View
    {

        $student = Student::find($id);    //SELECT QUERY
        return view('student.show',compact('student'));
    }

    public function edit($id): View
    {
        $student = Student::find($id);   //SELECT QUERY
        return view('student.edit',compact('student'));
        // dd('$student');
    }



    public function update(Request $request, $id): RedirectResponse
    {
        $student=$request->validate([

            'title' => 'required',
            'name' => 'required|max:255',
            'bday' => 'required|date',
            'age' => 'required|numeric',
            'gender' => 'required',
            'phone' => 'required|min:10',
            'address' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:255',
            'category' => 'required|min:2',
        ]);
        dd('$request');
        $input = $request->all();
        $id->update($input); //UPDATE QUERY
        $id->fill($request->post)->save();
        return redirect('student')->with('flash_message', 'student Updated!');
        // dd('$student');

    }








































































        // public function index(): View
        // {
        //     $students = Student::all();  //SELECT QUERY
        //     return view ('students.index', compact('students'));
        // }


        // public function create(): View
        // {
        //     return view('students.create');
        // }


        // public function store(Request $request): RedirectResponse
        // {
        //     $input = $request->all();     //INSERT QUERY
        //     Student::create($input);
        //     return redirect('student')->with('flash_message', 'Student Addedd!');
        // }

        // public function show(string $id): View
        // {
        //     $student = Student::find($id);    //SELECT QUERY
        //     return view('students.show')->with('students', $student);
        // }

        // public function edit(string $id): View
        // {
        //     $student = Student::find($id);   //SELECT QUERY
        //     return view('students.edit')->with('students', $student);
        // }

        // public function update(Request $request, string $id): RedirectResponse
        // {
        //     $student = Student::find($id);
        //     $input = $request->all();
        //     $student->update($input);  //UPDATE QUERY
        //     return redirect('student')->with('flash_message', 'student Updated!');
        // }

        // public function destroy(string $id): RedirectResponse
        // {

        //     Student::destroy($id);   //DELETE QUERY
        //     return redirect('student')->with('flash_message', 'Student deleted!');
        // }

























// ----------------------------------------------heare crud start-----------------------------------

      // //  login form here
//             public function fblogin()
//             {
//                 return view ('fblogin');

//             }
//             public function add(Request $request)
//             {

//                 $request->validate([
//                     'email' => 'required',
//                     'password' => 'required',
//                 ]);
//                 $credentials = $request->only('email', 'password');

//                 if (Auth::attempt($credentials)) {
//                     //  dd($credentials);
//                     return redirect()->intended('dashboard')
//                                 ->withSuccess('status','You have Successfully loggedin');
//                 }
//                 return redirect("fbregistraion")->withSuccess('Oppes! Login details are not valid');
//             }

// // kkkkkkkkkkkkkkkk

// // public function customLogin(Request $request)
// // {
// //     $request->validate([
// //         'email' => 'required',
// //         'password' => 'required',
// //     ]);
// //     $credentials = $request->only('email', 'password');
// //     if (Auth::attempt($credentials)) {
// //         return redirect()->intended('dashboard')
// //             ->withSuccess('Signed in');
// //     }
// //     return redirect("fbregistraion")->withSuccess('Login details are not valid');
// // }




// // registration page here
//         public function fbregistraion()
//         {
//             return view('fbregistraion');
//         }
//                     public function store(Request $request)
//                          {
//                             $request->validate([
//                                 'name' =>'required',
//                                 'email' => 'required',
//                                 'password' => 'required',
//                             ]);
//                             $array=array(

//                                 'name' => $request ->name,
//                                 'email' => $request ->email,
//                                 'password'=>Hash::make($request->newPassword),
//                                  );
//                                 //   dd('$array');
//                                 DB::table('tests') ->insert($array);
//                                 return  redirect('fblogin')->with('status','You have Successfully registration');
//                            }



}
