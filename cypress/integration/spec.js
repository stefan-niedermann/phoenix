describe('The Home Page', () => {
    it('successfully loads', () => {
        cy.visit('/');

        cy.contains('Feuerwehr Aurachhöhe');
        cy.contains('Unsere Freizeit für Ihre Sicherheit');

        cy.contains('Es gab einen kritischen Fehler auf deiner Website.').should('not.exist');
    })
});
