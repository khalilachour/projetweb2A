/*document.addEventListener('DOMContentLoaded', function() {
    // Sélectionnez tous les boutons "Fixer une date"
    const fixDateBtns = document.querySelectorAll('.fix-date-btn');

    // Ajoutez un écouteur d'événements à chaque bouton
    fixDateBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id; // ID de la candidature
            const idOffre = this.dataset.idOffre; // ID de l'offre
            console.log(id); // Affiche l'ID de la candidature dans la console du navigateur
            console.log(idOffre); // Affiche l'ID de l'offre dans la console du navigateur
            const date = prompt('Choisissez une date :');

        });
    });
});*/


document.addEventListener('DOMContentLoaded', function() {
    // Sélectionnez tous les boutons "Fixer une date"
    const fixDateBtns = document.querySelectorAll('.fix-date-btn');

    // Ajoutez un écouteur d'événements à chaque bouton
    fixDateBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Récupérer l'ID de la candidature et l'ID de l'offre
            const idCandidature = this.dataset.id;
            const idOffre = this.dataset.idOffre;

            // Afficher la section pour choisir une date
            document.getElementById('select-date-section').style.display = 'block';

            // Stocker l'ID de l'offre dans un attribut data de la section de sélection de date
            document.getElementById('select-date-section').setAttribute('data-id-offre', idOffre);
        });
    });

    // Ajoutez un écouteur d'événements au bouton "Confirmer"
    const confirmDateBtn = document.getElementById('confirm-date-btn');
    confirmDateBtn.addEventListener('click', function() {
        // Récupérer la date sélectionnée
        const selectedDate = document.getElementById('selected-date').value;

        // Récupérer l'ID de l'offre de la section de sélection de date
        const idOffre = document.getElementById('select-date-section').getAttribute('data-id-offre');


    



        // Construire l'URL avec la date sélectionnée et l'ID de l'offre
        const url = 'entretiens.php?date=' + selectedDate + '&id_offre=' + idOffre;

        // Rediriger l'utilisateur vers la page d'entretien avec les paramètres dans l'URL
        window.location.href = url;
    });
});
