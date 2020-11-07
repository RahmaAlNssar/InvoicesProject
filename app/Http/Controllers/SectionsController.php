<?php

namespace App\Http\Controllers;

use App\sections;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=sections::all();
        return view('sections.sections',compact('sections'));
       
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
    //     $input= $request->all();
    //  $section=sections::where('section_name',$input['section_name'])->exists();
    //  if($section){
    //      session()->flash('Error','هذا القسم موجود مسبقا');
    //      return redirect('/sections');
    //  }else{
    //     sections::create([
    //         'section_name'=>$request->section_name,
    //         'description'=>$request->description,
    //         'created_by'=>(Auth::user()->name)
    //     ]);
    //     session()->flash('add','تمت اضافة القسم بنجاح');
    //     return redirect('/sections');
    //     }

        //طريقة ثانية
    //  

    //  
   
    //
    
        $validator=$request->validate( ['section_name' => 'required|unique:sections',
        'description' => 'required'],[
            'section_name.required'=>'يرجى ادخال اسم القسم',
            'section_name.unique'=>'هذا القسم موجود',
            'description.required'=>'يرجى ادخال التوصيف'
        ]);
     
      sections::create([
            'section_name'=>$request->section_name,
            'description'=>$request->description,
            'created_by'=>(Auth::user()->name)
        ]);

        session()->flash('Add','تمت اضافة القسم بنجاح');
        return redirect('/sections');
     
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       $id=$request->id;
      $validator=$request->validate(['section_name'=>'required|unique:sections',
      'description'=>'required'],[
        'section_name.required'=>'يرجى ادخال اسم القسم',
        'section_name.unique'=>'هذا القسم موجود',
        'description.required'=>'يرجى ادخال التوصيف'
      ]);

      $section=sections::find($id);
        
      $section->update([
        'section_name'=>$request->section_name,
        'description'=>$request->description
      ]);
      session()->flash('edit','تم التعديل بنجاح');
      return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
        $sections=sections::find($id);
        $sections->delete();
        session()->flash('delete','تم الذف بنجاح');
        return redirect('/sections');
    }
}
