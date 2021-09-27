const fs = require('fs-extra');
const util = require('util');
const exec = util.promisify(require('child_process').exec);

const build = async () => {
    fs.rmSync('dist', { recursive: true });
    await fs.copy('src', 'dist');
    await fs.copy('node_modules/@materializecss/materialize/dist/css/materialize.min.css', 'dist/css/materialize.min.css');
    await fs.copy('node_modules/@materializecss/materialize/dist/js/materialize.min.js', 'dist/js/materialize.min.js');
    ['de_DE'].forEach(async (lang) => {
        await exec(`msgfmt dist/languages/${lang}.po -o dist/languages/${lang}.mo`);
    });
}

build();