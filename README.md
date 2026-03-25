<div align="center">

<img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
<img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" />
<img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" />
<img src="https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white" />
<img src="https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white" />

<br/><br/>

# 🏙️ GestionHab

**Back-office d'administration pour la gestion des villes et de leurs habitants.**  
Construit avec Laravel 12, Bootstrap 5 et une interface moderne avec sidebar.

</div>



---

# Apperçu

GestionHab est un back-office d'administration permettant de gérer un registre de villes et leurs habitants. L'interface propose un tableau de bord avec statistiques, une gestion complète CRUD pour les villes et les habitants, ainsi qu'une recherche et filtrage en temps réel.

---


## ✨ Fonctionnalités

| Module | Détails |
|--------|---------|
| 📊 **Dashboard** | Statistiques globales : total villes, total habitants, derniers ajouts |
| 🏙️ **Villes** | CRUD complet — création, édition, suppression, comptage des habitants |
| 👤 **Habitants** | CRUD complet — CIN unique, photo de profil, rattachement à une ville |
| 🔍 **Recherche** | Filtrage par nom, prénom, CIN et par ville avec pagination |
| 🖼️ **Upload photo** | Stockage local des photos avec suppression automatique à la mise à jour |
| ✅ **Validation** | Règles de validation serveur sur tous les formulaires |
| 📱 **Responsive** | Interface adaptée mobile avec sidebar fixe (Bootstrap 5 + Bootstrap Icons) |

---

## 🗂️ Structure du projet

```
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php
│   │   ├── HabitantController.php
│   │   └── VilleController.php
│   └── Models/
│       ├── Habitant.php          # belongsTo Ville
│       └── Ville.php             # hasMany Habitants
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
└── resources/views/
    ├── layout.blade.php
    ├── dashboard.blade.php
    ├── habitants/                # index · create · edit · show
    └── villes/                   # index · create · edit
```

---

## 🗄️ Schéma de la base de données

```
┌─────────────────────────────────┐       ┌──────────────────────────────────────────┐
│             villes              │       │               habitants                  │
├─────────────────────────────────┤       ├──────────────────────────────────────────┤
│ id              INT (PK)        │◄──┐   │ id              INT (PK)                 │
│ ville           VARCHAR(100)    │   └───│ ville_id        INT (FK)                 │
│ nombreHabitant  INT             │       │ cin             VARCHAR(20) UNIQUE        │
│ created_at      TIMESTAMP       │       │ nom             VARCHAR(100)              │
│ updated_at      TIMESTAMP       │       │ prenom          VARCHAR(100)              │
└─────────────────────────────────┘       │ photo           VARCHAR nullable          │
                                          │ created_at      TIMESTAMP                │
                                          │ updated_at      TIMESTAMP                │
                                          └──────────────────────────────────────────┘
```

---

## ⚙️ Stack technique

| Couche | Technologie |
|--------|-------------|
| Backend | PHP 8.2 · Laravel 12 |
| Frontend | Bootstrap 5.3 · Bootstrap Icons 1.11 |
| Base de données | SQLite (défaut) · MySQL / MariaDB |
| Build | Vite |
| Tests | PHPUnit 11 |

---

## 🚀 Installation

### Prérequis

- PHP >= 8.2 avec extensions `pdo_sqlite` ou `pdo_mysql`
- Composer
- Node.js >= 18 & npm

### Démarrage rapide

```bash
# Cloner le dépôt
git clone https://github.com/votre-utilisateur/gestionhab.git
cd gestionhab

# Dépendances PHP
composer install

# Environnement
cp .env.example .env
php artisan key:generate

# Assets
npm install && npm run build

# Base de données
php artisan migrate --seed

# Lien de stockage pour les photos
php artisan storage:link

# Serveur local
php artisan serve
```

> 💡 **Raccourci** : `composer setup` enchaîne automatiquement les étapes install → .env → key → migrate → npm build.

L'application est disponible sur **[http://localhost:8000](http://localhost:8000)**

---

## 🛢️ Configuration base de données

Par défaut le projet tourne sur **SQLite** (aucune configuration requise).  
Pour basculer sur **MySQL**, modifiez `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestionhab
DB_USERNAME=root
DB_PASSWORD=
```

---

## 🧪 Tests

```bash
php artisan test
```

---

## 📁 Variables d'environnement clés

| Variable | Valeur par défaut | Description |
|----------|-------------------|-------------|
| `APP_NAME` | `Laravel` | Nom affiché dans l'interface |
| `APP_ENV` | `local` | Environnement (`local`, `production`) |
| `DB_CONNECTION` | `sqlite` | Driver base de données |
| `FILESYSTEM_DISK` | `local` | Disque de stockage des fichiers |
| `SESSION_DRIVER` | `database` | Driver de session |

---

