<?php

class Reponse
{
    private ?int $id_rep = null;
    private ?int $id_rec = null;
    private ?string $rep = null;



    public function __construct($id_rep = null,$id_rec = null, $rep)
    {
        $this->id_rep= $id_rep;
        $this->id_rec= $id_rec;
        $this->rep= $rep;
       
    }

    public function getid_rep()
    {
        return $this->id_rep;
    }
    public function getid_rec()
    {
        return $this->id_rec;
    }
    public function getrep()
    {
        return $this->rep;
    }
    
    /**
     * Set the value of nom
     *
     * @return  self
     */

     public function setid_rec($id_rec)
     {
         $this->id_rec = $id_rec;
 
         return $this;
     }



    public function setrep($rep)
    {
        $this->rep = $rep;

        return $this;
    }
}