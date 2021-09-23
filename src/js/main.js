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