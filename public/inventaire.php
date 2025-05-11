<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IUT Inventaires - Accueil</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <style>
        body {
            font-family: sans-serif;
        }
        .category-card {
            transition: transform 0.2s ease-in-out;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .category-card:hover {
            transform: translateY(-4px);
        }
        .category-card .card-icon {
            width: 3rem;
            height: 3rem;
            color: #6c757d;
        }
        .footer a {
             text-decoration: none;
        }
        .navbar-brand img {
            max-height: 35px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light"> <header class="bg-white border-bottom"> <nav class="container navbar navbar-expand-lg navbar-light py-3"> <div class="container-fluid px-0">
                <a class="navbar-brand me-4" href="#">
                    <img src="https://elearning.univ-eiffel.fr/pluginfile.php/1/theme_boost_union/logo/0x200/1742812575/logo_univ_gustave_eiffel_rvb.png" alt="Logo IUT Placeholder" class="img-fluid">
                </a>
                <span class="navbar-text d-none d-lg-block">INVENTAIRES</span>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                            <a href="#" class="btn btn-outline-secondary btn-sm">
                                PROFIL
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1">
        <section class="bg-dark text-white py-5"> <div class="container text-center py-4">
                <h1 class="h2 mb-3">Gestion des inventaires de l'IUT</h1> <p class="lead mb-0">
                    Gérez facilement les salles, le matériel VR et les autres ressources de l'IUT.
                </p>
            </div>
        </section>

        <section class="py-5">
            <div class="container text-center">
                <a href="#" class="btn btn-primary btn-lg mb-5"> ACCÉDER AUX INVENTAIRES
                </a> <div class="row justify-content-center g-4">
                    <div class="col-12 col-sm-6 col-md-4">
                        <a href="#" class="card category-card h-100 border">
                            <div class="card-body text-center p-4">
                                 <svg class="card-icon mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H21"></path></svg>
                                <h3 class="card-title h5">Salles</h3> </div>
                        </a>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                         <a href="#" class="card category-card h-100 border border-primary"> <div class="card-body text-center p-4">
                                 <svg class="card-icon mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 11H7.5a1.5 1.5 0 00-1.5 1.5v3.5a1.5 1.5 0 001.5 1.5h1.5m6 0h1.5a1.5 1.5 0 001.5-1.5v-3.5a1.5 1.5 0 00-1.5-1.5H15M5 11V7a4 4 0 018 0v4m8 0V7a4 4 0 00-8 0v4M5 11a4 4 0 004 4h2a4 4 0 004-4M5 11a4 4 0 014-4h2a4 4 0 014 4"></path></svg>
                                <h3 class="card-title h5">Matériel VR</h3>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <a href="#" class="card category-card h-100 border">
                             <div class="card-body text-center p-4">
                                 <svg class="card-icon mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M3 7l9-4 9 4M3 7h18M9 21v-4m6 4v-4M9 12a1 1 0 11-2 0 1 1 0 012 0zm6 0a1 1 0 11-2 0 1 1 0 012 0zM5 7h14v4H5V7z"></path></svg>
                                <h3 class="card-title h5">Matériaux</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer bg-dark text-white-50 pt-5 pb-3 mt-auto"> <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-3">
                    <h4 class="h6 text-white mb-3">Qui sommes nous ?</h4> <p class="mb-2 small">Université Gustave Eiffel</p> <p class="small">Centre d'innovation Pédagogique et Numérique (CIPEN)</p>
                </div>
                <div class="col-12 col-md-2">
                    <h4 class="h6 text-white mb-3">Support</h4>
                    <ul class="list-unstyled small">
                        <li class="mb-1"><a href="#" class="link-light">FAQs</a></li> <li class="mb-1"><a href="#" class="link-light">Privacy</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-4 small">
                    <h4 class="h6 text-white mb-3">Restons en contact</h4>
                    <p class="mb-2">Vous pouvez nous contacter :</p>
                    <p class="mb-1">01 60 95 72 54</p>
                    <p class="mb-1">du lundi au vendredi de 9h à 17h ou par courriel :</p>
                    <p><a href="mailto:cipen@univ-eiffel.fr" class="link-light">cipen@univ-eiffel.fr</a></p>
                </div>
                <div class="col-12 col-md-3">
                    <h4 class="h6 text-white mb-3">Suivez nous</h4>
                    <div class="d-flex">
                        <a href="#" aria-label="Facebook" class="social-icon me-3 link-light">
                            <svg fill="currentColor" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
                        </a>
                        <a href="#" aria-label="Twitter" class="social-icon me-3 link-light">
                             <svg fill="currentColor" viewBox="0 0 16 16"><path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .79 13.58a6.32 6.32 0 0 1-.79-.045A9.344 9.344 0 0 0 5.026 15z"/></svg>
                        </a>
                        <a href="#" aria-label="Instagram" class="social-icon me-3 link-light">
                             <svg fill="currentColor" viewBox="0 0 16 16"><path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.85.175 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.85-.04 1.433-.175 1.942-.372.525-.205.972-.478 1.416-.923.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.85-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.231s.008-2.389.046-3.232c.035-.78.166-1.204.275-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.843-.038 1.096-.047 3.232-.047h.001zm4.905 1.72c-.78 0-1.418.636-1.418 1.414s.637 1.414 1.418 1.414 1.418-.636 1.418-1.414-.637-1.414-1.418-1.414zm-3.005 1.562a3.76 3.76 0 1 1-7.52 0 3.76 3.76 0 0 1 7.52 0z"/></svg>
                        </a>
                        <a href="#" aria-label="LinkedIn" class="social-icon me-3 link-light">
                            <svg fill="currentColor" viewBox="0 0 16 16"><path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/></svg>
                        </a>
                        <a href="#" aria-label="YouTube" class="social-icon link-light">
                             <svg fill="currentColor" viewBox="0 0 16 16"><path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.022.26-.01.104c-.048.519-.119-1.023-.22-1.402a2.007 2.007 0 0 1-1.415-1.42c-1.16.312-5.569.334-6.18.335h-.054c-.822-.003-4.987-.033-6.11-.335a2.007 2.007 0 0 1-1.415-1.42c-.1-.38-.172-.883-.22-1.402l-.01-.104-.022-.26-.008-.104c-.065-.914-.073-1.77-.074-1.957v-.075c.001-.194.01-1.108.082-2.06l.008-.105.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c1.16-.312 5.569-.334 6.18-.335h.054l.089-.001zm3.595 6.176L8.257 9.81l-3.405-1.634 3.405-1.634 3.405 1.634z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="text-center text-secondary small mt-4 pt-4 border-top border-secondary border-opacity-25">
                &copy; 2025 IUT Marne-la-Vallée - Université Gustave Eiffel. Tous droits réservés.
            </div>
        </div>
    </footer>

</body>
</html>