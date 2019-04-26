@extends('admin.dashboard')

@section('other_styles')
      <!-- Custom Theme Style -->
    <link href="{{ asset('dashboard/build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/production/css/custom.css?v=0.1.4') }}" rel="stylesheet">
@stop
@section('content')
<?php $_sel_idposttype = 0; ?>
 <!-- page content -->       
            <div class="page-title">
              <div class="title_left">
                <h3>Tương tác<small> </small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>&nbsp;</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <ul class="stats-overview">
                        <li>
                          <span class="name"> Estimated budget </span>
                          <span class="value text-success"> 2300 </span>
                        </li>
                        <li>
                          <span class="name"> Total amount spent </span>
                          <span class="value text-success"> 2000 </span>
                        </li>
                        <li class="hidden-phone">
                          <span class="name"> Estimated project duration </span>
                          <span class="value text-success"> 20 </span>
                        </li>
                      </ul>
                      <br />

                      {{-- <div id="mainb" style="height:350px;"></div> --}}
                      <div class="detail-post">
                      	@if(isset($message))
                      		{{ $message }}
                      	@endif 
                      </div>
                      <div>

                        <h4>Hoạt động gần đây</h4>

                        <!-- end of user messages -->
                        <ul class="messages">
                          <li>
                            <img src="{{ asset('dashboard/production/images/img.jpg') }}" class="avatar" alt="Avatar">
                            <div class="message_wrapper comment">
                              <h4 class="heading">Desmond Davison</h4>
                              <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                              <br />
                              <p class="url">
                                <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                              </p>
                            </div>
                          </li>
                        </ul>
                      <form method="post" action="{{ url('/admin/customerreg/interactivecustomer') }}">
                        {{ csrf_field() }}
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>&nbsp;</h2>
                            @if(isset($post_type_inter))
                              <ul class="nav navbar-right panel_toolbox">
                                @foreach($post_type_inter as $row)
                                  <li>&nbsp;&nbsp;&nbsp;<label>{{ $row['nametype'] }}:&nbsp;</label><input type="radio" class="flat form-control" name="sel_idposttype"  value="{{ $row['idposttype'] }}"/></li>
                                @endforeach
                              </ul> 
                            @endif
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <ul class="messages">
                              <li>
                                <img src="{{ asset('dashboard/production/images/img.jpg') }}" class="avatar" alt="Avatar">
                                <div class="message_wrapper comment">
                                  <textarea class="resizable_textarea form-control" placeholder="Ghi chú"></textarea>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <ul class="nav navbar-right panel_toolbox">
                              <li><input class="btn btn-default" type="submit" name="submit-info" value="Xác nhận"></li>
                            </ul>
                        </div>
                        </form>                 
                        <!-- end of user messages -->
                      </div>


                    </div>

                    <!-- start project-detail sidebar -->
                    <div class="col-md-3 col-sm-3 col-xs-12">

                      <section class="panel">

                        <div class="x_title">
                          <h2>Thông tin khách hàng</h2>
                          <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                          <h3 class="green"><i class="fa fa-paint-brush"></i> Gentelella</h3>

                          <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
                          <br />

                          <div class="project_detail">

                            <p class="title">Client Company</p>
                            <p>Deveint Inc</p>
                            <p class="title">Project Leader</p>
                            <p>Tony Chicken</p>
                          </div>

                          <br />
                          <h5>Project files</h5>
                          <ul class="list-unstyled project_files">
                            <li><a href=""><i class="fa fa-file-word-o"></i> Functional-requirements.docx</a>
                            </li>
                            <li><a href=""><i class="fa fa-file-pdf-o"></i> UAT.pdf</a>
                            </li>
                            <li><a href=""><i class="fa fa-mail-forward"></i> Email-from-flatbal.mln</a>
                            </li>
                            <li><a href=""><i class="fa fa-picture-o"></i> Logo.png</a>
                            </li>
                            <li><a href=""><i class="fa fa-file-word-o"></i> Contract-10_12_2014.docx</a>
                            </li>
                          </ul>
                          <br />

                          <div class="text-center mtop20">
                            <a href="#" class="btn btn-sm btn-primary">Add files</a>
                            <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                          </div>
                        </div>

                      </section>

                    </div>
                    <!-- end project-detail sidebar -->

                  </div>
                </div>
              </div>
            </div>
        <!-- /page content -->
@stop
@section('other_scripts')
    {{-- <script src="{{ asset('dashboard/build/js/custom.min.js') }}"></script> --}}
    <script src="{{ asset('dashboard/vendors/echarts/dist/echarts.min.js') }}"></script>
    <script src="{{ asset('dashboard/build/js/custom.js') }}"></script> 
@stop