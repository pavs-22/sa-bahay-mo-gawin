@php
                  $user = Auth::user();
                @endphp
                
<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('scholar.index')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CSP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CARD MRI Scholarship Program </b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ URL::to('/') }}/images/profile.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ ucwords($user->name) }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ URL::to('/') }}/images/profile.jpg" class="img-circle" alt="User Image">
                
                <p>
                {{ ucwords($user->name) }}
                  <small>Member since {{ $user->created_at->format('M. Y') }} </small>
                </p>
              </li>
              <li class="user-footer">
               <!-- <div class="pull-left">
                  <a href="#profile" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile">Update</a>
                </div>-->
                <div class="pull-right">
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-default btn-flat">Sign out</button>
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
</header>

@include('includes/profile_modal')
