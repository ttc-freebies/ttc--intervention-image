<?php
declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Rector\Renaming\Rector\Namespace_\RenameNamespaceRector;

var_dump('hello');
return static function (\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator): void {
  // Set some params
  $parameters = $containerConfigurator->parameters();
  $parameters->set(Option::PATHS, [
    __DIR__ . '/vendor/autoload.php',
    __DIR__ . '/vendor/composer',

    __DIR__ . '/vendor/guzzlehttp',
    __DIR__ . '/vendor/intervention',
    __DIR__ . '/vendor/psr',
    __DIR__ . '/vendor/ralouphie',
  ]);
  $parameters->set(Option::SKIP, [
    __DIR__ . '/vendor/ralouphie',
    __DIR__ . '/vendor/intervention/image/src/Intervention/Image/ImageServiceProviderLaravel4.php',
    __DIR__ . '/vendor/intervention/image/src/Intervention/Image/ImageServiceProvider.php',
    __DIR__ . '/vendor/intervention/image/src/Intervention/Image/Facades/Image.php',
    __DIR__ . '/vendor/intervention/image/src/Intervention/Image/ImageServiceProviderLaravelRecent.php',
    __DIR__ . '/vendor/intervention/image/src/Intervention/Image/ImageServiceProviderLumen.php',
    __DIR__ . '/vendor/intervention/image/src/Intervention/Image/ImageServiceProviderLeague.php',
  ]);

  // Namespace renaming
  // get services (needed for register a single rule)
  $services = $containerConfigurator->services();

  // register a single rule
  $services->set(Rector\Renaming\Rector\Namespace_\RenameNamespaceRector::class)
    // ->set(NoUnusedImportsFixer::class)
    ->configure([
      'GuzzleHttp'    => 'Ttc\GuzzleHttp',
      'Intervention'  => 'Ttc\Intervention',
      'Psr'           => 'Ttc\Psr',
    ]);
};