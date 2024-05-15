<?php
include "../config.php";
include "../Model/Reclamation.php";

class ReclamationC
{
    public function ListReclamations()
{
    $sql = "SELECT r.id_rec, r.nom, r.mail, r.reclam, rp.rep 
            FROM reclamations r 
            LEFT JOIN reponses rp ON r.id_rec = rp.id_rec";
    $db = config::getConnexion();
    try {
        $liste = $db->query($sql);
        return $liste;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}


    public function deleteReclamation($id_rec)
    {
        if (isset($_POST['delete'])) {
            $sql = "DELETE FROM reclamations WHERE id_rec= :id_rec";
            $db= config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(':id_rec', $id_rec);
    
            try {
                $req->execute();
                echo "La réclamation a été supprimée avec succès";
            } catch (Exception $e) {
                die('Error:' .$e->getMessage());
            }
        }
    }

    public function addReclamation($Reclamation)
    {
        $sql= "INSERT INTO reclamations
        VALUES (NULL, :nom ,:mail, :reclam)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                 'nom' => $Reclamation->getNom(),
                'mail' => $Reclamation->getmail(),
                'reclam' => $Reclamation->getreclam()
                        ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function updateReclamation($Reclamation , $id_rec)
        {
            try {
                $db = config::getConnexion();
                $query = $db->prepare(
                    'UPDATE reclamations SET nom=:nom, mail=:mail, reclam=:reclam WHERE id_rec= :id_rec');
                $query->execute([
                    'id_rec' => $id_rec,
                    'nom' => $Reclamation->getNom(),
                    'mail' => $Reclamation->getmail(),
                    'reclam' => $Reclamation->getreclam()

                ]);
                echo $query->rowCount() . "records UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }

        public function showReclamation($id_rec)
        {
            $sql = "SELECT * FROM reclamations WHERE id_rec= $id_rec";
            $db = config::getConnexion();
            try {
                $query = $db->prepare($sql);
                $query->execute();

                $Reclamation = $query->fetch();
                return $Reclamation;
            } catch (Exception $e) {
                die('Error: ' .$e->getMessage());
            }
        }

        public function trinom()
	{
		$db = config::getConnexion();
    	$sql = "SELECT * FROM reclamations ORDER BY nom ASC;";
		
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	
	}
    public function trimail()
	{
		$db = config::getConnexion();
    	$sql = "SELECT * FROM reclamations ORDER BY mail ASC;";
		
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	
	}
    public function trireclam()
	{
		$db = config::getConnexion();
    	$sql = "SELECT * FROM reclamations ORDER BY reclam ASC;";
		
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	
	}
}