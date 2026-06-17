<?= $this->extend('layout/model') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Connexion</h5>
            </div>
            <div class="card-body p-4">

                <?php if (session()->getFlashdata('erreur')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('erreur') ?></div>
                <?php endif; ?>

                <form method="post" action="<?= site_url('login') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Login</label>
                        <input type="text" name="login" class="form-control" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Mot de passe</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
