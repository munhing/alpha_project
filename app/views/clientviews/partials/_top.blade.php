<!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="{{ URL::route('client_home') }}" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <i class="fa" style="font-size:33px;">&#945</i>lpha Testing
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">

                    <ul class="nav navbar-nav">
                        <!-- 
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o fa-fw"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">New Reports<small class="badge pull-right bg-green">3</small></a></li>

                            </ul>
                        </li> -->

                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user fa-fw"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header" align="center"><strong>{{ Auth::user()->fullname }} {{ Auth::user()->client->id }}</strong></li>
                                <li><a href="{{ URL::route('client_profile') }}"><i class="fa fa-user fa-fw"></i>Profile</a>
                                </li>

                                <li class="footer"><a href="{{ URL::route('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>