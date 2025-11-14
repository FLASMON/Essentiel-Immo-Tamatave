<?php
/**
 * Script pour mettre à jour le nom du site
 * Exécutez ce script après avoir redémarré Laragon: php update_site_name.php
 */

use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Mise à jour du nom du site...\n\n";

try {
    // Mettre à jour site_title
    DB::table('settings')->updateOrInsert(
        ['key' => 'site_title'],
        ['value' => 'Essentiel Immo Tamatave']
    );
    echo "✓ site_title mis à jour\n";

    // Mettre à jour site_name
    DB::table('settings')->updateOrInsert(
        ['key' => 'site_name'],
        ['value' => 'Essentiel Immo Tamatave']
    );
    echo "✓ site_name mis à jour\n";

    // Mettre à jour admin_title
    DB::table('settings')->updateOrInsert(
        ['key' => 'admin_title'],
        ['value' => 'Essentiel Immo Tamatave']
    );
    echo "✓ admin_title mis à jour\n";

    echo "\n✅ Tous les paramètres ont été mis à jour avec succès!\n";
    echo "N'oubliez pas de vider le cache: php artisan cache:clear\n";

} catch (Exception $e) {
    echo "\n❌ Erreur: " . $e->getMessage() . "\n";
    echo "Assurez-vous que Laragon est bien démarré et que la base de données est accessible.\n";
}
