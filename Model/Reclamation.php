<?php

class Reclamation
{
    private ?int $id_rec = null;
    private ?string $nom = null;
    private ?string $mail = null;
    private ?string $reclam = null;



    public function __construct($id_rec = null, $nom, $mail, $reclam)
    {
        $this->id_rec= $id_rec;
        $this->nom= $nom;
        $this->mail= $mail;
        $this->reclam= $reclam;

    }

    public function getid_rec()
    {
        return $this->id_rec;
    }

    public function getnom()
    {
        return $this->nom;
    }

    public function getmail()
    {
        return $this->mail;
    }

    public function getreclam()
    {
        return $this->reclam;
    }
    
    /**
     * Set the value of nom
     *
     * @return  self
     */

     public function setnom($nom)
     {
         $this->nom = $nom;
 
         return $this;
     }
     public function setmail($mail)
    {
        $this->mail = $mail;

        return $this;
    }


    public function setreclam($reclam)
    {
        $this->reclam = $reclam;

        return $this;
    }
}