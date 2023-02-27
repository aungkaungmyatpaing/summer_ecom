<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item {{ Request::is('admin/dashboard') ? 'active':'' }}">
            <a class="nav-link" href="/admin/dashboard">
              <i class="mdi mdi-speedometer menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/orders') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('/admin/orders') }}">
              <i class="mdi mdi-sale menu-icon"></i>
              <span class="menu-title">Orders</span>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/category*') ? 'active':'' }}">
            <a class="nav-link" href="/admin/category">
              <i class="mdi mdi-view-list menu-icon"></i>
              <span class="menu-title">Category</span>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/product*') ? 'active':'' }}">
            <a class="nav-link" href="/admin/product">
              <i class="mdi mdi-plus-circle menu-icon"></i>
              <span class="menu-title">Products</span>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/brand*') ? 'active':'' }}">
            <a class="nav-link" href="/admin/brand">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Brands</span>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/color*') ? 'active':'' }}">
            <a class="nav-link" href="/admin/color">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Colors</span>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/slider*') ? 'active':'' }}">
            <a class="nav-link" href="/admin/slider">
              <i class="mdi mdi-view-carousel menu-icon"></i>
              <span class="menu-title">Slider</span>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/users*') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('/admin/users') }}">
              <i class="mdi mdi-account-multiple-plus menu-icon"></i>
              <span class="menu-title">Users Info</span>
            </a>
          </li>
          <li class="nav-item {{ Request::is('admin/settings') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('/admin/settings') }}">
              <i class="mdi mdi-settings menu-icon"></i>
              <span class="menu-title">Site Setting</span>
            </a>
          </li>
        </ul>
      </nav>


      