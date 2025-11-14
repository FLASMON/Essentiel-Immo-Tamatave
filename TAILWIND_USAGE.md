# Guide d'utilisation de Tailwind CSS - Essentiel Immo Tamatave

## ✅ Installation complète

Tailwind CSS v3 a été installé et configuré avec succès dans votre projet Laravel !

## 📁 Fichiers configurés

1. **tailwind.config.js** - Configuration Tailwind avec les chemins du projet
2. **resources/css/app.css** - Fichier CSS principal avec les directives Tailwind
3. **webpack.mix.js** - Configuration Laravel Mix pour compiler Tailwind
4. **public/css/app.css** - Fichier compilé (19 KB minifié)

## 🎨 Comment utiliser Tailwind CSS dans vos templates

### 1. Inclure le CSS Tailwind dans votre header

Ajoutez dans `platform/themes/resido/partials/header.blade.php` :

```blade
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
```

### 2. Exemples d'utilisation

#### Card de propriété avec Tailwind :

```blade
<div class="max-w-sm rounded-lg overflow-hidden shadow-lg bg-white hover:shadow-xl transition-shadow duration-300">
    <img class="w-full h-48 object-cover" src="property-image.jpg" alt="Propriété">
    <div class="p-6">
        <h3 class="font-bold text-xl mb-2 text-gray-800">Villa Moderne</h3>
        <p class="text-gray-600 text-sm mb-4">Tamatave, Madagascar</p>
        <div class="flex items-center justify-between">
            <span class="text-2xl font-bold text-blue-600">1,500,000 Ar</span>
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                Voir détails
            </button>
        </div>
    </div>
</div>
```

#### Formulaire de recherche :

```blade
<form class="bg-white p-6 rounded-xl shadow-lg">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <input 
            type="text" 
            placeholder="Localisation" 
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        >
        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <option>Type de bien</option>
            <option>Maison</option>
            <option>Appartement</option>
        </select>
        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors">
            Rechercher
        </button>
    </div>
</form>
```

#### Navigation responsive :

```blade
<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="text-2xl font-bold text-blue-600">Essentiel Immo</div>
            <div class="hidden md:flex space-x-8">
                <a href="#" class="text-gray-700 hover:text-blue-600 transition-colors">Accueil</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition-colors">Propriétés</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 transition-colors">Contact</a>
            </div>
            <button class="md:hidden text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>
</nav>
```

## 🛠️ Commandes utiles

### Compiler en mode développement (avec watch) :
```bash
npm run watch
```

### Compiler en mode production (minifié) :
```bash
npm run production
```

### Compiler une seule fois :
```bash
npm run dev
```

## 🎨 Classes Tailwind les plus utiles pour l'immobilier

### Layout & Spacing :
- `container mx-auto` - Container centré
- `grid grid-cols-1 md:grid-cols-3 gap-4` - Grille responsive
- `flex items-center justify-between` - Flexbox
- `p-4, px-6, py-3` - Padding
- `m-4, mx-auto, my-2` - Margin

### Couleurs :
- `bg-blue-500, bg-white, bg-gray-100` - Fond
- `text-blue-600, text-gray-700` - Texte
- `border-gray-300` - Bordures

### Typographie :
- `text-xl, text-2xl` - Tailles
- `font-bold, font-semibold` - Poids
- `text-center, text-left` - Alignement

### Effets :
- `shadow-lg, shadow-xl` - Ombres
- `rounded-lg, rounded-full` - Bordures arrondies
- `hover:bg-blue-600` - Effets au survol
- `transition-colors, duration-300` - Transitions

### Responsive :
- `sm:` - Small (640px+)
- `md:` - Medium (768px+)
- `lg:` - Large (1024px+)
- `xl:` - Extra Large (1280px+)

## 📚 Ressources

- [Documentation Tailwind CSS](https://tailwindcss.com/docs)
- [Tailwind UI Components](https://tailwindui.com/)
- [Tailwind Cheat Sheet](https://nerdcave.com/tailwind-cheat-sheet)

## 🚀 Prochaines étapes

1. Remplacez progressivement les classes CSS existantes par Tailwind
2. Créez des composants réutilisables
3. Utilisez les utilitaires responsive pour mobile-first design
4. Personnalisez les couleurs dans `tailwind.config.js` selon la charte graphique

Bon développement ! 🎉
