<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeIgniter Teste de moi meme</title>
</head>

<body>
    <h1>Liste des Étudiants</h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ETU</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Date Naissance</th>
                <th>Promotion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $etudiant): ?>
                <tr>
                    <td>ETU00<?= $etudiant['etu'] ?></td>
                    <td><?= esc($etudiant['nom']) ?></td>
                    <td><?= esc($etudiant['prenom']) ?></td>
                    <td><?= esc($etudiant['email']) ?></td>
                    <td><?= $etudiant['dateNaissance'] ?></td>
                    <td><?= esc($etudiant['promotion']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>