@extends('layouts.master')
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الفاتورة</span>
						</div>
					</div>
					

	
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

@if(session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

	@if(session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
	@if($errors->any())
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
	@endif
			
				<!-- row -->
				<div class="row">
					
				<div class="card mg-b-20" id="tabs-style2">
							<div class="card-body">
								
								<div class="text-wrap">
									<div class="example">
										<div class="panel panel-primary tabs-style-2">
											<div class=" tab-menu-heading">
												<div class="tabs-menu1">
													<!-- Tabs -->
													<ul class="nav panel-tabs main-nav-line">
														<li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات الفاتورة</a></li>
														<li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الفاتورة</a></li>
														<li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
													</ul>
												</div>
											</div>
											<div class="panel-body tabs-menu-body main-content-body-right border">
												<div class="tab-content">
													<div class="tab-pane active" id="tab4">
													
					<!--div-->
					
						
							
								<div class="table-responsive mt-15">
									<table id="tab4" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												
												<th class="border-bottom-0">رقم الفاتورة</th>
												<th class="border-bottom-0">تاريخ الاصدار</th>
												<th class="border-bottom-0">تاريخ الاستحقاق</th>
												<th class="border-bottom-0">المنتج</th>
												<th class="border-bottom-0">القسم</th>
												<th class="border-bottom-0">الخصم</th>
												<th class="border-bottom-0">نسبة الضريبة</th>
												<th class="border-bottom-0">قيمة الضريبة</th>
												<th class="border-bottom-0">الاجمالي</th>
												<th class="border-bottom-0"> الحالةالحالية</th>
												<th class="border-bottom-0">الملاحظات</th>
												<th class="border-bottom-0">المستخدم</th>
												
												<th class="border-bottom-0">مبلغ التحصيل</th>
												<th class="border-bottom-0">مبلغ العمولة</th>
												

											</tr>
										</thead>
										<tbody>
										
										
									
											<tr>
											
												
												<td>{{$invoices->invoice_number}}</td>
												<td>{{$invoices->invoice_Date}}</td>
												<td>{{$invoices->Due_date}}</td>
												<td>{{$invoices->product}}</td>
												
												<td>{{$invoices->section->section_name}}</td>
												
												<td>{{$invoices->Discount}}</td>
												<td>{{$invoices->Rate_VAT}} </td>
												<td>{{$invoices->Value_VAT}}</td>
												<td>{{$invoices->Total}}</td>
												<td>{{$invoices->Status}}</td>
												<td>{{$invoices->note}}</td>
												<td></td>
												<td>{{$invoices->Amount_collection}}</td>
												<td>{{$invoices->Amount_Commission}}</td>
												
												
												
												
												
											</tr>
											
										</tbody>
									</table>
								</div>
						
													</div>
													<div class="tab-pane" id="tab5">
														<!-- star -->
															<!--div-->
				
								<div class="table-responsive mt-15">
									<table id="tab5" class="table center-aligned-table mb-0 table table-hover">
										<thead>
											<tr>
											<th class="border-bottom-0"> #</th>
												<th class="border-bottom-0">رقم الفاتورة</th>
												
												<th class="border-bottom-0">نوع المنتج</th>
												<th class="border-bottom-0">القسم</th>
												
												<th class="border-bottom-0"> حالة الدفع</th>
												<th class="border-bottom-0">تاريخ الدفع</th>
												<th class="border-bottom-0">الملاحظات</th>
												<th class="border-bottom-0">تاريخ الاضافة</th>
												<th class="border-bottom-0">المستخدم</th>
												
												
												

											</tr>
										</thead>
										<tbody>
										<?php $i=0?>
									@foreach($invoices_details as $invoices_detail)
											<tr>
											
												<?php $i++?>
												<td>{{$i}}</td>
												<td>{{$invoices_detail->invoice_number}}</td>
												<td>{{$invoices_detail->product}}</td>
												<td>{{$invoices->Section->section_name}}</td>
												<td>{{$invoices_detail->Status}}</td>
												
												<td>{{$invoices_detail->Payment_Date}}</td>
												
												<td>{{$invoices_detail->note}}</td>
												<td>{{$invoices_detail->created_at}}</td>
												<td>{{$invoices_detail->user}}</td>
												
												
												
												
												
												
											</tr>
											@endforeach
										
										</tbody>
									</table>
								</div>
						
														<!-- end -->
													</div>
							
													<div class="tab-pane" id="tab6">
														<div class="card card-statistics">
														<div class="card-body">
																				<!-- start attacment -->
				
																				<div class="card-body">
                    <form action="{{ route('InvoiceAttachments.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
						<p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">المرفقات</h5>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="file_name" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
								<input type="hidden" name="invoice_number"  id="customFile" value="{{$invoices->invoice_number}}" />
								<input type="hidden" name="invoice_id"  id="invoice_id" value="{{$invoices->id}}" />
                               
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>


                    </form>
                </div>
          <br>
					<!-- end attachment -->
								<div class="table-responsive mt-15">
									<table id="tab5" class="table center-aligned-table mb-0 table table-hover">
										<thead>
											<tr>
											<th class="border-bottom-0"> #</th>
												<th class="border-bottom-0">اسم الملف </th>
												
												<th class="border-bottom-0">قام بلإضافة </th>
												<th class="border-bottom-0">تاريخ الاضافة</th>
												<th class="border-bottom-0">العمليات </th>
												
												
												
												

											</tr>
										</thead>
										<tbody>
										<?php $i=0?>
									@foreach($invoice_attachments as $invoice_attachment)
											<tr>
											
												<?php $i++?>
												<td>{{$i}}</td>
												<td>{{$invoice_attachment->file_name}}</td>
												<td>{{$invoice_attachment->Created_by}}</td>
												<td>{{$invoice_attachment->created_at}}</td>
											
												<td>
												<a href="{{url('view_file')}}/{{ $invoice_attachment->file_name }}/{{ $invoices->invoice_number }}"><button type="button" class="btn btn-outline-success btn-sm"
												 data-file_name="{{ $invoice_attachment->file_name }}"
												 data-invoice_number="{{ $invoices->invoice_number }}">عرض</button></a>
												<a href="{{url('download')}}/{{ $invoice_attachment->file_name }}/{{ $invoices->invoice_number }}"><button type="button" class="btn btn-outline-primary btn-sm"
												 data-file_name="{{ $invoice_attachment->file_name }}"
												 data-invoice_number="{{ $invoices->invoice_number }}">تحميل</button></a>
												
												<button class="btn btn-outline-danger btn-sm " data-id="$invoice_attachment->id"
												data-file_name="{{ $invoice_attachment->file_name }}"
                                                data-invoice_number="{{ $invoices->invoice_number }}" data-toggle="modal"
                                                data-target="#modaldemo9">حذف</button>
												
												
												</td>
											
												
												
												
												
												
												
											</tr>
											@endforeach
										
										</tbody>
									</table>
								</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								

								</div>
							</div>
						</div>
					</div>
					<!-- /div -->
									
					  <!-- delete -->
			 <div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">حذف المرفق</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('delete_file')}}" method="post">
                        
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="file_name" id="file_name" type="hidden" readonly>
							<input class="form-control" name="invoice_number" id="invoice_number" type="hidden" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<!-- end delete -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
<script>
$('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var file_name = button.data('file_name')
			var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #file_name').val(file_name);
			modal.find('.modal-body #invoice_number').val(invoice_number);
        })
</script>
@endsection