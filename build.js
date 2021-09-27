const fs = require('fs-extra');
const util = require('util');
const exec = util.promisify(require('child_process').exec);

const build = async () => {
    if (fs.existsSync('dist')) {
        fs.rmSync('dist', { recursive: true });
    }
    fs.mkdirSync('dist');
    fs.copySync('src', 'dist');
    fs.copySync('node_modules/@materializecss/materialize/dist/css/materialize.min.css', 'dist/css/materialize.min.css');
    fs.copySync('node_modules/@materializecss/materialize/dist/js/materialize.min.js', 'dist/js/materialize.min.js');
    ['de_DE'].forEach(async (lang) => await exec(`msgfmt dist/languages/${lang}.po -o dist/languages/${lang}.mo`));
}

build();