            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->

                    <!-- search form -->
                    @include('layouts/partials/_search')
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->

                    <ul class="sidebar-menu">
                        <li class="{{ Request::is('admin/reports*') ? 'active' : '' }}">
                            <a href="{{ URL::route('reports') }}"><i class="fa fa-file-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                        </li>

                        <li class="{{ Request::is('admin/certificates*') ? 'active' : '' }}">
                            <a href="{{ URL::route('certificates') }}"><i class="fa fa-file-text-o fa-fw"></i> Certificates<span class="fa arrow"></span></a>
                        </li>
                        <li  class="{{ Request::is('admin/items*') ? 'active' : '' }}">
                            <a href="{{ URL::route('items') }}"><i class="fa fa-gears fa-fw"></i> Items<span class="fa arrow"></span></a>
                        </li>
                        <li  class="{{ Request::is('admin/clients*') ? 'active' : '' }}">
                            <a href="{{ URL::route('clients') }}"><i class="fa fa-group fa-fw"></i> Clients<span class="fa arrow"></span></a>
                        </li>
                        <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                            <a href="{{ URL::route('users') }}"><i class="fa fa-user fa-fw"></i> Users<span class="fa arrow"></span></a>
                        </li>   
                        <li class="{{ Request::is('admin/reporttypes*') ? 'active' : '' }}">
                            <a href="{{ URL::route('reports.type') }}"><i class="fa fa-edit fa-fw"></i> Report Type<span class="fa arrow"></span></a>
                        </li>   
                        <li class="{{ Request::is('admin/certificatetypes*') ? 'active' : '' }}">
                            <a href="{{ URL::route('certificates.type') }}"><i class="fa fa-edit fa-fw"></i> Certificate Type<span class="fa arrow"></span></a>
                        </li>                         
                        <li class="{{ Request::is('admin/itemtypes*') ? 'active' : '' }}">
                            <a href="{{ URL::route('items.type') }}"><i class="fa fa-edit fa-fw"></i> Item Type<span class="fa arrow"></span></a>
                        </li>                                                                                                                      
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>