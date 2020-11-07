<?php

namespace App\Http\Controllers;

use App\products;
use App\sections;
use App\categories;
use App\supplier;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers=supplier::all();
        $categories=categories::all();
        $products=products::all();
        $sections=sections::all();
       
        $products = products::with('supplier')->where('product_name', 'LIKE', '%' . $request->search . '%')
        ->orWhere('supplier_id','LIKE', '%' . $request->search . '%')
        ->get();

        
            
             
            
              
          
       
      
       
        return view('products.products',compact('sections','products','suppliers','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator=$request->validate([
        //     'product_name'=>'required',
        //     'section_id'=>'required',
        //     'description'=>'required'
        // ],[
        //     'product_name.required'=>'يرجى ادخال اسم المنتج',
        //     'product_name.required'=>'يرجى ادخال التوصيف',
        //     'section_id.required'=>'يرجى ادخال القسم']);

        products::create([
                'product_name'=>$request->product_name,
                'section_id'=>$request->section_id,
                'description'=>$request->description,
                'price'=>$request->price,
                'category_id'=>$request->category_id,
              
                'supplier_id'=>$request->supplier_id
            ]);
            session()->flash('Add','تمت اضافة المنتج بنجاح');
            return redirect('/products');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    
        $id = sections::where('section_name', $request->section_name)->first()->id;

        $Products = Products::findOrFail($request->pro_id);
 
        $Products->update([
        'product_name' => $request->product_name,
        'description' => $request->description,
        'section_id' => $id,
        ]);
 
        session()->flash('Edit', 'تم تعديل المنتج بنجاح');
        return back();

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $Products = products::findOrFail($request->pro_id);
        $Products->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return back();
      
      
       
    }
}
