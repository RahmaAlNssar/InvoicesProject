<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\invoices;
use App\sections;
use App\invoices_details;
use App\invoice_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Notifications\AddInvoice;
use App\Exports\InvoiceExport;
use Maatwebsite\Excel\Facades\Excel;
class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=invoices::all();
        return view('invoices.invoices',compact( 'invoices'));
    }

    public function export() 
    {
        return Excel::download(new InvoiceExport, 'Invoice.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections=sections::all();
      
        return view('invoices.add_invoice',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        
      
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);

        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {

            $invoice_id = invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

         
             $user = User::first();
        
            //$user->notify(new AddInvoice($invoice_id));
            
             Notification::send($user, new AddInvoice($invoice_id));


        
        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return back();
    
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices=invoices::where('id',$id)->first();
       
        return view('invoices.status_update',compact('invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $invoices=invoices::where('id',$id)->first();
      $sections=sections::all();
      return view('invoices.edit_invoice',compact('invoices','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $invoices=invoices::findOrFail($request->invoice_id);
        $invoices->update([
             'invoice_number'=>$request->invoice_number,
            'invoice_Date'=>$request->invoice_Date,
            'Due_date'=>$request->Due_date,
            'product'=>$request->product,
            'section_id'=>$request->Section,
            'Amount_collection'=>$request->Amount_collection,
            'Amount_Commission'=>$request->Amount_Commission,
            'Discount'=>$request->Discount,
            'Value_VAT'=>$request->Value_VAT,
            'Rate_VAT'=>$request->Rate_VAT,
            'note'=>$request->note,
            'Status'=>'غير مدفوعة',
            'Value_Status'=>2,

        ]);

        session()->flash('Edit','تم تعديل الفاتورة بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $id=$request->id;
     
      $invoice=invoices::findOrFail($id)->first();
      $attachments=invoice_attachments::where('invoice_id',$id)->first();
      if(!empty($attachments->invoice_number)){
          Storage::disk('public_uploads')->deleteDirectory( $attachments->invoice_number);
      }
      $invoice->forceDelete();
      session()->flash('delete','تم حذف الفاتورة بنجاح');
      return redirect('/invoices');
   

    }

    public function getproducts($id){
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);


    }

    public function Trash_Invoice(Request $request){
        $id=$request->id;
       $invoices=invoices::findOrFail($id)->first();  
       $invoices->Delete();

       session()->flash('Edit','تمت أرشفة الفاتورة بنجاح');
       return back();
    }

    public function update_status(Request $request,$id){
       
       $invoices=invoices::findOrFail($id);
       if($request->Status === 'مدفوعة'){
       
         
           
           $invoices->update([
            'Status'=>$request->Status,
            'Value_Status'=>1,
            'Payment_Date'=>$request->Payment_Date
           ]);
           invoices_details::create([
            'id_Invoice'=>$request->id,
           'invoice_number'=>$request->invoice_number,
           'product'=>$request->product,
           'Section'=>$request->Section,
           'Status'=>$request->Status,
           'Value_Status'=>1,
           'note'=>$request->note,
           'user'=>(Auth::user()->name),
           'Payment_Date'=>$request->Payment_Date,
           ]);

         
       }else{
    
        $invoices->update([
            'Status'=>$request->Status,
            'Value_Status'=>3,
            'Payment_Date'=>$request->Payment_Date
           ]);
           invoices_details::create([
            'id_Invoice'=>$request->id,
            'invoice_number'=>$request->invoice_number,
            'product'=>$request->product,
            'Section'=>$request->Section,
            'Status'=>$request->Status,
            'Value_Status'=>3,
            'note'=>$request->note,
            'user'=>(Auth::user()->name),
            'Payment_Date'=>$request->Payment_Date,
            ]);
        

       }
       
   
      

        session()->flash('Edit','تم تحديث حالة الفاتورة بنجاح');
        return redirect('/invoices');

    }

    public function Invoice_Paid(){
        $invoices=invoices::where('Value_Status',1)->get();
        return view('invoices.invoices_paid',compact('invoices'));

        
    }
    public function Invoice_UnPaid(){
        $invoices=invoices::where('Value_Status',2)->get();
        return view('invoices.‏‏invoices_unpaid',compact('invoices'));
    }

    public function Invoice_Partial(){
        $invoices=invoices::where('Value_Status',3)->get();
        return view('invoices.invoices_partial',compact('invoices'));
    }
// طباعة فاتورة
  public function Print_invoice($id){
      $invoices=invoices::where('id',$id)->first();
      return view('invoices.Print_invoice',compact('invoices'));
  }
}
