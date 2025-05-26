<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>E-LEARNING</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/logo.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img class="img-fluid" src="{{ asset('img/logo.png') }}" style="width:70px;height:70px;" alt="">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('index') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }} " style="color: rgba(24, 56, 24, 0.7);">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link custom-hover{{ request()->is('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('courses.index') }}" class="nav-item nav-link custom-hover{{ request()->is('courses') ? 'active' : '' }}">Courses</a>
                <a href="{{ route('team') }}" class="nav-item nav-link custom-hover{{ request()->is('team') ? 'active' : '' }}">Our Team</a>
                <a href="{{ route('testimonial') }}" class="nav-item nav-link custom-hover{{ request()->is('testimonial') ? 'active' : '' }}">Testimonial</a>
                <a href="{{ route('contact') }}" class="nav-item nav-link custom-hover{{ request()->is('contact') ? 'active' : '' }}">Contact</a>
            </div>
            @auth
                <a href="{{ route('profile') }}" class="btn py-4 px-lg-5 d-none d-lg-block" style="background-color: rgba(24, 56, 24, 0.7); color: #fff;">
                    Profile <i class="fa fa-user ms-3"></i>
                </a>
            @else
                <a href="{{ route('login.show') }}" class="btn py-4 px-lg-5 d-none d-lg-block" style="background-color: rgba(24, 56, 24, 0.7); color: #fff;">
                    Join Now <i class="fa fa-arrow-right ms-3"></i>
                </a>
            @endauth
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('img/carousel-1.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 56, 24, 0.7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-uppercase mb-3 animated slideInDown" style="color: rgba(24, 56, 24, 0.7);">Best Online Courses</h5>
                                <h1 class="display-3 text-white animated slideInDown">The Best Online Learning Platform</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus eirmod elitr.</p>
                                <a href="{{ route('courses.index') }}" class="btn py-md-3 px-md-5 me-3 animated slideInLeft" style="background-color: rgba(24, 56, 24, 0.7); color: #fff;">Read More</a>
                                <a href="{{ route('login.show') }}" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('img/carousel-2.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 56, 24, 0.7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-uppercase mb-3 animated slideInDown" style="color: rgba(24, 56, 24, 0.7);">Best Online Courses</h5>
                                <h1 class="display-3 text-white animated slideInDown">Get Educated Online From Your Home</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus eirmod elitr.</p>
                                <a href="{{ route('courses.index') }}" class="btn py-md-3 px-md-5 me-3 animated slideInLeft" style="background-color: rgba(24, 56, 24, 0.7); color: #fff;">Read More</a>
                                <a href="{{ route('login.show') }}" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-graduation-cap mb-4" style="color:rgba(24, 56, 24, 0.7);"></i>
                            <h5 class="mb-3">Skilled Instructors</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe mb-4" style="color:rgba(24, 56, 24, 0.7);"></i>
                            <h5 class="mb-3">Online Classes</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-home mb-4"  style="color:rgba(24, 56, 24, 0.7);"></i>
                            <h5 class="mb-3">Home Projects</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-book-open mb-4" style="color:rgba(24, 56, 24, 0.7);"></i>
                            <h5 class="mb-3">Book Library</h5>
                            <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{ asset('img/about.jpg') }}" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start pe-3"  style="color:rgba(24, 56, 24, 0.7);">About Us</h6>
                    <h1 class="mb-4">Welcome to eLEARNING</h1>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right me-2" style="color:rgba(24, 56, 24, 0.7);"></i>Skilled Instructors</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right me-2" style="color:rgba(24, 56, 24, 0.7);"></i>Online Classes</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right me-2" style="color:rgba(24, 56, 24, 0.7);"></i>International Certificate</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right me-2" style="color:rgba(24, 56, 24, 0.7);"></i>Skilled Instructors</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right me-2" style="color:rgba(24, 56, 24, 0.7);"></i>Online Classes</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right me-2" style="color:rgba(24, 56, 24, 0.7);"></i>International Certificate</p>
                        </div>
                    </div>
                    <a class="btn py-3 px-5 mt-2" style="background-color:rgba(24, 56, 24, 0.7);color:rgba(255, 255, 255, 0.96);" href="{{ route('courses.index') }}">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Courses Start -->
    <div class="container my-4">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center px-3 mb-3" style="color:rgba(24, 56, 24, 0.7);">Catégories</h6>
        </div>
        <!-- Filtres Catégories -->
        <div class="mb-5 text-center">
            <a href="{{ route('courses.index') }}" class="btn btn-outline-custom mx-1 {{ request('categorie') ? '' : 'active' }}">
                Toutes les catégories
            </a>
            @foreach ($categories as $cat)
                <a href="{{ route('courses.index', ['categorie' => $cat->categorie]) }}" class="btn btn-outline-custom mx-1 {{ request('categorie') === $cat->categorie ? 'active' : '' }}">
                    {{ $cat->categorie }}
                </a>
            @endforeach
        </div>
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center px-3 mb-3" style="color:rgba(24, 56, 24, 0.7);">Courses</h6>
        </div>
        <!-- Affichage des cours -->
        <div class="row">
            @forelse ($cours as $cour)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">{{ $cour->titre }}</h5>
                                <!--p class="card-text">{{ Str::limit($cour->description, 100) }}</p-->
                            </div>

                            <div class="mt-4 d-flex justify-content-center">
                                <a href="{{ route('courses.show', $cour->id) }}" class="flex-shrink-0 btn btn-sm px-3 me-2" style="border-radius: 30px 0 0 30px; background-color: rgba(24, 56, 24, 0.7); color: white;">
                                    Read More
                                </a>
                                <a href="{{ route('login.show') }}" class="flex-shrink-0 btn btn-sm px-3" style="border-radius: 0 30px 30px 0; background-color: rgba(24, 56, 24, 0.7); color: white;">
                                    Join Now
                                </a>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <!--small class="text-muted">Catégorie : {{ $cour->categorie }}</small-->
                            <small class="text-muted">Difficulté : {{ $cour->difficulte }}</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Aucun cours trouvé pour cette catégorie.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <!-- Pagination -->
    <nav aria-label="Page navigation example">
        {{ $cours->links('pagination::bootstrap-5') }}
    </nav>
    <!-- Courses End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center px-3" style="color:rgba(24, 56, 24, 0.7);">Instructors</h6>
                <h1 class="mb-5">Expert Instructors</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('img/team-2.jpg') }}" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square mx-1" style="color:rgba(24, 56, 32, 0.96);background-color:rgba(24, 56, 32, 0.50);" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square mx-1" style="color:rgba(24, 56, 32, 0.96);background-color:rgba(24, 56, 32, 0.50);" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square mx-1" style="color:rgba(24, 56, 32, 0.96);background-color:rgba(24, 56, 32, 0.50);" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Instructor Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('img/team-3.jpg') }}" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square mx-1" style="color:rgba(24, 56, 32, 0.96);background-color:rgba(24, 56, 32, 0.50);" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square mx-1" style="color:rgba(24, 56, 32, 0.96);background-color:rgba(24, 56, 32, 0.50);" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square mx-1" style="color:rgba(24, 56, 32, 0.96);background-color:rgba(24, 56, 32, 0.50);" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Instructor Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center px-3" style="color:rgba(24, 56, 24, 0.7);">Testimonial</h6>
                <h1 class="mb-5">Our Students Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="{{ asset('img/testimonial-1.jpg') }}" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="{{ asset('img/testimonial-2.jpg') }}" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="{{ asset('img/testimonial-3.jpg') }}" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="border rounded-circle p-2 mx-auto mb-3" src="{{ asset('img/testimonial-4.jpg') }}" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
        

    <!-- Footer Start -->
    <div class="container-fluid text-light footer pt-5 mt-5 wow fadeIn" style="background-color:rgba(14, 31, 14, 0.98);" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a href="{{ route('about') }}" class="btn btn-link" href="">About Us</a>
                    <a href="{{ route('contact') }}" class="btn btn-link" href="">Contact Us</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('img/course-1.jpg') }}" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('img/course-2.jpg') }}" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('img/course-3.jpg') }}" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('img/course-2.jpg') }}" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('img/course-3.jpg') }}" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="{{ asset('img/course-1.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn py-2 position-absolute top-0 end-0 mt-2 me-2" style="background-color:rgba(24, 56, 24, 0.7);">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-lg-square back-to-top" style="background-color:rgba(24, 56, 24, 0.7);"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>