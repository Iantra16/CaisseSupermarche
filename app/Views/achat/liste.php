<?= $this->extend('layout/model') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">🧾 Historique des Achats</h4>
    <span class="badge bg-secondary fs-6"><?= count($achats) ?> achat(s)</span>
</div>

<!-- Filtres par statut -->
<div class="mb-3 d-flex gap-2 flex-wrap">
    <a href="<?= site_url('achats') ?>" class="btn btn-sm <?= !$filtre ? 'btn-dark' : 'btn-outline-dark' ?>">Tous</a>
    <a href="<?= site_url('achats?statut=en_cours') ?>" class="btn btn-sm <?= $filtre === 'en_cours' ? 'btn-info' : 'btn-outline-info' ?>">🟡 En cours</a>
    <a href="<?= site_url('achats?statut=cloture') ?>" class="btn btn-sm <?= $filtre === 'cloture' ? 'btn-success' : 'btn-outline-success' ?>">✅ Clôturés</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <?php if (empty($achats)): ?>
            <div class="text-center text-muted py-5">
                <p class="mb-0">Aucun achat trouvé.</p>
            </div>
        <?php else: ?>
            <table class="table table-bordered table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Caisse</th>
                        <th class="text-center">Nb lignes</th>
                        <th class="text-end">Total (Ar)</th>
                        <th class="text-center">Statut</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($achats as $achat): ?>
                        <tr>
                            <td class="text-muted small"><?= $achat['id'] ?></td>
                            <td><?= esc($achat['caisse_libelle'] ?? '—') ?></td>
                            <td class="text-center"><?= $achat['nb_lignes'] ?></td>
                            <td class="text-end fw-bold"><?= number_format($achat['total'], 0, ',', ' ') ?></td>
                            <td class="text-center">
                                <?php if ($achat['statut'] === 'en_cours'): ?>
                                    <span class="badge bg-warning text-dark">🟡 En cours</span>
                                <?php else: ?>
                                    <span class="badge bg-success">✅ Clôturé</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center text-muted small">
                                <?= $achat['date_achat'] ?? '—' ?>
                            </td>
                            <td class="text-center">
                                <?php if ($achat['statut'] === 'en_cours'): ?>
                                    <a href="<?= site_url('achat/cloturer?id=' . $achat['id']) ?>"
                                       class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('Clôturer cet achat ?')">
                                        🔒 Clôturer
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small">—</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
