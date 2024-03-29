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
 
    <!-- Spinner Start -->
    {{--  <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>  --}}
    <!-- Spinner End -->


    {{--  <!-- Topbar Start -->
   
    <!-- Topbar End -->  --}}


  <div class="container-fluid" style="background-color: #575757">
    <div class="row">
      <div class="col-lg-3 col-12">
        <div style="margin-top: 1px;" class="vertical-menu">
          <a href="/ourproducts">C&U Bearing</a>
          <a href="/ourproducts">FSB</a>
          <a href="/ourproducts">FUKA</a>
          <a href="/ourproducts">ACGO</a>
        </div>
      </div>
      <div class="col-lg-1 col-1"></div>
      <div class="col-lg-7 col-12">

        <!-- Carousel Start -->
        <div class=" px-0 p-2">
          @if(count($slides) > 0)
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  @foreach ($slides as $key => $item)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="min-height: 145px !important;" >
                      <img class="w-100" src="{{ $item->cover }}" alt="Image">
                    </div>
                  @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            @endif
        </div>
        <!-- Carousel End -->
        
      </div>
      <div class="col-lg-1 col-1"></div>
    </div>
  </div>





    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="row gx-3 h-100">
                        <div class="align-self-start wow fadeInUp" data-wow-delay="0.1s">
                          <h2 style="border-bottom: 3px solid #ffc000;"><span class="text-danger">NEW</span> PRODUCTS</h2>
                            <img class="img-fluid" src="img/menu1.png">
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4">
                  <div class="row gx-3 h-100">
                      <div class="align-self-start wow fadeInUp" data-wow-delay="0.1s">
                        <h2 style="border-bottom: 3px solid #ffc000;"><span class="text-danger">HOT</span> SALES</h2>
                          <img class="img-fluid" src="img/menu2.png">
                      </div>  
                  </div>
              </div>
              <div class="col-lg-4">
                <div class="row gx-3 h-100">
                    <div class="align-self-start wow fadeInUp text-center mt-4" data-wow-delay="0.1s">
                      <br><br>
                        <h2 style="font-size: 26px;">TOOLS <br>FOR PROFESSIONAL USE</h2>
                        <h3>เครื่องมือช่างที่มืออาชีพเลือกใช้</h3>
                    </div>  
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- About End -->



    <!-- Footer Start -->
    <div class="container-fluid footer wow fadeIn" data-wow-delay="0.1s" style="background-color: #c4c4c4">
        <div class="container">
            <div class="row ">
                <div class="col-lg-1 col-md-6 g-4">
                 
                  <h5 class="text-black text-center">
                    <img src="/images/logo.png"  alt="" height="120px">
                  </h5>
                 
                </div>
                <div class="col-lg-2 col-md-6 g-5">
                  <h4 class="text-black text-center">
                    <span style="border-bottom: 2px solid #ffc000;">SINRACHASIT</span>
                    <br>
                  </h4>
                  <h4 class="text-black text-center">สินรชสิทธิ์</h4>
                </div>
                <div class="col-lg-6 col-md-6 g-5">
                    <h6 class="text-black">SINRACHASIT CO., LTD.</h6>
                    <h6 class="text-black">96, SOI KRUNGTHON BURI 2, KRUNG THON BURI, BANG LAM PHU LANG,</h6>
                    <h6 class="text-black">KHLONG SAN, BANGKOK 10600. THAILAND.</h6>
                </div>
                <div class="col-lg-3 col-md-6 g-5">
                    <h6 class="text-black mb-2">TEL. (02) 437-1322</h6>
                    <h6 class="text-black mb-2">FAX. (02) 437-1321</h6>
                    <h6 class="text-black mb-4">Email. info@sinrachasit.com</h6>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


 


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