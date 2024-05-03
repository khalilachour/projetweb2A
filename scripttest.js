/*document.addEventListener('DOMContentLoaded', function() {
    const addBtn = document.querySelector('.addbtn');
    const skillsContainer = document.querySelector('.skillscontainer');
    const form = document.getElementById('myForm');

    addBtn.addEventListener('click', function() {
        console.log("cccc");
        // Cloner le formulaire
        const clonedForm = form.cloneNode(true);
        // Afficher le formulaire cloné dans le conteneur de compétences
        skillsContainer.appendChild(clonedForm);
    });
});
*/



/*
document.addEventListener('DOMContentLoaded', function() {
    const addBtn = document.querySelector('.addbtn');
    const skillsContainer = document.querySelector('.skillscontainer');
    const form = document.getElementById('myForm');

    addBtn.addEventListener('click', function() {
        // Cloner le formulaire
        const clonedForm = form.cloneNode(true);
        
        // Générer un nouvel identifiant unique en utilisant PHP
        // Notez que cela ne fonctionnera que si le fichier HTML est un fichier PHP
        const newId = document.getElementById('nouveau_id').getAttribute('nvid');
        
        // Modifier l'identifiant du champ d'identifiant dans le formulaire cloné
        const idInput = clonedForm.querySelector('input[name="id_skill"]');
        idInput.value = newId;

        // Afficher le formulaire cloné dans le conteneur de compétences
        skillsContainer.appendChild(clonedForm);
    });
});*/


/*
document.addEventListener('DOMContentLoaded', function() {
    const linkSkill = document.getElementById('link_skill');
    const messageContainer = document.getElementById('message');

    linkSkill.addEventListener('click', function(event) {
        const idCandidature = ''; // Récupérez l'ID de la candidature ici
        
        if (idCandidature === '') {
            event.preventDefault(); // Empêche le lien de rediriger l'utilisateur

            // Affichez le message si l'ID de la candidature est vide
            const message = document.createElement('p');
            message.textContent = "Ajouter votre candidature d'abord";
            messageContainer.appendChild(message);
        }
    });
});*/





// Récupérer le champ date
const dateField = document.getElementById('date');
// Créer une nouvelle date
const currentDate = new Date();
console.log(currentDate);
// Obtenir la date au format YYYY-MM-DD
const formattedDate = currentDate.toISOString().split('T')[0];
console.log(formattedDate);
console.log("fff");
// Définir la valeur du champ date
dateField.value = formattedDate;






