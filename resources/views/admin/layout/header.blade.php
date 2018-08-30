<header class="app-header">
  <a class="app-header__logo" href="#">{{ __('master.logo') }}</a>
  <!-- Sidebar toggle button-->
  <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
  <!-- Navbar Right Menu-->
  <ul class="app-nav">
     <li class="app-search">
      <div class="container">
        <div class="row searchFilter" >
          <div class="col-sm-12" >
            <div class="input-group" >
            <input id="table_filter" type="text" class="form-control" aria-label="Text input with segmented button dropdown" >
            <div class="input-group-btn" >
              <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><span class="label-icon" >Category</span> <span class="caret" >&nbsp;</span></button>
              <div class="dropdown-menu dropdown-menu-right" >
                <ul class="category_filters" >
                  <li >
                  <input class="cat_type category-input" data-label="film" id="film" value="film" name="search-filter" type="radio" ><label for="film" >Film</label>
                  </li>
                  <li >
                  <input type="radio" name="search-filter" id="design" value="design" ><label class="category-label" for="design" >Design</label>
                  </li>
                  <li >
                  <input type="radio" name="search-filter" id="user" value="user" ><label class="category-label" for="user" >User</label>
                  </li>
                  <li >
                  <input type="radio" name="search-filter" id="schedule" value="schedule" ><label class="category-label" for="schedule" >Schedule</label>
                  </li>
                </ul>
              </div>
              <button id="searchBtn" type="button" class="btn btn-secondary btn-search" ><span class="glyphicon glyphicon-search" >&nbsp;</span> <span class="label-icon" >Search</span></button>
            </div>
            </div>
            <div class="search-hint" id="search-hint"></div>
          </div>
        </div>
      </div>
     </li>
     <!--Notification Menu-->
     <li class="dropdown">
        <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
          <i class="fa fa-bell-o fa-lg"></i>
        </a>
     </li>
     <!-- User Menu-->
     <li class="dropdown">
        <a class="app-nav__item" href="#"  id="logout-button" data-toggle="dropdown" aria-label="Open Profile Menu">
          <i class="fa fa-user fa-lg"></i>
        </a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
           <li><a class="dropdown-item" href="#"><i class="fa fa-cog fa-lg"></i>{{ __('master.setting') }}</a></li>
           <li><a class="dropdown-item" href="#"><i class="fa fa-user fa-lg"></i>
            @if (Auth::user())
              {{ Auth::user()->full_name }}
           @endif
          </a></li>
           <li><a class="dropdown-item" id="link-click-me" href="{{ route('admin.logout') }}"><i class="fa fa-sign-out fa-lg"></i>{{ __('master.logout') }}</a></li>
        </ul>
     </li>
  </ul>
</header>
