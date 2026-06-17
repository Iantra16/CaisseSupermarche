<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Caisse Supermarché</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/favicon.ico') ?>" />
    <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet" />
</head>
<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light">
                🛒 Supermarché
                <?php if (session('caisse')): ?>
                    <br>
                    <small class="text-muted fs-6">
                        <?= esc(session('caisse')['libelle']) ?>
                    </small>
                <?php endif; ?>
            </div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= (current_url() == site_url('/')) ? 'active' : '' ?>"
                   href="<?= site_url('/') ?>">
                    🏠 Accueil
                </a>
                <?php if (session('caisse')): ?>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 <?= (current_url() == site_url('achat')) ? 'active' : '' ?>"
                   href="<?= site_url('achat') ?>">
                    🧾 Saisie des achats
                </a>
                <?php endif; ?>
                <?php if (session('utilisateur')): ?>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 text-danger"
                   href="<?= site_url('logout') ?>">
                    🚪 Déconnexion
                </a>
                <?php endif; ?>
            </div>
        </div>
        <!-- Fin Sidebar -->

        <!-- Contenu de la page -->
        <div id="page-content-wrapper">

            <!-- Barre de navigation top -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="sidebarToggle">☰ Menu</button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <?php if (session('caisse')): ?>
                            <li class="nav-item">
                                <span class="nav-link fw-bold text-success">
                                    🖥️ <?= esc(session('caisse')['numero']) ?> — <?= esc(session('caisse')['libelle']) ?>
                                </span>
                            </li>
                            <?php endif; ?>
                            <?php if (session('utilisateur')): ?>
                            <li class="nav-item">
                                <span class="nav-link text-muted">
                                    👤 <?= esc(session('utilisateur')['login']) ?>
                                </span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="<?= site_url('logout') ?>">Déconnexion</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Contenu principal de la page -->
            <div class="container-fluid p-4">

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>

            </div>
        </div>
        <!-- Fin contenu -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('js/scripts.js') ?>"></script>
</body>
</html>
