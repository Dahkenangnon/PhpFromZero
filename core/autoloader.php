<?php

$configuration = json_decode(
    file_get_contents(__DIR__ . '/config.json'),
    true
);

$namespaces = $configuration['autoload']['psr-4'];


/**
 * Class autoloader
 * 
 * @see https://github.com/pretzelhands/psr-4
 */
function fqcnToPath(string $fqcn, string $prefix)
{
    $relativeClass = ltrim($fqcn, $prefix);

    return str_replace('\\', '/', $relativeClass) . '.php';
}

spl_autoload_register(function (string $class) use ($namespaces) {
    $prefix = strtok($class, '\\') . '\\';

    // We don't handle that namespace.
    // Return and hope some other autoloader handles it.
    if (!array_key_exists($prefix, $namespaces)) return;

    $baseDirectory = $namespaces[$prefix];
    $path = fqcnToPath($class, $prefix);

    require $baseDirectory . '/' . $path;


    // If you encounter an autoload error in production, please comment the require line above and uncomment the following lines.

    // $explodedPath = explode('/', $baseDirectory . '/' . ($path));

    // $filename = $explodedPath[sizeof($explodedPath)-1];

    // require strtolower(implode('/', array_slice($explodedPath, 0, sizeof($explodedPath)-1))) . '/' . $filename;
});
