const fs = require('fs-extra');
const execSync = require('child_process').execSync;

// Build

prepareWorkspace('dist');
copyAllSources('src', 'dist');
copyNecessaryDependencies('dist');
translate('dist/languages');

// Helper functions

const prepareWorkspace = (dist) => {
    if (fs.existsSync(dist)) {
        fs.rmSync(dist, { recursive: true });
    }
    fs.mkdirSync(dist);
}

const copyAllSources = (src, dist) => fs.copySync(src, dist);

const copyNecessaryDependencies = () => {
    fs.copySync('node_modules/@materializecss/materialize/dist/css/materialize.min.css', `${dist}/css/materialize.min.css`);
    fs.copySync('node_modules/@materializecss/materialize/dist/js/materialize.min.js', `${dist}/js/materialize.min.js`);
}

const translate = (i18n) =>
    fs.readdirSync(i18n)
        .filter(file => file.endsWith('.po'))
        .map(file => file.substring(0, file.length - 3))
        .forEach(file => execSync(`msgfmt ${i18n}/${file}.po -o ${i18n}/${file}.mo`));