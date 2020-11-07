<?php

namespace App\Http\Controllers;
use App\invoices;
use App\invoice_attachments;
use App\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices=invoices::where('id',$id)->first();
        $invoices_details=invoices_details::where('id_Invoice',$id)->get();
        $invoice_attachments=invoice_attachments::where('invoice_id',$id)->get();

        return view('invoices.details_invoice',compact('invoices','invoices_details','invoice_attachments'));
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        $file_id=invoice_attachments::findOrFail($request->id);
        $file_id->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number .'/'. $request->file_name);
        session()->flash('delete','تم حذف المرفق بنجاح');
        return back();
       
    }

    public function open_file($file_name,$invoice_number){
        $files=Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number .'/' .$file_name);
        return response()->file($files);
    }

    public function get_file($file_name,$invoice_number){
        $download_file=Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number .'/' .$file_name);
        return response()->download($download_file);
    }
}
