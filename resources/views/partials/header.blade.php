<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-brand-center"
  data-nav="brand-center">
  <div class="navbar-header d-xl-block d-none">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="navbar-brand" href="{{ url('admin/home') }}">
          <span class="brand-logo">
            @if(\Auth::user()->logo_img)
        <img src="{{ asset('images/logo/' . \Auth::user()->logo_img) }}" alt="">
      @else
        <img src="{{ asset('admin_assets') }}/images/logo.png" alt="">
      @endif
          </span>
        </a>
      </li>
    </ul>
  </div>
  <div class="navbar-container d-flex content align-items-center">
    <div class="bookmark-wrapper d-flex align-items-center">
      <ul class="nav navbar-nav d-xl-none">
        <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
              data-feather="menu"></i></a></li>
      </ul>
    </div>
    <ul class="nav navbar-nav align-items-center ml-auto">
      <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon"
            data-feather="search"></i></a>
        <div class="search-input">
          <div class="search-input-icon"><i data-feather="search"></i></div>
          <input class="form-control input" type="text" placeholder="Search..." tabindex="-1" data-search="search">
          <div class="search-input-close"><i data-feather="x"></i></div>
          <ul class="search-list search-list-main"></ul>
        </div>
      </li>



      <li class="nav-item dropdown dropdown-user">
        <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="user-nav d-sm-flex d-none">
            <span class="user-name font-weight-bolder">{{ \Auth::user()->name }}</span>
            <span class="user-status">{{ ucfirst(\Auth::user()->username) }}</span>
          </div>
          <span class="avatar">
            @if(\Auth::user()->profile_img)
        <img class="round" src="{{ asset('images/profiles/' . \Auth::user()->profile_img) }}" alt="Robert Downey"
          height="40" width="40">
      @else
        <img class="round" src="{{ asset('admin_assets') }}/images/admin-profile.png" alt="Robert Downey"
          height="40" width="40">
      @endif
            <span class="avatar-status-online"></span>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
          <a class="dropdown-item" href="{{ route('profile.show') }}"><i class="mr-50" data-feather="user"></i>
            Profile</a>
          <a class="dropdown-item" href="{{ route('profile.setting') }}"><i class="mr-50" data-feather="settings"></i>
            Settings</a>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();"><i class="mr-50"
              data-feather="power"></i>
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="horizontal-menu-wrapper">
  <div
    class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border"
    role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto">
          <a class="navbar-brand" href="{{ Route('admin.home') }}">
            <span class="brand-logo">
              <img src="{{ asset('admin_assets') }}/images/logo.png" alt="">
            </span>
          </a>
        </li>
        <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
              class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i></a></li>
      </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="navbar-container main-menu-content" data-menu="menu-container">
      <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item active"><a class="nav-link d-flex align-items-center"
            href="{{ route('home') }}"><span>Dashboard</span></a></li>
        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Products Catalogue</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.manage-categories.index') }}"><span>Categories</span></a></li>

            <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.manage-subcategories.index') }}"><span>Sub Categories</span></a></li>

            <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.attributes.index') }}"><span>Attributes</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.attribute-values.index') }}"><span>Attributes Values</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.subcategory-attributes.index') }}"><span>Attributes Mapping</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.pricing-rules.index') }}"><span>Price Rule Setting
                </span></a></li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.images.index') }}"><span>Images Settings
                </span></a></li>
            <!-- <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.centralized-paper-pricing.index') }}"><span>Centralized Paper
                  Pricing</span></a></li> -->
            <!-- <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.attribute-groups.index') }}"><span>Attributes Grouping</span></a></li> -->
            <!-- <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.group-assignments.index') }}"><span>Attributes Group Mapping</span></a></li> -->
            <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.attribute-conditions.index') }}"><span>Attributes Conditions</span></a></li>

          </ul>
        </li>

        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Customer & Orders</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class=" dropdown-item d-flex align-items-center" href="{{ route('admin.customers') }}"><span>
                  Customers</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center" href="{{ route('admin.quote.request') }}"><span>
                  Orders</span></a>
            </li>

          </ul>
        </li>

        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Content Management</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class=" dropdown-item d-flex align-items-center"
                href="{{ route('admin.content.blogs') }}"><span>Manage Blogs</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center" href="{{ route('admin.content.faq') }}"><span>Manage
                  FAQ</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.content.dynamic.pages') }}"><span>Dynamic Page Creations</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.content.manage.page.content') }}"><span>Manage Page Content</span></a>
            </li>
          </ul>
        </li>

        <li class="dropdown nav-item" data-menu="dropdown">
          <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <span>Settings</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class=" dropdown-item d-flex align-items-center"
                href="{{ route('admin.proof-reading.index') }}"><span>Proof Reading</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.delivery-charges.index') }}"><span>Delivery Charges</span></a></li>

            <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.postal-codes.index') }}"><span>Postal codes</span></a></li>
            <li><a class="dropdown-item d-flex align-items-center" href="{{ route('admin.manage-vat.index') }}"><span>
                  <span>Manage VAT</span></a>
            </li>
            <li><a class="dropdown-item d-flex align-items-center"
                href="{{ route('admin.manage-department.index') }}"><span>Manage Departments</span></a>
            </li>
          </ul>
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.header-contact.index') }}">
            <span>Header & Contact Info</span>
          </a>
        </li>

      </ul>
    </div>
  </div>
</div>