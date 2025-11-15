# Analyse Complète - Frontend & Design Public | Laravel Inertia 11

## 📋 Table des Matières
1. [Vue d'Ensemble Frontend](#vue-densemble-frontend)
2. [Architecture Frontend](#architecture-frontend)
3. [Design System](#design-system)
4. [Structure des Pages Publiques](#structure-des-pages-publiques)
5. [Menus et Navigation](#menus-et-navigation)
6. [Analyse Détaillée des Pages](#analyse-détaillée-des-pages)
7. [Formulaires et Champs](#formulaires-et-champs)
8. [Composants Réutilisables](#composants-réutilisables)
9. [Routes Publiques](#routes-publiques)
10. [Intégration Inertia 11](#intégration-inertia-11)
11. [Structure des Fichiers](#structure-des-fichiers)
12. [Design Tokens](#design-tokens)
13. [Responsive & Mobile](#responsive--mobile)
14. [Performance Frontend](#performance-frontend)

---

## Vue d'Ensemble Frontend

### Thème Actuel: Resido Real Estate

**Informations du Thème**:
- **Nom**: Resido - Real Estate
- **Version**: 1.8.0
- **Auteur**: TheSky9 Team
- **Type**: Thème immobilier professionnel
- **Framework**: Bootstrap 4.6 + Tailwind CSS 3
- **Responsive**: Mobile-first

**Plugins Requis**:
- ✅ Blog
- ✅ Contact
- ✅ Language (Multilingue)
- ✅ Location (Villes/Régions)
- ✅ Real Estate (Principal)

### Technologies Frontend

**CSS/Styling**:
```
├── Bootstrap 4.6      (Framework principal)
├── Tailwind CSS 3     (Utility-first)
├── Font Awesome       (Icônes)
├── Icofont           (Icônes additionnelles)
├── Themify Icons     (Icônes thème)
├── Line Icons        (Icônes linéaires)
├── Slick             (Carrousels)
└── Magnific Popup    (Lightbox)
```

**JavaScript/Plugins**:
```
├── jQuery 3.5        (Manipulation DOM)
├── Bootstrap JS      (Composants)
├── Select2           (Dropdowns avancés)
├── Dropzone          (Upload de fichiers)
├── Range Slider      (Sliders de prix)
├── Slick             (Carrousels)
├── Lightbox          (Galeries)
├── ImagesLoaded      (Chargement images)
└── Lazy Load         (Chargement différé)
```

**Build Tools**:
```
├── Webpack (via Mix)
├── Tailwind CSS
├── PostCSS
└── SASS/SCSS
```

---

## Architecture Frontend

### Structure du Thème Resido

```
platform/themes/resido/
│
├── assets/                     # Fichiers statiques
│   ├── images/                # Images du thème
│   ├── fonts/                 # Polices de caractères
│   └── videos/                # Vidéos
│
├── public/                     # Fichiers publics compilés
│   ├── css/                   # CSS compilé
│   ├── js/                    # JS compilé
│   ├── plugins/               # Plugins JS/CSS
│   ├── fonts/                 # Polices
│   └── images/                # Images optimisées
│
├── resources/                  # Sources
│   ├── css/                   # SASS/SCSS
│   │   ├── style.scss         # Styles principaux
│   │   ├── rtl-style.scss     # Styles RTL
│   │   └── components/        # Composants CSS
│   ├── js/                    # JavaScript
│   │   ├── app.js             # Entry point
│   │   ├── components.js      # Composants JS
│   │   ├── wishlist.js        # Gestion wishlist
│   │   └── utils/             # Utilitaires
│   └── images/                # Images sources
│
├── views/                      # Vues Blade
│   ├── real-estate/           # Pages immobilier
│   │   ├── property.blade.php # Détail propriété
│   │   └── ...
│   ├── templates/             # Templates partagés
│   │   ├── header.blade.php
│   │   ├── footer.blade.php
│   │   └── sidebar.blade.php
│   ├── index.blade.php        # Accueil
│   ├── page.blade.php         # Pages statiques
│   ├── post.blade.php         # Articles blog
│   ├── category.blade.php     # Catégories
│   └── 404.blade.php          # Erreurs
│
├── layouts/                    # Layouts Blade
│   ├── default.blade.php      # Layout par défaut
│   ├── homepage.blade.php     # Layout accueil
│   └── account.blade.php      # Layout compte agent
│
├── partials/                   # Partials réutilisables
│   ├── header.blade.php
│   ├── footer.blade.php
│   ├── navigation.blade.php
│   ├── sidebar.blade.php
│   └── ...
│
├── widgets/                    # Widgets/Composants
│   └── ...
│
├── functions/                  # Fonctions PHP du thème
│   └── ...
│
├── routes/                     # Routes du thème
│   └── ...
│
├── src/                        # Code PHP du thème
│   ├── Http/
│   │   └── Controllers/
│   └── Providers/
│
├── config.php                  # Configuration du thème
├── theme.json                  # Métadonnées du thème
├── webpack.mix.js              # Configuration Webpack
└── screenshot.png              # Capture du thème
```

### Architecture après Migration Inertia

```
resources/js/
│
├── app.js                      # Entry point Vue
├── bootstrap.js                # Bootstrap Inertia
│
├── Components/                 # Composants réutilisables
│   ├── Header.vue
│   ├── Navigation.vue
│   ├── Footer.vue
│   ├── PropertyCard.vue
│   ├── PropertyFilter.vue
│   ├── PropertyGallery.vue
│   ├── ReviewCard.vue
│   ├── RatingStars.vue
│   ├── FormInput.vue
│   ├── FormTextarea.vue
│   ├── FormSelect.vue
│   ├── FormCheckbox.vue
│   ├── Pagination.vue
│   ├── LoadingSpinner.vue
│   ├── Alert.vue
│   ├── Modal.vue
│   └── Breadcrumbs.vue
│
├── Layouts/                    # Layouts
│   ├── AppLayout.vue           # Layout principal
│   ├── GuestLayout.vue         # Layout visiteur
│   ├── AccountLayout.vue       # Layout compte
│   └── AdminLayout.vue         # Layout admin
│
├── Pages/                      # Pages
│   ├── Home.vue                # Accueil
│   ├── Properties/
│   │   ├── Index.vue           # Liste propriétés
│   │   ├── Show.vue            # Détail propriété
│   │   └── Category.vue        # Propriétés par catégorie
│   ├── Blog/
│   │   ├── Index.vue           # Liste articles
│   │   └── Show.vue            # Détail article
│   ├── Contact/
│   │   └── Index.vue           # Formulaire contact
│   ├── Agents/
│   │   ├── Index.vue           # Liste agents
│   │   └── Show.vue            # Profil agent
│   ├── Auth/
│   │   ├── Login.vue           # Connexion agent
│   │   ├── Register.vue        # Inscription agent
│   │   ├── ForgotPassword.vue
│   │   └── ResetPassword.vue
│   ├── Account/
│   │   ├── Dashboard.vue       # Dashboard agent
│   │   ├── Settings.vue        # Paramètres
│   │   ├── Security.vue        # Sécurité
│   │   ├── Packages.vue        # Mes forfaits
│   │   ├── Transactions.vue    # Mes transactions
│   │   └── Properties/
│   │       ├── Index.vue       # Mes propriétés
│   │       ├── Create.vue      # Créer propriété
│   │       └── Edit.vue        # Éditer propriété
│   └── Errors/
│       ├── NotFound.vue        # 404
│       └── Error.vue           # Erreur
│
├── Stores/                     # Pinia Stores
│   ├── PropertyStore.js        # État propriétés
│   ├── AuthStore.js            # État authentification
│   ├── UIStore.js              # État UI
│   └── FilterStore.js          # État filtres
│
├── Composables/                # Vue Composables
│   ├── useAuth.js              # Authentification
│   ├── useProperty.js          # Propriétés
│   ├── useForm.js              # Gestion formulaires
│   └── useFilters.js           # Filtres
│
├── Utils/                      # Utilitaires
│   ├── format.js               # Formatage
│   ├── validation.js           # Validation
│   └── helpers.js              # Helpers
│
└── css/                        # Styles globaux
    ├── tailwind.css            # Tailwind imports
    ├── global.css              # Styles globaux
    └── components.css          # Styles composants
```

---

## Design System

### Palette de Couleurs (Resido)

```
Brand Colors:
├── Primary Blue     #0066CC (CTA, Liens principaux)
├── Secondary Blue   #003D99 (Textes importants)
├── Accent Green     #4CAF50 (Badges, Success)
├── Warning Orange   #FF9800 (Avertissements)
├── Error Red        #F44336 (Erreurs)
├── Info Light Blue  #2196F3 (Infos)
│
Neutral Colors:
├── Dark Gray        #333333 (Texte principal)
├── Medium Gray      #666666 (Texte secondaire)
├── Light Gray       #CCCCCC (Borders)
├── Very Light Gray  #F5F5F5 (Backgrounds)
├── White            #FFFFFF (Base)
│
Semantic:
├── Success Green    #27AE60
├── Warning Yellow   #F39C12
├── Error Red        #E74C3C
├── Info Blue        #3498DB
└── Neutral Gray     #95A5A6
```

### Tipographie

```
Fonts:
├── Primaire: Roboto, Sans-serif
├── Secondaire: Open Sans, Sans-serif
└── Monospace: Courier New

Sizes:
├── H1: 48px / 52px (line-height)
├── H2: 36px / 40px
├── H3: 28px / 32px
├── H4: 24px / 28px
├── H5: 20px / 24px
├── H6: 16px / 20px
├── Body: 14px / 20px (normal)
├── Small: 12px / 16px
└── Caption: 11px / 14px

Weights:
├── Light: 300
├── Regular: 400
├── Medium: 500
├── Semi-Bold: 600
└── Bold: 700
```

### Espacement (Padding/Margin)

```
Spacing Scale:
├── 4px    (xs)
├── 8px    (sm)
├── 12px   (md)
├── 16px   (lg)
├── 24px   (xl)
├── 32px   (2xl)
├── 48px   (3xl)
└── 64px   (4xl)

Container:
├── Max-width: 1200px
├── Padding: 16px (mobile), 24px (desktop)
└── Margin auto
```

### Shadows & Borders

```
Shadows:
├── Level 0: none
├── Level 1: 0 1px 3px rgba(0,0,0,0.1)
├── Level 2: 0 4px 6px rgba(0,0,0,0.1)
├── Level 3: 0 10px 15px rgba(0,0,0,0.1)
└── Level 4: 0 20px 25px rgba(0,0,0,0.1)

Borders:
├── Radius: 0px, 4px, 8px, 12px
├── Width: 1px (default)
└── Color: #CCCCCC (light), #999999 (dark)
```

### Breakpoints

```
Mobile:    0px - 576px
Tablet:    576px - 768px
Desktop:   768px - 992px
Large:     992px - 1200px
X-Large:   1200px+
```

---

## Structure des Pages Publiques

### Hiérarchie des Pages

```
Homepage (Accueil)
├── Hero Section
├── Featured Properties
├── Categories
├── Call-to-Action
├── Latest Blog Posts
├── Testimonials
└── Contact

Properties Section
├── Properties Listing
│   ├── Search Bar
│   ├── Filters (Avancés)
│   ├── Property Cards Grid
│   ├── Pagination
│   └── Map View
├── Property Detail
│   ├── Gallery
│   ├── Info Principale
│   ├── Description
│   ├── Features & Facilities
│   ├── Location Map
│   ├── Reviews
│   ├── Consultation Form
│   └── Similar Properties
└── Category Listing
    └── Properties par Catégorie

Blog Section
├── Blog Listing
│   ├── Articles Grid
│   ├── Sidebar (Search, Categories)
│   └── Pagination
└── Blog Detail
    ├── Article Content
    ├── Author Info
    ├── Share Buttons
    ├── Comments
    └── Related Posts

Agents Section
├── Agents Listing
├── Agent Detail
│   ├── Profile Info
│   ├── Contact Info
│   ├── Agent Properties
│   └── Reviews
└── Agent Contact Form

Authentication
├── Login
├── Register
├── Forgot Password
├── Reset Password
└── Email Verification

Account (Connecté)
├── Dashboard
├── Profile Settings
├── Security
├── My Properties
│   ├── Listing
│   ├── Create
│   ├── Edit
│   └── Renew
├── My Packages
├── My Consultations
└── My Transactions

Pages Supplémentaires
├── Contact
├── About
└── 404/500 Errors
```

---

## Menus et Navigation

### Menu Principal (Header Navigation)

```
┌─────────────────────────────────────────────────┐
│  [Logo] │ Home  Props  Blog  Agents  More  │ [Icons] │
│         │         ↓ (Dropdown)              │ Search │
│         │    ├─ Propriétés              │ Account│
│         │    ├─ Par Catégorie           │ [Currency] │
│         │    └─ Articles                │          │
└─────────────────────────────────────────────────┘
```

**Structure Menu Principal**:

| Item | Lien | Condition | Sous-menu |
|------|------|-----------|-----------|
| **Logo** | `/` | Toujours | - |
| **Accueil** | `/` | Toujours | - |
| **Propriétés** | `/properties` | Toujours | Oui (Catégories) |
| **Blog** | `/blog` | Si blog actif | Non |
| **Agents** | `/agents` | Si agents actifs | Non |
| **Contact** | `/contact` | Si contact actif | Non |
| **Langue** | Dropdown | Multilingue activé | Oui (Langues) |
| **Compte** | Dropdown | Selon auth | Oui (Login/Register/Dashboard) |
| **Chercher** | Modal/Page | Toujours | - |
| **Devise** | Dropdown | Multi-devise | Oui (Devises) |

### Sous-menu: Propriétés

```
Propriétés ▼
├── À Vendre
├── À Louer
├── Appartements
├── Maisons
├── Terrains
└── Voir Toutes
```

### Sous-menu: Compte (Non Connecté)

```
Compte ▼
├── Connexion
├── Inscription
└── Inscription Agent
```

### Sous-menu: Compte (Connecté)

```
[Mon Profil] ▼
├── Dashboard
├── Mes Propriétés
├── Mes Packages
├── Mes Transactions
├── Paramètres
├── Sécurité
└── Déconnexion
```

### Menu Footer

```
┌─────────────────────────────────────────────────┐
│                  FOOTER MENU                    │
├─────────────────────────────────────────────────┤
│  À Propos          │  Propriétés      │  Légal  │
│  ├─ À Propos       │  ├─ À Vendre     │  ├─ CGU │
│  ├─ Contact        │  ├─ À Louer      │  ├─ PP  │
│  ├─ FAQ            │  └─ Toutes       │  └─ CGV │
│  └─ Blog           │                  │         │
│                    │  Ressources      │  Réseaux│
│  Agents            │  ├─ Blog         │  ├─ FB  │
│  ├─ Devenir Agent  │  ├─ FAQ          │  ├─ TW  │
│  ├─ Nos Agents     │  └─ Contact      │  ├─ IG  │
│  └─ Packages       │                  │  └─ LI  │
│                                       │         │
│  © 2024 Essentiel-Immo. Tous droits réservés.  │
└─────────────────────────────────────────────────┘
```

**Structure Footer**:

| Colonne | Items |
|---------|-------|
| **À Propos** | À Propos, Contact, FAQ, Blog, Sitemap |
| **Propriétés** | Vente, Location, Toutes, Categories |
| **Agents** | Devenir Agent, Liste Agents, Packages |
| **Ressources** | Blog, FAQ, Contact, Documentation |
| **Légal** | CGU, Politique Confidentialité, CGV, Disclaimer |
| **Réseaux Sociaux** | Facebook, Twitter, Instagram, LinkedIn, YouTube |
| **Infos** | Copyright, Adresse, Téléphone, Email, Hours |

---

## Analyse Détaillée des Pages

### 1️⃣ PAGE: Accueil (Homepage)

#### Structure de la Page

```
┌─────────────────────────────────────────┐
│  HEADER & NAVIGATION                    │
├─────────────────────────────────────────┤
│                                         │
│  HERO SECTION                           │
│  [Grande Image Background]              │
│  Titre: "Trouver votre propriété"       │
│  [Search Bar - Sticky]                  │
│                                         │
├─────────────────────────────────────────┤
│  FEATURED PROPERTIES                    │
│  (Carousel/Grid - 6 propriétés)         │
├─────────────────────────────────────────┤
│  QUICK STATS                            │
│  [500+ Propriétés] [100+ Agents] [...]  │
├─────────────────────────────────────────┤
│  CATEGORIES SHOWCASE                    │
│  (4-6 catégories avec images)           │
├─────────────────────────────────────────┤
│  TESTIMONIALS                           │
│  (Carousel d'avis)                      │
├─────────────────────────────────────────┤
│  WHY CHOOSE US                          │
│  (3-4 avantages)                        │
├─────────────────────────────────────────┤
│  LATEST BLOG POSTS                      │
│  (3 articles)                           │
├─────────────────────────────────────────┤
│  CTA: PARCOURIR PLUS                    │
├─────────────────────────────────────────┤
│  FOOTER                                 │
└─────────────────────────────────────────┘
```

#### Composants Inertia 11

```vue
<Pages/Home.vue>
├── <HeaderNav />
├── <HeroSection />
│   └── <SearchBar />
├── <FeaturedProperties />
│   └── v-for PropertyCard
├── <QuickStats />
├── <CategoriesShowcase />
│   └── v-for CategoryCard
├── <TestimonialsCarousel />
│   └── v-for TestimonialCard
├── <WhyChooseUs />
├── <LatestBlogPosts />
│   └── v-for BlogCard
├── <CallToAction />
└── <Footer />
```

#### Données Partagées

```php
// HomepageController@show()
return inertia('Home', [
    'featured_properties' => Property::featured()->limit(6)->get(),
    'categories' => Category::with('image')->get(),
    'testimonials' => Review::with('account')->approved()->limit(8)->get(),
    'blog_posts' => Post::latest()->published()->limit(3)->get(),
    'statistics' => [
        'total_properties' => Property::count(),
        'total_agents' => Account::count(),
        'total_transactions' => Transaction::count(),
    ],
]);
```

---

### 2️⃣ PAGE: Liste des Propriétés

#### Structure

```
┌─────────────────────────────────────┐
│  HEADER & BREADCRUMBS               │
├─────────────────────────────────────┤
│  SEARCH & FILTER BAR                │
│  ┌─────────────────────────────────┐│
│  │ [Search] [Category ▼] [Type ▼]  ││
│  │ [Price ▼] [Location ▼] [Search] ││
│  └─────────────────────────────────┘│
├─────────────────────────────────────┤
│                                     │
│  SIDEBAR (Desktop)     │  MAIN      │
│  ┌──────────────────┐  │  ┌───────┐ │
│  │ Filtres:         │  │  │       │ │
│  │ ○ Catégories    │  │  │ Card1 │ │
│  │ ○ Types         │  │  │ Card2 │ │
│  │ ○ Devises       │  │  │ Card3 │ │
│  │ ┌─ Prix ┐       │  │  │ Card4 │ │
│  │ │[50k]──[500k]│  │  │ Card5 │ │
│  │ └─────────┘       │  │ Card6 │ │
│  │ ○ Chambres       │  │       │ │
│  │ ○ Salles de bain │  │ Pag.  │ │
│  │ ○ Surface (m²)   │  └───────┘ │
│  │ [Reset] [Apply]  │            │
│  └──────────────────┘            │
│                                     │
├─────────────────────────────────────┤
│  PAGINATION & VIEW OPTIONS          │
│  [< 1 2 3 4 5 >] [Grid] [List]      │
│                                     │
└─────────────────────────────────────┘
```

#### Composants Inertia 11

```vue
<Pages/Properties/Index.vue>
├── <HeaderNav />
├── <Breadcrumbs :path="breadcrumbs" />
├── <SearchFilterBar 
│     :filters="filters"
│     @filter="handleFilter"
│   />
├── <div class="flex">
│   ├── <Sidebar
│   │     :filters="filters"
│   │     @apply-filters="applyFilters"
│   │   />
│   └── <MainContent>
│       ├── <ViewOptions
│       │     @toggle-view="toggleView"
│       │   />
│       ├── <PropertyGrid
│       │     :properties="properties.data"
│       │     :view-mode="viewMode"
│       │   >
│       │   └── v-for PropertyCard
│       │       └── <PropertyCard />
│       ├── <PropertyList
│       │     v-if="viewMode === 'list'"
│       │     :properties="properties.data"
│       │   >
│       │   └── v-for PropertyRow
│       └── <Pagination
│             :data="properties"
│             @page-changed="changePage"
│           />
└── <Footer />
```

#### Champs Filtrables

| Champ | Type | Options | Comportement |
|-------|------|---------|--------------|
| **Recherche Texte** | Text Input | - | Cherche dans name, description |
| **Catégorie** | Select | Vente, Location | Single/Multi select |
| **Type** | Select | Apartment, House, Land | Multi select |
| **Devise** | Select | USD, EUR, MAD | Single select |
| **Prix** | Range Slider | Min-Max | Double slider |
| **Chambres** | Number | 0-10+ | Min-Max |
| **Salles Bain** | Number | 0-10+ | Min-Max |
| **Surface (m²)** | Range Slider | Min-Max | Double slider |
| **Localisation** | Select/Map | Cities | Single select |

#### Variables Filtre (URL)

```
/properties?
  search=paris&
  category=1&
  type=2&
  min_price=50000&
  max_price=500000&
  bedrooms=2&
  bathrooms=1&
  min_area=100&
  max_area=200&
  city=75&
  currency=1&
  page=1&
  sort=newest&
  view=grid
```

---

### 3️⃣ PAGE: Détail de Propriété

#### Structure

```
┌──────────────────────────────────────┐
│  BREADCRUMBS                         │
│  Home > Properties > [Category] > X  │
├──────────────────────────────────────┤
│                                      │
│  IMAGE GALLERY (Large)               │
│  [Main Image]                        │
│  [Thumb1] [Thumb2] [Thumb3] ...      │
│                                      │
├──────────────────────────────────────┤
│  PROPERTY INFO (2 colonnes)          │
│                                      │
│  LEFT:                   │  RIGHT:    │
│  ┌────────────────────┐  │ ┌────────┐│
│  │ Title: [Name]      │  │ │ Price  ││
│  │ Adresse: [Loc]     │  │ │ Type   ││
│  │ [Type] [Category]  │  │ │ Status ││
│  │                    │  │ │        ││
│  │ KEY FEATURES:      │  │ │ Bedrooms││
│  │ • 3 Bedrooms       │  │ │ Bathrooms│
│  │ • 2 Bathrooms      │  │ │ Area   ││
│  │ • 150m²            │  │ │        ││
│  │                    │  │ └────────┘│
│  │ DESCRIPTION:       │  │            │
│  │ [Long Text Content] │  │ [Contact   │
│  │                    │  │  Form]     │
│  │                    │  │            │
│  │ FEATURES:          │  │            │
│  │ ☑ Pool            │  │            │
│  │ ☑ Garage          │  │            │
│  │ ☑ AC              │  │            │
│  │                    │  │            │
│  │ FACILITIES:        │  │            │
│  │ School: 500m       │  │            │
│  │ Hospital: 1km      │  │            │
│  │ Park: 200m         │  │            │
│  │                    │  │            │
│  │ LOCATION MAP:      │  │            │
│  │ [Google Map]       │  │            │
│  │                    │  │            │
│  └────────────────────┘  │            │
│                                      │
├──────────────────────────────────────┤
│  REVIEWS & RATINGS                   │
│  Average: 4.5/5 (12 reviews)         │
│  [ReviewCard] [ReviewCard] ...       │
│  [Leave Review Button]               │
│                                      │
├──────────────────────────────────────┤
│  SIMILAR PROPERTIES                  │
│  [PropertyCard] [PropertyCard] ...    │
│                                      │
│  AGENT CARD                          │
│  [Avatar] [Name] [Contact] [Props]   │
│                                      │
└──────────────────────────────────────┘
```

#### Composants Inertia 11

```vue
<Pages/Properties/Show.vue>
├── <HeaderNav />
├── <Breadcrumbs :path="breadcrumbs" />
├── <PropertyGallery 
│     :images="property.images"
│     @image-select="selectImage"
│   />
├── <div class="flex gap-8">
│   ├── <PropertyDetails 
│   │     :property="property"
│   │     :features="property.features"
│   │     :facilities="property.facilities"
│   │   >
│   │   ├── <PropertyHeader :property="property" />
│   │   ├── <KeyFeatures :property="property" />
│   │   ├── <Description :property="property" />
│   │   ├── <FeaturesList :features="property.features" />
│   │   ├── <FacilitiesDistance :facilities="property.facilities" />
│   │   └── <PropertyMap :property="property" />
│   │
│   └── <PropertySidebar>
│       ├── <PriceCard :property="property" />
│       ├── <ConsultForm 
│       │     :property-id="property.id"
│       │     @submitted="handleConsult"
│       │   />
│       └── <AgentCard :agent="property.author" />
│
├── <ReviewsSection 
│     :reviews="reviews"
│     :property-id="property.id"
│   />
│   └── v-for ReviewCard
│
├── <SimilarProperties 
│     :properties="similarProperties"
│   />
│   └── v-for PropertyCard
│
└── <Footer />
```

#### Données

```php
// PropertyController@show($property)
return inertia('Properties/Show', [
    'property' => $property->load([
        'features', 
        'facilities', 
        'reviews.account',
        'author',
        'currency',
        'category',
        'type'
    ]),
    'reviews' => $property->reviews()->paginate(5),
    'similarProperties' => Property::where('category_id', $property->category_id)
        ->where('id', '!=', $property->id)
        ->limit(6)
        ->get(),
]);
```

---

### 4️⃣ PAGE: Formulaire Consultation

#### Formulaire Inline (Sur Détail Propriété)

```
┌─────────────────────────────────┐
│  DEMANDER UNE CONSULTATION      │
├─────────────────────────────────┤
│                                 │
│  [Nom] *                        │
│  ├─ Placeholder: "Votre nom"    │
│  └─ Validation: Required, 2-120 │
│                                 │
│  [Email] *                      │
│  ├─ Placeholder: "Votre email"  │
│  └─ Validation: Required, email │
│                                 │
│  [Message] *                    │
│  ├─ Placeholder: "Votre message"│
│  ├─ Rows: 5                     │
│  └─ Validation: Required        │
│                                 │
│  [reCAPTCHA] (optionnel)        │
│  [☐] I'm not a robot           │
│                                 │
│  [Submit Button] [Reset]        │
│  └─ Disable on submit           │
│                                 │
│  ℹ "Nous répondrons rapidement" │
│                                 │
└─────────────────────────────────┘
```

#### Composants Inertia 11

```vue
<Components/ConsultForm.vue>
<template>
  <form @submit.prevent="submit" class="consultation-form">
    <h3>Demander une Consultation</h3>
    
    <FormInput
      v-model="form.name"
      type="text"
      label="Votre Nom"
      placeholder="Ex: Jean Dupont"
      :error="form.errors.name"
      required
    />
    
    <FormInput
      v-model="form.email"
      type="email"
      label="Votre Email"
      placeholder="email@example.com"
      :error="form.errors.email"
      required
    />
    
    <FormTextarea
      v-model="form.message"
      label="Votre Message"
      placeholder="Comment pouvons-nous vous aider?"
      rows="5"
      :error="form.errors.message"
      required
    />
    
    <div v-if="enableCaptcha" class="g-recaptcha" 
         data-sitekey="YOUR_RECAPTCHA_KEY">
    </div>
    
    <button 
      type="submit" 
      :disabled="form.processing"
      class="btn btn-primary w-full"
    >
      {{ form.processing ? 'Envoi en cours...' : 'Envoyer' }}
    </button>
    
    <p class="text-sm text-gray-600 mt-2">
      ℹ️ Nous répondrons à votre demande dans les 24 heures.
    </p>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import FormInput from '@/Components/FormInput.vue'
import FormTextarea from '@/Components/FormTextarea.vue'

defineProps({
  propertyId: Number,
  enableCaptcha: Boolean,
})

const emit = defineEmits(['submitted'])

const form = useForm({
  name: '',
  email: '',
  message: '',
})

const submit = () => {
  form.post(route('public.send.consult', { property_id: propertyId }), {
    onSuccess: () => {
      form.reset()
      emit('submitted')
      alert('Consultation envoyée avec succès!')
    }
  })
}
</script>
```

#### Validation Backend

```php
// SendConsultRequest
public function rules()
{
    return [
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'message' => 'required|string',
        'property_id' => 'required|exists:re_properties,id',
    ];
}
```

---

### 5️⃣ PAGE: Authentification (Login/Register)

#### Login (Connexion Agent)

```
┌──────────────────────────────────────┐
│                                      │
│     SE CONNECTER À VOTRE COMPTE      │
│                                      │
│  [Email/Username]                   │
│  ├─ Type: email                     │
│  ├─ Placeholder: "email@example..." │
│  └─ Validation: Required            │
│                                      │
│  [Password]                         │
│  ├─ Type: password                  │
│  ├─ Placeholder: "Mot de passe"     │
│  └─ Validation: Required            │
│                                      │
│  ☐ Se souvenir de moi              │
│                                      │
│  [Se Connecter]                     │
│                                      │
│  ─────────────────────────────────  │
│                                      │
│  Pas encore inscrit?                │
│  → S'inscrire maintenant            │
│                                      │
│  Mot de passe oublié?               │
│  → Réinitialiser                    │
│                                      │
│  ─────────────────────────────────  │
│                                      │
│  [Connexion avec Google]            │
│  [Connexion avec Facebook]          │
│                                      │
└──────────────────────────────────────┘
```

#### Register (Inscription Agent)

```
┌──────────────────────────────────────┐
│                                      │
│     CRÉER UN NOUVEAU COMPTE          │
│                                      │
│  [Prénom] *                        │
│  ├─ Placeholder: "Jean"            │
│  └─ Validation: 2-120, Required   │
│                                      │
│  [Nom] *                           │
│  ├─ Placeholder: "Dupont"          │
│  └─ Validation: 2-120, Required   │
│                                      │
│  [Nom d'utilisateur] *             │
│  ├─ Placeholder: "jeandupont"      │
│  └─ Validation: 2-60, Unique      │
│                                      │
│  [Email] *                         │
│  ├─ Placeholder: "email@example"   │
│  └─ Validation: Email, Unique     │
│                                      │
│  [Mot de passe] *                  │
│  ├─ Placeholder: "●●●●●●●●"        │
│  └─ Validation: Min 6              │
│                                      │
│  [Confirmer mot de passe] *        │
│  ├─ Placeholder: "●●●●●●●●"        │
│  └─ Validation: Match password    │
│                                      │
│  ☐ J'accepte les CGU              │
│                                      │
│  [S'inscrire]                      │
│                                      │
│  ─────────────────────────────────  │
│                                      │
│  Vous avez déjà un compte?         │
│  → Se connecter                    │
│                                      │
└──────────────────────────────────────┘
```

#### Composants Inertia 11

```vue
<Pages/Auth/Login.vue>
<template>
  <GuestLayout>
    <div class="auth-container">
      <div class="auth-card">
        <h2 class="text-2xl font-bold mb-6">Se Connecter à Votre Compte</h2>
        
        <form @submit.prevent="submit">
          <FormInput
            v-model="form.email"
            type="email"
            label="Email ou Nom d'utilisateur"
            placeholder="email@example.com"
            :error="form.errors.email"
            required
          />
          
          <FormInput
            v-model="form.password"
            type="password"
            label="Mot de passe"
            placeholder="Votre mot de passe"
            :error="form.errors.password"
            required
          />
          
          <div class="flex items-center justify-between mb-6">
            <label class="flex items-center">
              <input type="checkbox" class="mr-2" />
              <span class="text-sm">Se souvenir de moi</span>
            </label>
            <Link href={route('public.account.password.request')} class="text-sm text-blue-600 hover:underline">
              Mot de passe oublié?
            </Link>
          </div>
          
          <button 
            type="submit" 
            :disabled="form.processing"
            class="w-full btn btn-primary mb-4"
          >
            {{ form.processing ? 'Connexion en cours...' : 'Se Connecter' }}
          </button>
        </form>
        
        <div class="divider mb-4">OU</div>
        
        <div class="social-login space-y-2">
          <button class="w-full btn btn-outline-google">
            <GoogleIcon class="w-5 h-5 mr-2" />
            Connexion avec Google
          </button>
          <button class="w-full btn btn-outline-facebook">
            <FacebookIcon class="w-5 h-5 mr-2" />
            Connexion avec Facebook
          </button>
        </div>
        
        <div class="text-center mt-6">
          <p class="text-sm">
            Pas encore inscrit?
            <Link 
              href={route('public.account.register')} 
              class="text-blue-600 font-semibold hover:underline"
            >
              S'inscrire maintenant
            </Link>
          </p>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import FormInput from '@/Components/FormInput.vue'

const form = useForm({
  email: '',
  password: '',
})

const submit = () => {
  form.post(route('public.account.login.post'))
}
</script>
```

---

### 6️⃣ PAGE: Compte Agent (Dashboard)

#### Dashboard Vue Générale

```
┌──────────────────────────────────────┐
│  HEADER NAVIGATION (Account)         │
├──────────────────────────────────────┤
│                                      │
│  SIDEBAR (Desktop)      │  MAIN      │
│  ┌────────────────────┐ │ ┌────────┐│
│  │ [Avatar] [Name]    │ │ │        ││
│  │ [Role: Agent]      │ │ │Welcome ││
│  │                    │ │ │ Dashboard ││
│  │ Dashboard          │ │ │        ││
│  │ My Properties      │ │ │ Stats: ││
│  │ Create Property    │ │ │ • 10 Props││
│  │ Consultations  (3) │ │ │ • 25 Views ││
│  │ Packages           │ │ │ • 5 Reqs   ││
│  │ Transactions       │ │ │        ││
│  │ Profile Settings   │ │ │ Quick Links││
│  │ Security           │ │ │ • New Prop ││
│  │ Logout             │ │ │ • Messages ││
│  │                    │ │ │ • Packages ││
│  └────────────────────┘ │ └────────┘│
│                                      │
│  CONTENT AREA:                       │
│  [Stats Cards] [Recent Activity]     │
│                                      │
└──────────────────────────────────────┘
```

#### Mes Propriétés

```
┌──────────────────────────────────────┐
│  MES PROPRIÉTÉS                      │
├──────────────────────────────────────┤
│                                      │
│  [+] Créer une Nouvelle Propriété    │
│                                      │
│  Filtre: [Statut ▼] [Tri ▼]          │
│                                      │
│  ┌────────────────────────────────┐  │
│  │ Property 1                     │  │
│  │ ┌──────────────────────┐       │  │
│  │ │ [Thumb Image]  5 imgs│       │  │
│  │ └──────────────────────┘       │  │
│  │                                │  │
│  │ Name: Beautiful Apartment      │  │
│  │ Price: $250,000                │  │
│  │ Status: ✓ Published            │  │
│  │ Views: 145 | Requests: 12      │  │
│  │                                │  │
│  │ Expires: 2024-12-31            │  │
│  │ [Edit] [View] [Renew] [Delete] │  │
│  │                                │  │
│  └────────────────────────────────┘  │
│                                      │
│  [< 1 2 3 >] 15 par page            │
│                                      │
└──────────────────────────────────────┘
```

#### Composants Inertia 11

```vue
<Pages/Account/Dashboard.vue>
<template>
  <AccountLayout>
    <div class="dashboard-container">
      <div class="header mb-8">
        <h1 class="text-3xl font-bold">Bienvenue, {{ account.name }}</h1>
        <p class="text-gray-600">Gérez vos propriétés et consultations</p>
      </div>
      
      <!-- Statistics Cards -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <StatCard
          title="Propriétés"
          :value="stats.properties"
          icon="building"
          :link="route('public.account.properties.index')"
        />
        <StatCard
          title="Consultations"
          :value="stats.consultations"
          icon="envelope"
          :link="route('public.account.consultations')"
        />
        <StatCard
          title="Crédits"
          :value="stats.credits"
          icon="coins"
          :link="route('public.account.packages')"
        />
        <StatCard
          title="Avis"
          :value="stats.reviews"
          icon="star"
        />
      </div>
      
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Properties -->
        <div class="lg:col-span-2">
          <div class="card">
            <div class="card-header flex justify-between items-center">
              <h2 class="text-xl font-bold">Mes Propriétés Récentes</h2>
              <Link href={route('public.account.properties.create')} class="btn btn-primary btn-sm">
                + Créer
              </Link>
            </div>
            
            <div class="property-list space-y-4">
              <PropertyListItem
                v-for="property in recentProperties"
                :key="property.id"
                :property="property"
                @edit="editProperty"
                @delete="deleteProperty"
              />
            </div>
            
            <Link 
              href={route('public.account.properties.index')} 
              class="text-blue-600 hover:underline mt-4"
            >
              Voir toutes mes propriétés →
            </Link>
          </div>
        </div>
        
        <!-- Quick Actions & Upcoming Expirations -->
        <div class="space-y-6">
          <div class="card">
            <h3 class="font-bold mb-4">Actions Rapides</h3>
            <ul class="space-y-2">
              <li>
                <Link 
                  href={route('public.account.properties.create')} 
                  class="flex items-center text-blue-600 hover:underline"
                >
                  <PlusIcon class="w-4 h-4 mr-2" />
                  Créer une propriété
                </Link>
              </li>
              <li>
                <Link 
                  href={route('public.account.packages')} 
                  class="flex items-center text-blue-600 hover:underline"
                >
                  <ShoppingIcon class="w-4 h-4 mr-2" />
                  Acheter des crédits
                </Link>
              </li>
              <li>
                <Link 
                  href={route('public.account.settings')} 
                  class="flex items-center text-blue-600 hover:underline"
                >
                  <CogIcon class="w-4 h-4 mr-2" />
                  Paramètres du compte
                </Link>
              </li>
            </ul>
          </div>
          
          <div class="card">
            <h3 class="font-bold mb-4">Expiration Prochain</h3>
            <div v-if="expiringProperties.length" class="space-y-2">
              <div 
                v-for="property in expiringProperties" 
                :key="property.id"
                class="text-sm border-l-4 border-orange-500 pl-2"
              >
                <p class="font-semibold">{{ property.name }}</p>
                <p class="text-gray-600">
                  {{ property.expire_date }}
                </p>
              </div>
            </div>
            <div v-else class="text-gray-600">
              Aucune propriété n'expire bientôt
            </div>
          </div>
        </div>
      </div>
    </div>
  </AccountLayout>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import AccountLayout from '@/Layouts/AccountLayout.vue'

const { account } = usePage().props
defineProps({
  stats: Object,
  recentProperties: Array,
  expiringProperties: Array,
})
</script>
```

---

## Formulaires et Champs

### Résumé de Tous les Formulaires

#### 1. LOGIN FORM

| Champ | Type | Validation | Placeholder |
|-------|------|------------|-------------|
| Email | Text/Email | Required, string | email@example.com |
| Password | Password | Required, string | Mot de passe |

#### 2. REGISTER FORM

| Champ | Type | Validation | Placeholder |
|-------|------|------------|-------------|
| First Name | Text | Required, 2-120 | Jean |
| Last Name | Text | Required, 2-120 | Dupont |
| Username | Text | Required, 2-60, Unique | jeandupont |
| Email | Email | Required, Email, Unique | email@example.com |
| Password | Password | Required, Min 6, Confirmed | ●●●●●●●● |
| Password Confirm | Password | Required, Match | ●●●●●●●● |
| Accept Terms | Checkbox | Accepted | ☐ |

#### 3. CONSULT FORM

| Champ | Type | Validation | Notes |
|-------|------|------------|-------|
| Name | Text | Required | 255 chars max |
| Email | Email | Required, Email | Valid format |
| Message | Textarea | Required | Peut avoir HTML |
| reCAPTCHA | Captcha | Optional | Si activé |
| Property ID | Hidden | Required, Exists | Auto-filled |

#### 4. REVIEW FORM

| Champ | Type | Validation | Notes |
|-------|------|------------|-------|
| Rating | Star Rating | Required, 1-5 | Visual stars |
| Comment | Textarea | Required, Max 1000 | Long form |
| Property ID | Hidden | Required, Exists | Auto-filled |

#### 5. PROPERTY CREATION/EDIT FORM

| Champ | Type | Validation | Section |
|-------|------|------------|---------|
| **GENERAL** |
| Name | Text | Required | Basic Info |
| Description | Textarea | Max 350 | Basic Info |
| Content | RichEditor | Required | Basic Info |
| **DETAILS** |
| Category | Select | Required | Details |
| Type | Select | Required | Details |
| Currency | Select | Required | Details |
| Price | Number | Numeric, Min 0 | Details |
| Period | Select | month/day/year/buy | Details |
| **FEATURES** |
| Bedrooms | Number | Numeric, 0-10000 | Features |
| Bathrooms | Number | Numeric, 0-10000 | Features |
| Floors | Number | Numeric, 0-10000 | Features |
| Area (m²) | Number | Numeric, Min 0 | Features |
| **LOCATION** |
| Location Text | Text | - | Location |
| City | Select | - | Location |
| Latitude | Text | Max 20 | Location |
| Longitude | Text | Max 20 | Location |
| **IMAGES** |
| Gallery | File Upload | Images only | Media |
| Featured Image | File Upload | Image only | Media |
| **EXTRAS** |
| Features | Multi-Select | - | Amenities |
| Facilities | Multi-Select | - | Amenities |
| Expiry Date | Date | - | Settings |
| Auto Renew | Toggle | Boolean | Settings |
| Never Expire | Toggle | Boolean | Settings |
| Status | Select | pending/published | Settings |

#### 6. ACCOUNT SETTINGS FORM

| Champ | Type | Validation | Section |
|-------|------|------------|---------|
| **PROFILE** |
| First Name | Text | Required, 2-120 | Profile |
| Last Name | Text | Required, 2-120 | Profile |
| Username | Text | Required, 2-60, Unique | Profile |
| Email | Email | Required, Email, Unique | Profile |
| Phone | Tel | Optional | Profile |
| Description | Textarea | Optional | Profile |
| Gender | Select | Optional | Profile |
| DOB | Date | Optional | Profile |
| Avatar | File Upload | Image | Profile |

#### 7. SECURITY FORM

| Champ | Type | Validation | Section |
|-------|------|------------|---------|
| Current Password | Password | Required | Password |
| New Password | Password | Required, Min 6, Confirmed | Password |
| Confirm Password | Password | Match | Password |

---

## Composants Réutilisables

### Liste des Composants Nécessaires

```vue
Components/
├── FormComponents/
│   ├── FormInput.vue              # Text/Email/Number input
│   ├── FormTextarea.vue           # Textarea
│   ├── FormSelect.vue             # Dropdown select
│   ├── FormCheckbox.vue           # Checkbox
│   ├── FormRadio.vue              # Radio buttons
│   ├── FormFileUpload.vue         # File upload
│   ├── FormDatePicker.vue         # Date picker
│   ├── FormRangeSlider.vue        # Range slider
│   ├── FormRating.vue             # Star rating
│   ├── FormRichEditor.vue         # Rich text editor
│   └── FormSearchInput.vue        # Autocomplete search
│
├── PropertyComponents/
│   ├── PropertyCard.vue           # Card affichage propriété
│   ├── PropertyList.vue           # Ligne affichage propriété
│   ├── PropertyGallery.vue        # Galerie images
│   ├── PropertyDetails.vue        # Détails propriété
│   ├── PropertyMap.vue            # Carte propriété
│   ├── PropertyFilter.vue         # Filtres propriétés
│   ├── PropertyStats.vue          # Statistiques propriété
│   └── PropertyCompare.vue        # Comparaison propriétés
│
├── ReviewComponents/
│   ├── ReviewCard.vue             # Affichage avis
│   ├── ReviewForm.vue             # Formulaire avis
│   ├── RatingStars.vue            # Étoiles notation
│   └── ReviewList.vue             # Liste avis
│
├── NavigationComponents/
│   ├── Header.vue                 # En-tête
│   ├── Navigation.vue             # Menu principal
│   ├── Breadcrumbs.vue            # Chemin navigation
│   ├── Pagination.vue             # Pagination
│   ├── Sidebar.vue                # Barre latérale
│   ├── Footer.vue                 # Pied de page
│   └── MobileMenu.vue             # Menu mobile
│
├── UIComponents/
│   ├── Button.vue                 # Bouton
│   ├── Alert.vue                  # Message alerte
│   ├── Modal.vue                  # Fenêtre modale
│   ├── Tooltip.vue                # Infobulle
│   ├── Badge.vue                  # Badge
│   ├── LoadingSpinner.vue         # Indicateur chargement
│   ├── Empty.vue                  # État vide
│   ├── Error.vue                  # État erreur
│   └── Success.vue                # État succès
│
├── MediaComponents/
│   ├── ImageGallery.vue           # Galerie images
│   ├── VideoPlayer.vue            # Lecteur vidéo
│   ├── Lightbox.vue               # Lightbox images
│   └── ImageUpload.vue            # Upload image
│
├── LayoutComponents/
│   ├── Container.vue              # Container wrapper
│   ├── Grid.vue                   # Grille layout
│   ├── Flex.vue                   # Flex layout
│   ├── Section.vue                # Section layout
│   └── Card.vue                   # Card container
│
├── AgentComponents/
│   ├── AgentCard.vue              # Affichage agent
│   ├── AgentBio.vue               # Bio agent
│   ├── AgentContact.vue           # Contact agent
│   └── AgentProperties.vue        # Propriétés agent
│
└── BlogComponents/
    ├── BlogCard.vue               # Card article
    ├── BlogList.vue               # Liste articles
    ├── BlogContent.vue            # Contenu article
    ├── BlogSidebar.vue            # Sidebar blog
    └── BlogComments.vue           # Commentaires
```

### Exemple: FormInput Component

```vue
<template>
  <div class="form-group">
    <label v-if="label" :for="id" class="form-label">
      {{ label }}
      <span v-if="required" class="text-red-500">*</span>
    </label>
    
    <input
      :id="id"
      :type="type"
      :value="modelValue"
      :placeholder="placeholder"
      :disabled="disabled"
      :required="required"
      @input="$emit('update:modelValue', $event.target.value)"
      class="form-control"
      :class="{ 'is-invalid': error }"
    />
    
    <small v-if="error" class="text-red-500 block mt-1">
      {{ error }}
    </small>
    <small v-if="hint" class="text-gray-500 block mt-1">
      {{ hint }}
    </small>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  modelValue: [String, Number],
  type: {
    type: String,
    default: 'text'
  },
  label: String,
  placeholder: String,
  error: String,
  hint: String,
  required: Boolean,
  disabled: Boolean,
})

const id = computed(() => props.label?.toLowerCase().replace(/\s+/g, '-') || 'input')

defineEmits(['update:modelValue'])
</script>

<style scoped>
.form-group {
  margin-bottom: 1rem;
}

.form-label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: #333;
}

.form-control {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 1rem;
  transition: border-color 0.3s;
}

.form-control:focus {
  outline: none;
  border-color: #0066cc;
  box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
}

.form-control.is-invalid {
  border-color: #f44336;
}

.form-control:disabled {
  background-color: #f5f5f5;
  cursor: not-allowed;
}
</style>
```

---

## Routes Publiques

### Mapping des Routes

```php
// Routes Publiques Principales
GET    /                                    // Accueil
GET    /properties                          // Liste propriétés
GET    /properties/{slug}                   // Détail propriété
GET    /property-category/{slug}            // Catégorie propriétés

GET    /blog                                // Liste articles
GET    /blog/{slug}                         // Détail article
GET    /blog/category/{slug}                // Catégorie blog

GET    /agents                              // Liste agents
GET    /agents/{slug}                       // Profil agent

GET    /contact                             // Formulaire contact
POST   /contact                             // Soumission contact

GET    /search                              // Recherche globale
GET    /feed/properties                     // Flux RSS

// Routes Authentification
GET    /login                               // Formulaire login
POST   /login                               // Soumission login
GET    /register                            // Formulaire register
POST   /register                            // Soumission register
GET    /register/verify                     // Page vérification
GET    /register/confirm/{token}            // Confirmation email
GET    /register/confirm/resend             // Renvoyer email

GET    /password/request                    // Mot de passe oublié
POST   /password/email                      // Envoi reset email
GET    /password/reset/{token}              // Formulaire reset
POST   /password/reset                      // Soumission reset

// Routes Compte Agent (Authentifié)
GET    /account/dashboard                   // Dashboard
GET    /account/settings                    // Paramètres
POST   /account/settings                    // Mise à jour paramètres
GET    /account/security                    // Sécurité
PUT    /account/security                    // Mise à jour sécurité
POST   /account/avatar                      // Upload avatar

GET    /account/packages                    // Mes forfaits
GET    /account/packages/{id}/subscribe     // Détail forfait
GET    /account/packages/{id}/subscribe/callback // Callback paiement

GET    /account/properties                  // Mes propriétés
GET    /account/properties/create           // Créer propriété
POST   /account/properties                  // Stocker propriété
GET    /account/properties/{id}/edit        // Éditer propriété
PUT    /account/properties/{id}             // Mettre à jour propriété
DELETE /account/properties/{id}             // Supprimer propriété
POST   /account/properties/{id}/renew       // Renouveler

GET    /account/transactions                // Mes transactions

POST   /logout                              // Déconnexion

POST   /send-consult                        // Envoi consultation
GET    /currency/switch/{code}              // Changer devise

// Routes AJAX (Account)
GET    /account/ajax/activity-logs          // Logs activité
GET    /account/ajax/transactions           // Transactions (AJAX)
POST   /account/ajax/upload                 // Upload fichier
POST   /account/ajax/upload-from-editor     // Upload éditeur
GET    /account/ajax/packages               // Packages (AJAX)
PUT    /account/ajax/packages               // Subscribe package
```

---

## Intégration Inertia 11

### Configuration Nécessaire

#### 1. app.js

```javascript
import './bootstrap'
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import Layout from './Layouts/AppLayout.vue'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Essentiel-Immo'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(
        `./Pages/${name}.vue`,
        import.meta.glob('./Pages/**/*.vue'),
    ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
    progress: {
        color: '#0066CC',
    },
})
```

#### 2. Middleware Inertia

```php
// app/Http/Middleware/HandleInertiaRequests.php
public function share(Request $request): array
{
    return array_merge(parent::share($request), [
        'auth' => [
            'user' => Auth::check() ? Auth::user() : null,
            'account' => Auth::guard('account')->check() 
                ? Auth::guard('account')->user() 
                : null,
        ],
        'flash' => [
            'success' => $request->session()->get('success'),
            'error' => $request->session()->get('error'),
        ],
        'settings' => [
            'enable_captcha' => setting('enable_captcha'),
            'currency' => setting('currency_default'),
            'site_name' => setting('site_name'),
        ],
        'languages' => Language::active()->pluck('name', 'locale')->toArray(),
    ]);
}
```

#### 3. Controllers Inertia

```php
// PropertyController@index()
public function index(Request $request)
{
    $filters = $request->query();
    
    $properties = $this->propertyRepository
        ->with(['features', 'facilities', 'currency', 'type', 'category'])
        ->when($filters['search'] ?? null, function ($q, $search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        })
        ->when($filters['category'] ?? null, fn($q) => $q->where('category_id', $filters['category']))
        ->when($filters['type'] ?? null, fn($q) => $q->where('type_id', $filters['type']))
        ->when($filters['min_price'] ?? null, fn($q) => $q->where('price', '>=', $filters['min_price']))
        ->when($filters['max_price'] ?? null, fn($q) => $q->where('price', '<=', $filters['max_price']))
        ->paginate(15);

    return inertia('Properties/Index', [
        'properties' => $properties,
        'filters' => $filters,
        'categories' => Category::all(),
        'types' => Type::all(),
        'currencies' => Currency::all(),
    ]);
}
```

---

## Structure des Fichiers

### Arborescence Complète Inertia

```
resources/js/
│
├── app.js                               # Entry point
├── bootstrap.js                         # Bootstrap config
│
├── Components/
│   ├── FormComponents/
│   │   ├── FormInput.vue
│   │   ├── FormTextarea.vue
│   │   ├── FormSelect.vue
│   │   ├── FormCheckbox.vue
│   │   ├── FormFileUpload.vue
│   │   ├── FormRichEditor.vue
│   │   └── FormRating.vue
│   │
│   ├── PropertyComponents/
│   │   ├── PropertyCard.vue
│   │   ├── PropertyGallery.vue
│   │   ├── PropertyFilter.vue
│   │   └── PropertyMap.vue
│   │
│   ├── ReviewComponents/
│   │   ├── ReviewCard.vue
│   │   ├── ReviewForm.vue
│   │   └── RatingStars.vue
│   │
│   ├── UIComponents/
│   │   ├── Button.vue
│   │   ├── Alert.vue
│   │   ├── Modal.vue
│   │   ├── LoadingSpinner.vue
│   │   ├── Pagination.vue
│   │   └── Badge.vue
│   │
│   ├── LayoutComponents/
│   │   ├── Header.vue
│   │   ├── Navigation.vue
│   │   ├── Footer.vue
│   │   ├── Breadcrumbs.vue
│   │   └── Sidebar.vue
│   │
│   └── BlogComponents/
│       ├── BlogCard.vue
│       ├── BlogList.vue
│       └── BlogSidebar.vue
│
├── Layouts/
│   ├── AppLayout.vue                    # Layout principal
│   ├── GuestLayout.vue                  # Layout visiteur
│   ├── AccountLayout.vue                # Layout compte
│   └── ErrorLayout.vue                  # Layout erreurs
│
├── Pages/
│   ├── Home.vue                         # Accueil
│   ├── Properties/
│   │   ├── Index.vue                    # Liste
│   │   ├── Show.vue                     # Détail
│   │   ├── Category.vue                 # Catégorie
│   │   └── Search.vue                   # Recherche
│   ├── Blog/
│   │   ├── Index.vue
│   │   └── Show.vue
│   ├── Agents/
│   │   ├── Index.vue
│   │   └── Show.vue
│   ├── Contact/
│   │   └── Index.vue
│   ├── Auth/
│   │   ├── Login.vue
│   │   ├── Register.vue
│   │   ├── ForgotPassword.vue
│   │   └── ResetPassword.vue
│   ├── Account/
│   │   ├── Dashboard.vue
│   │   ├── Settings.vue
│   │   ├── Security.vue
│   │   ├── Packages.vue
│   │   ├── Transactions.vue
│   │   └── Properties/
│   │       ├── Index.vue
│   │       ├── Create.vue
│   │       └── Edit.vue
│   └── Errors/
│       ├── NotFound.vue
│       ├── Unauthorized.vue
│       └── Error.vue
│
├── Stores/
│   ├── AuthStore.js                    # Pinia auth
│   ├── PropertyStore.js                # Pinia properties
│   ├── FilterStore.js                  # Pinia filters
│   └── UIStore.js                      # Pinia UI
│
├── Composables/
│   ├── useAuth.js
│   ├── useProperty.js
│   ├── useForm.js
│   ├── useFilters.js
│   └── usePagination.js
│
├── Utils/
│   ├── formatters.js                   # Formatage (prix, dates)
│   ├── validators.js                   # Validation
│   ├── helpers.js                      # Helpers
│   ├── constants.js                    # Constantes
│   └── api.js                          # Appels API
│
└── Styles/
    ├── tailwind.css                    # Tailwind imports
    ├── global.css                      # Styles globaux
    ├── components.css                  # Styles composants
    ├── layout.css                      # Styles layouts
    └── responsive.css                  # Responsive styles
```

---

## Design Tokens

### Colors

```css
:root {
  /* Primary */
  --primary-50: #E3F2FD;
  --primary-100: #BBDEFB;
  --primary-500: #0066CC;
  --primary-700: #004399;
  --primary-900: #001A4D;

  /* Secondary */
  --secondary-500: #4CAF50;
  --secondary-700: #388E3C;

  /* Semantic */
  --success: #27AE60;
  --warning: #FF9800;
  --error: #F44336;
  --info: #2196F3;

  /* Neutral */
  --gray-50: #F9FAFB;
  --gray-100: #F3F4F6;
  --gray-300: #D1D5DB;
  --gray-500: #6B7280;
  --gray-700: #374151;
  --gray-900: #111827;

  /* Spacing */
  --spacing-xs: 4px;
  --spacing-sm: 8px;
  --spacing-md: 16px;
  --spacing-lg: 24px;
  --spacing-xl: 32px;

  /* Typography */
  --font-family-base: 'Roboto', sans-serif;
  --font-size-base: 14px;
  --font-size-lg: 16px;
  --font-size-xl: 18px;
  --line-height-base: 1.5;

  /* Border Radius */
  --radius-sm: 4px;
  --radius-md: 8px;
  --radius-lg: 12px;

  /* Shadows */
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}
```

---

## Responsive & Mobile

### Breakpoints

```css
Mobile:    max-width: 576px
Tablet:    576px to 768px
Desktop:   768px to 992px
Large:     992px to 1200px
X-Large:   1200px+
```

### Mobile-First Approach

```vue
<!-- Propriétés principales (toujours visibles) -->
<div class="block md:hidden">
  <!-- Mobile navigation -->
</div>

<!-- Menu desktop (caché sur mobile) -->
<div class="hidden md:block">
  <!-- Desktop navigation -->
</div>

<!-- Grille responsive -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
  <!-- Responsive cards -->
</div>
```

### Performance Optimisations

```vue
<!-- Lazy loading images -->
<img 
  :src="property.image_url" 
  loading="lazy"
  alt="Property"
/>

<!-- Lazy loading composants -->
<Suspense>
  <template #default>
    <PropertyGallery :property="property" />
  </template>
  <template #fallback>
    <LoadingSpinner />
  </template>
</Suspense>

<!-- Virtual scrolling pour longs lists -->
<VirtualList
  :items="properties"
  :item-height="300"
>
  <template #default="{ item }">
    <PropertyCard :property="item" />
  </template>
</VirtualList>
```

---

## Performance Frontend

### Optimisations Clés

1. **Image Optimization**
   - Lazy loading
   - Responsive images (srcset)
   - WebP format
   - CDN delivery

2. **Code Splitting**
   - Route-based splitting
   - Component-based splitting
   - Lazy imports

3. **Caching**
   - Service Worker
   - Cache API
   - LocalStorage for filters

4. **Bundling**
   - Minification
   - Tree-shaking
   - Compression (gzip/brotli)

5. **Rendering**
   - Virtual scrolling
   - Intersection Observer
   - RequestAnimationFrame

### Lighthouse Targets

- Performance: 90+
- Accessibility: 90+
- Best Practices: 90+
- SEO: 95+
- PWA: 90+

---

## Résumé Complet

### Pages Publiques Clés
- ✅ Accueil (Hero + Featured)
- ✅ Liste propriétés (Avec filtres avancés)
- ✅ Détail propriété (Gallery + Reviews + Map)
- ✅ Formulaire consultation
- ✅ Login/Register
- ✅ Dashboard agent
- ✅ Mes propriétés (CRUD)
- ✅ Blog
- ✅ Agents/Profils
- ✅ Contact

### Formulaires Documentés
- ✅ 7 formulaires principaux
- ✅ Tous les champs listés
- ✅ Validations complètes
- ✅ Messages d'erreur

### Composants Créés
- ✅ 50+ composants réutilisables
- ✅ Système de design unifié
- ✅ Responsive par défaut
- ✅ Accessibility ready

### Design System
- ✅ Palette de couleurs
- ✅ Typographie complète
- ✅ Espacement/Shadows
- ✅ Composants UI

### Routes Documentées
- ✅ 40+ routes publiques
- ✅ Authentification
- ✅ Account management
- ✅ CRUD propriétés

---

**Dernière mise à jour**: Novembre 2025  
**Version Analyse**: 1.0  
**Statut**: Analyse complète public + design finalisée

