const fs = require('fs');

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

const allPHPFiles = getFiles('./vendor');
allPHPFiles.forEach(function(file) {
  console.log(file)
  if (
    file.endsWith('.md') ||
    file.endsWith('.json') ||
    file.endsWith('.yml') ||
    file.endsWith('.gitignore') ||
    ['./vendor/intervention/image/src/Intervention/Image/ImageServiceProvider.php',
    './vendor/intervention/image/src/Intervention/Image/ImageServiceProviderLaravel4.php',
    './vendor/intervention/image/src/Intervention/Image/ImageServiceProviderLaravelRecent.php',
    './vendor/intervention/image/src/Intervention/Image/ImageServiceProviderLeague.php',
    './vendor/intervention/image/src/Intervention/Image/ImageServiceProviderLumen.php',
    './vendor/intervention/image/src/Intervention/Image/Response.php',
    ].includes(file)
    ) {
    fs.rmSync(file);
  } else {
    if (file === './vendor/intervention/image/src/Intervention/Image/ImageManager.php') {
      let fileContent = fs.readFileSync(file, 'utf8');
       // Intervention\\Image\\%s\\Driver
      fileContent = fileContent.replace(/Intervention\\\\Image\\\\%s\\\\Driver/gm, "Ttc\\\\Freebies\\\\Intervention\\\\Image\\\\%s\\\\Driver");
      // Intervention\\Image\\ImageCache
      fileContent = fileContent.replace(/Intervention\\\\Image\\\\ImageCache/gm, "Ttc\\\\Freebies\\\\Intervention\\\\Image\\\\ImageCache");
      fs.writeFileSync(file, fileContent, 'utf8');
    }

    if (file === './vendor/intervention/image/src/Intervention/Image/AbstractDriver.php') {
      let fileContent = fs.readFileSync(file, 'utf8');
      // \Intervention\Image\%s\Commands\%sCommand
      fileContent = fileContent.replace(/\\Intervention\\Image\\%s\\Commands\\%sCommand/gm, "\\Ttc\\Freebies\\Intervention\\Image\\%s\\Commands\\%sCommand");
      fileContent = fileContent.replace(/\\Intervention\\Image\\Commands\\%sCommand/gm, "\\Ttc\\Freebies\\Intervention\\Image\\Commands\\%sCommand");
      fs.writeFileSync(file, fileContent, 'utf8');
    }
  }
});

fs.rmSync('./vendor/intervention/image/src/Intervention/Image/Facades', {recursive: true});

// fs.mkdirSync('../vendor/Intervention', { recursive: true });
// fs.cpSync('./vendor/Intervention/Image/src/intervention/image', '../vendor/Intervention/Image', { recursive: true });

// fs.rmSync('./vendor', {recursive: true});
