<?php
$composerFiles = [
  // __DIR__ . '/vendor/composer/autoload_classmap.php',
  __DIR__ . '/vendor/composer/autoload_files.php',
  __DIR__ . '/vendor/composer/autoload_namespaces.php',
  __DIR__ . '/vendor/composer/autoload_psr4.php',
  __DIR__ . '/vendor/composer/autoload_real.php',
] ;

$renamedNamespaces = [
  'GuzzleHttp'   => 'Ttc\GuzzleHttp',
  'Intervention' => 'Ttc\Intervention',
  'Psr'          => 'Ttc\Psr',
];

$editStack = [
  // Replace changed namespaces
  function (string $contents) use ($renamedNamespaces): string {
    $findThis = array_map(function ($x) {
      return "'" . str_replace('\\', '\\\\', rtrim($x, '\\')) . '\\';
    }, array_keys($renamedNamespaces));
    $changeTo = array_map(function ($x) {
      return "'" . str_replace('\\', '\\\\', rtrim($x, '\\')) . '\\';
    }, array_values($renamedNamespaces));

    return str_replace($findThis, $changeTo, $contents);
  },
  // Never use the static loader
  function (string $contents): string {
    return str_replace('$useStaticLoader = ', '$useStaticLoader = false && ', $contents);
  },
];

foreach ($composerFiles as $composerFileToEdit) {
  $contents = file_get_contents($composerFileToEdit);
  $oldHash = sha1($contents);

  foreach ($editStack as $callback) {
    $contents = $callback($contents);
  }

  $newHash = sha1($contents);

  if ($newHash === $oldHash) {
    continue;
  }

  file_put_contents($composerFileToEdit, $contents);
}
