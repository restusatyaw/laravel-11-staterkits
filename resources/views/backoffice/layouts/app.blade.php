<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Backoffice - {{$page_title}}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('assets/modules/jqvmap/dist/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/modules/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap4.min.css">
  @stack('style')
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      @include('backoffice.layouts.header')
      @include('backoffice.layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          @if (!request()->routeIs('backoffice.dashboard.index'))
             <div class="section-header">
                <div>
                    <h1>{{$page_title}}</h1>
                    <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Root</a></div>
                    <div class="breadcrumb-item"><a href="#">{{$page_title}}</a></div>
                    </div>
                </div>
                <div class="section-header-breadcrumb">
                    @if (isset($urlCreate))
                        <a href="{{$urlCreate}}" class="btn btn-primary">Tambah Data {{$page_title}}</a>
                    @endif
                </div>
              </div> 
          @endif
            
          @yield('content')
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; {{\Carbon\Carbon::now()->format('Y')}} <div class="bullet"></div> Design By Benny Setiawan</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('assets/modules/jquery.min.js')}}"></script>
  <script src="{{asset('assets/modules/popper.js')}}"></script>
  <script src="{{asset('assets/modules/tooltip.js')}}"></script>
  <script src="{{asset('assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('assets/modules/moment.min.js')}}"></script>
  <script src="{{asset('assets/js/stisla.js')}}"></script>
  
  <!-- JS Libraies -->
  <script src="{{asset('assets/modules/jquery.sparkline.min.js')}}"></script>
  <script src="{{asset('assets/modules/chart.min.js')}}"></script>
  <script src="{{asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js')}}"></script>
  <script src="{{asset('assets/modules/summernote/summernote-bs4.js')}}"></script>
  <script src="{{asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('assets/js/page/index.js')}}"></script>
  
  <!-- Template JS File -->
  <script src="{{asset('assets/js/scripts.js')}}"></script>
  <script src="{{asset('assets/js/custom.js')}}"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap4.min.js"></script>
  @stack('script')
  @include('backoffice.components.alert')

  <script>
    $(document).on("click", ".delete-item", function () {
        var deleteEndpoint = $(this).data('url');
        // Konfirmasi pengguna sebelum menghapus data
        var confirmation = confirm("Apakah Anda yakin ingin menghapus data?");

        if (confirmation) {
            // Melakukan permintaan AJAX DELETE
            $.ajax({
                url: deleteEndpoint,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (result) {
                    // Tindakan yang diambil jika penghapusan berhasil
                    console.log("Data berhasil dihapus", result);
                    Swal.fire({
                        icon: "success",
                        title: "Sukses",
                        text: "Data berhasil dihapus",
                    });
                    table.draw();
                },
                error: function (error) {
                    // Tindakan yang diambil jika terjadi kesalahan
                    console.error("Terjadi kesalahan saat menghapus data", error);
                }
            });
        }
    });

</script>


</body>
</html>