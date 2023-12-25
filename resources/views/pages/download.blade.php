
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Industro - Industrial HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
              <h2>
                <span style="border-bottom: 3px solid #ffc000;">
                  <span class="text-danger">Our</span> PRODUCTS
                </span>
              </h2>

              <div class="col-lg-12">
                <div class="row gx-3 h-100">
                 
                    <div class=" wow fadeInUp" data-wow-delay="0.1s">
                      <a href="/media/pdf/[SRS CATALOG 2022] [NEW] - Update 2022-09-01.pdf" target="_blank">
                        <div class="d-flex align-items-center justify-content-center">
                          <img src="/img/d01_0.png" alt="" height="250px">
                        </div>
                      
                        <div class="d-flex align-items-center justify-content-center mt-2">
                          <p class="text-black">FULL CATALOG (Updated: 19-09-2022).pdf</p>
                        </div>
                      </a>
                    </div>
                 
                </div>
              </div>

              @php $products = ["BEARING", "PERFECT", "ACGO", "MISUI", "NKG"]; @endphp

              <div class="row d-flex justify-content-center mt-4">
                @for ($i = 2; $i <= count($products)+1; $i++)
                  <div class="col-lg-2">
                    <div class="row gx-3 h-100" >
                        <div class="d-flex justify-content-evenly wow fadeInUp" data-wow-delay="0.1s">
                          <img src="/img/d0{{ $i }}_0.png" height="250px">
                        </div>
                    </div>
                  </div>
                @endfor
              </div>
                


            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>