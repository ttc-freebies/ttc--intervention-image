<?php
declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Rector\Renaming\Rector\Namespace_\RenameNamespaceRector;

return static function (\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator): void {
  // Set some params
  $parameters = $containerConfigurator->parameters();
  $parameters->set(Option::PATHS, [
    __DIR__ . '/vendor/intervention',
  ]);
  $parameters->set(Option::SKIP, [
    __DIR__ . '/vendor/intervention/image/src/Intervention/Image/ImageServiceProviderLaravel4.php',
    __DIR__ . '/vendor/intervention/image/src/Intervention/Image/ImageServiceProvider.php',
    __DIR__ . '/vendor/intervention/image/src/Intervention/Image/Facades/Image.php',
    __DIR__ . '/vendor/intervention/image/src/Intervention/Image/ImageServiceProviderLaravelRecent.php',
    __DIR__ . '/vendor/intervention/image/src/Intervention/Image/ImageServiceProviderLumen.php',
    __DIR__ . '/vendor/intervention/image/src/Intervention/Image/ImageServiceProviderLeague.php',
  ]);

  // Namespace renaming
  $containerConfigurator
    ->services()
    ->set(Rector\Renaming\Rector\Namespace_\RenameNamespaceRector::class)
    // ->set(NoUnusedImportsFixer::class)
    ->configure([
      'Intervention'       => 'Ttc\Freebies\Intervention',
      'Intervention\Image' => 'Ttc\Freebies\Intervention\Image',
      'Intervention\Image\AbstractDriver' => 'Ttc\Freebies\Intervention\Image\AbstractDriver',
      'Intervention\Image\ImageManager' => 'Ttc\Freebies\Intervention\Image\ImageManager',
    ]);
};
