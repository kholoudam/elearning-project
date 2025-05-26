<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="{{ asset('img/logo.png') }}" rel="icon">
        <title>E-LEARNING</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand" style="background-color: rgba(24, 56, 24, 0.7); color: #fff;">
            <!-- Navbar Brand-->
            <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
                <img class="img-fluid" src="{{ asset('img/logo.png') }}" style="width:50px;height:50px;" alt="">
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-dark btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-dark" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Afficher Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Modifier Profile</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form method="POST" action="{{ route('logout.perform') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger" style="background-color: #dc3545; border: none;">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ route('enseignants.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                cours
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('cours.index') }}">Liste des cours</a>
                                    <a class="nav-link" href="{{ route('cours.create') }}">Ajouter un cours</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container">
                        <div class="row">
                            {{-- Sidebar avec la liste des cours --}}
                            <div class="col-md-3">
                                <h4>Liste des cours</h4>
                                <ul class="list-group">
                                    @foreach($coursList as $cour)
                                        <li class="list-group-item">
                                            <a href="{{ route('cours.edit', $cour->id) }}">
                                                {{ $cour->titre }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            {{-- Formulaire d'édition --}}
                            <div class="col-md-9">
                                <h3>Modifier le cours : {{ $cours->titre }}</h3>

                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('cours.update', $cours->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="titre" class="form-label">Titre du cours</label>
                                        <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre', $cours->titre) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $cours->description) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="difficulte" class="form-label">Difficulté</label>
                                        <select class="form-control" id="difficulte" name="difficulte" required>
                                            <option value="débutant" {{ old('difficulte', $cours->difficulte) == 'débutant' ? 'selected' : '' }}>Débutant</option>
                                            <option value="intermédiaire" {{ old('difficulte', $cours->difficulte) == 'intermédiaire' ? 'selected' : '' }}>Intermédiaire</option>
                                            <option value="avancé" {{ old('difficulte', $cours->difficulte) == 'avancé' ? 'selected' : '' }}>Avancé</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="categorie" class="form-label">Catégorie (facultatif)</label>
                                        <input type="text" class="form-control" id="categorie" name="categorie" value="{{ old('categorie', $cours->categorie) }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    </body>
</html>