
// Sélection du champ de saisie par son nom
var nomInput = document.querySelector('input[name="nom"]');
var errorMessage = document.getElementById('errorMessage');

// Ajout d'un écouteur d'événement pour l'événement "input"
nomInput.addEventListener('input', function() {
    // Récupération de la valeur saisie
    var valeur = this.value;
    
    // Vérification de la longueur et des caractères
    if (valeur.length > 20 || !/^[A-Za-z\s]+$/.test(valeur)) {
        // Affichage du message d'erreur
        
        errorMessage.textContent = "Le nom doit contenir uniquement des lettres et des espaces et ne pas dépasser 20 caractères.";
        
    } 
    // Effacer la saisie incorrecte
    this.value = valeur.slice(0, 20);
});



// Fonction de validation de la saisie
function validateDescription() {
    var descriptionInput = document.getElementById('descriptionInput');
    var descriptionError = document.getElementById('descriptionError');
    var descriptionValue = descriptionInput.value.trim(); // Supprime les espaces vides au début et à la fin

    if (descriptionValue === '') {
        descriptionError.textContent = "Veuillez saisir une description."; // Affiche le message d'erreur
        descriptionError.style.display = 'inline'; // Affiche l'élément de message d'erreur
        return false; // Empêche la soumission du formulaire
    }

    descriptionError.textContent = ""; // Efface le message d'erreur s'il existe
    descriptionError.style.display = 'none'; // Cache l'élément de message d'erreur
    return true; // Autorise la soumission du formulaire
}

// Événement de soumission du formulaire
document.getElementById('myForm').addEventListener('submit', function(event) {
    if (!validateDescription()) {
        event.preventDefault(); // Empêche la soumission du formulaire si la validation échoue
    }
});