<?php declare(strict_types = 1);

namespace Ssil\Foundation;

class Config
{
    public static function get(string $config): mixed
    {
        [$file, $key] = static::getFileAndKey($config);
        $path = static::getPath($file);
        $config = require $path;
        return $config[$key] ?? null;
    }

    protected static function getFileAndKey(string $config): array
    {
        if (!preg_match('/^[a-z_]+\.[a-z_]+$/i', $config)) {
            throw new \InvalidArgumentException(
                sprintf('Mauvais format (%s au lieu de fichier.clé (lettres et _ acceptés))', $config)
            );
        }
        return explode('.', $config);
    }

    protected static function getPath(string $file): string
    {
        $path = sprintf('%s/config/%s.php', ROOT, $file);
        if (!file_exists($path)) {
            throw new \InvalidArgumentException('Le fichier de configuration n\'existe pas');
        }
        return $path;
    }
}
