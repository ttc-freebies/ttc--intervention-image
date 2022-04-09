const fs = require('fs');

fs.rmSync('./vendor/composer', { recursive: true });
fs.rmSync('./vendor/guzzlehttp', { recursive: true });
fs.rmSync('./vendor/psr', { recursive: true });
fs.rmSync('./vendor/ralouphie', { recursive: true });

fs.rmSync('./vendor/autoload.php');
