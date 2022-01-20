try {
    document.addEventListener('DOMContentLoaded', () => {
        M.Sidenav.init(document.querySelectorAll('.sidenav'))
        M.Parallax.init(document.querySelectorAll('.parallax'))
        M.Tooltip.init(document.querySelectorAll('.tooltipped'))
        M.Collapsible.init(document.querySelectorAll('.collapsible'))
    })
} catch (e) {
    console.error(e)
}

try {
    document.addEventListener('DOMContentLoaded', () => {
        Array
            .from(document.querySelectorAll('#nav-mobile > li, #slide-out > li, #menu-fussmenue-1 > li'))
            .filter(li => li.firstChild instanceof HTMLAnchorElement)
            .filter(li => li.firstChild.firstChild)
            .forEach(li => {
                const icon = li.classList
                    .filter(clazz => clazz.startsWith('material-icons-'))
                    .map(clazz => clazz.substring(15))
                if (icon.length > 0) {
                    const i = document.createElement('i')
                    i.classList.add('material-icons')
                    i.classList.add('left')
                    i.appendChild(document.createTextNode(icon[0]))
                    li.firstChild.insertBefore(i, li.firstChild.firstChild)
                }
            })
    })
} catch (e) {
    console.error(e)
}

try {
    const disableContextMenu = elem => elem.addEventListener('contextmenu', e => e.preventDefault(), false)
    document.addEventListener('DOMContentLoaded', () => {
        Array
            .from(document.querySelectorAll(':not(.teaser-row) img'))
            .forEach(disableContextMenu)
        Array
            .from(document.querySelectorAll('.teaser-row img'))
            .forEach(img => {
                if (img.parentElement instanceof HTMLAnchorElement) {
                    img.addEventListener('contextmenu', e => {
                        e.preventDefault()
                        img.parentElement.click()
                    }, false)
                } else {
                    disableContextMenu(img)
                }
            })

        new MutationObserver((mutations) => {
            mutations
                .filter(mutation => mutation.type === 'childList')
                .forEach(mutation => {
                    Array.from(mutation.addedNodes)
                        .filter(node => node instanceof HTMLImageElement)
                        .forEach(disableContextMenu)
                })
        }).observe(document.body, {
            attributes: false,
            subtree: true,
            childList: true,
            characterData: false
        })
    }, false)
} catch (e) {
    console.error(e)
}