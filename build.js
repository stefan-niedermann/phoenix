const fs = require('fs-extra');
const execSync = require('child_process').execSync;

const build = () => {
    prepareWorkspace('dist');
    copyAllSources('src', 'dist');
    copyNecessaryDependencies('dist');
    translate('dist/languages');
}

const prepareWorkspace = (dist) => {
    if (fs.existsSync(dist)) {
        fs.rmSync(dist, { recursive: true });
    }
    fs.mkdirSync(dist);
}

const copyAllSources = (src, dist) => fs.copySync(src, dist);

const copyNecessaryDependencies = (dist) => {
    fs.copySync('node_modules/@materializecss/materialize/dist/js/materialize.min.js', `${dist}/js/materialize.min.js`);
    fs.copySync('node_modules/@materializecss/materialize/dist/css/materialize.min.css', `${dist}/css/materialize.min.css`);
    fs.copySync('node_modules/material-icons/iconfont/material-icons.woff', `${dist}/fonts/material-design-icons.woff`);
    fs.copySync('node_modules/material-icons/iconfong/material-icons.woff2', `${dist}/fonts/material-design-icons.woff2`);
}

const translate = (i18n) =>
    fs.readdirSync(i18n)
        .filter(file => file.endsWith('.po'))
        .map(file => file.substring(0, file.length - 3))
        .forEach(file => execSync(`msgfmt ${i18n}/${file}.po -o ${i18n}/${file}.mo`));

build();