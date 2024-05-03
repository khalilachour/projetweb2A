
/*
// Sélectionnez toutes les cellules du calendrier
var cells = document.querySelectorAll('#calendar tbody td');

// Parcourez chaque cellule pour comparer la date avec la date sélectionnée
cells.forEach(function(cell) {
    // Récupérez la date de la cellule
    var cellDate = cell.dataset.date;
    
    // Si la date de la cellule correspond à la date sélectionnée, appliquez un style jaune
    if (cellDate === dateSelectionnee) {
        cell.style.backgroundColor = 'yellow';
    }
});
*/



document.addEventListener('DOMContentLoaded', function() {
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');
    const currentMonthSpan = document.getElementById('current-month');
    const calendarBody = document.querySelector('#calendar tbody');
  
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    // Supposons que vous ayez une variable JavaScript nommée "dateSelectionnee" contenant la date sélectionnée
var dateSelectionnee = '2024-5-1'; // C'est un exemple, vous devrez l'adapter à votre logique


// Tableau pour stocker les urlDate qui ont été traitées
let datesTraitees = [];
  
    displayCalendar(currentMonth, currentYear);
  
    prevMonthBtn.addEventListener('click', function() {
      currentMonth--;
      if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
      }
      displayCalendar(currentMonth, currentYear);
    });
  
    nextMonthBtn.addEventListener('click', function() {
      currentMonth++;
      if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
      }
      displayCalendar(currentMonth, currentYear);
    });

    
  
    function displayCalendar(month, year) {
      calendarBody.innerHTML = '';
      const monthName = new Date(year, month).toLocaleString('default', { month: 'long' });
      currentMonthSpan.textContent = monthName + ' ' + year;
  
      const firstDayOfMonth = new Date(year, month, 1).getDay();
      const daysInMonth = new Date(year, month + 1, 0).getDate();
  
      let date = 1;
      for (let i = 0; i < 6; i++) {
        const row = document.createElement('tr');
        for (let j = 0; j < 7; j++) {
          if (i === 0 && j < firstDayOfMonth) {
            const cell = document.createElement('td');
            row.appendChild(cell);
          } else if (date > daysInMonth) {
            break;
          } else {
            const cell = document.createElement('td');
            cell.textContent = date;
            cell.dataset.date = `${year}-${month + 1}-${date}`;
            cell.addEventListener('click', showInfo);
            row.appendChild(cell);


            // Si la date de la cellule correspond à la date sélectionnée, appliquez un style jaune
            if (cell.dataset.date === dateSelectionnee) {
                cell.style.backgroundColor = 'pink';
            }

            // Vérifier si cette date a déjà été traitée
            if (datesTraitees.includes(cell.dataset.date)) {
                // Si oui, changer la couleur de fond
                cell.style.backgroundColor = 'yellow';
            }

            date++;
          }
        }
        calendarBody.appendChild(row);
      }
    }
  
    function showInfo(event) {
      const selectedDate = event.target.dataset.date;
      //document.getElementById('info-content').textContent = `Informations pour le jour sélectionné : ${selectedDate}`;
         // Ajouter une classe à la cellule de date confirmée
       // event.target.classList.add('confirmed-date');
       const offreNom = document.getElementById('Offre-details').getAttribute('data-Nom');
        const offreLieu = document.getElementById('Offre-details').getAttribute('data-Lieu');
        //var urlDate = '<?php echo $urlDate; ?>';
        var urlDate = document.getElementById('Offre-details').getAttribute('urlDate');

        console.log(urlDate);
        

          // Ajouter la date sélectionnée au tableau des dates traitées si elle n'est pas déjà présente
          if (!datesTraitees.includes(selectedDate)) {
            datesTraitees.push(selectedDate);
        }


        function normalizeDate(dateString) {
            if (!dateString) return null; // Vérifie si la chaîne de date est définie
            const [year, month, day] = dateString.split('-').map(part => parseInt(part));
            if (isNaN(year) || isNaN(month) || isNaN(day)) return null; // Vérifie si la chaîne de date est dans le bon format
            const normalizedMonth = month < 10 ? `0${month}` : `${month}`; // Ajoute un zéro devant le mois si nécessaire
            const normalizedDay = day < 10 ? `0${day}` : `${day}`; // Ajoute un zéro devant le jour si nécessaire
            return `${year}-${normalizedMonth}-${normalizedDay}`;
        }
        // Utilisation :
        const selectedDateNormalized = normalizeDate(selectedDate);
        console.log(selectedDateNormalized+"gggg");

        
        if (datesTraitees.includes(selectedDate)) {
            // La date a déjà été traitée, afficher les informations
            document.getElementById('info-content').innerHTML = `
                <h2>Détails de l'offre</h2>
                <p>Nom de l'offre : ${offreNom}</p>
                <p>Lieu de l'offre : ${offreLieu}</p>
            `;
        } 






        if (selectedDateNormalized === urlDate) {
            document.getElementById('info-content').innerHTML = `
                <h2>Détails de l'offre</h2>
                <p>Nom de l'offre : ${offreNom}</p>
                <p>Lieu de l'offre : ${offreLieu}</p>
            `;

        } else {
            document.getElementById('info-content').textContent = `Aucune information disponible pour cette date.`;
    }
       console.log(selectedDate);
    }
  });


  

/*
document.addEventListener('DOMContentLoaded', function() {
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');
    const currentMonthSpan = document.getElementById('current-month');
    const calendarBody = document.querySelector('#calendar tbody');
    const infoContent = document.getElementById('info-content');

    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    displayCalendar(currentMonth, currentYear);

    prevMonthBtn.addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        displayCalendar(currentMonth, currentYear);
    });

    nextMonthBtn.addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        displayCalendar(currentMonth, currentYear);
    });

    function displayCalendar(month, year) {
        calendarBody.innerHTML = '';
        const monthName = new Date(year, month).toLocaleString('default', { month: 'long' });
        currentMonthSpan.textContent = monthName + ' ' + year;

        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        let date = 1;
        for (let i = 0; i < 6; i++) {
            const row = document.createElement('tr');
            for (let j = 0; j < 7; j++) {
                if (i === 0 && j < firstDayOfMonth) {
                    const cell = document.createElement('td');
                    row.appendChild(cell);
                } else if (date > daysInMonth) {
                    break;
                } else {
                    const cell = document.createElement('td');
                    cell.textContent = date;
                    cell.dataset.date = `${year}-${month + 1}-${date}`;
                    row.appendChild(cell);
                    date++;
                }
            }
            calendarBody.appendChild(row);
        }
    }

    calendarBody.addEventListener('click', function(event) {
        if (event.target.tagName === 'TD') {
            const selectedDate = event.target.dataset.date;
            const offreNom = document.getElementById('Offre-details').getAttribute('data-nom');
            const offreLieu = document.getElementById('Offre-details').getAttribute('data-lieu');
            const urlDate = '<?= $date ?>'; // Récupérer la date depuis PHP

            if (selectedDate === urlDate) {
                infoContent.innerHTML = `
                    <h2>Détails de l'offre</h2>
                    <p>Nom de l'offre : ${offreNom}</p>
                    <p>Lieu de l'offre : ${offreLieu}</p>
                    <p>Date sélectionnée : ${selectedDate}</p>
                `;
            } else {
                infoContent.textContent = `Aucune information disponible pour cette date.`;
            }
        }
    });
});
*/

