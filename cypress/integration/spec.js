describe('The Home Page', () => {
    it('should only contain links that can be loaded successfully', () => {
        cy.visit('/', {
            qs: { 'donotcachepage': Cypress.env('WP_SUPER_CACHE_BUSTER') }
        });

        cy.contains('Feuerwehr Aurachhöhe');
        cy.contains('Unsere Freizeit für Ihre Sicherheit');

        const visitedPages = new Set('/');

        const checkLinkedUrlsAreValid = (page, visitedPages) => {
            visitedPages.add(page);
            cy.get('a:not([href*="#"], [href|="mailto:"], [href|="tel:"], [href*="wp-content"])').each($anchor => {
                const url = $anchor.attr('href');
                if (!visitedPages.has(url)) {
                    visitedPages.add(url);
                    cy.request(url, {
                        qs: { 'donotcachepage': Cypress.env('WP_SUPER_CACHE_BUSTER') }
                    });
                }
            });
        }

        checkLinkedUrlsAreValid('/', visitedPages);
    })
});
