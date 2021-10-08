describe('The Home Page', () => {
    it('successfully loads', () => {
        cy.visit('/', {
            qs: {'donotcachepage': Cypress.env('WP_SUPER_CACHE_BUSTER')}
        });

        cy.contains('Feuerwehr Aurachhöhe');
        cy.contains('Unsere Freizeit für Ihre Sicherheit');

        cy.contains('Es gab einen kritischen Fehler auf deiner Website.').should('not.exist');
    })
});
