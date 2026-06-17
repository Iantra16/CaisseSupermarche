<?= $this->extend('layout/model') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">🖥️ Choisir une Caisse</h5>
            </div>
            <div class="card-body p-4">

                <form action="<?= site_url('caisse/choisir') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label for="caisse_id" class="form-label fw-bold">Caisse</label>
                        <select class="form-select form-select-lg" name="caisse_id" id="caisse_id" required>
                            <option value="" disabled selected>— Sélectionnez une caisse —</option>
                            <?php foreach ($caisses as $caisse): ?>
                                <option value="<?= $caisse['id'] ?>">
                                    <?= esc($caisse['numero']) ?> — <?= esc($caisse['libelle']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Valider
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
