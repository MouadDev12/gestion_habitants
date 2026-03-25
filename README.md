# GestionHab

Application web de gestion des habitants et des villes, construite avec **Laravel 12** et **Bootstrap 5**.

---

## Aperçu

GestionHab est un back-office d'administration permettant de gérer un registre de villes et leurs habitants. L'interface propose un tableau de bord avec statistiques, une gestion complète CRUD pour les villes et les habitants, ainsi qu'une recherche et filtrage en temps réel.

---

## Fonctionnalités

- Tableau de bord avec statistiques (nombre de villes, habitants, derniers ajouts)
- Gestion des **villes** : création, modification, suppression, comptage des habitants
- Gestion des **habitants** : création, modification, suppression, upload de photo
- Recherche par nom, prénom ou CIN
- Filtrage des habitants par ville
- Pagination
- Validation des formulaires côté serveur
- Interface responsive avec sidebar fixe (Bootstrap 5 + Bootstrap Icons)

---

## Stack technique

| Couche       | Technologie              |
|--------------|--------------------------|
| Backend      | PHP 8.2 / Laravel 12     |
| Frontend     | Bootstrap 5.3 + Bootstrap Icons |
| Base de données | SQLite (par défaut) / MySQL |
| Build assets | Vite                     |
| Tests        | PHPUnit 11               |

---

## Prérequis

- PHP >= 8.2
- Composer
- Node.js >= 18 & npm
- SQLite (inclus avec PHP) ou MySQL/MariaDB

---

## Installation

```bash
# 1. Cloner le dépôt
git clone https://github.com/votre-utilisateur/gestionhab.git
cd gestionhab

# 2. Installer les dépendances PHP
composer install

# 3. Copier le fichier d'environnement
cp .env.example .env

# 4. Générer la clé d'application
php artisan key:generate

# 5. Installer les dépendances JS et compiler les assets
npm install && npm run build

# 6. Lancer les migrations et les seeders
php artisan migrate --seed

# 7. Créer le lien symbolique pour le stockage des photos
php artisan storage:link

# 8. Démarrer le serveur de développement
php artisan serve
```

L'application est accessible sur [http://localhost:8000](http://localhost:8000).

> Astuce : vous pouvez aussi utiliser le script `composer setup` qui enchaîne les étapes 2 à 6 automatiquement.

---

## Configuration de la base de données

Par défaut, le projet utilise **SQLite**. Pour utiliser MySQL, modifiez `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestionhab
DB_USERNAME=root
DB_PASSWORD=
```

---

## Structure du projet

```
app/
├── Http/Controllers/
│   ├── DashboardController.php
│   ├── HabitantController.php
│   └── VilleController.php
├── Models/
│   ├── Habitant.php
│   └── Ville.php
database/
├── migrations/
├── seeders/
└── factories/
resources/views/
├── layout.blade.php
├── dashboard.blade.php
├── habitants/        # index, create, edit, show
└── villes/           # index, create, edit
```

---

## Schéma de la base de données

```
villes
  id, ville, nombreHabitant, created_at, updated_at

habitants
  id, cin (unique), nom, prenom, photo (nullable), ville_id (FK), created_at, updated_at
```

---

## Lancer les tests

```bash
php artisan test
```

---

## Licence

Ce projet est sous licence [MIT](LICENSE).
