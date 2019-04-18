@extends('admin.dashboard')

@section('other_styles')
   <!-- Datatables -->
      <link href="{{ asset('dashboard/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('dashboard/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('dashboard/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('dashboard/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('dashboard/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
    
      <!-- Custom Theme Style -->
      <link href="{{ asset('dashboard/build/css/custom.min.css') }}" rel="stylesheet">
      <link href="{{ asset('dashboard/production/css/custom.css?v=0.1.2') }}" rel="stylesheet">
@stop

@section('content')
   <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  	<div align="right">
          						<a class="btn btn-default btn-primary" href="{{ URL::route('admin.customerreg.create') }}">Thêm mới</a>
          					</div>
                  <div class="x_title">
                     @if($message = Session::get('error'))
          			        	<h2 class="card-subtitle">{{ $message }}</h2>
          					@endif         
                  </div>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        @if(isset($post_types))
                          <ul class="dropdown-menu" role="menu">
                          @foreach($post_types as $row)
                            <li><a href="{{ url('/admin/customerreg/'.Request::segment(3).'/'.$row['idposttype'].'/'.Request::segment(5))}}">{{ $row['nametype'] }}</a></li>
                          @endforeach
                        </ul>    
                        @endif          
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30"></p>
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                        <th>Ngày</th>
            							<th>Điện thoại</th>
                          <th>Họ Tên</th>
                          <th>Email</th>
                          <th>Nguồn</th>
                          <th>Chi nhánh</th>
            							<th>-</th>
            							<th>-</th>
                          <th>-</th>
            	         </tr>
            	     </thead>
            	     <tfoot>
            	      <tr>
                          <th>Ngày</th>
                          <th>Điện thoại</th>
                          <th>Họ Tên</th>
                          <th>Email</th>
                          <th>Nguồn</th>
                          <th>Chi nhánh</th>
                          <th>-</th>
                          <th>-</th>
                          <th>-</th>
                       </tr>
	                </tfoot>
	                <tbody>
	                	@foreach($customer_reg as $row)
      							<tr>
                      <td>{{ $row['created_at'] }}</td>
      								<td>{{ $row['mobile'] }}</td>
      								<td>{{ $row['firstname'] }}</td>
                      <td>{{ $row['email'] }}</td>
                      <td>{{ $row['body'] }}</td>
                      <td>{{ $row['address_reg'] }}</td>
                      <td class="btn-control-action">
                        <input type="hidden" name="idpost_row" value="{{ $row['idpost'] }}">
                        <a onclick="popup_modal({{ $row['idpost'] }});" class="btn btn-primary btn-action" href="javascript:void(0)"><i class="fa fa-comments-o"></i></a>
                     </td>		
      								<td class="btn-control"><a class="btn btn-primary btn-edit" href="{{ action('Admin\CustomerRegController@edit',$row['idimppost']) }}"><i class="fa fa-edit"></i></a></td>
      								<td class="btn-control">
      								     <form method="post" class="delete_form" action="{{action('Admin\CustomerRegController@destroy', $row['idimppost'])}}">
      								      {{csrf_field()}}
      								      <input type="hidden" name="_method" value="DELETE" />
      								      <button type="submit" class="btn btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
      								     </form>
      								</td>
      							</tr>
      							@endforeach                
	                </tbody>
	            </table>
          </div>
        </div>
      </div>
</div>
<div class="modal-cus">
  <div class="modal-content-cus">
      <span class="close">&times;</span>
        <div class="x_content"> 
        <form class="form-valide frm_post">
            
            <div class="form-group row">
                  <label class="col-lg-12 col-form-label" for="val-username">Nội dung <span class="text-danger"></span></label>
                  <div class="col-lg-12">
                     <textarea name="body" rows="4" cols="50" class="form-control-text body" placeholder="Nội dung"></textarea>
                  </div>
                  <input type="hidden" class="idpost" name="idpost" value="0">
            </div>
              
            <div class="form-group row">
                  <label class="col-lg-12 col-form-label" for="val-username">Tương tác<span class="text-danger"></span></label>
                  <div class="col-lg-12">
                     @if(isset($post_type_inter))
                      <select class="form-control sel_idposttype" name="sel_idposttype">
                        <option value="">Chọn kiểu nội dung</option>
                       @foreach($post_type_inter as $row)
                           <option value="{{ $row['idposttype'] }}">{{ $row['nametype'] }}</option>
                        @endforeach
                      </select>
                      @endif
                  </div>
            </div>
            <div class="form-group row">
                  {{-- <label class="col-lg-12 col-form-label" for="val-username">Trạng thái<span class="text-danger"></span></label> --}}
                  <div class="col-lg-12">
                     @if(isset($post_type_inter))
                      <select class="form-control sel_idstatustype" name="sel_idstatustype">
                        <option value="">Chọn kiểu trạng thái</option>
                       @foreach($status_types as $row)
                           <option value="{{ $row['id_status_type'] }}">{{ $row['name_status_type'] }}</option>
                        @endforeach
                      </select>
                      @endif
                  </div>
            </div>  
            <div class="form-group row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <a class="btn btn-primary btn-submit">Xác nhận</a>
                </div>
            </div>

        </form>
    </div>
  </div>
</div>
@stop

@section('other_scripts')
    <!-- Datatables -->
    <script src="{{ asset('dashboard/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
      <!-- Custom Theme Scripts -->
    {{-- <script src="{{ asset('dashboard/build/js/custom.min.js') }}"></script> --}}
    <script src="{{ asset('dashboard/build/js/custom.js') }}"></script>
    <script src="{{ asset('dashboard/production/js/custom.js?v=0.0.2') }}"></script>
    <script src="{{ asset('dashboard/production/js/customer.js?v=0.1.1') }}"></script>
@stop