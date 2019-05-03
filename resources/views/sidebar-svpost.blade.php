<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Tổng hợp</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Trang chủ <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Dashboard</a></li>
                      <li><a href="#">Dashboard2</a></li>
                      <li><a href="#">Dashboard3</a></li>
                    </ul>
                  </li>
                 
                  <li><a><i class="fa fa-desktop"></i> Quản lý post <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('admin.svposttype.index') }}">Kiểu post</a></li>
                      <li><a href="{{ route('admin.svpost.index') }}">post</a></li>           
                    </ul>
                  </li>
                  
              
                </ul>
              </div>
               <div class="menu_section">
                <h3>Quản lý nội dung</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-edit"></i> Bài viết <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="{{ route('admin.category.index') }}">Chuyên mục</a></li>
                        <li><a href="{{ route('admin.posttype.index') }}">Kiểu post</a></li>
                        <li><a href="{{ route('admin.post.index') }}">post</a></li> 
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Hệ thống</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Phân quyền <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('admin.roles.index') }}">Vai trò</a></li>
                      <li><a href="{{ route('admin.permission.index') }}">Tạo quyền</a></li>
                      <li><a href="{{ route('admin.impperm.index') }}">Cấp quyền cho nhóm</a></li>
                      <li><a href="{{ route('admin.grantperm.index') }}">Cấp quyền người dùng</a></li>
                      <li><a href="{{ route('admin.aduser.index') }}">Quản lý người dùng</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">403 Error</a></li>
                      <li><a href="#">404 Error</a></li>
                      <li><a href="#">500 Error</a></li>
                      <li><a href="#">Plain Page</a></li>
                      <li><a href="#">Login Page</a></li>
                      <li><a href="#">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div>

            </div>