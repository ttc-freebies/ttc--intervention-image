<?php
declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Rector\Renaming\Rector\Namespace_\RenameNamespaceRector;

return static function (\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator): void {
  // Set some params
  $parameters = $containerConfigurator->parameters();
  $parameters->set(Option::PATHS, [
    __DIR__ . '/vendor/autoload.php',
    __DIR__ . '/vendor/composer',

    __DIR__ . '/vendor/intervention',
  ]);
  $parameters->set(Option::SKIP, [
    // __DIR__ . '/vendor/ralouphie',
  ]);

  // Namespace renaming
  $containerConfigurator
    ->services()
    ->set(Rector\Renaming\Rector\Namespace_\RenameNamespaceRector::class)
    // ->set(NoUnusedImportsFixer::class)
    ->configure([
      'Intervention'             => 'Ttc\Intervention',
      'Intervention\Image'       => 'Ttc\Intervention\Image',
      'Intervention\Gif'         => 'Ttc\Intervention\Gif',
      'Intervention\MimeSniffer' => 'Ttc\Intervention\MimeSniffer',
    ]);
};
