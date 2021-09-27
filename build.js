const fs = require('fs-extra');
const util = require('util');
const exec = util.promisify(require('child_process').exec);

const build = async () => {
    // Clean up workspace
    if (fs.existsSync('dist')) {
        fs.rmSync('dist', { recursive: true });
    }
    fs.mkdirSync('dist');

    // Copy all sources
    fs.copySync('src', 'dist');

    // Copy necessary dependencies
    fs.copySync('node_modules/@materializecss/materialize/dist/css/materialize.min.css', 'dist/css/materialize.min.css');
    fs.copySync('node_modules/@materializecss/materialize/dist/js/materialize.min.js', 'dist/js/materialize.min.js');

    // Translate i18n files
    const i18n = 'dist/languages';
    await Promise.all(
        fs.readdirSync(i18n)
            .filter(file => file.endsWith('.po'))
            .map(file => file.substring(0, file.length - 3))
            .map(file => exec(`msgfmt ${i18n}/${file}.po -o ${i18n}/${file}.mo`))
    );
}

build();