@extends('admin.dashboard')
@section('other_styles')
   {{-- <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css') }}"></link> --}}
   <link href="{{ asset('dashboard/production/editor/editor.css') }}" type="text/css" rel="stylesheet"/>
   <link href="{{ asset('dashboard/production/css/editor.css?v=0.0.7') }}" rel="stylesheet">
@stop
@section('content')
<div class="row">
	<div class="col-md-12 col-xs-12">
		<h2>Chỉnh sửa</h2>
		@if(count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		@if(\Session::has('success'))
			<div class="alert alert-success">
				<p>{{ \Session::get('success') }}</p>
			</div>
		@endif
	</div>
</div>
<script type="text/javascript">
	var test = '<a href="#">test</a>';
</script>
<div class="row">
		<form class="frm_create_post" method="post" action="{{action('Admin\PostsController@update',$idpost)}}">
			{{ csrf_field() }}
			<input type="hidden" name="_method" value="PATCH">
			<div class="col-md-9 col-xs-12">
			<div class="form-group">
				<button type="button" onclick="pasteHtmlAtCaret(test)" value="addlink">insert link</button>
			</div>
			<div class="form-group">
				<input type="text" name="title" class="form-control" value="{{ $posts->title }}">
			</div>
			<div class="form-group">
				<input type="text" name="slug" class="form-control" value="{{ $posts->slug }}">
			</div>
			<div class="form-group">
              <div class="x_panel">
                <div class="x_content">
                  	<div id="alerts"></div>
                   <input type="hidden" name="render" value="{{ $posts->body }}" />         
                   <input id="txtEditor" name="body" value="{{ $posts->body }}" />
                </div>
              </div>
			</div>

			
			 	
			</div>
			<div class="col-md-3 col-xs-12">
				<div class="form-group row">
	                <label class="col-lg-4 col-form-label" for="sel_idposttype">Kiểu post <span class="text-danger">*</span></label>
	                <div class="col-lg-8">
	                    <select class="form-control cus-drop" name="sel_idposttype">
	                    	<option value="-1">Chọn kiểu post</option>
	                    	@foreach($posttypes as $row)
	                    		 <option value="{{ $row['idposttype'] }}">{{ $row['nametype'] }}</option>
							@endforeach        
	                    </select>
	                </div>
	            </div>
	            <div class="form-group row">
	                <label class="col-lg-4 col-form-label" for="sel_idstatustype">Trạng thái <span class="text-danger">*</span></label>
	                <div class="col-lg-8">
	                    <select class="form-control cus-drop" name="sel_idstatustype">
	                    	<option value="">Chọn trạng thái</option>
	                    	@foreach($statustypes as $row)
	                    		 <option value="{{ $row['id_status_type'] }}">{{ $row['name_status_type'] }}</option>
							@endforeach        
	                    </select>
	                </div>
	            </div>
				<div class="form-group row">
	                <label class="col-lg-12 col-form-label" for="sel_idcategory">Chuyên mục chính<span class="text-danger">*</span></label>
	                <div class="col-lg-12">
	                    <select class="form-control cus-drop" name="sel_idcat_main">
	                    	<option value="">Thuộc chuyên mục</option>
	                    	@foreach($cateparents as $row)
	                    		 <option value="{{ $row['idcategory'] }}">{{ $row['name'] }}</option>
							@endforeach        
	                    </select>
	                </div>
	            </div>
	            <div class="form-group row">
	                <label class="col-lg-12 col-form-label" for="sel_idcategory">Chuyên mục <span class="text-danger">*</span></label>
	                <div class="col-lg-12">
	                    	<ul class="list-check">
	                     	</ul>
	                </div>
	            </div>
	            <div class="form-group text-right">
				<input type="submit" class="btn btn-default btn-submit" name="btn-submit" value="Xác nhận" />
			</div>
			 </div>
			 
		</form>

		<form id="formID" class="upfile" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			  <div class="form-group">
		     <div class="input-group area-btn">
		     	 <label for="inputPassword">Hình đại diện&nbsp;&nbsp;</label>		
		     	<a href="#" onclick="performClick('file');"><i class="fa fa-camera-retro" aria-hidden="true"></i></a>
					<input style="display:none" type="file" name="file_name" id="file" accept="image/*" multiple/>
			  </div>
			  <img class="loading" src="{{ asset('dashboard/production/images/loader.gif') }}" style="display:none">
			  <input type="file" name="testfile">
			  <input type="text" name="slug" class="form-control" value="{{ $posts->slug }}">	  
		  </div>
		  <div class="form-group">
		  	<img id="canvasImg" style="width: auto;height: auto" alt="">
		  </div>
			  {{-- <input type="file" name="file_test" id="file_test" accept="image/*" multiple/>
			  <input type="button" name="submit" class="btn-submit" value="submit"> --}}
		</form>
		<form id="uploadfile" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
		     <div class="col-md-6">
		        <div class="block">
		            <div class="panel-body">
		              <div class="form-group">
		                    <label class="col-md-3 control-label">Upload file <span class="required">*</span></label>
		                    <div class="col-md-9">
		                        <input required="" type="file" name="result_file" id="result_file" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="col-md-3 control-label">supplier <span class="required">*</span></label>
		                    <div class="col-md-9">
		                        <input type="text" id="supplier_name" />
		                    </div>
		                </div>
		                <div class="btn-group pull-right">
		                    <button class="btn btn-primary" type="submit">Submit</button>
		                </div>
		                <div id="errormessage"></div>
		            </div>
		        </div>
		    </div>
		</form>
		
</div>
	<script type="text/javascript">
		var list_select = [];
		var i = 0;
	</script>
	@foreach($l_type_seleted as $row)
	<script type="text/javascript">
		 list_select[i] = {idimppost:'{{$row['idimppost']}}',idcatparent:'{{ $row['idcatparent'] }}',
		 idcategory:'{{ $row['idcategory'] }}', namecate :'{{ $row['namecate'] }}',
		 idposttype:'{{ $row['idposttype'] }}', nameposttype:'{{ $row['nameposttype'] }}',
		 id_status_type:'{{ $row['id_status_type'] }}', name_status_type:'{{ $row['name_status_type'] }}'};
		i = i + 1;
	</script>
	@endforeach
	<script type="text/javascript">
		
	</script> 
@stop
@section('other_scripts')
<!-- bootstrap-wysiwyg -->
  {{--  <script src="{{ asset('dashboard/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>  --}}
  	
    <script src="{{ asset('dashboard/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/google-code-prettify/src/prettify.js') }}"></script>
    <!-- jQuery Tags Input -->
    <script src="{{ asset('dashboard/vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
    <!-- Switchery -->
    <script src="{{ asset('dashboard/vendors/switchery/dist/switchery.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('dashboard/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- Parsley -->
    <script src="{{ asset('dashboard/vendors/parsleyjs/dist/parsley.min.js') }}"></script>
    <!-- Autosize -->
    <script src="{{ asset('dashboard/vendors/autosize/dist/autosize.min.js') }}"></script>
    <!-- jQuery autocomplete -->
    <script src="{{ asset('dashboard/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>
    <!-- starrr -->
    <script src="{{ asset('dashboard/vendors/starrr/dist/starrr.js') }}"></script>
  	{{-- <script src="{{ asset('bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js') }}"></script> --}}
  	<script src="{{ asset('dashboard/production/editor/editor.js') }}"></script>
  	<script src="{{ asset('dashboard/production/js/edit_post.js?v=0.6.4') }}"></script>
  	<script src="{{ asset('dashboard/production/js/edit_mutiselect.js?v=0.4.8') }}"></script>
  	<script src="{{ asset('dashboard/production/js/create_uploadfile.js?v=0.7.6') }}"></script>
@stop
{{-- https://blog.teamtreehouse.com/uploading-files-ajax --}}