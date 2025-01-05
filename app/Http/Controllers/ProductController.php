<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\product;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //This method will show products page
    public function index(){
        $product =product::orderBy('created_at','DESC')->get();
        return view('products.list',[
            'products'=> $product
        ]);

    }
    
    //This method will show create product page
    public function create(){
        return view('products.create');
    }

    //This method will show create product page
    public function store(Request $request){
        //dd($request->all());
        $rules = [ 
            'name'=> 'required|string|min:4',
           'sku'=> 'required|string|min:5',
        'price'=> 'required|numeric'
        ];
        if($request->image != ""){
            $rules['image'] = 'image';
        }
        $request->validate($rules);
        //$validator=Validator::make ($request->all(),$rules);

        //if($validator->fails()){
           // return redirect()->route('products.create')->withInput()->withErrors($validator);
        //}

        // here we will insert product in db
        $product = new product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->image != ""){

             // here we will store image
        $image = $request->image;
        $ext =$image->getClientOriginalExtension();
        $imageName = time().'.'.$ext; //Unique image name

        //Save image to product directory
        $image->move(public_path('uploads/products'),$imageName);

        //Save image name in database
        $product->image = $imageName;
        $product->save();
        }

       


    return redirect()->route('products.index')->with('success','Product added successfully');

    }

    //This method will show edit product page
    public function edit($id){
        $product = Product::findOrFail($id);
        return view('products.edit',[
            'product'=> $product
        ]);
    }

    //This method will update a product
    public function update($id,Request $request){
       
        $product = Product::findOrFail($id);
       
        $rules = [ 
            'name'=> 'required|string|min:4',
           'sku'=> 'required|string|min:5',
        'price'=> 'required|numeric'
        ];
        if($request->image != ""){
            $rules['image'] = 'image';
        }
        // $request->validate($rules);
        $validator=Validator::make ($request->all(),$rules);

        if($validator->fails()){
           return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        // here we will update product in db
        
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if($request->image != ""){
            //delete old image
            File::delete(public_path('uploads/products/'.$product->image));
        }

        if($request->image != ""){

             // here we will store image
        $image = $request->image;
        $ext =$image->getClientOriginalExtension();
        $imageName = time().'.'.$ext; //Unique image name

        //Save image to product directory
        $image->move(public_path('uploads/products'),$imageName);

        //Save image name in database
        $product->image = $imageName;
        $product->save();
        }

       


    return redirect()->route('products.index',$product->id)->with('success','Product updated  successfully');

    

        
    }

    //This method will delete a product
    public function destroy($id){
        $product = Product::findOrFail($id);
        //delete image
        File::delete(public_path('uploads/products/'.$product->image));
        
        //delete product from database
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted  successfully');

    }
}
