<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('') }}" class="brand-link">
        <img src="{{ asset( 'AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                {{-- Transaction --}}
                <li class="nav-header">Transaction</li>
                <li class="nav-item">
                    <a href="{{ route('sale.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>
                            Sales
                        </p>
                    </a>
                </li>
                {{-- /Transaction --}}

                {{-- Master Data --}}
                <li class="nav-header">Master Data</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-tags"></i>
                      <p>
                        Products
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('product.index') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Products List</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('category.index') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Products Category</p>
                        </a>
                      </li>
                    </ul>
                  </li>
				{{-- <li class="nav-item">
                    <a href="{{ route('stock.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Stocks</p>
                    </a>
                </li> --}}
				<li class="nav-item">
                    <a href="
                    {{ route('supplier.index') }}
                    " 
                    class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Supplier</p>
                    </a>
                </li>
				<li class="nav-item">
                    <a href="{{ route('customer.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Customer</p>
                    </a>
                </li>

                @can('contract.index')
                <li class="nav-item">
                    <a href="{{ route('contract.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Contract</p>
                    </a>
                </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('report.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>User</p>
                    </a>
                </li>
				{{-- /Master Data --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
