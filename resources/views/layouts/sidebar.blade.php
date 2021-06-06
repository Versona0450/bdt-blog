<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <span class="d-block nav-link">{{ Auth::user()->name }}</span>
          <span class="d-block nav-link">{{ Auth::user()->role->name }}</span>
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
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link {{request()->is('admin/dashboard') ?  'active' : ' '}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item  
          {{request()->is('admin/article') ?  'menu-open' : ' '}}
          {{request()->is('admin/article/create') ?  'menu-open' : ' '}}
          {{request()->is('admin/category') ?  'menu-open' : ' '}}
          {{request()->is('admin/tag') ?  'menu-open' : ' '}}
          {{request()->is('admin/comment') ?  'menu-open' : ' '}}">
          
            <a href="#" class="nav-link 
              {{request()->is('admin/article') ?  'active' : ' '}}
              {{request()->is('admin/article/create') ?  'active' : ' '}}
              {{request()->is('admin/category') ?  'active' : ' '}}
              {{request()->is('admin/tag') ?  'active' : ' '}}
              {{request()->is('admin/comment') ?  'active' : ' '}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Article
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if(Gate::check('isAdmin') || Gate::check('isWriter'))
              <li class="nav-item">
                <a href="{{route('article.create')}}" class="nav-link {{request()->is('admin/article/create') ?  'active' : ' '}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Article</p>
                </a>
              </li>
              @endif
              @if(Gate::check('isAdmin') || Gate::check('isWriter') || Gate::check('isPublisher'))
              <li class="nav-item">
                <a href="{{route('article.index')}}" class="nav-link {{request()->is('admin/article') ?  'active' : ' '}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Article</p>
                </a>
              </li>
              @endif
              @can('isAdmin')
              <li class="nav-item">
                <a href="{{route('category.index')}}" class="nav-link {{request()->is('admin/category') ?  'active' : ' '}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('tag.index')}}" class="nav-link {{request()->is('admin/tag') ?  'active' : ' '}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tags</p>
                </a>
              </li>
              @endcan
              @if (Gate::check('Publish Comment'))
              <li class="nav-item">
                <a href="{{route('comment.index')}}" class="nav-link {{request()->is('admin/comment') ?  'active' : ' '}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Comments</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @can('isAdmin')
          <li class="nav-item">
            <a href="{{route('user.index')}}" class="nav-link {{request()->is('admin/user') ? 'active' : ' '}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('role.index')}}" class="nav-link {{request()->is('admin/role') ? 'active' : ' '}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Roles
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" disabled class="nav-link disabled {{request()->is('admin/permission') ? 'active' : ' '}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Permissions
              </p>
            </a>
          </li>
          @endcan
          <hr>
          <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
            <a class="nav-link" href="{{ route('logout') }}" 
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="far fa-circle nav-logout"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>