# Guide de Migration: Laravel 8 → Laravel Inertia 11

## 📋 Table des Matières
1. [Vue d'Ensemble](#vue-densemble)
2. [Prérequis](#prérequis)
3. [Différences Principales](#différences-principales)
4. [Plan de Migration](#plan-de-migration)
5. [Installation et Configuration](#installation-et-configuration)
6. [Refactorisation de l'Architecture](#refactorisation-de-larchitecture)
7. [Migration des Contrôleurs](#migration-des-contrôleurs)
8. [Migration des Vues](#migration-des-vues)
9. [Configuration des Routes](#configuration-des-routes)
10. [Authentification avec Inertia](#authentification-avec-inertia)
11. [Gestion du State Global](#gestion-du-state-global)
12. [API et Middleware](#api-et-middleware)
13. [Tests et Validation](#tests-et-validation)
14. [Checklist de Migration](#checklist-de-migration)
15. [Dépannage](#dépannage)

---

## Vue d'Ensemble

### Qu'est-ce qu'Inertia.js?

Inertia.js est une librairie qui vous permet de construire des applications web entièrement monolithiques en utilisant des frameworks frontend classiques (Vue, React, Svelte) sans avoir besoin de construire une API REST separate.

**Caractéristiques principales**:
- Supprime la frontière entre backend et frontend
- Partage de code entres serveur et client
- Pas d'API REST à maintenir
- SPA-like experience
- Laravel conserve la gestion du routing et de la logique métier

### Avantages de la Migration

| Aspect | Laravel 8 + Blade | Laravel Inertia 11 |
|--------|------------------|-------------------|
| **Architecture** | Template engine serveur | Composants Vue/React côté client |
| **Recharges page** | Full page reloads | Navigation sans rechargement |
| **État partagé** | Sessions serveur | Props + Shared Data |
| **API** | Blade partials, AJAX | Inertia responses |
| **DX** | Blade syntax | Vue.js/React components |
| **Performance** | Pages statiques | SPA-like performance |
| **SEO** | Natif | Adapter SSR (optionnel) |
| **Mobile Apps** | Impossible | API compatible |

---

## Prérequis

### Versions Requises
```
PHP: ^8.1
Laravel: 11.x
Node.js: 18.x ou supérieur
npm: 9.x ou supérieur
```

### Connaissance Requise
- ✅ Laravel 8+ (déjà maîtrisé)
- ✅ Vue.js 3 (déjà utilisé dans le projet)
- ✅ Composants Vue
- ✅ Props et Emit
- ✅ Lifecycle hooks
- ✅ Composable/Hooks
- ✅ JavaScript moderne (ES6+)
- ✅ npm/webpack (déjà utilisé)

### État Initial du Projet
- Laravel 8.12
- Vue.js 3.5 (déjà partiellement utilisé)
- Blade pour les vues
- Mix/Webpack pour les assets
- Botble CMS Plugin-based

---

## Différences Principales

### Structure des Réponses

#### ❌ Avant (Laravel 8 + Blade)
```php
// routes/web.php
Route::get('/properties', 'PropertyController@index');

// Controllers/PropertyController.php
public function index()
{
    $properties = Property::paginate(15);
    return view('properties.index', ['properties' => $properties]);
}

// resources/views/properties/index.blade.php
@extends('layouts.app')
@section('content')
    @foreach($properties as $property)
        <div class="property-card">{{ $property->name }}</div>
    @endforeach
@endsection
```

#### ✅ Après (Inertia 11)
```php
// routes/web.php
Route::get('/properties', [PropertyController::class, 'index']);

// Controllers/PropertyController.php
public function index()
{
    $properties = Property::paginate(15);
    return inertia('Properties/Index', [
        'properties' => $properties,
    ]);
}

// resources/js/Pages/Properties/Index.vue
<template>
  <div>
    <PropertyCard 
      v-for="property in properties.data" 
      :key="property.id" 
      :property="property" 
    />
  </div>
</template>

<script setup>
defineProps({
  properties: Object,
})
</script>
```

### Gestion de l'État

#### ❌ Avant
```php
// Session serveur
session()->put('user_id', 123);

// Blade
<p>{{ auth()->user()->name }}</p>
```

#### ✅ Après
```php
// Shared data (envioyé à chaque réponse)
Inertia::share([
    'auth' => [
        'user' => auth()->user(),
    ],
]);

// Vue.js (accès via usePage composable)
<script setup>
import { usePage } from '@inertiajs/vue3'

const { auth } = usePage().props
</script>
```

### Formulaires et Soumissions

#### ❌ Avant
```javascript
// AJAX avec jQuery
$.ajax({
    url: '/api/properties',
    method: 'POST',
    data: formData,
    success: () => location.reload()
});
```

#### ✅ Après
```vue
<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: '',
    price: '',
})

const submit = () => {
    form.post('/properties', {
        onSuccess: () => {
            // Form reset automatique
        }
    })
}
</script>

<template>
    <form @submit.prevent="submit">
        <input v-model="form.name" />
        <span v-if="form.errors.name">{{ form.errors.name }}</span>
        <button :disabled="form.processing">Soumettre</button>
    </form>
</template>
```

---

## Plan de Migration

### Phase 1: Préparation (Semaine 1)
- [ ] Mise à jour vers Laravel 11
- [ ] Installation d'Inertia.js
- [ ] Configuration de Vite
- [ ] Setup initiale
- [ ] Tests pour vérifier que tout fonctionne

### Phase 2: Migration du Layout (Semaine 2)
- [ ] Convertir le layout principal
- [ ] Créer composants partagés
- [ ] Configurer le shared data
- [ ] Adapter la navigation

### Phase 3: Migration des Pages Admin (Semaine 3-4)
- [ ] Convertir les pages CRUD
- [ ] Remplacer les formulaires
- [ ] Adapter les tables de données
- [ ] Tester les validations

### Phase 4: Migration du Frontend (Semaine 5-6)
- [ ] Convertir les pages publiques
- [ ] Adapter le système de filtre
- [ ] Convertir les listes de propriétés
- [ ] Adapter les détails de propriété

### Phase 5: Fonctionnalités Avancées (Semaine 7-8)
- [ ] Authentification agent
- [ ] Dashboard agent
- [ ] Gestion des propriétés
- [ ] Gestion des consultations

### Phase 6: Testing & Déploiement (Semaine 9-10)
- [ ] Tests unitaires
- [ ] Tests d'intégration
- [ ] Tests de charge
- [ ] Déploiement staging
- [ ] Déploiement production

**Durée Estimée**: 8-10 semaines

---

## Installation et Configuration

### Étape 1: Mise à Jour de Laravel

```bash
# Mettre à jour Laravel vers 11
composer require laravel/framework:^11.0

# Publier les fichiers de configuration si besoin
php artisan vendor:publish --provider="Illuminate\Foundation\Providers\FrameworkServiceProvider"

# Exécuter les migrations
php artisan migrate
```

### Étape 2: Installation d'Inertia.js

```bash
# Installer le package Laravel
composer require inertiajs/inertia-laravel

# Installer le package client Vue
npm install @inertiajs/vue3 vue

# Publier la configuration
php artisan inertia:install vue
```

Cela crée automatiquement:
- `config/inertia.php` - Configuration Inertia
- `resources/js/app.js` - Fichier d'entrée Vue
- `resources/js/Pages/` - Dossier pour les pages

### Étape 3: Configuration de Vite

Laravel 11 utilise Vite par défaut. Vérifier `vite.config.js`:

```javascript
import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
})
```

### Étape 4: Middleware Inertia

Ajouter le middleware Inertia dans `app/Http/Kernel.php`:

```php
protected $middlewareGroups = [
    'web' => [
        // ... autres middlewares
        \Inertia\Middleware::class,
    ],
];
```

### Étape 5: Créer le Layout Principal

**resources/js/Layouts/AppLayout.vue**:
```vue
<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
      <div class="container mx-auto px-4">
        <div class="flex justify-between h-16">
          <Link href="/" class="flex items-center">
            <span class="font-bold text-xl">Essentiel-Immo</span>
          </Link>
          <div class="flex items-center space-x-4">
            <Link href="/properties">Propriétés</Link>
            <Link href="/blog">Blog</Link>
            <div v-if="auth.user">
              <Link href="/dashboard">Dashboard</Link>
              <button @click="logout">Déconnecter</button>
            </div>
            <div v-else>
              <Link href="/login">Connexion</Link>
              <Link href="/register">Inscription</Link>
            </div>
          </div>
        </div>
      </nav>
    </nav>

    <!-- Contenu -->
    <main class="container mx-auto px-4 py-8">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-16">
      <div class="container mx-auto px-4">
        <p>&copy; 2024 Essentiel-Immo. Tous droits réservés.</p>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'

const { auth } = usePage().props

const logout = async () => {
  await router.post('/logout')
}
</script>
```

### Étape 6: Configurer le Shared Data

**app/Http/Middleware/HandleInertiaRequests.php**:
```php
<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

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
                'message' => $request->session()->get('message'),
                'error' => $request->session()->get('error'),
            ],
            'ziggy' => function () {
                return array_merge((array) \Illuminate\Support\Facades\Route::current()?->parameters(), [
                    'location' => \Illuminate\Support\Facades\Request::url(),
                ]);
            },
        ]);
    }
}
```

### Étape 7: Créer la Vue App

**resources/views/app.blade.php**:
```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite('resources/js/app.js')
    @inertiaHead
</head>
<body>
    @inertia
</body>
</html>
```

### Étape 8: Configuration de l'Entry Point Vue

**resources/js/app.js**:
```javascript
import './bootstrap'
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import Layout from './Layouts/AppLayout.vue'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

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
        color: '#4B5563',
    },
})
```

### Étape 9: npm Scripts

Mettre à jour **package.json**:
```json
{
  "scripts": {
    "dev": "vite",
    "build": "vite build",
    "preview": "vite preview"
  }
}
```

### Étape 10: Démarrer le Développement

```bash
# Terminal 1: Serveur Laravel
php artisan serve

# Terminal 2: Vite dev server
npm run dev
```

---

## Refactorisation de l'Architecture

### Architecture avant (Blade)
```
routes/web.php
    ↓
Controllers/PropertyController
    ↓
Models + Repositories
    ↓
resources/views/properties/index.blade.php (rendu serveur)
    ↓
HTML envoyé au navigateur
```

### Architecture après (Inertia)
```
routes/web.php
    ↓
Controllers/PropertyController
    ↓
Models + Repositories
    ↓
inertia('Properties/Index', ['properties' => ...])
    ↓
Props en JSON au navigateur
    ↓
resources/js/Pages/Properties/Index.vue (rendu client)
    ↓
Vue.js affiche les composants
```

### Changement de Responsabilités

| Aspect | Blade | Inertia |
|--------|-------|---------|
| **Affichage de données** | Blade template | Vue component |
| **Validation** | Blade errors, artisan validate | Form.errors in Vue |
| **Navigation** | `<a href="">` ou `{{ route() }}` | `<Link href="">` |
| **Soumission formulaire** | `<form method="POST">` | `form.post()` |
| **Rechargement page** | Automatique | Gestion manuelle |
| **État côté client** | Pas vraiment | Reactive data + composables |

---

## Migration des Contrôleurs

### Template Contrôleur Inertia

```php
<?php

namespace App\Http\Controllers\RealEstate;

use Botble\RealEstate\Models\Property;
use Botble\RealEstate\Repositories\PropertyRepository;
use Inertia\Inertia;
use Inertia\Response;

class PropertyController extends Controller
{
    public function __construct(
        protected PropertyRepository $propertyRepository,
    ) {}

    /**
     * Liste des propriétés
     */
    public function index(): Response
    {
        $properties = $this->propertyRepository
            ->paginate(15)
            ->load(['features', 'facilities', 'currency', 'type', 'category']);

        return inertia('Properties/Index', [
            'properties' => $properties,
            'filters' => request()->all(['search', 'category', 'type', 'min_price', 'max_price']),
        ]);
    }

    /**
     * Détail d'une propriété
     */
    public function show(Property $property): Response
    {
        $property->load(['features', 'facilities', 'reviews', 'author']);

        return inertia('Properties/Show', [
            'property' => $property,
            'reviews' => $property->reviews()->paginate(10),
        ]);
    }

    /**
     * Créer une propriété (Admin)
     */
    public function create(): Response
    {
        return inertia('Admin/Properties/Create', [
            'categories' => $this->categoryRepository->all(),
            'types' => $this->typeRepository->all(),
            'currencies' => $this->currencyRepository->all(),
            'features' => $this->featureRepository->all(),
            'facilities' => $this->facilityRepository->all(),
        ]);
    }

    /**
     * Stocker une propriété
     */
    public function store(PropertyRequest $request)
    {
        $property = $this->propertyRepository->create(
            $request->validated()
        );

        return redirect()
            ->route('properties.show', $property)
            ->with('success', 'Propriété créée avec succès.');
    }

    /**
     * Éditer une propriété (Admin)
     */
    public function edit(Property $property): Response
    {
        return inertia('Admin/Properties/Edit', [
            'property' => $property->load(['features', 'facilities']),
            'categories' => $this->categoryRepository->all(),
            'types' => $this->typeRepository->all(),
            'currencies' => $this->currencyRepository->all(),
            'features' => $this->featureRepository->all(),
            'facilities' => $this->facilityRepository->all(),
        ]);
    }

    /**
     * Mettre à jour une propriété
     */
    public function update(Property $property, PropertyRequest $request)
    {
        $this->propertyRepository->update(
            $property->id,
            $request->validated()
        );

        return redirect()
            ->route('properties.show', $property)
            ->with('success', 'Propriété mise à jour avec succès.');
    }

    /**
     * Supprimer une propriété
     */
    public function destroy(Property $property)
    {
        $this->propertyRepository->delete($property->id);

        return redirect()
            ->route('properties.index')
            ->with('success', 'Propriété supprimée.');
    }
}
```

### Gestion des Erreurs de Validation

```php
// Le middleware Inertia gère automatiquement les erreurs
// et les renvoit au composant Vue
public function store(PropertyRequest $request)
{
    // Si la validation échoue, Inertia renvoit automatiquement
    // les erreurs avec le code 422
    $property = $this->propertyRepository->create(
        $request->validated()
    );

    return redirect()->route('properties.show', $property);
}
```

Dans le composant Vue:
```vue
<template>
    <form @submit.prevent="submit">
        <input v-model="form.name" />
        <span class="text-red-500" v-if="form.errors.name">
            {{ form.errors.name }}
        </span>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: '',
})

const submit = () => {
    form.post('/properties', {
        onSuccess: () => router.visit('/properties'),
    })
}
</script>
```

---

## Migration des Vues

### Avant: Blade
```blade
<!-- resources/views/properties/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Propriétés</h1>
    
    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}">
        <select name="category">
            <option value="">Toutes les catégories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Filtrer</button>
    </form>

    <div class="grid grid-cols-3 gap-4">
        @foreach($properties as $property)
            <div class="property-card">
                <img src="{{ $property->image_url }}" alt="{{ $property->name }}">
                <h3>{{ $property->name }}</h3>
                <p>{{ $property->price_format }}</p>
                <a href="{{ route('properties.show', $property) }}">Voir</a>
            </div>
        @endforeach
    </div>

    {{ $properties->links() }}
</div>
@endsection
```

### Après: Vue Inertia
```vue
<!-- resources/js/Pages/Properties/Index.vue -->
<template>
  <AppLayout>
    <div class="container mx-auto">
      <div class="mb-8">
        <h1 class="text-3xl font-bold mb-4">Propriétés</h1>
        
        <PropertiesFilter 
          :filters="filters"
          @search="handleSearch"
        />
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <PropertyCard 
          v-for="property in properties.data" 
          :key="property.id" 
          :property="property"
        />
      </div>

      <Pagination 
        :data="properties"
        @page-changed="handlePageChange"
      />
    </div>
  </AppLayout>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import PropertyCard from '@/Components/PropertyCard.vue'
import PropertiesFilter from '@/Components/PropertiesFilter.vue'
import Pagination from '@/Components/Pagination.vue'

defineProps({
  properties: Object,
  filters: Object,
})

const handleSearch = (newFilters) => {
  router.get('/properties', newFilters, {
    preserveState: true,
    replace: true,
  })
}

const handlePageChange = (page) => {
  handleSearch({ ...filters, page })
}
</script>
```

### Créer des Composants Réutilisables

**resources/js/Components/PropertyCard.vue**:
```vue
<template>
  <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
    <img 
      :src="property.image_url" 
      :alt="property.name"
      class="w-full h-64 object-cover"
    >
    <div class="p-4">
      <h3 class="font-bold text-lg mb-2">{{ property.name }}</h3>
      <p class="text-gray-600 text-sm mb-4">{{ property.location }}</p>
      <div class="flex justify-between items-center mb-4">
        <span class="text-2xl font-bold text-blue-600">
          {{ property.price_format }}
        </span>
        <span class="text-sm bg-gray-100 px-2 py-1 rounded">
          {{ property.type.name }}
        </span>
      </div>
      <div class="grid grid-cols-3 gap-2 mb-4 text-sm text-gray-600">
        <div>
          <span class="font-bold">{{ property.number_bedroom }}</span>
          <span>Chambres</span>
        </div>
        <div>
          <span class="font-bold">{{ property.number_bathroom }}</span>
          <span>Salles de bain</span>
        </div>
        <div>
          <span class="font-bold">{{ property.square }}</span>
          <span>m²</span>
        </div>
      </div>
      <Link 
        :href="`/properties/${property.id}`"
        class="block w-full text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
      >
        Voir plus
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  property: Object,
})
</script>
```

**resources/js/Components/PropertiesFilter.vue**:
```vue
<template>
  <form @submit.prevent="submit" class="bg-white p-6 rounded-lg shadow">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <div>
        <label class="block text-sm font-medium mb-1">Recherche</label>
        <input 
          v-model="form.search"
          type="text"
          class="w-full border rounded px-3 py-2"
          placeholder="Nom, localisation..."
        >
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Catégorie</label>
        <select v-model="form.category" class="w-full border rounded px-3 py-2">
          <option value="">Toutes les catégories</option>
          <option v-for="cat in categories" :key="cat.id" :value="cat.id">
            {{ cat.name }}
          </option>
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Type</label>
        <select v-model="form.type" class="w-full border rounded px-3 py-2">
          <option value="">Tous les types</option>
          <option v-for="type in types" :key="type.id" :value="type.id">
            {{ type.name }}
          </option>
        </select>
      </div>

      <div class="flex items-end">
        <button 
          type="submit"
          class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
        >
          Filtrer
        </button>
      </div>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

defineProps({
  filters: Object,
  categories: Array,
  types: Array,
})

const emit = defineEmits(['search'])

const form = useForm({
  search: '',
  category: '',
  type: '',
})

const submit = () => {
  emit('search', form.data())
}
</script>
```

### Tableau de Données (Data Table)

**resources/js/Components/DataTable.vue**:
```vue
<template>
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
      <thead class="bg-gray-100 border-b">
        <tr>
          <th 
            v-for="column in columns" 
            :key="column.key"
            class="px-4 py-2 text-left text-sm font-medium"
            @click="sort(column.key)"
            :class="{ 'cursor-pointer hover:bg-gray-200': column.sortable }"
          >
            {{ column.label }}
            <span v-if="sortBy === column.key">
              {{ sortDir === 'asc' ? '↑' : '↓' }}
            </span>
          </th>
          <th class="px-4 py-2 text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in data" :key="item.id" class="border-b hover:bg-gray-50">
          <td v-for="column in columns" :key="column.key" class="px-4 py-2">
            <template v-if="column.render">
              {{ column.render(item) }}
            </template>
            <template v-else>
              {{ item[column.key] }}
            </template>
          </td>
          <td class="px-4 py-2 text-right space-x-2">
            <slot name="actions" :item="item" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref } from 'vue'

defineProps({
  columns: Array,
  data: Array,
})

const emit = defineEmits(['sort'])
const sortBy = ref(null)
const sortDir = ref('asc')

const sort = (column) => {
  if (sortBy.value === column) {
    sortDir.value = sortDir.value === 'asc' ? 'desc' : 'asc'
  } else {
    sortBy.value = column
    sortDir.value = 'asc'
  }
  emit('sort', { column: sortBy.value, direction: sortDir.value })
}
</script>
```

---

## Configuration des Routes

### Avant: Routes Blade
```php
// routes/web.php
Route::get('/properties', 'PropertyController@index')->name('properties.index');
Route::get('/properties/create', 'PropertyController@create')->name('properties.create');
Route::post('/properties', 'PropertyController@store')->name('properties.store');
Route::get('/properties/{property}', 'PropertyController@show')->name('properties.show');
Route::get('/properties/{property}/edit', 'PropertyController@edit')->name('properties.edit');
Route::put('/properties/{property}', 'PropertyController@update')->name('properties.update');
Route::delete('/properties/{property}', 'PropertyController@destroy')->name('properties.destroy');
```

### Après: Routes Inertia (Exactement Identiques!)
```php
// routes/web.php
use App\Http\Controllers\RealEstate\PropertyController;

Route::prefix('properties')->group(function () {
    Route::get('/', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/create', [PropertyController::class, 'create'])->middleware('auth:account')->name('properties.create');
    Route::post('/', [PropertyController::class, 'store'])->middleware('auth:account')->name('properties.store');
    Route::get('/{property}', [PropertyController::class, 'show'])->name('properties.show');
    Route::middleware('auth:account')->group(function () {
        Route::get('/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
        Route::put('/{property}', [PropertyController::class, 'update'])->name('properties.update');
        Route::delete('/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    });
});

// Routes Admin
Route::prefix('admin')->middleware('auth:web')->group(function () {
    Route::prefix('real-estate').group(function () {
        Route::resources([
            'properties' => Admin\PropertyController::class,
            'accounts' => Admin\AccountController::class,
            'categories' => Admin\CategoryController::class,
            'types' => Admin\TypeController::class,
        ]);
    });
});
```

### Utiliser les Routes dans Vue

```vue
<template>
  <!-- Utiliser les noms de route -->
  <Link :href="route('properties.show', property.id)">
    Voir la propriété
  </Link>

  <!-- Formulaires -->
  <form @submit.prevent="submit" :action="route('properties.store')">
</template>

<script setup>
import { route } from 'ziggy-js'

const goToProperty = (id) => {
  router.get(route('properties.show', id))
}
</script>
```

Installer Ziggy pour accéder aux routes côté client:
```bash
composer require tightenco/ziggy
npm install ziggy-js
```

Ajouter à **resources/js/app.js**:
```javascript
import { ZiggyVue } from 'ziggy-js'
import { route } from 'ziggy-js'

createInertiaApp({
    // ...
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el)
    },
})

window.route = route
```

---

## Authentification avec Inertia

### Authentification Utilisateur (Admin)

```php
// app/Http/Controllers/Auth/LoginController.php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function create()
    {
        return inertia('Auth/Login');
    }

    public function store(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return back()->withErrors([
                'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function destroy()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
```

**resources/js/Pages/Auth/Login.vue**:
```vue
<template>
  <GuestLayout>
    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input 
          v-model="form.email"
          type="email"
          class="w-full border rounded px-3 py-2"
          required
        >
        <span v-if="form.errors.email" class="text-red-500 text-sm">
          {{ form.errors.email }}
        </span>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Mot de passe</label>
        <input 
          v-model="form.password"
          type="password"
          class="w-full border rounded px-3 py-2"
          required
        >
        <span v-if="form.errors.password" class="text-red-500 text-sm">
          {{ form.errors.password }}
        </span>
      </div>

      <button 
        type="submit"
        :disabled="form.processing"
        class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 disabled:opacity-50"
      >
        Connexion
      </button>
    </form>
  </GuestLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'

const form = useForm({
  email: '',
  password: '',
})

const submit = () => {
  form.post(route('login'))
}
</script>
```

### Authentification Agent (Compte Réel)

```php
// app/Http/Controllers/Account/LoginController.php
<?php

namespace App\Http\Controllers\Account;

use Botble\RealEstate\Models\Account;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function create()
    {
        return inertia('Account/Login');
    }

    public function store(LoginRequest $request)
    {
        if (!Auth::guard('account')->attempt($request->validated())) {
            return back()->withErrors([
                'email' => 'Email ou mot de passe incorrect.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('account.dashboard');
    }

    public function destroy()
    {
        Auth::guard('account')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
```

### Middleware d'Authentification

```php
// app/Http/Middleware/HandleInertiaRequests.php
public function share(Request $request): array
{
    return array_merge(parent::share($request), [
        'auth' => [
            'user' => $request->user(),
            'account' => Auth::guard('account')->user(),
        ],
        'flash' => [
            'success' => $request->session()->get('success'),
            'error' => $request->session()->get('error'),
        ],
    ]);
}
```

### Vérifier l'Authentification dans Vue

```vue
<script setup>
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const { auth } = usePage().props

const isLoggedIn = computed(() => !!auth.user)
const isAccountLoggedIn = computed(() => !!auth.account)
const user = computed(() => auth.user)
const account = computed(() => auth.account)
</script>

<template>
  <div v-if="isLoggedIn">
    <!-- Affichage pour utilisateur admin connecté -->
    Connecté comme: {{ user.name }}
  </div>
  <div v-else-if="isAccountLoggedIn">
    <!-- Affichage pour agent connecté -->
    Connecté comme agent: {{ account.name }}
  </div>
  <div v-else>
    <!-- Affichage pour visiteur non connecté -->
  </div>
</template>
```

### Composable d'Authentification

**resources/js/Composables/useAuth.js**:
```javascript
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

export const useAuth = () => {
    const { auth } = usePage().props

    const isLoggedIn = computed(() => !!auth.user)
    const isAccountLoggedIn = computed(() => !!auth.account)
    const user = computed(() => auth.user)
    const account = computed(() => auth.account)

    const logout = async () => {
        await router.post(route('logout'))
    }

    const accountLogout = async () => {
        await router.post(route('account.logout'))
    }

    return {
        isLoggedIn,
        isAccountLoggedIn,
        user,
        account,
        logout,
        accountLogout,
    }
}
```

Utilisation:
```vue
<script setup>
import { useAuth } from '@/Composables/useAuth'

const { isLoggedIn, user, logout } = useAuth()
</script>

<template>
  <div v-if="isLoggedIn">
    Hello {{ user.name }}
    <button @click="logout">Logout</button>
  </div>
</template>
```

---

## Gestion du State Global

### Store Pinia (Recommandé)

```bash
npm install pinia
```

**resources/js/Stores/PropertyStore.js**:
```javascript
import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

export const usePropertyStore = defineStore('property', () => {
    const filters = ref({
        search: '',
        category: null,
        type: null,
        min_price: null,
        max_price: null,
        page: 1,
    })

    const setFilter = (key, value) => {
        filters.value[key] = value
    }

    const clearFilters = () => {
        filters.value = {
            search: '',
            category: null,
            type: null,
            min_price: null,
            max_price: null,
            page: 1,
        }
    }

    const applyFilters = () => {
        router.get(route('properties.index'), filters.value, {
            preserveState: true,
            replace: true,
        })
    }

    return {
        filters,
        setFilter,
        clearFilters,
        applyFilters,
    }
})
```

Configuration Pinia dans **resources/js/app.js**:
```javascript
import { createPinia } from 'pinia'

const pinia = createPinia()

createInertiaApp({
    // ...
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .mount(el)
    },
})
```

### Utiliser le Store

```vue
<script setup>
import { usePropertyStore } from '@/Stores/PropertyStore'

const propertyStore = usePropertyStore()

const handleSearch = (value) => {
    propertyStore.setFilter('search', value)
    propertyStore.applyFilters()
}

const clearFilters = () => {
    propertyStore.clearFilters()
    propertyStore.applyFilters()
}
</script>

<template>
  <div>
    <input 
      :value="propertyStore.filters.search"
      @input="handleSearch"
      placeholder="Rechercher..."
    >
    <button @click="clearFilters">Réinitialiser</button>
  </div>
</template>
```

### Shared Data vs Store

| Aspect | Shared Data | Pinia Store |
|--------|------------|-------------|
| **Source** | Backend (Laravel) | Frontend (Vue) |
| **Cas d'usage** | Authentification, config globale | Filtres, état UI local |
| **Persistance** | À chaque requête | Durant la session |
| **Exemple** | `auth.user`, `settings` | `filters`, `selectedTab` |

---

## API et Middleware

### Routes API Inertia

Avec Inertia, vous n'avez pas besoin d'une API REST séparée. Les contrôleurs renvoient directement des composants Vue:

```php
// ❌ À éviter: créer une API REST séparate
Route::prefix('api')->group(function () {
    Route::get('/properties', [ApiPropertyController::class, 'index']);
    Route::post('/properties', [ApiPropertyController::class, 'store']);
});

// ✅ Préférer: Les routes normales avec Inertia
Route::get('/properties', [PropertyController::class, 'index']);
Route::post('/properties', [PropertyController::class, 'store']);
```

### Mais si vous avez besoin d'une API...

Pour les apps mobiles ou clients tiers:

```php
// routes/api.php
Route::prefix('v1')->group(function () {
    Route::post('/login', [ApiAuthController::class, 'login']);
    
    Route::middleware('auth:api')->group(function () {
        Route::get('/properties', [ApiPropertyController::class, 'index']);
        Route::post('/properties', [ApiPropertyController::class, 'store']);
    });
});

// app/Http/Controllers/Api/PropertyController.php
class PropertyController extends Controller
{
    public function index()
    {
        return response()->json($this->propertyRepository->paginate());
    }

    public function store(PropertyRequest $request)
    {
        $property = $this->propertyRepository->create($request->validated());
        return response()->json($property, 201);
    }
}
```

### Appels API côté Vue

```vue
<script setup>
import { ref } from 'vue'
import axios from 'axios'

const properties = ref([])
const loading = ref(false)

const fetchProperties = async () => {
    loading.value = true
    try {
        const response = await axios.get('/api/v1/properties')
        properties.value = response.data
    } catch (error) {
        console.error(error)
    } finally {
        loading.value = false
    }
}

const createProperty = async (data) => {
    try {
        const response = await axios.post('/api/v1/properties', data)
        properties.value.push(response.data)
    } catch (error) {
        console.error(error)
    }
}
</script>
```

### CSRF et Sécurité

Inertia s'occupe automatiquement du token CSRF. Aucune configuration supplémentaire nécessaire!

```php
// Le middleware web inclut VerifyCsrfToken
protected $middlewareGroups = [
    'web' => [
        // ...
        \App\Http\Middleware\VerifyCsrfToken::class,
    ],
];
```

Les formulaires Inertia incluent automatiquement le token:

```vue
<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: '',
})
// Le token CSRF est automatiquement inclus dans la requête
form.post('/properties')
</script>
```

---

## Tests et Validation

### Tests unitaires avec Inertia

```php
// tests/Feature/PropertyTest.php
<?php

namespace Tests\Feature;

use Botble\RealEstate\Models\Property;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    public function test_can_view_properties_list()
    {
        $properties = Property::factory(5)->create();

        $response = $this->get('/properties');

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => 
            $assert->component('Properties/Index')
                   ->has('properties.data', 5)
        );
    }

    public function test_can_view_property_detail()
    {
        $property = Property::factory()->create();

        $response = $this->get("/properties/{$property->id}");

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => 
            $assert->component('Properties/Show')
                   ->where('property.id', $property->id)
        );
    }

    public function test_authenticated_user_can_create_property()
    {
        $account = Account::factory()->create();

        $response = $this
            ->actingAs($account, 'account')
            ->post('/properties', [
                'name' => 'Test Property',
                'price' => 100000,
                'category_id' => 1,
                'type_id' => 1,
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('re_properties', [
            'name' => 'Test Property',
        ]);
    }

    public function test_validation_errors_are_returned()
    {
        $account = Account::factory()->create();

        $response = $this
            ->actingAs($account, 'account')
            ->post('/properties', []);

        $response->assertInertia(fn ($assert) => 
            $assert->hasErrors(['name', 'price', 'category_id'])
        );
    }
}
```

### Tests de Composants Vue

```javascript
// tests/unit/PropertyCard.test.js
import { describe, it, expect } from 'vitest'
import { mount } from '@vue/test-utils'
import PropertyCard from '@/Components/PropertyCard.vue'

describe('PropertyCard', () => {
    it('displays property information', () => {
        const property = {
            id: 1,
            name: 'Beautiful House',
            location: 'Paris',
            price_format: '$100,000',
            type: { name: 'House' },
            number_bedroom: 3,
            number_bathroom: 2,
            square: 150,
            image_url: '/image.jpg',
        }

        const wrapper = mount(PropertyCard, {
            props: { property },
        })

        expect(wrapper.text()).toContain('Beautiful House')
        expect(wrapper.text()).toContain('$100,000')
        expect(wrapper.text()).toContain('3 Chambres')
    })

    it('renders a link to property detail', () => {
        const property = { id: 1 }

        const wrapper = mount(PropertyCard, {
            props: { property },
        })

        const link = wrapper.find('a')
        expect(link.attributes('href')).toContain('/properties/1')
    })
})
```

Configuration **vite.config.js** pour les tests:

```javascript
import { defineConfig } from 'vitest/config'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
    plugins: [vue()],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/js'),
        },
    },
    test: {
        globals: true,
        environment: 'happy-dom',
    },
})
```

Exécuter les tests:
```bash
npm run test
```

---

## Checklist de Migration

### Phase 1: Préparation
- [ ] Backup de la base de données
- [ ] Créer une branche Git: `git checkout -b inertia-migration`
- [ ] Documenter la configuration actuelle
- [ ] Mettre à jour Laravel vers 11
- [ ] Installer Inertia
- [ ] Configurer Vite
- [ ] Tester le fonctionnement basique

### Phase 2: Layout et Navigation
- [ ] Créer AppLayout.vue principal
- [ ] Migrer le header/navigation
- [ ] Migrer le footer
- [ ] Migrer les styles globaux
- [ ] Créer GuestLayout.vue pour pages publiques
- [ ] Créer AdminLayout.vue pour admin
- [ ] Créer AccountLayout.vue pour compte agent
- [ ] Tester la navigation entre pages

### Phase 3: Composants Partagés
- [ ] Créer composant Alert/Flash messages
- [ ] Créer composant Pagination
- [ ] Créer composant FormInput
- [ ] Créer composant Loading spinner
- [ ] Créer composant Modal
- [ ] Créer composant Confirm dialog
- [ ] Créer composant DataTable
- [ ] Tester tous les composants

### Phase 4: Pages Publiques
- [ ] Migrer homepage
- [ ] Migrer liste des propriétés
- [ ] Migrer détail de propriété
- [ ] Migrer galerie d'images
- [ ] Migrer recherche/filtres
- [ ] Migrer profil agent public
- [ ] Migrer blog
- [ ] Migrer contact
- [ ] Tester toutes les pages publiques

### Phase 5: Authentification
- [ ] Migrer page login admin
- [ ] Migrer page login agent
- [ ] Migrer page register agent
- [ ] Migrer forgot password
- [ ] Migrer reset password
- [ ] Tester flow authentification complet
- [ ] Tester logout

### Phase 6: Dashboard Admin
- [ ] Migrer dashboard principal
- [ ] Migrer liste propriétés admin
- [ ] Migrer form créer/éditer propriété
- [ ] Migrer liste comptes admin
- [ ] Migrer form créer/éditer compte
- [ ] Migrer liste catégories
- [ ] Migrer liste types
- [ ] Migrer liste features
- [ ] Migrer liste facilities
- [ ] Migrer liste packages
- [ ] Migrer liste devises
- [ ] Migrer liste avis
- [ ] Migrer liste consultations
- [ ] Migrer liste transactions
- [ ] Tester tous les CRUD

### Phase 7: Dashboard Agent
- [ ] Migrer dashboard agent
- [ ] Migrer mes propriétés
- [ ] Migrer form créer/éditer propriété
- [ ] Migrer mes consultations
- [ ] Migrer mes avis
- [ ] Migrer mon profil
- [ ] Migrer mes transactions/crédits
- [ ] Tester tous les fonctionnalités

### Phase 8: Finalisation
- [ ] Passer les tests unitaires
- [ ] Passer les tests d'intégration
- [ ] Tests de charge/performance
- [ ] Vérifier responsive design
- [ ] Vérifier accessibilité
- [ ] Vérifier SEO
- [ ] Cleanup du code
- [ ] Documentation mise à jour

### Phase 9: Déploiement
- [ ] Tester en staging
- [ ] Performance testing
- [ ] Security testing
- [ ] Vérifier redirects
- [ ] Vérifier mails
- [ ] Déploiement production
- [ ] Monitoring post-déploiement

---

## Dépannage

### Erreur: "Cannot find module"

```
Error: Cannot find module '@inertiajs/vue3'
```

**Solution**:
```bash
npm install @inertiajs/vue3
```

### Erreur: "Inertia page instance has not been mounted"

```
Error: The Inertia page instance has not been mounted.
```

**Cause**: La page Vue n'a pas été chargée correctement

**Solution**: Vérifier que:
1. `app.blade.php` contient `@inertia`
2. `HandleInertiaRequests` middleware est configuré
3. Les noms de pages correspondent au chemin des fichiers

```php
// ✅ Correct
return inertia('Properties/Index');
// Cherche: resources/js/Pages/Properties/Index.vue

// ❌ Incorrect
return inertia('PropertiesIndex');
// Cherche: resources/js/Pages/PropertiesIndex.vue
```

### Erreur: "Inertia responses cannot have any other status code"

```
Error: Inertia responses must return a response status code of 200 or higher, and less than 300.
```

**Cause**: Tentative d'Inertia avec un code d'erreur

**Solution**: Retourner les erreurs autrement:
```php
// ❌ Incorrect
return inertia('Property/Show')->setStatusCode(404);

// ✅ Correct
if (!$property) {
    abort(404);
}
return inertia('Property/Show', ['property' => $property]);
```

### Les images ne s'affichent pas

**Solution**: Vérifier les chemins:
```vue
<!-- ✅ Correct -->
<img :src="`/storage/${property.image}`" />

<!-- Si les images sont en public -->
<img src="/images/logo.png" />

<!-- Utiliser asset() depuis Blade si nécessaire -->
<img :src="asset(`/images/${image}`)" />
```

### CSRF Token Missing

**Solution**: Inertia s'occupe automatiquement du CSRF. Si vous avez encore des problèmes:

```php
// Dans le middleware
protected $except = [
    'webhooks/*',
];
```

### Formulaires qui ne soumettent pas

```vue
<!-- ❌ Incorrect -->
<form @submit="submit">

<!-- ✅ Correct -->
<form @submit.prevent="submit">
```

### Props ne sont pas mises à jour

**Cause**: Oublier le spread operator dans les composants

```vue
<!-- ❌ Incorrect -->
<script setup>
const props = defineProps({
  property: Object,
})

// Essayer d'accéder directement
{{ property.name }}
</script>

<!-- ✅ Correct -->
<script setup>
const { property } = defineProps({
  property: Object,
})

// Ou utiliser le raccourci
{{ property.name }}
</script>
```

### Erreurs de validation non affichées

```vue
<!-- ✅ Correct -->
<input v-model="form.name" />
<span v-if="form.errors.name">{{ form.errors.name }}</span>

<!-- Vérifier que le serveur retourne le code 422 -->
<!-- dans le contrôleur -->
public function store(PropertyRequest $request)
{
    // PropertyRequest lance automatiquement une exception
    // si validation échoue avec le code 422
}
```

### Performance lente

**Solutions**:
```php
// 1. Utiliser eager loading
$properties = Property::with(['features', 'facilities'])->paginate();

// 2. Limiter les données envoyées
return inertia('Properties/Index', [
    'properties' => $properties->only(['id', 'name', 'price']),
]);

// 3. Lazy load les données secondaires
return inertia('Properties/Index', [
    'properties' => $properties,
    'reviews' => fn() => Review::latest()->limit(10)->get(),
]);
```

---

## Ressources Additionnelles

### Documentation Officielle
- [Inertia.js](https://inertiajs.com)
- [Laravel 11](https://laravel.com/docs/11)
- [Vue 3](https://vuejs.org)
- [Vite](https://vitejs.dev)

### Packages Recommandés
- `@headlessui/vue` - Composants UI headless
- `@heroicons/vue` - Icônes
- `@tailwindcss/forms` - Styles de formulaires
- `@tailwindcss/ui` - Composants UI Tailwind
- `pinia` - State management
- `zod` ou `yup` - Validation côté client

### Commandes Utiles

```bash
# Développement
npm run dev                 # Démarrer Vite
php artisan serve          # Démarrer Laravel
php artisan tinker         # REPL

# Production
npm run build              # Build des assets
php artisan migrate        # Migrer la BD
php artisan config:cache   # Cacher la config

# Tests
npm run test               # Tests Vue
php artisan test           # Tests PHP

# Déboggage
php artisan tinker         # REPL interactive
php artisan inertia:list   # Lister toutes les pages

# Cache
php artisan cache:clear    # Vider le cache
php artisan view:clear     # Vider le cache des vues
```

---

## Résumé des Changements Clés

### Avant (Blade)
```
Routes → Contrôleur → View Blade → HTML au navigateur
Pas de réactivité
Full page reloads
Session serveur
Pas d'état côté client
```

### Après (Inertia)
```
Routes → Contrôleur → inertia() → Props JSON → Composant Vue → Rendu client
Réactivité complète
Navigations sans rechargement
Shared data automatique
État client avec Pinia
```

### Efforts de Migration par Type de Composant

| Type | Effort | Durée |
|------|--------|-------|
| **Pages simples** | 🟢 Facile | 30 min |
| **Formulaires** | 🟡 Moyen | 1h |
| **Tableaux de données** | 🟡 Moyen | 1-2h |
| **Authentification** | 🔴 Difficile | 2-3h |
| **Filtres/Recherche** | 🔴 Difficile | 2-3h |
| **Upload fichiers** | 🔴 Difficile | 2-3h |
| **Real-time (WebSocket)** | 🔴 Très difficile | 3-5h |

### Budget Temps Estimé

**Petit projet** (5-10 pages): 20-30 heures  
**Projet moyen** (20-50 pages): 40-60 heures  
**Gros projet** (100+ pages): 80-120 heures  

Ce projet = **60-80 heures estimées** (8-10 semaines)

---

**Dernière mise à jour**: Novembre 2025  
**Version Guide**: 1.0  
**Statut**: Guide complet de migration

Bonne migration vers Inertia! 🚀

