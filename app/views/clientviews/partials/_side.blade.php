            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->

                    <!-- search form -->
                    @include('clientviews/partials/_search')
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="{{ Request::is('reports') ? 'active' : '' }}">
                            <a href="{{ URL::route('client_reports') }}"><i class="fa fa-file-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                        </li>

                        <li class="{{ Request::is('certificates') ? 'active' : '' }}">
                            <a href="{{ URL::route('client_certificates') }}"><i class="fa fa-file-text-o fa-fw"></i> Certificates<span class="fa arrow"></span></a>
                        </li>
                        <li class="{{ Request::is('items') ? 'active' : '' }}">
                            <a href="{{ URL::route('client_items') }}"><i class="fa fa-gears fa-fw"></i> Items<span class="fa arrow"></span></a>
                        </li>                                              
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>