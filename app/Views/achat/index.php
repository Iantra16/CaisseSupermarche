<?= $this->extend('layout/model') ?>

<?= $this->section('content') ?>

<h4 class="mb-4">Saisie des Achats</h4>

<!-- Formulaire ajout produit -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-light fw-bold">
        Ajouter un produit
    </div>
    <div class="card-body">
        <form action="<?= site_url('achat/ajouter') ?>" method="post">
            <?= csrf_field() ?>

            <div class="row g-3 align-items-end">

                <div class="col-md-6">
                    <label for="produit_id" class="form-label fw-bold">Produit</label>
                    <select class="form-select" name="produit_id" id="produit_id" required>
                        <option value="" disabled selected>— Choisir un produit —</option>
                        <?php foreach ($produits as $produit): ?>
                            <option value="<?= $produit['id'] ?>" data-prix="<?= $produit['prix'] ?>">
                                <?= esc($produit['designation']) ?> — <?= number_format($produit['prix'], 0, ',', ' ') ?> Ar (stock: <?= $produit['quantite_stock'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="quantite" class="form-label fw-bold">Quantité</label>
                    <input
                        type="number"
                        class="form-control"
                        name="quantite"
                        id="quantite"
                        min="1"
                        value="1"
                        required
                    />
                </div>

                <div class="col-md-3">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">
                            Valider
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- Tableau des lignes d'achat -->
<div class="card shadow-sm">
    <div class="card-header bg-light fw-bold d-flex justify-content-between align-items-center">
        <span>Récapitulatif de l'achat</span>
        <?php if (!empty($lignes)): ?>
            <a href="<?= site_url('achat/cloturer') ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('Confirmer la clôture de cet achat ?')">
                Cloturer l'achat
            </a>
        <?php endif; ?>
    </div>
    <div class="card-body p-0">

        <?php if (empty($lignes)): ?>
            <div class="text-center text-muted py-5">
                <p class="mb-0">Aucun produit ajouté pour l'instant.</p>
            </div>
        <?php else: ?>
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Produit</th>
                        <th class="text-end">Prix Unit. (Ar)</th>
                        <th class="text-center">Qté</th>
                        <th class="text-end">Montant (Ar)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lignes as $ligne): ?>
                        <tr>
                            <td><?= esc($ligne['designation']) ?></td>
                            <td class="text-end"><?= number_format($ligne['prix_unitaire'], 0, ',', ' ') ?></td>
                            <td class="text-center"><?= $ligne['quantite'] ?></td>
                            <td class="text-end"><?= number_format($ligne['montant'], 0, ',', ' ') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="table-success fw-bold">
                        <td colspan="3" class="text-end">TOTAL</td>
                        <td class="text-end">
                            <?= number_format(array_sum(array_column($lignes, 'montant')), 0, ',', ' ') ?> Ar
                        </td>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>
