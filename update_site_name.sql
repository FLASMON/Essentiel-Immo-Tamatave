-- Mettre à jour le nom du site dans la base de données
-- Exécutez ce script après avoir redémarré Laragon

UPDATE settings SET value = 'Essentiel Immo Tamatave' WHERE `key` = 'site_title';
UPDATE settings SET value = 'Essentiel Immo Tamatave' WHERE `key` = 'site_name';
UPDATE settings SET value = 'Essentiel Immo Tamatave' WHERE `key` = 'admin_title';

-- Vérifier les modifications
SELECT * FROM settings WHERE `key` IN ('site_title', 'site_name', 'admin_title');
