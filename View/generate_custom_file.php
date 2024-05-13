<?php/*
// Inclure la bibliothèque TCPDF
require_once('C:/xampp/htdocs/nouveau/tcpdf_6_3_2/tcpdf/tcpdf.php');

// Inclure CompetenceController
include 'C:/xampp/htdocs/nouveau/controller/compC.php';

// Créer une instance de CompetenceController
$competenceController = new CompetenceController();

// Récupérer l'identifiant de la candidature depuis l'URL
$id_candidature = $_GET['id_candidature'];

// Récupérer les compétences associées à la candidature spécifiée
$competences = $competenceController->getCompetencesByCandidatureId($id_candidature);

// Créer un nouvel objet TCPDF
$pdf = new TCPDF();

// Définir les métadonnées du PDF
$pdf->SetCreator('Your Application');
$pdf->SetTitle('Compétences associées à la candidature');

// Ajouter une page au PDF
$pdf->AddPage();

// Ajouter le contenu des compétences au PDF
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Compétences associées à la candidature :', 0, 1);
foreach ($competences as $competence) {
    $pdf->Cell(0, 10, "- " . $competence['nom'], 0, 1);
}

// Télécharger le fichier PDF
ob_end_clean(); // Vider tout contenu en mémoire tampon
$pdf->Output('competences_associated_with_candidature.pdf', 'D');*/
?>


<?php
// Inclure la bibliothèque TCPDF
require_once('C:/xampp/htdocs/projet/tcpdf_6_3_2/tcpdf/tcpdf.php');

// Inclure CompetenceController
include 'C:/xampp/htdocs/projet/controller/compC.php';

// Créer une instance de CompetenceController
$competenceController = new CompetenceController();

// Récupérer l'identifiant de la candidature depuis l'URL
$id_candidature = $_GET['id_candidature'];

// Récupérer les compétences associées à la candidature spécifiée
$competences = $competenceController->getCompetencesByCandidatureId($id_candidature);

// Créer un nouvel objet TCPDF
$pdf = new TCPDF();

// Définir les métadonnées du PDF
$pdf->SetCreator('Your Application');
$pdf->SetTitle('Compétences associées à la candidature');

// Ajouter une page au PDF
$pdf->AddPage();

// Ajouter le titre "JobFlash"
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'JobFlash', 0, 1, 'C');

// Ajouter le titre "Compétences associées à la candidature"
$pdf->SetFont('helvetica', '', 14);
$pdf->Cell(0, 10, 'Compétences associées à la candidature ' . $id_candidature, 0, 1, 'C');
$pdf->Ln();

// Ajouter le contenu des compétences au PDF
$pdf->SetFont('helvetica', '', 12);
$pdf->SetFillColor(173, 216, 230); // Bleu clair
$pdf->Cell(63.3, 10, 'Nom', 1, 0, 'C', 1);
$pdf->Cell(63.3, 10, 'Niveau', 1, 0, 'C', 1);
$pdf->Cell(63.3, 10, 'Description', 1, 1, 'C', 1);

foreach ($competences as $competence) {
    $pdf->Cell(63.3, 10, $competence['nom'], 1, 0, 'L');
    $pdf->Cell(63.3, 10, $competence['niveau'], 1, 0, 'L');
    $pdf->MultiCell(63.3, 10, $competence['description'], 1, 'L');
}

// Télécharger le fichier PDF
ob_end_clean(); // Vider tout contenu en mémoire tampon
$pdf->Output('competences_associated_with_candidature.pdf', 'D');
?>
