<?php
include "../config.php";
include "../Model/Reponse.php";

class ReponseC
{
    public function listReponses()
    {
        $sql = "SELECT * FROM reponses";
        $db =  config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deleteReponse($id_rep)
    {
        if (isset($_POST['delete'])) {
            $sql = "DELETE FROM reponses WHERE id_rep= :id_rep";
            $db= config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(':id_rep', $id_rep);
    
            try {
                $req->execute();
                echo "La reponse a été supprimée avec succès";
            } catch (Exception $e) {
                die('Error:' .$e->getMessage());
            }
        }
    }

    public function addReponse($Reponse)
    {
        $sql = "INSERT INTO reponses (id_rec, rep) VALUES (:id_rec, :rep)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_rec' => $Reponse->getid_rec(),
                'rep' => $Reponse->getrep()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    

    public function updateReponse($Reponse , $id_rep)
        {
            try {
                $db = config::getConnexion();
                $query = $db->prepare(
                    'UPDATE reponses SET id_rec=:id_rec, rep=:rep WHERE id_rep= :id_rep');
                $query->execute([
                    'id_rep' => $id_rep,
                    'id_rec' => $Reponse->getid_rec(),
                    'rep' => $Reponse->getrep(),

                ]);
                echo $query->rowCount() . "records UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }

        public function showReponse($id_rep)
        {
            $sql = "SELECT * FROM reponses WHERE id_rep= $id_rep";
            $db = config::getConnexion();
            try {
                $query = $db->prepare($sql);
                $query->execute();

                $Reponse = $query->fetch();
                return $Reponse;
            } catch (Exception $e) {
                die('Error: ' .$e->getMessage());
            }
        }
}