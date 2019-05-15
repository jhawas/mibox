<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
    <div>
      {{-- <p class="app-sidebar__user-name">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</p>
      <p class="app-sidebar__user-designation">{{ Auth::user()->user_role->role->name }}</p> --}}
    </div>
  </div>
  <ul class="app-menu">
    <li>
        <router-link :to="{ name: 'home' }" class="app-menu__item">
          <i class="app-menu__icon fa fa-dashboard"></i>
          <span class="app-menu__label">Dashboard</span>
        </router-link>
      </li>
      <li>
        <router-link :to="{ name: 'users' }" class="app-menu__item">
            <i class="app-menu__icon fa fa-pie-chart"></i>
            <span class="app-menu__label">Users</span>
        </router-link>
      </li>
      <li class="treeview">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa fa-th-list"></i>
            <span class="app-menu__label">Manage Patient</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a class="treeview-item" href="#">
              <i class="icon fa fa-circle-o"></i> In & Out Patient
            </a>
          </li>
          <li>
            <a class="treeview-item" href="#">
              <i class="icon fa fa-circle-o"></i> Diagnoses
            </a>
          </li>
          <li>
            <a class="treeview-item" href="#">
              <i class="icon fa fa-circle-o"></i> Laboratory
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa fa-th-list"></i>
            <span class="app-menu__label">Manage Rooms</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a class="treeview-item" href="#">
              <i class="icon fa fa-circle-o"></i> Rooms
            </a>
          </li>
          <li>
            <a class="treeview-item" href="#">
              <i class="icon fa fa-circle-o"></i> Floors
            </a>
          </li>
          <li>
            <a class="treeview-item" href="#">
              <i class="icon fa fa-circle-o"></i> Room Types
            </a>
          </li>
        </ul>
      </li>
  </ul>
</aside>