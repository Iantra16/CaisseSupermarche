### 📋 Travaux à faire 2 — Écran de choix de caisse (45 min)

#### **2.1. Écran d'accueil - Choix de caisse (20 min)**
- [ ] **Modèle** : Créer `app/Models/CaisseModel.php` avec une méthode `getAllCaisses()` pour récupérer la liste des caisses en base de données.
- [ ] **Contrôleur** : Créer `app/Controllers/CaisseController.php` avec une méthode `index()` qui charge les caisses et affiche la vue.
- [ ] **Vue** : Créer `app/Views/caisse/choix.php` contenant :
  - Une liste déroulante (`<select>`) affichant les caisses disponibles.
  - Un bouton de validation.
- [ ] **Route** : Déclarer la route GET dans `app/Config/Routes.php` :
  ```php
  $routes->get('/', 'CaisseController::index');
  ```

#### **2.2. Session - Afficher la caisse choisie (25 min)**
- [ ] **Traitement** : Ajouter la méthode `choisir()` dans `CaisseController` pour :
  - Récupérer l'ID de la caisse soumis en POST.
  - Enregistrer les informations de la caisse (ID, numéro, libellé) en session : `session()->set('caisse', $caisse)`.
  - Rediriger vers la page de saisie des achats.
- [ ] **Route** : Déclarer la route POST dans `app/Config/Routes.php` :
  ```php
  $routes->post('/caisse/choisir', 'CaisseController::choisir');
  ```
- [ ] **Affichage global** : Modifier le template de base (`app/Views/layout/base.php`) pour afficher dynamiquement la caisse active en haut de la page (au-dessus du menu) si elle existe en session.

---

### 📋 Travaux à faire 3 — Page de saisie des achats (105 min)

#### **3.1. Étape 1 : Formulaire de saisie - Partie haute (60 min)**
- [ ] **Modèle Produit** : Créer `app/Models/ProduitModel.php` pour lister tous les produits en stock.
- [ ] **Modèle Achat** : Créer `app/Models/AchatModel.php` pour :
  - Récupérer l'achat actif/en cours pour la caisse sélectionnée, ou en créer un nouveau s'il n'existe pas.
  - Ajouter une ligne d'achat (`achat_ligne`) liée à l'achat en cours.
- [ ] **Contrôleur** : Créer `app/Controllers/AchatController.php` avec :
  - `index()` : Affiche la page avec la liste des produits et les lignes d'achat actuelles.
  - `ajouterLigne()` : Traite le POST pour ajouter un produit (calcul du montant total de la ligne, mise à jour des stocks si nécessaire).
- [ ] **Vue** : Créer `app/Views/achat/index.php` avec le formulaire en haut :
  - Liste déroulante des produits.
  - Champ de saisie pour la quantité.
  - Bouton "Valider".
- [ ] **Routes** : Déclarer les routes dans `app/Config/Routes.php` :
  ```php
  $routes->get('/achat', 'AchatController::index');
  ```

#### **3.2. Étape 2 : Tableau des lignes - Partie basse (45 min)**
- [ ] **Requête Jointure** : Dans `AchatModel`, créer une méthode pour récupérer les lignes d'un achat avec une jointure (`JOIN`) sur la table `produit` afin d'avoir la désignation et le prix unitaire.
- [ ] **Affichage Tableau** : Dans `app/Views/achat/index.php`, afficher la liste des lignes d'achat en cours sous forme de tableau :
  | Produit | Prix Unitaire | Quantité | Montant |
  | :--- | :--- | :--- | :--- |
- [ ] **Total** : Calculer et afficher le montant total cumulé de l'achat en bas du tableau.
- [ ] **Route** : Déclarer la route POST pour l'ajout :
  ```php
  $routes->post('/achat/ajouter', 'AchatController::ajouterLigne');
  ```

---

### 📋 Travaux à faire 4 — Login + Clôture (Bonus)

#### **4.1. Écran de connexion (Login)**
- [ ] **Modèle** : Créer `app/Models/UtilisateurModel.php` pour authentifier les utilisateurs.
- [ ] **Contrôleur** : Créer `app/Controllers/AuthController.php` avec les méthodes `login()`, `doLogin()` et `logout()`.
- [ ] **Vue** : Créer `app/Views/auth/login.php` avec les champs Login et Mot de passe.
- [ ] **Sécurité** : Créer un filtre `app/Filters/AuthFilter.php` pour empêcher l'accès aux pages de choix de caisse et d'achats si l'utilisateur n'est pas connecté.
- [ ] **Routes** : Déclarer et protéger les routes d'authentification :
  ```php
  $routes->get('/login', 'AuthController::login');
  ```

#### **4.2. Bouton "Clôturer achat"**
- [ ] **Traitement** : Dans `AchatController`, ajouter une méthode `cloturer()` pour changer le statut de l'achat en cours en `'cloture'`.
- [ ] **Comportement** : S'assurer que lors de l'ajout du produit suivant, un nouvel achat (nouveau client) est automatiquement ouvert.
- [ ] **Bouton** : Placer le lien/bouton de clôture de manière visible dans `app/Views/achat/index.php`.
- [ ] **Route** : Déclarer la route de clôture :
  ```php
  $routes->get('/achat/cloturer', 'AchatController::cloturer');
  ```