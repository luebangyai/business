
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

              @if(isset($downloads) && !empty($downloads[0]))
              <div class="col-lg-12">
                <div class="row gx-3 h-100">
                 
                    <div class=" wow fadeInUp" data-wow-delay="0.1s">
                      <a href="{{ $downloads[0]->detail }}" target="_blank">
                        <div class="d-flex align-items-center justify-content-center">
                          <img src="{{ $downloads[0]->cover }}" alt="" height="250px">
                        </div>
                      
                        <div class="d-flex align-items-center justify-content-center mt-2">
                          <p class="text-black">{{ $downloads[0]->name }}</p>
                        </div>
                      </a>
                    </div>
                </div>
              </div>
              @endif

              <div class="row d-flex justify-content-center mt-4">
                @foreach ($downloads as $key => $item)
                  @php  if($key == 0) { continue; } @endphp
                  
                  <div class="col-lg-2">
                    <div class="row gx-3 h-100" >
                        <div class="d-flex justify-content-evenly wow fadeInUp" data-wow-delay="0.1s">
                          @if(!empty($item->detail))
                          <a href="{{ $item->detail }}" target="_blank">
                            <img src="{{ $item->cover }}" height="250px">
                          </a>
                          @else
                          <img src="{{ $item->cover }}" height="250px">
                          @endif
                        </div>
                    </div>
                  </div>
               
                @endforeach
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