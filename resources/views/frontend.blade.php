@extends('layouts.frontend')
@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    <!-- slider section -->
    
    <div class="hero_area">
        <section class="slider_section ">
            <div class="container ">
            <div class="row">
                <div class="col-md-6">
                <div class="detail-box">
                    <h1>
                        QR Media Hub – Store, Share, and Access Media Seamlessly
                    </h1>
                    <p>QR Media Hub is your all-in-one media storage and sharing platform. Similar to Google Drive, QR Media Hub allows users to upload images, videos, and descriptions securely to a live server. With an easy-to-use interface, users can store their personal media files and share them effortlessly by generating unique QR codes. </p>              
                        <div class="btn-box">
                    <a href="" class="btn-1">
                        Read More
                    </a>
                    <a href="{{route('registerUser')}}" class="btn-2">
                        Register
                    </a>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="row">
                    <div class=" col-lg-10 mx-auto">
                    <div class="img-box">
                        <img src="frontend/images/slider-img.png" alt="">
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>
    </div>
    <!-- end slider section -->

    <!-- service section -->

    <section class="service_section layout_padding" id="services">
        <div class="container">
          <div class="heading_container heading_center">
            <h2>
              Our Services
            </h2>
          </div>
        </div>
        <div class="container ">
          <div class="row">
            <div class="col-md-6 col-lg-4">
              <div class="box ">
                <div class="img-box">
                  <img src="frontend/images/s1.png" alt="">
                </div>
                <div class="detail-box">
                  <h4>
                    Secure Media Storage
                  </h4>
                  <p>
                    Store your images and videos securely in the cloud. Access your files anytime from anywhere with our robust storage infrastructure.
                  </p>
                  <a href="">
                    Read More
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="box ">
                <div class="img-box">
                  <img src="frontend/images/s2.png" alt="">
                </div>
                <div class="detail-box">
                  <h4>
                    QR Code Sharing
                  </h4>
                  <p>
                    Easily generate and share QR codes to give others access to your media files. No need for complex links—just scan and view.
                  </p>
                  <a href="">
                    Read More
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 ">
              <div class="box ">
                <div class="img-box">
                  <img src="frontend/images/s3.png" alt="">
                </div>
                <div class="detail-box">
                  <h4>
                    High-Speed Uploads
                  </h4>
                  <p>
                    Upload your media quickly and efficiently with our high-speed server technology. Large video files and photo albums are uploaded in no time.
                  </p>
                  <a href="">
                    Read More
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="box ">
                <div class="img-box">
                  <img src="frontend/images/s4.png" alt="">
                </div>
                <div class="detail-box">
                  <h4>
                    Media Management
                  </h4>
                  <p>
                    Manage your media effortlessly with our user-friendly dashboard. Organize, categorize, and search your media with ease.
                  </p>
                  <a href="">
                    Read More
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="box ">
                <div class="img-box">
                  <img src="frontend/images/s5.png" alt="">
                </div>
                <div class="detail-box">
                  <h4>
                    Admin QR Access
                  </h4>
                  <p>
                    Admins can log in securely using a generated QR code, providing a fast and secure method for system access and management.
                  </p>
                  <a href="">
                    Read More
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="box ">
                <div class="img-box">
                  <img src="frontend/images/s6.png" alt="">
                </div>
                <div class="detail-box">
                  <h4>
                    Media Sharing
                  </h4>
                  <p>
                    Share your uploaded images and videos with friends, family, or colleagues with a simple QR scan, ensuring quick and hassle-free access.
                  </p>
                  <a href="">
                    Read More
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      

    <!-- end service section -->

    <!-- about section -->

    <section class="about_section layout_padding-bottom" id="about">
        <div class="container  ">
        <div class="row">
            <div class="col-md-6">
            <div class="detail-box">
                <div class="heading_container">
                <h2>
                    About Us
                </h2>
                </div>
                <p>
                    QR Media Hub is your all-in-one media storage and sharing platform. Similar to Google Drive, QR Media Hub allows users to upload images, videos, and descriptions securely to a live server. With an easy-to-use interface, users can store their personal media files and share them effortlessly by generating unique QR codes.                </p>
                <a href="">
                Read More
                </a>
            </div>
            </div>
            <div class="col-md-6 ">
            <div class="img-box">
                <img src="frontend/images/about-img.png" alt="">
            </div>
            </div>

        </div>
        </div>
    </section>

    <!-- end about section -->


    <!-- server section -->

    <section class="server_section">
        <div class="container ">
        <div class="row">
            <div class="col-md-6">
            <div class="img-box">
                <img src="frontend/images/server-img.jpg" alt="">
                <div class="play_btn">
                <button>
                    <i class="fa fa-play" aria-hidden="true"></i>
                </button>
                </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="detail-box">
                <div class="heading_container">
                <h2>
                    Let us manage your server
                </h2>
                <p>
                    Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore
                </p>
                </div>
                <a href="">
                Read More
                </a>
            </div>
            </div>
        </div>
        </div>
    </section>

    <!-- end server section -->

    <!-- price section -->

    <section class="price_section layout_padding" id="price">
        <div class="container">
        <div class="heading_container heading_center">
            <h2>
            Our Pricing
            </h2>
        </div>
        <div class="price_container ">
            <div class="box">
            <div class="detail-box">
                <h2>$ <span>49</span></h2>
                <h6>
                Startup
                </h6>
                <ul class="price_features">
                <li>
                    2GB RAM
                </li>
                <li>
                    20GB SSD Cloud Storage
                </li>
                <li>
                    Weekly Backups
                </li>
                <li>
                    DDoS Protection
                </li>
                <li>
                    Full Root Access
                </li>
                <li>
                    24/7/365 Tech Support
                </li>
                </ul>
            </div>
            <div class="btn-box">
                <a href="">
                See Detail
                </a>
            </div>
            </div>
            <div class="box">
            <div class="detail-box">
                <h2>$ <span>99</span></h2>
                <h6>
                Standard
                </h6>
                <ul class="price_features">
                <li>
                    4GB RAM
                </li>
                <li>
                    50GB SSD Cloud Storage
                </li>
                <li>
                    Weekly Backups
                </li>
                <li>
                    DDoS Protection
                </li>
                <li>
                    Full Root Access
                </li>
                <li>
                    24/7/365 Tech Support
                </li>
                </ul>
            </div>
            <div class="btn-box">
                <a href="">
                See Detail
                </a>
            </div>
            </div>
            <div class="box">
            <div class="detail-box">
                <h2>$ <span>149</span></h2>
                <h6>
                Business
                </h6>
                <ul class="price_features">
                <li>
                    8GB RAM
                </li>
                <li>
                    100GB SSD Cloud Storage
                </li>
                <li>
                    Weekly Backups
                </li>
                <li>
                    DDoS Protection
                </li>
                <li>
                    Full Root Access
                </li>
                <li>
                    24/7/365 Tech Support
                </li>
                </ul>
            </div>
            <div class="btn-box">
                <a href="">
                See Detail
                </a>
            </div>
            </div>
        </div>
        </div>
    </section>

    <!-- price section -->

    <!-- client section -->
    <section class="client_section" id="client">
        <div class="container">
        <div class="heading_container heading_center">
            <h2>
            Testimonial
            </h2>
            <p>
            Even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to
            </p>
        </div>
        </div>
        <div class="container px-0">
        <div id="customCarousel2" class="carousel  slide" data-ride="carousel">
            <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                    <div class="box">
                        <div class="img-box">
                        <img src="frontend/images/client.jpg" alt="">
                        </div>
                        <div class="detail-box">
                        <div class="client_info">
                            <div class="client_name">
                            <h5>
                                Morojink
                            </h5>
                            <h6>
                                Customer
                            </h6>
                            </div>
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore
                            et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum
                            dolore eu fugia
                        </p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                    <div class="box">
                        <div class="img-box">
                        <img src="frontend/images/client.jpg" alt="">
                        </div>
                        <div class="detail-box">
                        <div class="client_info">
                            <div class="client_name">
                            <h5>
                                Morojink
                            </h5>
                            <h6>
                                Customer
                            </h6>
                            </div>
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore
                            et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum
                            dolore eu fugia
                        </p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                    <div class="box">
                        <div class="img-box">
                        <img src="frontend/images/client.jpg" alt="">
                        </div>
                        <div class="detail-box">
                        <div class="client_info">
                            <div class="client_name">
                            <h5>
                                Morojink
                            </h5>
                            <h6>
                                Customer
                            </h6>
                            </div>
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore
                            et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum
                            dolore eu fugia
                        </p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <div class="carousel_btn-box">
            <a class="carousel-control-prev" href="#customCarousel2" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#customCarousel2" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="sr-only">Next</span>
            </a>
            </div>
        </div>
        </div>
    </section>
    <!-- end client section -->

    <!-- contact section -->
    <section class="contact_section layout_padding-bottom" id="contact">
        <div class="container">
        <div class="heading_container heading_center">
            <h2>
            Get In Touch
            </h2>
        </div>
        <div class="row">
            <div class="col-md-8 col-lg-6 mx-auto">
            <div class="form_container">
                <form action="">
                <div>
                    <input type="text" placeholder="Your Name" />
                </div>
                <div>
                    <input type="email" placeholder="Your Email" />
                </div>
                <div>
                    <input type="text" placeholder="Your Phone" />
                </div>
                <div>
                    <input type="text" class="message-box" placeholder="Message" />
                </div>
                <div class="btn_box ">
                    <button>
                    SEND
                    </button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </section>
    <!-- end contact section -->
  @endsection