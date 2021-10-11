try {
    document.addEventListener('DOMContentLoaded', () => {
        M.Sidenav.init(document.querySelectorAll('.sidenav'));
        M.Parallax.init(document.querySelectorAll('.parallax'));
        M.Tooltip.init(document.querySelectorAll('.tooltipped'));
        M.Collapsible.init(document.querySelectorAll('.collapsible'));
    });
} catch (e) {
    console.error(e);
}

try {
    const disableContextMenu = (elem) => {
        elem.addEventListener('contextmenu', (e) => e.preventDefault(), false);
    }
    document.addEventListener('DOMContentLoaded', () => {
        Array
            .from(document.getElementsByTagName(':not(.teaser-row) img'))
            .forEach(img => disableContextMenu(img));
            Array
                .from(document.getElementsByTagName('.teaser-row img'))
                .forEach(img => {
                    if(img.parentElement instanceof HTMLAnchorElement) {
                        img.addEventListener('contextmenu', (e) => {
                            e.preventDefault()
                            img.parentElement.click();
                        }, false);
                    } else {
                        disableContextMenu(img);
                    }
                });

        new MutationObserver((mutations) => {
            mutations
                .filter(mutation => mutation.type === 'childList')
                .forEach((mutation) => {
                    Array.from(mutation.addedNodes)
                        .filter(node => node instanceof HTMLImageElement)
                        .forEach(node => disableContextMenu(node));
                });
        }).observe(document.body, {
            attributes: false,
            subtree: true,
            childList: true,
            characterData: false
        });
    }, false);
} catch (e) {
    console.error(e);
}