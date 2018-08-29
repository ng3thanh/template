@php
    $dashboardActive = \Request::route()->getName() == 'dashboard' ? 'active' : '';
    $serviceIndexActive = \Request::route()->getName() == 'services.index' ? 'active' : '';
    $serviceCreateActive = \Request::route()->getName() == 'services.create' ? 'active' : '';
    $serviceActive = (!empty($serviceIndexActive) || !empty($serviceCreateActive)) ? 'active' : '';
    $clientIndexActive = \Request::route()->getName() == 'clients.index' ? 'active' : '';
    $clientCreateActive = \Request::route()->getName() == 'clients.create' ? 'active' : '';
    $clientActive = (!empty($clientIndexActive) || !empty($clientCreateActive)) ? 'active' : '';
    $blogIndexActive = \Request::route()->getName() == 'blog.index' ? 'active' : '';
    $blogCreateActive = \Request::route()->getName() == 'blog.create' ? 'active' : '';
    $blogActive = (!empty($blogIndexActive) || !empty($blogCreateActive)) ? 'active' : '';
@endphp

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Admin System</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="search_all" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
					<button type="submit" name="search" id="search-btn" class="btn btn-flat">
						<i class="fa fa-search"></i>
					</button>
				</span>
            </div>
        </form>
        <!-- /.search form -->


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="header">SIDEBAR MENU</li>

            <li class="{{ $dashboardActive }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span> Dashboard</span>
                </a>
            </li>

            <li class="treeview {{ $serviceActive }}">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span> Services</span>
                    <span class="pull-right-container"> 
						<i class="fa fa-angle-left pull-right"></i>
					</span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $serviceIndexActive }}">
                        <a href="{{ route('services.index') }}">
                            <i class="fa fa-circle-o"></i> Services index
                        </a>
                    </li>
                    <li class="{{ $serviceCreateActive }}">
                        <a href="{{ route('services.create') }}">
                            <i class="fa fa-plus-circle"></i> Add service
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $clientActive }}">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span> Clients</span>
                    <span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $clientIndexActive }}">
                        <a href="{{ route('clients.index') }}">
                            <i class="fa fa-circle-o"></i> Clients index
                        </a>
                    </li>
                    <li class="{{ $clientCreateActive }}">
                        <a href="{{ route('clients.create') }}">
                            <i class="fa fa-plus-circle"></i> Add client
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ $blogActive }}">
                <a href="#">
                    <i class="fa fa-calendar"></i>
                    <span> Blogs</span>
                    <span class="pull-right-container"> 
						<i class="fa fa-angle-left pull-right"></i>
					</span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $blogIndexActive }}">
                        <a href="{{ route('blog.index') }}">
                            <i class="fa fa-asterisk"></i> Blogs index
                        </a>
                    </li>
                    <li class="{{ $blogCreateActive }}">
                        <a href="{{ route('blog.create') }}">
                            <i class="fa fa-edit"></i> Add blog
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"> <i class="fa fa-usd"></i>
                    <span> Contact</span>
                    <span class="pull-right-container"> 
						<i class="fa fa-angle-left pull-right"></i>
        			</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('contact.index') }}">
                            <i class="fa fa-circle-o"></i> Contact index
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cubes"></i>
                    <span> Setting</span>
                    <span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
        			</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('slide.index') }}">
                            <i class="fa fa-circle-o"></i> Background slide
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('footer.index') }}">
                            <i class="fa fa-circle-o"></i> Footer info
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('introduce.index') }}">
                            <i class="fa fa-circle-o"></i> Introduce
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logo.index') }}">
                            <i class="fa fa-circle-o"></i> Logo
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->

</aside>