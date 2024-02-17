<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Favicon -->
<link href="img/favicon.ico" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Rubik:wght@500;600;700&display=swap"
    rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


  <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
    @include('partials.head')

    <body class="antialiased">

      @include('partials.header')
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="main-panel">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0 mt-4">
                    <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5 mb-5">
                       
                        <h4 class="text-dark mt-1">
                          <span style="border-bottom: 3px solid #ffc000;">
                            <span class="text-danger">Log</span> In
                          </span>
                        </h4>
                       
                        <form method="POST" action="{{ route('login') }}" class="pt-3">
                            @csrf
                        <div class="form-group mt-2">
                          <label for="">Username : </label>
                            <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="">
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group mt-2">
                          <label for="">Password :</label>
                            <input type="password" name="password" class="form-control form-control-lg" id="password" required autocomplete="current-password" placeholder="">
                            @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        </div>
                        <div class="mt-3 mb-4">
                            <button type="submit" style="background-color: #ffc000;" class="btn btn-block btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                        </div>

                        </form>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            </div>
        </div>


        @include('partials.footer')
        <script src="/vendors/js/vendor.bundle.base.js"></script>
        <script src="/js/off-canvas.js"></script>
        <script src="/js/hoverable-collapse.js"></script>
        <script src="/js/template.js"></script>
        <script src="/js/settings.js"></script>
        <script src="/js/todolist.js"></script>
        <script src="/js/tabs.js"></script>

        <script src="/vendors/moment/moment.min.js"></script>
        <script src="/vendors/fullcalendar/fullcalendar.min.js"></script>
        <script src="/js/calendar.js"></script>
    </body>
</html>
