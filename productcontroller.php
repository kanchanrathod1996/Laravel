<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use DB;

use App\Models\Product_detail;

class productcontroller extends Controller
{



    public function index()
    {
        $product = DB::table('products')->get();
        // dd($product);
        return view('tube.index', compact('product'));

    }
    public function create()
    {
        return view ('tube.create');
    }
    public function store(Request $request )
            {

                $array = [];
                $array['name'] = $request->name;
                $array['price'] = $request->price;

        // $input = $request->all();//insert query
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $array['image'] = "$profileImage";
        }
        $getpid = DB::table('products')->insertGetId($array);
        // dd($getpid);

        $getallArray = array(

            'product_id'=> $getpid,
            'description' => $request->description,
            'm_date'=> $request->m_date

        );
        // dd($getallArray);
        DB::table('product_details')->insert($getallArray);


        return redirect('product/index')->with('success','Company has been created successfully.');
        }


     public function show($id): View
     {

        // dd($id);

        $product = DB::table('products')->where('products.id',$id)
                ->join('product_details','product_details.product_id','products.id')
                ->select('products.*','product_details.description','product_details.m_date')
                ->first();
        // dd($product);

         return view('tube.show',compact('product'));
     }


    //  */
    public function cart()
    {
        return view('tube.cart');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
    // $id = $request->input('id');
    // DB::table('products')->where(id,$id)->delete();

        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    // public function delete($id)
    // {
    //     $product = Product::findOrFail($id)->delete();
    //     // product::find($id)->delete();

    //     return response()->json(['success'=>'User Deleted Successfully!']);
    // }




    public function import(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        foreach ($fileContents as $line) {
            $data = str_getcsv($line);

            Product::create([
                'name' => $data[0],
                'price' => $data[1],
                // Add more fields as needed
            ]);
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
}
        public function export()
        {
            $products = Product::all();
            $csvFileName = 'products.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
            ];

            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Name', 'Price']); // Add more headers as needed

            foreach ($products as $product) {
                fputcsv($handle, [$product->name, $product->price]); // Add more fields as needed
            }

            fclose($handle);

            return Response::make('', 200, $headers);
}

}
