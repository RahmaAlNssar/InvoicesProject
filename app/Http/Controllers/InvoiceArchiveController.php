<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoices;
class InvoiceArchiveController extends Controller
{
    public function index(){
        $invoices=invoices::onlyTrashed()->get();
        return view('invoices.Archive_Invoices',compact('invoices'));
    }
   public function restore_Archive(Request $request){
       $id=$request->id;
       $invoices=invoices::withTrashed()->restore();
       session()->flash('Edit','تمت استعادة الفاتورة بنجاح');
       return redirect('/invoices');
   }

   public function DeleteArchive(Request $request){
       $id=$request->id;
       $invoices=invoices::withTrashed()->where('id',$id)->first();
       $invoices->forceDelete();
       session()->flash('delete','تم حذف الفاتورة بنجاح');
       return back();
   }
}
