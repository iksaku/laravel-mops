<?php

namespace iksaku\Laravel\Mops;

class Util
{
    /**
     * Run str_replace in a File.
     *
     * @param string|string[] $search
     * @param string|string[] $replace
     * @param string $path
     * @param callable|null $condition
     */
    public static function replaceInFile($search, $replace, string $path, callable $condition = null)
    {
        // Don't replace anything, since the file doesn't exist.
        if (!file_exists($path)) {
            return;
        }

        $file_contents = file_get_contents($path);

        // Only execute if a condition is provided and passes.
        if (is_callable($condition) && !$condition($search, $file_contents)) {
            return;
        }

        file_put_contents($path, str_replace($search, $replace, $file_contents));
    }

    public static function updateNodePackageFile(callable $callback, string $key = null)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $contents = $original = json_decode(file_get_contents(base_path('package.json')), true);

        if (empty($key)) {
            $contents = $callback($contents);
        } else {
            $contents[$key] = $callback(
                array_key_exists($key, $contents) ? $contents[$key] : []
            );
        }

        file_put_contents(
            base_path('package.json'),
            json_encode($contents, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Update Node packages in "package.json" file.
     *
     * @param  callable  $callback
     * @return void
     */
    public static function updateNodePackages(callable $callback)
    {
        self::updateNodePackageFile(function ($packages) use ($callback) {
            $packages = $callback($packages);

            ksort($packages);

            return $packages;
        }, 'devDependencies');
    }
}