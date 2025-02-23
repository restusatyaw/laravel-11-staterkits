<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand ">
        <a href="index.html" class="text-white">BackOffice</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">BO</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown active">
          <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
          </a>
          <ul class="dropdown-menu">
            <li class="active">
              <a class="nav-link" href="{{route('backoffice.dashboard.index')}}"> Zakat Dashboard</a>
            </li>
          </ul>
        </li>

        <li class="menu-header">Produktifitas</li>
        <li><a class="nav-link" href="{{route('backoffice.customer.index')}}"><i class="fas fa-users"></i> <span>List Customer</span></a></li>
        <li><a class="nav-link" href="{{route('backoffice.transaction.index')}}"><i class="fas fa-wallet"></i> <span>Transaksi Zakat</span></a></li>

        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
              <i class="fas fa-paste"></i>
              <span>Laporan</span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="nav-link" href="layout-default.html">Customer</a>
              </li>
              <li>
                <a class="nav-link" href="layout-transparent.html">Pembayaran Zakat</a>
              </li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
              <i class="fas fa-box"></i>
              <span>Master Data</span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="nav-link" href="{{route('backoffice.user.index')}}">Pengguna</a>
              </li>
              <li>
                <a class="nav-link" href="{{route('backoffice.donationtype.index')}}">Jenis Zakat</a>
              </li>
            </ul>
          </li>
        <li><a class="nav-link" href=""><i class="fas fa-cogs"></i> <span>Pengaturan</span></a></li>

      </ul>
    </aside>
  </div>