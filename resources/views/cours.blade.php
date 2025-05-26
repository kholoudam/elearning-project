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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-outline-custom {
            border: 2px solid rgba(24, 56, 24, 0.7);
            color: rgba(24, 56, 24, 0.7);
            background-color: transparent;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-custom:hover,
        .btn-outline-custom.active {
            background-color: rgba(24, 56, 24, 0.1);
            color: rgba(24, 56, 24, 1);
            border-color: rgba(24, 56, 24, 1);
        }
    </style>
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
                <a href="{{ route('index') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }} ">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link custom-hover{{ request()->is('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('courses.index') }}" class="nav-item nav-link custom-hover{{ request()->is('courses') ? 'active' : '' }}" style="color: rgba(24, 56, 24, 0.7);">Courses</a>
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

    <div class="container">
        <h1>{{ $cours->titre }}</h1>
        <p>{{ $cours->description }}</p>

        @if($contenu && $contenu->type === 'video')
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ $contenu->lien }}" allowfullscreen></iframe>
            </div>
        @endif

@auth
    @if($question)
        <form action="{{ route('cours.quiz', $cours->id) }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="question_id" value="{{ $question->id }}">
            <h4>{{ $question->texte }}</h4>
            @foreach(['option1', 'option2', 'option3', 'option4'] as $option)
                @if(!empty($question->$option))
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="reponse" value="{{ $question->$option }}" required>
                        <label class="form-check-label">{{ $question->$option }}</label>
                    </div>
                @endif
            @endforeach
            <button class="btn btn-primary mt-2" type="submit">Soumettre</button>
        </form>
    @endif
@else
    <div class="alert alert-warning">
        Veuillez vous <a href="{{ route('login.show') }}">connecter</a> pour accéder au quiz.
    </div>
@endauth


        @if(session('success'))
            <div class="alert alert-success mt-4">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger mt-4">{{ session('error') }}</div>
        @endif
    </div>
    
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