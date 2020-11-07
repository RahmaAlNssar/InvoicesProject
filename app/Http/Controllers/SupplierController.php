<?php

namespace App\Http\Controllers;

use App\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier=supplier::all();
        return view('products.supplires',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=$request->validate([
            'name'=>'required',
            'address'=>'required',
            'phone_number'=>'required'
        ],[
            'name.required'=>'يرجى ادخال اسم المورد',
            'address.required'=>'يرجى ادخال عنوان المورد',
            'phone_number.required'=>'يرجى دخال رقم الهاتف'
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        supplier::create([
            'name'=>$request->name,
            'address'=>$request->address,
            'phone_number'=>$request->phone_number
        ]);
        session()->flash('Add','تمت اضافة المورد بنجاح');
        return redirect('suppliers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(supplier $supplier)
    {
        //
    }
}
