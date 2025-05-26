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
                            <a class="nav-link" href="{{ route('admin.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            {{-- Menu cours --}}
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCours" aria-expanded="false" aria-controls="collapseCours">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Cours
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCours" aria-labelledby="headingCours" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('coursa.index') }}">Liste des cours</a>
                                    <a class="nav-link" href="{{ route('coursa.create') }}">Ajouter un cours</a>
                                </nav>
                            </div>
                            {{-- Menu utilisateurs --}}
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUtilisateurs" aria-expanded="false" aria-controls="collapseUtilisateurs">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Utilisateurs
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseUtilisateurs" aria-labelledby="headingUtilisateurs" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('utilisateurs.index') }}">Liste des utilisateurs</a>
                                    <a class="nav-link" href="{{ route('utilisateurs.create') }}">Ajouter un utilisateur</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Cours</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Liste des cours</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="d-flex m-2 justify-content-start">
                                <a href="{{ route('coursa.create') }}" class="btn btn-primary d-flex align-items-center gap-2 px-3"
                                style="background-color: #00811e; height: 40px; box-shadow: rgba(0, 129, 30, 0.16) 0px 10px 36px 0px, rgba(0, 129, 30, 0.06) 0px 0px 0px 1px;">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0,0,300,150">
                                        <g fill="#ffffff" fill-rule="nonzero" stroke="none">
                                            <g transform="scale(4,4)">
                                                <path d="M32,6c-14.359,0 -26,11.641 -26,26c0,14.359 11.641,26 26,26c14.359,0 26,-11.641 26,-26c0,-14.359 -11.641,-26 -26,-26zM49,34l-14,1l-1,14h-4l-1,-14l-14,-1v-4l14,-1l1,-14h4l1,14l14,1z"></path>
                                            </g>
                                        </g>
                                    </svg>

                                    <em class="mb-0">Ajouter</em>
                                </a>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 25%;">Titre</th>
                                            <th scope="col" style="width: 40%;">Description</th>
                                            <th scope="col" style="width: 20%;">Difficulté</th>
                                            <th scope="col"style="width: 25%;">Opération</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cours as $index => $c)
                                            <tr>
                                                <td>{{ $c->titre }}</td>
                                                <td>{{ $c->description }}</td>
                                                <td>{{ $c->difficulte }}</td>
                                                <td>
                                                    <a href="{{ route('coursa.show', $c->id) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('coursa.edit', $c->id) }}" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('coursa.destroy', $c->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Pagination -->
                                <nav aria-label="Page navigation example">
                                    {{ $cours->links('pagination::bootstrap-5') }}
                                </nav>
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