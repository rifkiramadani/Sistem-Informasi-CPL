<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
      
        <title>Sistem Informasi CPL</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
      
        <!-- Favicons -->
        <link href="/assets/img/Logo-unib.png" rel="icon">
        <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
      
        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      
        <!-- Vendor CSS Files -->
        <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">
      
        <!-- Template Main CSS File -->
        <link href="/assets/css/style.css" rel="stylesheet">
      
        <!-- =======================================================
        * Template Name: NiceAdmin
        * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
        * Updated: Apr 20 2024 with Bootstrap v5.3.3
        * Author: BootstrapMade.com
        * License: https://bootstrapmade.com/license/
        ======================================================== -->
    </head>
    <body>

        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center header-scrolled">
      
          <div class="d-flex align-items-center justify-content-between">
            <img src="/assets/img/Logo-unib.png" alt="" width="50px">
            <a href="#" class="logo d-flex align-items-center ms-2">
              <span class="d-none d-lg-block" style="font-size: 20px">Sistem Informasi CPL</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
          </div><!-- End Logo -->
      
          <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
      
              <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                  <i class="bi bi-search"></i>
                </a>
              </li><!-- End Search Icon-->
      
              <li class="nav-item dropdown pe-3">
      
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                  <img src="{{ asset('storage/'. auth()->user()->profile_picture) }}" alt="Profile" class="rounded-circle">
                  <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                </a><!-- End Profile Iamge Icon -->
      
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                  <li class="dropdown-header">
                    <h6>{{ auth()->user()->name }}</h6>
                    <span>{{ auth()->user()->name }}</span>
                  </li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li>
                    <a href="/profile" class="dropdown-item d-flex align-items-center">
                      <i class="bi bi-person"></i>
                        <button class="btn btn">Profile</button>
                    </a>
                    <a class="dropdown-item d-flex align-items-center">
                      <i class="bi bi-box-arrow-right"></i>
                      <form action="/logout" method="post">
                        @csrf
                        <button class="btn btn">Log Out</button>
                      </form>
                    </a>
                  </li>
                </ul><!-- End Profile Dropdown Items -->
              </li><!-- End Profile Nav -->
            </ul>
          </nav><!-- End Icons Navigation -->
        </header><!-- End Header -->
      
        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">
          <ul class="sidebar-nav" id="sidebar-nav">
          @if (auth()->user()->hasRole('SuperAdmin/AkunSakti') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Operator')|| auth()->user()->hasRole('Dosen'))
            <h5>Dashboard</h5>  
          @endif
          @if (auth()->user()->hasRole('SuperAdmin/AkunSakti') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Operator')|| auth()->user()->hasRole('Dosen'))
            <li class="nav-item">
              <a class="nav-link {{ request()->is('dashboard') ? '' : 'collapsed' }}" href="/dashboard">
                <i class="bi bi-archive"></i>
                <span>Dashboard</span>
              </a>
            </li>
          @endif
          <hr>
          @if (auth()->user()->hasRole('SuperAdmin/AkunSakti') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Operator')|| auth()->user()->hasRole('Dosen'))
            <h5>Pengguna</h5>  
          @endif
          @if (auth()->user()->hasRole('SuperAdmin/AkunSakti'))
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin') ? '' : 'collapsed' }}" href="/admin">
                <i class="bi bi-person"></i>
                <span>Admin</span>
              </a>
            </li>
          @endif
          @if (auth()->user()->hasRole('SuperAdmin/AkunSakti'))
            <li class="nav-item">
              <a class="nav-link {{ request()->is('operator') ? '' : 'collapsed' }}" href="/operator">
                <i class="bi bi-person"></i>
                <span>Operator</span>
              </a>
            </li>
          @endif
          @if (auth()->user()->hasRole('SuperAdmin/AkunSakti') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Operator')|| auth()->user()->hasRole('Dosen'))
            <li class="nav-item">
              <a class="nav-link {{ request()->is('mahasiswa') ? '' : 'collapsed' }}" href="/mahasiswa">
                <i class="bi bi-person"></i>
                <span>Mahasiswa</span>
              </a>
            </li>
          @endif
          @if (auth()->user()->hasRole('SuperAdmin/AkunSakti') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Operator'))
            <li class="nav-item">
              <a class="nav-link {{ request()->is('dosen') ? '' : 'collapsed' }}" href="/dosen">
                <i class="bi bi-person"></i>
                <span>Dosen</span>
              </a>
            </li>
            @endif
            @if (auth()->user()->hasRole('SuperAdmin/AkunSakti') || auth()->user()->hasRole('Admin'))
            <hr>
            <h5>Pemetaan</h5>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('cpmk') ? '' : 'collapsed' }}" href="/cpmk">
                <i class="bi bi-journals"></i>
                <span>CPMK</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('cpl') ? '' : 'collapsed' }}" href="/cpl">
                <i class="bi bi-journal"></i>
                <span>CPL</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('matakuliah') ? '' : 'collapsed' }}" href="/matakuliah">
                <i class="bi bi-book"></i>
                <span>Mata Kuliah</span>
              </a>
            </li>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('rumusan') ? '' : 'collapsed' }}" href="/rumusan">
              <i class="bi bi-file"></i>
              <span><b>Rumusan</b></span>
            </a>
          </li>
            @endif
            <!-- End Dashboard Nav -->
          </ul>
        </aside><!-- End Sidebar-->
      
          @yield('content')
      
        <!-- ======= Footer ======= -->
        <footer id="footer" class="footer">
          <div class="copyright">
            © Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
          </div>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </footer><!-- End Footer -->
      
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center active"><i class="bi bi-arrow-up-short"></i></a>
      
        <!-- Vendor JS Files -->
        <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/vendor/chart.js/chart.umd.js"></script>
        <script src="/assets/vendor/echarts/echarts.min.js"></script>
        <script src="/assets/vendor/quill/quill.js"></script>
        <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="/assets/vendor/php-email-form/validate.js"></script>
      
        <!-- Template Main JS File -->
        <script src="/assets/js/main.js"></script>
      
      
      
      <svg id="SvgjsSvg1171" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1172"></defs><polyline id="SvgjsPolyline1173" points="0,0"></polyline><path id="SvgjsPath1174" d="M0 0 "></path></svg></body>
</html>