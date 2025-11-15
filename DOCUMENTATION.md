# Documentation Complète - Système Immobilier Multilingue Laravel

## 📋 Table des Matières
1. [Vue d'ensemble](#vue-densemble)
2. [Architecture](#architecture)
3. [Modules et Plugins](#modules-et-plugins)
4. [Base de Données](#base-de-données)
5. [Modèles (Models)](#modèles-models)
6. [Contrôleurs (Controllers)](#contrôleurs-controllers)
7. [Requêtes (Requests)](#requêtes-requests)
8. [Migrations](#migrations)
9. [Repositories et Interfaces](#repositories-et-interfaces)
10. [Services et Supports](#services-et-supports)
11. [Frontend et Thème](#frontend-et-thème)
12. [Configuration](#configuration)
13. [Authentification](#authentification)
14. [Fonctionnalités Principales](#fonctionnalités-principales)

---

## Vue d'Ensemble

### Informations du Projet
- **Nom**: Essentiel-Immo-Tamatave
- **Type**: Plateforme Immobilière Multilingue
- **Framework**: Laravel 8.12+
- **PHP**: 7.3+ / 8.0+
- **Base de Données**: MySQL/MariaDB
- **Frontend**: Vue.js 3, Bootstrap 4, Tailwind CSS
- **Architecture**: Plugin-based CMS (Botble CMS)

### Stack Technologique

**Backend**:
- Laravel Framework 8.12+
- Laravel Passport (API Authentication)
- Laravel Sanctum (Token-based Authentication)
- Doctrine DBAL 3.0 (Database abstraction)
- Guzzle HTTP 7.0+
- Google API Client Services

**Frontend**:
- Vue.js 3.5+
- Bootstrap 4.6
- Tailwind CSS 3.4
- Laravel Mix (Webpack)
- jQuery 3.5
- Sass/SCSS

**Plugins CMS Botble**:
- API Management
- Menu Management
- Page Management
- Platform Core
- Plugin Management
- Shortcode
- Theme Management

**Dépendances Additionnelles**:
- Laravel DebugBar (Développement)
- Laravel IDE Helper (Développement)
- FakerPHP (Tests/Seeding)
- PHPUnit (Tests)

---

## Architecture

### Structure Générale du Projet

```
Laravel Real Estate Multilingual System/
├── app/                          # Application principale
│   ├── Http/
│   │   ├── Controllers/         # Contrôleurs de l'app principale
│   │   ├── Middleware/          # Middlewares personnalisés
│   │   └── Kernel.php
│   ├── Models/                  # Modèles Eloquent
│   │   └── User.php            # Modèle utilisateur Laravel
│   ├── Console/                 # Commandes Artisan
│   ├── Exceptions/              # Gestion des exceptions
│   └── Providers/               # Service Providers
├── platform/                     # Cœur de la plateforme (Botble CMS)
│   ├── core/                    # Modules core du CMS
│   │   ├── acl/                # Access Control List
│   │   ├── base/               # Base module
│   │   ├── chart/              # Charts
│   │   ├── dashboard/          # Dashboard admin
│   │   ├── js-validation/      # Validation JavaScript
│   │   ├── media/              # Gestion des médias
│   │   ├── setting/            # Paramètres globaux
│   │   ├── support/            # Support/Aide
│   │   └── table/              # Gestion des tables
│   ├── plugins/                 # Plugins spécifiques
│   │   ├── real-estate/        # Plugin principal (Immobilier)
│   │   ├── blog/               # Blog
│   │   ├── contact/            # Formulaire de contact
│   │   ├── payment/            # Paiements
│   │   ├── social-login/       # Login social
│   │   ├── analytics/          # Analytics
│   │   ├── testimonial/        # Témoignages
│   │   └── [17 autres plugins]
│   └── themes/                  # Thèmes frontend
│       └── resido/             # Thème principal
├── database/
│   ├── migrations/             # Migrations de base de données
│   ├── seeders/                # Seeding
│   └── factories/              # Factories de test
├── resources/
│   ├── views/                  # Vues Blade
│   ├── css/                    # Styles CSS
│   └── lang/                   # Fichiers de traduction
├── routes/
│   ├── web.php                # Routes web
│   ├── api.php                # Routes API
│   ├── console.php            # Routes console
│   └── channels.php           # Broadcast channels
├── config/                     # Fichiers de configuration
├── public/                     # Fichiers publics
├── storage/                    # Fichiers de stockage
├── tests/                      # Tests unitaires
└── vendor/                     # Dépendances Composer
```

### Pattern d'Architecture

Le projet utilise un pattern **Repository + Service**:

```
Controller
    ↓
Request (Validation)
    ↓
Service (Business Logic)
    ↓
Repository (Interface)
    ↓
Repository (Eloquent Implementation)
    ↓
Cache Decorator (Optional)
    ↓
Model (Eloquent)
    ↓
Database
```

---

## Modules et Plugins

### Plugins Principaux Actifs

#### 1. **Real Estate Plugin** ⭐ (Plugin Principal)
- **Namespace**: `Botble\RealEstate\`
- **Description**: Gestion complète des propriétés immobilières
- **Version**: 1.0
- **Auteur**: Botble Technologies

**Sous-modules**:
- Gestion des propriétés
- Gestion des comptes/agents immobiliers
- Gestion des catégories
- Gestion des types de propriétés
- Gestion des devises
- Gestion des facilities/commodités
- Gestion des features/caractéristiques
- Gestion des packages/forfaits
- Gestion des consultations/demandes
- Gestion des avis/reviews
- Gestion des transactions
- Logs d'activités des comptes

#### 2. **Blog Plugin**
- Gestion d'articles de blog
- Catégories d'articles
- Commentaires

#### 3. **Contact Plugin**
- Formulaires de contact
- Gestion des messages de contact

#### 4. **Payment Plugins**
- **Payment**: Passerelle de paiement générique
- **Paystack**: Intégration Paystack
- **Razorpay**: Intégration Razorpay
- **SSL Commerz**: Intégration SSL Commerz

#### 5. **Location Plugin**
- Gestion des villes
- Gestion des états/régions

#### 6. **Language Plugin**
- Support multilingue
- Gestion des langues

#### 7. **Translation Plugin**
- Traductions dynamiques
- Localisation du contenu

#### 8. **Social Login Plugin**
- Authentification via réseaux sociaux

#### 9. **Analytics Plugin**
- Suivi Google Analytics
- Statistiques du site

#### 10. **Autres Plugins**
- **Testimonial**: Gestion des témoignages
- **RSS Feed**: Génération de flux RSS
- **Cookie Consent**: Gestion du consentement cookies
- **Captcha**: Protection CAPTCHA
- **Block**: Gestion des blocs de contenu
- **Audit Log**: Journalisation des actions
- **Backup**: Sauvegarde de la base de données

### Modules Core

#### ACL (Access Control List)
- Gestion des rôles et permissions
- Contrôle d'accès basé sur les rôles (RBAC)

#### Base Module
- Modèles de base
- Traits réutilisables
- Helpers génériques

#### Dashboard
- Tableau de bord administrateur
- Statistiques

#### Media
- Gestion des fichiers et images
- Upload/Download

#### Setting
- Paramètres globaux du système
- Configurations dynamiques

---

## Base de Données

### Tables Principales (Real Estate Plugin)

#### 1. **re_properties**
Stockage des propriétés immobilières
- `id`: Identifiant unique
- `name`: Nom de la propriété
- `description`: Description courte
- `content`: Contenu détaillé (HTML)
- `location`: Localisation textuelle
- `images`: Images (JSON array)
- `number_bedroom`: Nombre de chambres
- `number_bathroom`: Nombre de salles de bain
- `number_floor`: Nombre d'étages
- `square`: Surface (m²)
- `price`: Prix
- `currency_id`: Devise (FK)
- `city_id`: Ville (FK)
- `period`: Période de prix (buy/day/month/year)
- `author_id`: ID de l'auteur
- `author_type`: Type d'auteur (morphable)
- `category_id`: Catégorie (FK)
- `is_featured`: Propriété en vedette
- `moderation_status`: État (pending/approved/rejected)
- `expire_date`: Date d'expiration
- `auto_renew`: Renouvellement automatique
- `never_expired`: N'expire jamais
- `latitude/longitude`: Coordonnées GPS
- `type_id`: Type de propriété (FK)
- `created_at/updated_at`: Timestamps

#### 2. **re_property_types**
Types de propriétés (Apartment, House, Land, etc.)
- `id`: Identifiant
- `name`: Nom du type
- `slug`: Slug URL
- `order`: Ordre d'affichage

#### 3. **re_categories**
Catégories de propriétés (Vente/Location)
- `id`: Identifiant
- `name`: Nom
- `description`: Description
- `status`: Statut (published/draft)
- `order`: Ordre
- `is_default`: Catégorie par défaut
- `created_at/updated_at`: Timestamps

#### 4. **re_accounts**
Comptes d'agents/propriétaires immobiliers
- `id`: Identifiant
- `first_name/last_name`: Noms
- `username`: Identifiant unique
- `email`: Email unique
- `password`: Mot de passe hashé
- `avatar_id`: Avatar (FK Media)
- `description`: Bio/Description
- `gender`: Genre
- `dob`: Date de naissance
- `phone`: Téléphone
- `credits`: Crédits disponibles
- `confirmed_at`: Confirmation email
- `email_verify_token`: Token de vérification
- `is_featured`: Agent en vedette
- `remember_token`: Token Laravel
- `created_at/updated_at`: Timestamps

#### 5. **re_features**
Caractéristiques des propriétés (Swimming pool, Garage, etc.)
- `id`: Identifiant
- `name`: Nom
- `icon`: Icône CSS/SVG
- `status`: Statut

#### 6. **re_property_features**
Relation Many-to-Many: Propriétés ↔ Caractéristiques
- `property_id`: FK vers re_properties
- `feature_id`: FK vers re_features

#### 7. **re_facilities**
Commodités/Installations (School, Hospital, Park, etc.)
- `id`: Identifiant
- `name`: Nom
- `icon`: Icône
- `status`: Statut (published/draft)
- `created_at/updated_at`: Timestamps

#### 8. **re_facilities_distances**
Distances des installations par rapport aux propriétés (Polymorphic)
- `id`: Identifiant
- `facility_id`: FK vers re_facilities
- `reference_id`: ID de la ressource
- `reference_type`: Type de ressource (polymorphic)
- `distance`: Distance (texte)

#### 9. **re_currencies**
Devises disponibles
- `id`: Identifiant
- `title`: Nom de la devise
- `symbol`: Symbole (€, $, etc.)
- `is_prefix_symbol`: Symbole avant/après
- `decimals`: Décimales
- `order`: Ordre
- `is_default`: Devise par défaut
- `exchange_rate`: Taux de change
- `created_at/updated_at`: Timestamps

#### 10. **re_packages**
Forfaits/Plans pour agents
- `id`: Identifiant
- `name`: Nom du forfait
- `price`: Prix
- `currency_id`: Devise (FK)
- `percent_save`: % d'économie
- `number_of_listings`: Nombre d'annonces incluses
- `account_limit`: Limite de comptes
- `order`: Ordre
- `is_default`: Forfait par défaut
- `features`: Fonctionnalités (JSON)
- `status`: Statut

#### 11. **re_accounts_packages**
Relation Many-to-Many: Comptes ↔ Forfaits
- `id`: Identifiant
- `account_id`: FK vers re_accounts
- `package_id`: FK vers re_packages
- `created_at/updated_at`: Timestamps

#### 12. **re_consults**
Demandes de consultation/informations
- `id`: Identifiant
- `name`: Nom du demandeur
- `email`: Email
- `phone`: Téléphone
- `property_id`: Propriété demandée (FK)
- `content`: Message
- `status`: Statut (unread/read)
- `created_at/updated_at`: Timestamps

#### 13. **re_reviews**
Avis/Évaluations (Polymorphic)
- `id`: Identifiant
- `account_id`: Auteur de l'avis (FK)
- `reviewable_id`: ID de la ressource
- `reviewable_type`: Type de ressource
- `star`: Note (1-5)
- `comment`: Commentaire
- `status`: Statut (published/draft)
- `created_at/updated_at`: Timestamps

#### 14. **re_reviews_meta**
Métadonnées des avis
- `id`: Identifiant
- `key`: Clé
- `value`: Valeur
- `review_id`: FK vers re_reviews

#### 15. **re_transactions**
Transactions de crédits
- `id`: Identifiant
- `credits`: Nombre de crédits
- `description`: Description
- `user_id`: Utilisateur admin (FK)
- `account_id`: Compte agent (FK)
- `type`: Type (add/subtract)
- `payment_id`: Paiement associé (FK)
- `created_at/updated_at`: Timestamps

#### 16. **re_account_activity_logs**
Logs d'activité des comptes
- `id`: Identifiant
- `action`: Action effectuée
- `user_agent`: User Agent du navigateur
- `reference_url`: URL de référence
- `reference_name`: Nom de référence
- `ip_address`: Adresse IP
- `account_id`: Compte concerné (FK)
- `created_at/updated_at`: Timestamps

#### 17. **re_account_password_resets**
Tokens de réinitialisation de mot de passe
- `email`: Email
- `token`: Token
- `created_at`: Timestamp

### Autres Tables (Laravel)

#### users
Table utilisateurs Laravel pour l'administration

#### password_resets
Tokens de réinitialisation de mot de passe

#### jobs
Queue jobs

#### failed_jobs
Jobs échoués

---

## Modèles (Models)

### Plugin Real Estate - Modèles

#### 1. **Property** (`re_properties`)
```php
class Property extends BaseModel
{
    // Timestamps
    // Many-to-many: features()
    // Morphable: author() (User ou Account)
    // Belongs to: currency(), city(), category(), type()
    // One-to-many: reviews()
    
    // Scopes:
    // - notExpired()
    // - expired()
    
    // Attributs calculés:
    // - image (première image)
    // - image_thumb
    // - image_small
    // - price_format
    // - price_html
    // - square_text
    // - city_name
    // - type_name
    // - category_name
}
```

**Principales Méthodes**:
- `features()`: Relation Many-to-Many avec Feature
- `facilities()`: Relation Polymorphe Many-to-Many avec Facility
- `author()`: Relation Morphe avec User ou Account
- `currency()`: Relation Belongs-to avec Currency
- `city()`: Relation Belongs-to avec City
- `category()`: Relation Belongs-to avec Category
- `type()`: Relation Belongs-to avec Type
- `reviews()`: Relation Morphe One-to-Many avec Review
- `scopeNotExpired()`: Propriétés non expirées
- `scopeExpired()`: Propriétés expirées

#### 2. **Account** (`re_accounts`)
```php
class Account extends Authenticatable
{
    use Notifiable, HasApiTokens
    
    // Authentifiable (Passport/Laravel Sanctum)
    // One-to-many: properties()
    // Many-to-many: packages()
    // One-to-many: transactions()
    // Belongs-to: avatar() (MediaFile)
    
    // Attributs calculés:
    // - name (first_name + last_name)
    // - avatar_url
}
```

**Principales Méthodes**:
- `properties()`: Propriétés de l'agent
- `packages()`: Forfaits auxquels l'agent est abonné
- `transactions()`: Transactions de l'agent
- `canPost()`: Peut-il poster (credits > 0)
- `sendPasswordResetNotification()`: Envoie notification de réinitialisation

#### 3. **Category** (`re_categories`)
```php
class Category extends BaseModel
{
    // One-to-many: properties()
    // Fillable: name, description, status, order, is_default
    // Casts: status => BaseStatusEnum
}
```

#### 4. **Type** (`re_property_types`)
```php
class Type extends BaseModel
{
    // One-to-many: properties()
    // Fillable: name, slug, order
}
```

#### 5. **Feature** (`re_features`)
```php
class Feature extends BaseModel
{
    // Many-to-many: properties()
    // Fillable: name, icon, status
}
```

#### 6. **Facility** (`re_facilities`)
```php
class Facility extends BaseModel
{
    // Morphable Many-to-many: properties()
    // One-to-many: distances()
    // Fillable: name, icon, status
    // Timestamps
}
```

#### 7. **Currency** (`re_currencies`)
```php
class Currency extends BaseModel
{
    // One-to-many: properties()
    // Fillable: title, symbol, is_prefix_symbol, decimals, order, is_default, exchange_rate
    // Timestamps
}
```

#### 8. **Package** (`re_packages`)
```php
class Package extends BaseModel
{
    // Many-to-many: accounts()
    // Belongs-to: currency()
    // Fillable: name, price, currency_id, percent_save, number_of_listings, account_limit, order, is_default, features, status
    // Timestamps
}
```

#### 9. **Consult** (`re_consults`)
```php
class Consult extends BaseModel
{
    // Belongs-to: property()
    // Fillable: name, email, phone, property_id, content, status
    // Timestamps
}
```

#### 10. **Review** (`re_reviews`)
```php
class Review extends BaseModel
{
    // Polymorphic One-to-Many (properties, accounts)
    // Belongs-to: account()
    // One-to-many: metas()
    // Fillable: account_id, reviewable_id, reviewable_type, star, comment, status
    // Timestamps
}
```

#### 11. **Transaction** (`re_transactions`)
```php
class Transaction extends BaseModel
{
    // Belongs-to: account()
    // Fillable: credits, description, user_id, account_id, type, payment_id
    // Timestamps
}
```

#### 12. **AccountActivityLog** (`re_account_activity_logs`)
```php
class AccountActivityLog extends BaseModel
{
    // Belongs-to: account()
    // Fillable: action, user_agent, reference_url, reference_name, ip_address, account_id
    // Timestamps
}
```

#### 13. **ReviewMeta** (`re_reviews_meta`)
```php
class ReviewMeta extends BaseModel
{
    // Belongs-to: review()
    // Fillable: key, value, review_id
}
```

---

## Contrôleurs (Controllers)

### Real Estate Plugin Controllers

#### Frontend Controllers (Public)

##### 1. **PublicController**
Gestion des pages publiques

##### 2. **PublicAccountController**
Profils publics des agents
- Affichage du profil
- Propriétés de l'agent
- Avis et évaluations

##### 3. **RealEstateController**
Page d'accueil immobilière
- Listes de propriétés
- Filtrage et recherche
- Détails d'une propriété

##### 4. **PropertyController**
Gestion des propriétés côté public
- Liste des propriétés
- Détails
- Recherche/Filtrage

#### Admin/Backend Controllers

##### 5. **AccountController**
Gestion des comptes agents (Admin)
- Liste des comptes
- Création/Édition
- Suppression
- Assignation de forfaits

##### 6. **AccountPropertyController**
Gestion des propriétés des agents
- Liste des propriétés par agent
- Création/Édition
- Suppression
- Modération

##### 7. **CategoryController**
Gestion des catégories
- CRUD complet
- Ordonancement

##### 8. **TypeController**
Gestion des types de propriétés
- CRUD complet

##### 9. **FeatureController**
Gestion des caractéristiques
- CRUD complet

##### 10. **FacilityController**
Gestion des installations/commodités
- CRUD complet

##### 11. **PackageController**
Gestion des forfaits
- CRUD complet
- Attribution aux comptes

##### 12. **CurrencyController**
Gestion des devises
- CRUD complet
- Taux de change

##### 13. **ReviewController**
Gestion des avis/évaluations
- Modération des avis
- Suppression

##### 14. **ConsultController**
Gestion des consultations
- Liste des demandes
- Marquer comme lues
- Suppression

##### 15. **TransactionController**
Gestion des transactions
- Liste des transactions
- Création manuelle

#### Account Management Controllers (Agent Portal)

##### 16. **LoginController**
Authentification des agents
- Formulaire de connexion
- Validation
- Session

##### 17. **RegisterController**
Inscription des agents
- Formulaire d'inscription
- Validation
- Email de confirmation

##### 18. **ForgotPasswordController**
Mot de passe oublié
- Formulaire de demande
- Envoi de lien

##### 19. **ResetPasswordController**
Réinitialisation de mot de passe
- Validation du token
- Modification du mot de passe

---

## Requêtes (Requests)

### Form Requests (Validation)

#### 1. **AccountCreateRequest**
Validation pour création de compte
- Prénoms/Noms
- Email unique
- Mot de passe
- Phone

#### 2. **AccountEditRequest**
Validation pour édition de compte
- Prénoms/Noms
- Email unique
- Phone
- Description

#### 3. **AccountChangeAvatarRequest**
Validation avatar
- Fichier image

#### 4. **PropertyRequest**
Validation pour propriétés
- Nom
- Description/Contenu
- Prix
- Bedrooms/Bathrooms/Floors
- Square
- Localisation
- Images
- Devises
- Type/Catégorie

#### 5. **AccountPropertyRequest**
Validation pour propriétés d'agent
- Valide les propriétés côté agent

#### 6. **CategoryRequest**
Validation des catégories
- Nom
- Description
- Statut

#### 7. **TypeRequest**
Validation des types
- Nom

#### 8. **FeatureRequest**
Validation des caractéristiques
- Nom
- Icône

#### 9. **FacilityRequest**
Validation des installations
- Nom
- Icône

#### 10. **PackageRequest**
Validation des forfaits
- Nom
- Prix
- Devise
- Nombre d'annonces
- Features

#### 11. **CurrencyRequest**
Validation des devises
- Titre
- Symbole
- Taux de change

#### 12. **ReviewRequest**
Validation des avis
- Note (1-5)
- Commentaire

#### 13. **ConsultRequest**
Validation des consultations
- Nom
- Email
- Phone
- Message

#### 14. **SendConsultRequest**
Validation pour envoi de consultation
- Email
- Phone
- Message

#### 15. **LoginRequest**
Validation connexion
- Email
- Mot de passe

#### 16. **RegisterRequest**
Validation inscription
- Prénoms/Noms
- Email
- Mot de passe
- Phone

#### 17. **UpdatePasswordRequest**
Validation changement de mot de passe
- Ancien mot de passe
- Nouveau mot de passe

#### 18. **UpdateSettingsRequest**
Validation paramètres utilisateur
- Informations personnelles

#### 19. **CreateTransactionRequest**
Validation transaction manuelle
- Compte
- Crédits
- Description

#### 20. **SettingRequest**
Validation paramètres système
- Diverses clés/valeurs

#### 21. **AvatarRequest**
Validation avatar
- Fichier image

---

## Migrations

### Migration Principale: `2018_06_22_032304_create_real_estate_table.php`

Cette migration crée la structure complète de la base de données pour le plugin Real Estate.

**Tables créées** (17 tables):

1. `re_property_types` - Types de propriétés
2. `re_properties` - Propriétés
3. `re_features` - Caractéristiques
4. `re_property_features` - Pivot entre propriétés et caractéristiques
5. `re_currencies` - Devises
6. `re_consults` - Consultations
7. `re_accounts` - Comptes agents
8. `re_account_password_resets` - Tokens de réinitialisation
9. `re_account_activity_logs` - Logs d'activité
10. `re_packages` - Forfaits
11. `re_categories` - Catégories
12. `re_transactions` - Transactions
13. `re_accounts_packages` - Pivot entre comptes et forfaits
14. `re_facilities` - Installations/Commodités
15. `re_facilities_distances` - Distances des installations
16. `re_reviews` - Avis/Évaluations
17. `re_reviews_meta` - Métadonnées des avis

**Caractéristiques**:
- Utilise des transactions et Foreign Key Constraints
- Supporte les polymorphic relations
- Indices sur les colonnes fréquemment utilisées
- Supports JSON et Enum casting

---

## Repositories et Interfaces

### Pattern Repository

Chaque entité a:
1. **Interface** (`Repositories/Interfaces/XXXInterface.php`)
2. **Implémentation Eloquent** (`Repositories/Eloquent/XXXRepository.php`)
3. **Cache Decorator** (Optionnel) (`Repositories/Caches/XXXCacheDecorator.php`)

### Repositories Disponibles

#### 1. **PropertyRepository**
- CRUD pour les propriétés
- Filtrage avancé
- Recherche
- Gestion des images

#### 2. **AccountRepository**
- CRUD pour les comptes
- Gestion des crédits
- Activité des comptes

#### 3. **CategoryRepository**
- CRUD pour les catégories
- Ordonancement

#### 4. **TypeRepository**
- CRUD pour les types

#### 5. **FeatureRepository**
- CRUD pour les caractéristiques

#### 6. **FacilityRepository**
- CRUD pour les installations
- Gestion des distances

#### 7. **PackageRepository**
- CRUD pour les forfaits
- Gestion des features

#### 8. **CurrencyRepository**
- CRUD pour les devises

#### 9. **ReviewRepository**
- CRUD pour les avis
- Modération

#### 10. **ConsultRepository**
- CRUD pour les consultations
- Statut lecture

#### 11. **TransactionRepository**
- CRUD pour les transactions
- Historique des crédits

#### 12. **AccountActivityLogRepository**
- Logging des activités
- Requête par compte

### Cache Decorators

Tous les repositories ont un Cache Decorator correspondant:
- `AccountCacheDecorator`
- `PropertyCacheDecorator`
- `CategoryCacheDecorator`
- `TypeCacheDecorator`
- `FeatureCacheDecorator`
- `FacilityCacheDecorator`
- `PackageCacheDecorator`
- `CurrencyCacheDecorator`
- `ReviewCacheDecorator`
- `ConsultCacheDecorator`
- `AccountActivityLogCacheDecorator`

**Fonctionnalité**: Mise en cache automatique des requêtes pour améliorer les performances.

---

## Services et Supports

### Services

#### 1. **StoreCurrenciesService**
Service pour importer/stocker les devises
- Récupère les devises depuis une source externe
- Stocke en base de données
- Gère les taux de change

#### 2. **SaveFacilitiesService**
Service pour sauvegarder les installations
- Validation des données
- Création/Mise à jour en masse
- Gestion des associations

### Support Classes

#### 1. **RealEstateHelper**
Helpers pour le plugin Real Estate
- Formatage des prix
- Calculs divers
- Fonctions utilitaires

#### 2. **CurrencySupport**
Support pour la gestion des devises
- Conversion de devises
- Formatage des prix
- Récupération des symboles

### Notifications

#### 1. **ResetPasswordNotification**
Notification d'email pour réinitialisation de mot de passe

#### 2. **ConfirmEmailNotification**
Notification d'email pour confirmation d'adresse

### Enums

#### 1. **ModerationStatusEnum**
Statuts de modération:
- `pending` - En attente
- `approved` - Approuvé
- `rejected` - Rejeté

#### 2. **PropertyPeriodEnum**
Périodes de prix:
- `day` - Par jour
- `month` - Par mois
- `year` - Par année
- `buy` - Achat

#### 3. **PropertyTypeEnum**
Types de propriétés:
- `sale` - Vente
- `rent` - Location

---

## Frontend et Thème

### Thème Resido

Structure:
```
platform/themes/resido/
├── assets/              # Fichiers assets (images, fonts)
├── functions/           # Fonctions PHP du thème
├── lang/                # Traductions du thème
├── layouts/             # Layouts Blade
├── partials/            # Partials réutilisables
├── public/              # Fichiers publics
├── resources/           # Ressources (CSS/JS)
├── routes/              # Routes du thème
├── src/                 # Code PHP du thème
├── views/               # Vues du thème
├── widgets/             # Widgets personnalisés
├── config.php           # Configuration du thème
├── theme.json           # Métadonnées du thème
└── webpack.mix.js       # Configuration Webpack
```

### Technologies Frontend

**CSS/Styling**:
- Tailwind CSS 3.4 (Utility-first CSS)
- Bootstrap 4.6 (Framework legacy)
- Sass/SCSS (Préprocesseur)
- PostCSS

**JavaScript**:
- Vue.js 3.5 (Framework réactif)
- jQuery 3.5 (DOM manipulation)
- Axios (HTTP client)
- Epic Spinners (Loading spinners)
- Moment.js (Date handling)

**Build Tool**:
- Laravel Mix 6 (Webpack wrapper)
- Développement avec `npm run watch`
- Production avec `npm run production`

### Pages Principales

**Homepage**: Affichage des propriétés en vedette
**Property Listing**: Liste filtrable des propriétés
**Property Detail**: Détails complets d'une propriété
**Agent Profile**: Profil public d'un agent
**Search**: Recherche avancée
**Contact**: Formulaire de contact
**Blog**: Articles de blog
**Dashboard Agent**: Espace agent connecté

---

## Configuration

### Fichiers de Configuration Principaux

#### 1. **config/app.php**
Configuration générale Laravel
- Nom de l'application
- Environment (dev/production)
- Timezone
- Locale (multilingue)
- Service Providers
- Aliases

#### 2. **config/database.php**
Configuration base de données
- Connexion par défaut
- Plusieurs connections supportées

#### 3. **config/auth.php**
Configuration authentification
- Guards (web, api)
- Providers (users, accounts)
- Password reset configuration

#### 4. **config/mail.php**
Configuration email
- Driver email
- From address
- Markdown templates

#### 5. **config/filesystems.php**
Configuration stockage fichiers
- Disks (local, s3, etc.)
- Chemin de stockage

#### 6. **config/cache.php**
Configuration du cache
- Cache driver
- Durée par défaut

#### 7. **config/cors.php**
Configuration CORS
- Origins autorisées
- Méthodes autorisées

#### 8. **config/session.php**
Configuration sessions
- Driver de session
- Durée de vie

#### 9. **config/services.php**
Services externes
- Google Drive
- Réseaux sociaux
- Passerelles de paiement

### Variables d'Environnement (.env)

```
APP_NAME=Essentiel-Immo
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=real_estate
DB_USERNAME=user
DB_PASSWORD=password

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=xxxx
MAIL_PASSWORD=xxxx
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

GOOGLE_DRIVE_CLIENT_ID=
GOOGLE_DRIVE_CLIENT_SECRET=
GOOGLE_DRIVE_REFRESH_TOKEN=
GOOGLE_DRIVE_FOLDER_ID=
```

---

## Authentification

### Deux Systèmes d'Authentification Parallèles

#### 1. **Admin/User Authentication** (Laravel Standard)
- Table: `users`
- Modèle: `App\Models\User`
- Guards: `web`, `api`
- Authentification standard Laravel
- Pour l'équipe administrative

#### 2. **Agent Account Authentication** (Custom)
- Table: `re_accounts`
- Modèle: `Botble\RealEstate\Models\Account`
- Guards: `account`, `account-api`
- Laravel Passport (OAuth2)
- Pour les agents immobiliers
- Endpoint API: `/api/agent/login`

### Flux d'Authentification Agent

```
1. Inscription (RegisterController)
   ↓
2. Envoi email de confirmation
   ↓
3. Validation du lien de confirmation
   ↓
4. Activation du compte
   ↓
5. Connexion (LoginController)
   ↓
6. Génération du token Passport
   ↓
7. Accès au Dashboard Agent
```

### Middleware d'Authentification

- `auth` - Vérifie authentification utilisateur
- `auth.account` - Vérifie authentification agent
- `verified` - Vérifie email confirmé
- `admin` - Vérifie accès admin

---

## Fonctionnalités Principales

### 1. Gestion des Propriétés

#### Front-end (Public)
- [x] Lister les propriétés avec pagination
- [x] Filtrer par catégorie, type, prix, localisation
- [x] Recherche textuelle
- [x] Voir les détails d'une propriété
- [x] Gallerie d'images
- [x] Localisation sur la carte (GPS)
- [x] Caractéristiques et installations affichées
- [x] Avis et évaluations
- [x] Demande d'information (Consult)

#### Back-end Admin
- [x] CRUD complet des propriétés
- [x] Modération (pending/approved/rejected)
- [x] Gestion des expiration et renouvellement
- [x] Attribution aux agents
- [x] Marquage en vedette
- [x] Gestion des images
- [x] Assignation de caractéristiques et installations

#### Portail Agent
- [x] Créer/Éditer ses propriétés
- [x] Importer en masse (si crédits disponibles)
- [x] Voir les consultations reçues
- [x] Voir les avis sur ses propriétés
- [x] Suivi des performance

### 2. Gestion des Comptes Agents

#### Admin
- [x] Lister tous les agents
- [x] Créer/Éditer/Supprimer des agents
- [x] Assigner des forfaits
- [x] Gérer les crédits
- [x] Voir l'historique d'activité

#### Agent
- [x] Consulter et éditer son profil
- [x] Changer l'avatar
- [x] Changer le mot de passe
- [x] Voir son historique de transactions
- [x] Consulter ses crédits restants

### 3. Système de Crédits et Forfaits

#### Forfaits
- [x] Créer différents types de forfaits
- [x] Définir le nombre d'annonces par forfait
- [x] Tarification en différentes devises
- [x] Réductions disponibles
- [x] Features/Avantages du forfait

#### Crédits
- [x] Ajout/Soustraction manuelle de crédits (Admin)
- [x] Transactions enregistrées
- [x] Historique des transactions
- [x] Vérification des crédits avant création de propriété

#### Paiements
- [x] Intégration Paystack
- [x] Intégration Razorpay
- [x] Intégration SSL Commerz
- [x] Passerelle de paiement générique

### 4. Système d'Avis et Évaluations

- [x] Avis sur propriétés
- [x] Avis sur agents
- [x] Notes par étoiles (1-5)
- [x] Commentaires textuels
- [x] Modération des avis
- [x] Métadonnées des avis (images, etc.)

### 5. Localisation et Géolocalisation

- [x] Système multilingue
- [x] Gestion des villes et régions
- [x] Coordonnées GPS (latitude/longitude)
- [x] Affichage sur carte
- [x] Recherche par localisation
- [x] Installations/Commodités à proximité

### 6. Système de Consultation

- [x] Formulaire de demande d'information
- [x] Email de confirmation
- [x] Admin peut voir les consultations
- [x] Marquage comme lu/non-lu
- [x] Réponse aux consultations

### 7. Blog

- [x] Créer/Éditer articles
- [x] Catégories d'articles
- [x] Commentaires
- [x] Tags
- [x] Partage social

### 8. Contact

- [x] Formulaire de contact général
- [x] Validation des données
- [x] Notification email
- [x] Stockage des messages

### 9. Multilingue

- [x] Support de plusieurs langues
- [x] Traductions dynamiques
- [x] Gestion des langues via admin
- [x] Plugin Translation pour traductions custom
- [x] Plugin Language pour gestion des langues

### 10. Analytics

- [x] Intégration Google Analytics
- [x] Suivi des conversions
- [x] Rapports de visite
- [x] Tableau de bord des statistiques

### 11. Médias

- [x] Upload d'images
- [x] Galerie d'images
- [x] Redimensionnement automatique
- [x] Stockage (Local ou AWS S3)
- [x] Gestion de médiathèque

### 12. Sécurité

- [x] Authentification par email/mot de passe
- [x] Authentification OAuth2 (Passport)
- [x] Login social (Facebook, Google, etc.)
- [x] CSRF Protection
- [x] Validation des entrées
- [x] Hashage des mots de passe
- [x] JWT Tokens pour API
- [x] CORS configuré
- [x] Rate limiting
- [x] Captcha (Google reCAPTCHA)
- [x] Logs d'activité

### 13. Admin Dashboard

- [x] Tableau de bord avec statistiques
- [x] Graphiques des propriétés
- [x] Graphiques des utilisateurs
- [x] Graphiques des transactions
- [x] Accès rapide aux sections
- [x] Notifications
- [x] Menu de navigation

### 14. SEO

- [x] Meta tags
- [x] URLs amicales
- [x] Sitemap
- [x] RSS Feed
- [x] Schema.org markup
- [x] Redirects 301

### 15. Paramètres Système

- [x] Configurations dynamiques
- [x] Logos et branding
- [x] Emails génériques
- [x] Texte des pages
- [x] Paramètres sociaux
- [x] Paramètres de localisation

---

## Guides d'Utilisation

### Installation et Configuration

```bash
# 1. Cloner le projet
git clone https://github.com/FLASMON/Essentiel-Immo-Tamatave.git

# 2. Installer les dépendances PHP
composer install --ignore-platform-req=ext-sodium

# 3. Copier le fichier .env
cp .env.example .env

# 4. Générer la clé de l'application
php artisan key:generate

# 5. Configurer la base de données dans .env

# 6. Migrer la base de données
php artisan migrate

# 7. Remplir la base de données (optionnel)
php artisan db:seed

# 8. Installer les dépendances JavaScript
npm install

# 9. Compiler les assets
npm run dev

# 10. Démarrer le serveur
php artisan serve
```

### Commandes Artisan Utiles

```bash
# Migrations
php artisan migrate          # Exécuter les migrations
php artisan migrate:rollback # Annuler la dernière batch
php artisan migrate:refresh  # Réinitialiser et migrer

# Cache
php artisan cache:clear     # Vider le cache
php artisan view:clear      # Vider le cache des vues
php artisan route:cache     # Cacher les routes

# Publishing Assets
php artisan cms:publish:assets # Publier les assets du CMS

# Tinker (REPL)
php artisan tinker          # Accès à la console interactive

# Testing
php artisan test            # Exécuter les tests PHPUnit
```

### Structure d'URL

#### Frontend
```
/ - Accueil
/properties - Liste des propriétés
/properties/{slug} - Détail d'une propriété
/agents/{slug} - Profil public d'un agent
/blog - Liste des articles
/blog/{slug} - Article détaillé
/contact - Formulaire de contact
/dashboard - Dashboard agent (connecté)
```

#### Admin
```
/admin - Dashboard admin
/admin/real-estate/properties - Gestion des propriétés
/admin/real-estate/accounts - Gestion des agents
/admin/real-estate/categories - Catégories
/admin/real-estate/types - Types de propriétés
/admin/real-estate/features - Caractéristiques
/admin/real-estate/facilities - Installations
/admin/real-estate/packages - Forfaits
/admin/real-estate/currencies - Devises
/admin/real-estate/reviews - Avis
/admin/real-estate/consults - Consultations
/admin/real-estate/transactions - Transactions
```

#### API
```
/api/agent/login - Connexion agent
/api/properties - Liste des propriétés
/api/properties/{id} - Détail d'une propriété
/api/agents - Liste des agents
/api/agents/{id} - Détail d'un agent
/api/reviews - Avis
```

---

## Points Clés à Retenir

### Architecture
- **Plugin-based**: Utilise Botble CMS comme base
- **Multi-authentication**: Utilisateurs admin ET agents
- **Repository Pattern**: Abstraction de la base de données
- **Service Layer**: Logique métier séparée
- **Cache Decorators**: Performance optimisée

### Base de Données
- **17 tables principales** pour le Real Estate plugin
- **Polymorphic Relations** pour flexibilité
- **Enum Casting** pour typage des statuts
- **Soft Deletes** optionnels sur certains modèles

### Frontend
- **Vue.js 3** pour interactivité
- **Tailwind CSS** pour styles
- **Responsive** sur tous les appareils
- **Mobile-first** design

### Sécurité
- **CSRF Protection** intégrée
- **Authentication Middleware**
- **Data Validation** stricte
- **SQL Injection Protection** (Eloquent ORM)
- **XSS Protection**

### Performance
- **Caching System** multi-niveaux
- **Pagination** sur les listes
- **Lazy Loading** des images
- **Asset Minification** en production
- **Query Optimization** via Repository pattern

### Scalabilité
- **Modular Structure** - Facile d'ajouter des fonctionnalités
- **Plugin System** - Extensible
- **Queue Support** - Pour jobs longs
- **API Ready** - Backend prêt pour mobile apps

---

## Ressources et Références

### Documentation Officielle
- Laravel: https://laravel.com/docs
- Botble CMS: https://laravel-cms.flutterwave.com
- Vue.js: https://vuejs.org
- Tailwind CSS: https://tailwindcss.com

### Fichiers Clés du Projet
- `composer.json` - Dépendances PHP
- `package.json` - Dépendances JavaScript
- `.env` - Variables d'environnement
- `routes/web.php` - Routes web
- `routes/api.php` - Routes API
- `config/` - Fichiers de configuration

### Contacts et Support
- Repository: https://github.com/FLASMON/Essentiel-Immo-Tamatave
- Issues: Ouvrir une issue sur GitHub
- Email: Voir la configuration du projet

---

**Dernière mise à jour**: Novembre 2025  
**Version Documentation**: 1.0  
**Statut**: Complet et à jour

