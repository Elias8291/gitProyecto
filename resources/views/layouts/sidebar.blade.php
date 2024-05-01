<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ url('/') }}">
        <div class="d-flex align-items-center">
          <img class="navbar-brand-full app-header-logo" src="https://cdn-icons-png.flaticon.com/512/2491/2491055.png" width="50" alt="Student Icon">
          <span class="brand-name ml-2">MINDITO</span>
        </div>
      </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ url('/') }}">
        <img class="navbar-brand-full" src="https://cdn-icons-png.flaticon.com/512/2491/2491055.png" width="60px" alt="Student Icon"/>
      </a>
    </div>
    <ul class="sidebar-menu">
      @include('layouts.menu')
    </ul>
  </aside>
  
  <style>
    .brand-name {
      font-family: 'Arial', sans-serif;
      font-size: 24px;
      font-weight: bold;
      color: rgb(31, 6, 138);
    }
  </style>