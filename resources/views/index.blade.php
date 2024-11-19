
  @extends('base')
  @section('title','MikrotekWifi')
  @section('main')
  
  
    <section id="hero" class="hero section dark-background">
      <img src="assets/img/hero-bg-2.jpg" alt="" class="hero-bg">

      <div class="container">
        <div class="row gy-4 justify-content-between">
          <div class="col-lg-4 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>

          <div class="col-lg-6  d-flex flex-column justify-content-center" data-aos="fade-in">
            <h1>{{__("site.about manage")}}<span>MikrotekWifi</span></h1>
            <p>{{__("site.Convert your Wi-Fi network into a competitive advantage!")}}</p>
            <div class="d-flex">
              <a href="{{route('site.signup.user')}}" class="btn-get-started">{{__("site.Get Started")}}</a>
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>{{__("site.Watch Video")}}</span></a>
            </div>
          </div>

        </div>
      </div>

      <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="3"></use>
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0"></use>
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="9"></use>
        </g>
      </svg>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">

          <div class="col-xl-5 content">
            <h3>{{__("About Us")}}</h3>
            <h2>MikrotekWifi </h2>
            <p>{{__("site.aboutus")}}</p>
            <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>

          <div class="col-xl-7">
            <div class="row gy-4 icon-boxes">

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box">
                  <i class="bi bi-buildings"></i>
                  <h3>{{__("site.Easy to use")}}</h3>
                  <p>{{__("site.easy_to_use")}}</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box">
                  <i class="bi bi-clipboard-pulse"></i>
                  <h3>{{__("site.Automatic System")}}</h3>
                  <p>{{__("site.automatic_system")}}</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box">
                  <i class="bi bi-command"></i>
                  <h3>{{__("site.Interactive Application")}}</h3>
                  <p>{{__("site.interative_application")}}</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box">
                  <i class="bi bi-graph-up-arrow"></i>
                  <h3>{{__("site.Request Small Custom")}}</h3>
                  <p>{{__("site.request_small")}}</p>
                </div>
              </div> <!-- End Icon Box -->

            </div>
          </div>

        </div>
      </div>

    </section><!-- /About Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="features-item">
              <img src="assets/img/Group-360.webp" width="40px" height="40px" style="margin-right: 7px" alt="">
              <h3><a href="" class="stretched-link">MTN Mobile Money</a></h3>
            </div>
          </div><!-- End Feature Item -->

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="features-item">
              <img src="assets/img/logo-orange-money.svg" width="40px" height="40px" style="margin-right: 7px" alt="">
              <h3><a href="" class="stretched-link">Orange Money</a></h3>
            </div>
          </div><!-- End Feature Item -->

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="features-item">
              <i class="fa-solid fa-message" width="40px" height="40px"></i>
              <h3><a href="" class="stretched-link">{{__("Send SMS")}}</a></h3>
            </div>
          </div><!-- End Feature Item -->

        </div>

      </div>

    </section><!-- /Features Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-emoji-smile"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
              <p>{{__("site.Happy Clients")}}</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-journal-richtext"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
              <p>{{__("site.Projects")}}</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-headset"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="463" data-purecounter-duration="1" class="purecounter"></span>
              <p>{{__("site.Hours Of Support")}}</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-people"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="5" data-purecounter-duration="1" class="purecounter"></span>
              <p>{{__("site.Hard Workers")}}</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Details Section -->
    <section id="details" class="details section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>{{__("site.Details")}}</h2>
        <div><span>{{__("site.Check Our")}}</span> <span class="description-title">{{__("site.Details")}}</span></div>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
            <img src="assets/img/details-1.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
            <h3>{{__("site.check_out")}}</h3>
            <p class="fst-italic">
              {{__("site.check_detail")}}
            </p>
            <ul>
              <li><i class="bi bi-check"></i><span> {{__("site.check_wifi_zone")}}</span></li>
              <li><i class="bi bi-check"></i> <span>{{__("site.check_ticket")}}</span></li>
              <li><i class="bi bi-check"></i> <span>{{__("site.check_import")}}</span></li>
            </ul>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/details-2.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 order-2 order-md-1" data-aos="fade-up" data-aos-delay="200">
            <h3>{{__("site.Generate income with your wifi zones")}}</h3>
            <p>
              {{__("site.generate_detail")}}
            </p>
          </div>
        </div><!-- Features Item -->

        <div class="row gy-4 align-items-center features-item">
          <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out">
            <img src="assets/img/details-3.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-7" data-aos="fade-up">
            <h3>{{__("site.Administer and monetize your Wi-Fi like a pro!")}}</h3>
            <p>{{__("site.administrer_monetize")}}</p>
            <ul>
              <li><i class="bi bi-check"></i> <span>{{__("site.be notified in real time of wifi ticket purchases")}}</span></li>
              <li><i class="bi bi-check"></i><span> {{__("site.see the details of each transaction")}}</span></li>
              <li><i class="bi bi-check"></i> <span>{{__("site.have a transaction history and sales statistics over different periods")}}</span>.</li>
            </ul>
          </div>
        </div><!-- Features Item -->

      </div>

    </section><!-- /Details Section -->


    <!-- Pricing Section -->
    <section id="pricing" class="pricing section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>{{__("site.Pricing")}}</h2>
        <div><span>{{__("site.Check Our")}}</span> <span class="description-title">{{__("Pricing")}}</span></div>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="pricing-item">
              <h3>{{__("site.First Plan")}}</h3>
              <p class="description">{{__("site.you can subscribe to a package in the form of a percentage deduction")}}</p>
              <h4><sup>%</sup>15<span> / transaction</span></h4>
              <a href="{{route('site.create.account')}}" class="cta-btn">Start</a>
              <ul>
                <li><i class="bi bi-check"></i> <span>{{__("site.send unlimited messages")}}</span></li>
                <li><i class="bi bi-check"></i> <span>{{__("site.unlimited number of ticket sales")}}</span></li>
                <li><i class="bi bi-check"></i> <span>{{__("site.real-time notification")}}</span></li>
              </ul>
            </div>
          </div><!-- End Pricing Item -->
          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="pricing-item">
              <h3>{{__("site.second Plan")}}</h3>
              <p class="description">{{__("site.you can subscribe to a package in the form of a percentage deduction")}}</p>
              <h4><sup>CFA</sup>10000<span> / {{__("site.month")}}</span></h4>
              <a href="{{route('site.create.account')}}" class="cta-btn">Start </a>
              <ul>
                <li><i class="bi bi-check"></i> <span>{{__("site.send unlimited messages")}}</span></li>
                <li><i class="bi bi-check"></i> <span>{{__("site.unlimited number of ticket sales")}}</span></li>
                <li><i class="bi bi-check"></i> <span>{{__("site.real-time notification")}}</span></li>
              </ul>
            </div>
          </div><!-- End Pricing Item -->

        </div>

      </div>

    </section><!-- /Pricing Section -->


    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <div><span>{{__("site.Check Our")}}</span> <span class="description-title">Contact</span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p>Douala Makepe bloc L</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>{{__("site.Call Us")}}</h3>
                <p>674659490 / 699277529</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>{{__("site.Email Us")}}</h3>
                <p>nguegouealain@gmail.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="{{route('site.submit.email')}}" method="POST" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              @csrf
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="first_name" class="form-control" placeholder="{{__("site.First Name")}}" required="">
                </div>
                @error('first_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="col-md-6">
                  <input type="text" name="last_name" class="form-control" placeholder="{{__("site.Last Name")}}" required="">
                </div>
                @error('last_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Email" required="">
                </div>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="{{__("site.Subject")}}" required="">
                </div>
                @error('subject')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>
                @error('message')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">{{__("site.Send Message")}}</button>
                </div>
                

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->
    @endsection