<?= $this->extend('layout/model') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Gestion des Produits</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAjouter">
        Nouveau Produit
    </button>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <?php if (empty($produits)): ?>
            <div class="text-center text-muted py-5">
                <p class="mb-0">Aucun produit enregistré.</p>
            </div>
        <?php else: ?>
            <table class="table table-bordered table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Désignation</th>
                        <th class="text-end">Prix (Ar)</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $p): ?>
                        <tr>
                            <td class="text-muted small"><?= $p['id'] ?></td>
                            <td class="fw-semibold"><?= esc($p['designation']) ?></td>
                            <td class="text-end"><?= number_format($p['prix'], 0, ',', ' ') ?></td>
                            <td class="text-center">
                                <?php if ($p['quantite_stock'] <= 5): ?>
                                    <span class="badge bg-danger"><?= $p['quantite_stock'] ?></span>
                                <?php elseif ($p['quantite_stock'] <= 20): ?>
                                    <span class="badge bg-warning text-dark"><?= $p['quantite_stock'] ?></span>
                                <?php else: ?>
                                    <span class="badge bg-success"><?= $p['quantite_stock'] ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalModifier"
                                        data-id="<?= $p['id'] ?>"
                                        data-designation="<?= esc($p['designation']) ?>"
                                        data-prix="<?= $p['prix'] ?>"
                                        data-stock="<?= $p['quantite_stock'] ?>">
                                    Modifier
                                </button>
                                <a href="<?= site_url('produits/supprimer/' . $p['id']) ?>"
                                   class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Supprimer ce produit ?')">
                                    Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<!-- Modal : Ajouter -->
<div class="modal fade" id="modalAjouter" tabindex="-1" aria-labelledby="modalAjouterLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= site_url('produits/creer') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalAjouterLabel">Ajouter un produit</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Désignation</label>
                        <input type="text" name="designation" class="form-control" required placeholder="Ex: Riz 5kg" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Prix unitaire (Ar)</label>
                        <input type="number" name="prix" class="form-control" required min="0" step="0.01" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Quantité en stock</label>
                        <input type="number" name="quantite_stock" class="form-control" required min="0" value="0" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal : Modifier -->
<div class="modal fade" id="modalModifier" tabindex="-1" aria-labelledby="modalModifierLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formModifier" action="" method="post">
                <?= csrf_field() ?>
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="modalModifierLabel">Modifier le produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Désignation</label>
                        <input type="text" name="designation" id="edit_designation" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Prix unitaire (Ar)</label>
                        <input type="number" name="prix" id="edit_prix" class="form-control" required min="0" step="0.01" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Quantité en stock</label>
                        <input type="number" name="quantite_stock" id="edit_stock" class="form-control" required min="0" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-warning">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('modalModifier').addEventListener('show.bs.modal', function (event) {
    const btn = event.relatedTarget;
    const id  = btn.getAttribute('data-id');
    document.getElementById('formModifier').action = '<?= site_url('produits/modifier/') ?>' + id;
    document.getElementById('edit_designation').value = btn.getAttribute('data-designation');
    document.getElementById('edit_prix').value         = btn.getAttribute('data-prix');
    document.getElementById('edit_stock').value        = btn.getAttribute('data-stock');
});
</script>

<?= $this->endSection() ?>
