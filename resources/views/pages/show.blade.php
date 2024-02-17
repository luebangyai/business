
<!DOCTYPE html>
<html lang="en">
@php $segment_blog = Request::segment(2); @endphp

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sinrachasit - {{ !empty($blog->name) ? $blog->name : "" }}</title>
  <meta name="description" content="Sinrachasit - {{ !empty($blog->name) ? $blog->name : "" }}">

  <meta property="og:url" content="https://sinrachasit.com/blog/{{ $segment_blog }}" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Sinrachasit - {{ !empty($blog->name) ? $blog->name : "" }}" />
  <meta property="og:description" content="Sinrachasit เครื่องมือช่างที่มืออาชีพเลือกใช้ - {{ !empty($blog->name) ? $blog->name : "" }}" />
  <meta property="og:image" content="https://sinrachasit.com/{{ $blog->cover }}" />

  <meta name="twitter:url" content="https://sinrachasit.com/blog/{{ $segment_blog }}" />
  <meta name="twitter:card" content="photo" />
  <meta name="twitter:site" content="@sinrachasit" />
  <meta name="twitter:title" content="Sinrachasit - {{ !empty($blog->name) ? $blog->name : "" }}" />
  <meta name="twitter:image" content="https://sinrachasit.com/{{ $blog->cover }}" />

  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  <meta name="keywords" content="SINRACHASIT, sinrachasit, NEW PRODUCTS, HOT SALES, TOOLS FOR PROFESSIONAL USE., เครื่องมือช่างที่มืออาชีพเลือกใช้ ">


    <!-- Favicon -->
    <link href="/img/favicon.ico" rel="icon">

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
    <link href="/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/css/style.css" rel="stylesheet">
</head>

<body>
  <style>
    .vertical-menu {
      width: 100%; /* Set a width if you like */
    }
    
    .vertical-menu a {
      background: rgb(255,192,0);
      background: linear-gradient(90deg, rgba(255,192,0,1) 40%, rgba(255,255,255,1) 98%);
      color: black; /* Black text color */
      display: block; /* Make the links appear below each other */
      padding: 12px; /* Add some padding */
      text-decoration: none; /* Remove underline from links */
      border-bottom: 1px solid #fff;
    }
    
    /*.vertical-menu a:hover {
      background: #fff;
    }*/
    
    .vertical-menu a.active {
      border-bottom: 2px solid #000;
  
    }

    .text-black{
      color: black; /* Black text color */
    }
  </style>
    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/blogs">Blog</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> {{ !empty($blog->name) ? $blog->name : "" }}</li>
                </ol>
              </nav>
              
              <div class="row g-3 px-4">
                <div class="col-md-10 offset-md-1">

                  <article class="blog-post">
                    <h2 class="display-5 link-body-emphasis mb-1"> {{ !empty($blog->name) ? $blog->name : "" }}</h2>
                    <p class="blog-post-meta">{{ $blog->created_at->format('M d, Y') }}</p>
                    <hr>
                    <div class="text-center">
                    <img class="rounded" width="70%" src="/{{ $blog->cover }}">
                    </div>
                    <br><br>
                    {!! $blog->detail !!}
                  </article>
       
                </div>
              </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/lib/wow/wow.min.js"></script>
    <script src="/lib/easing/easing.min.js"></script>
    <script src="/lib/waypoints/waypoints.min.js"></script>
    <script src="/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/lib/counterup/counterup.min.js"></script>

    <!-- Template Javascript -->
    <script src="/js/main.js"></script>
</body>

</html>