const fs = require('fs');
const engine = require('php-parser');

const parser = new engine({
  parser: {
    extractDoc: true,
    php7: true
  },
  ast: {
    withPositions: true
  }
});

if (fs.existsSync('./vendor_prefixed/guzzlehttp/psr7/vendor-bin')) fs.rmSync('./vendor_prefixed/guzzlehttp/psr7/vendor-bin', { recursive: true });
if (fs.existsSync('./vendor_prefixed/intervention/image/.github')) fs.rmSync('./vendor_prefixed/intervention/image/.github', { recursive: true });

//vendor_prefixed/intervention/image/.github
function getFiles(dir, files_) {
  files_ = files_ || [];
  const files = fs.readdirSync(dir);
  for (const i in files) {
    const name = `${dir}/${files[i]}`;
    if (fs.statSync(name).isDirectory()){
      getFiles(name, files_);
    } else {
      files_.push(name);
    }
  }
  return files_;
}

const collection = [];
const allPHPFiles = getFiles('./vendor_prefixed');
allPHPFiles.forEach(function(file) {
  if (
    file.endsWith('.md') ||
    file.endsWith('.json') ||
    file.endsWith('.yml') ||
    file.endsWith('.gitignore')
    ) {
    fs.rmSync(file);
    return;
  }

  const fileAST = parser.parseCode(fs.readFileSync(file));
  if (
    fileAST
    && fileAST.children
    && fileAST.children.length > 0
    && fileAST.children[0].kind === 'namespace'
    && !['Composer\\Autoload', 'Composer', ].includes(fileAST.children[0].name)
    && !collection.includes(fileAST.children[0].name)
    ) {
      collection.push({ [fileAST.children[0].name]: `$baseDir . '${file.replace('./', '/')}'` })
  }

});

let text = `
<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
  'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
`;
  collection.forEach(name => {
  text += `  '${Object.keys(name)[0]}' => '${Object.values(name)[0]}',
`;
  });

  text += `
);
`;

fs.writeFileSync('./vendor_prefixed/autoload_classmap.php', text);
