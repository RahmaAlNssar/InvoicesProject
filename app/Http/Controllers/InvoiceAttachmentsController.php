<?php

namespace App\Http\Controllers;

use App\invoice_attachments;
use App\invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class InvoiceAttachmentsController extends Controller
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
        $validator=$request->validate(['file_name'=>'mimes:pdf,jpg,png,jpeg,png'],[
            'file_name.mimes'=>' (pngأو jpegأوpngأو pngأوjpg)المرفق يجب أن يكون بي دي إف أو صورة من نوع'
        ]);
      
        $image=$request->file('file_name');
        $file_name=$image->getClientOriginalName();
        $invoice_number=$request->invoice_number;

        $invoice_attachments=new invoice_attachments();
        $invoice_attachments->file_name=$file_name;
        $invoice_attachments->invoice_number=$invoice_number;
        $invoice_attachments->Created_by=Auth::user()->name;
        $invoice_attachments->invoice_id=$request->invoice_id;
        $invoice_attachments->save();

        //move file

        $image_file=$request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachment/'.$invoice_number),$file_name);

        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoice_attachments  $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function show(invoice_attachments $invoice_attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoice_attachments  $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function edit(invoice_attachments $invoice_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoice_attachments  $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoice_attachments $invoice_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoice_attachments  $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoice_attachments $invoice_attachments)
    {
        //
    }
}
