<?php 

    //require_once 'views/vue_principale.php'; //la sol pr le prob d'inclusion des 
    // fichiers et donc de 'undefined variable' => ne pas inclure ce fichier ici
    // ala khater ena amalt l'inclusion bch f index k n3ayet lel controller
    // ahawka f wostou la vue principale mais de cette façon plus tard bch yabda
    //ya9ra w bch yabda bel vue principale elly feha $content benesba liih non
    // déclarée khater mezel mawsolch lel appel mtae create() ou y'a l'integ
    // du fichier vue_create()
    require_once 'model/model.php';
    
        function test(){
            $x = connexion();
            echo "cnx réussie à la BD";
        }

        function create(){
            require_once 'views/vue_create.php';
        }

        function create_skills(){
            require_once 'views/vue_skills.php';
        }

        function afficher(){
            $elements = get_data();
            require_once 'views/vue_afficher.php';
        }

        function see_skills(){
            $elements = get_data2();
            require_once 'views/vue_see_skills.php';
        }


        function store(){
            send_data();
            require_once 'index.php';
        }
        

        function delete(){
    
            $id = $_GET['id'];//fazzet supp lkol f get  w fel href w lview inutile à moins que bch taamel zeyed
            delete_data($id);
            //require_once 'index.php';
            require_once 'afficher.php';
        }


        function delete2(){
    
            $id = $_GET['id'];
            delete_data2($id);
            require_once 'see_skills.php';
        }

        
        
        function edit(){
            $id = $_GET['id'];
            $element= edit_data($id);
            require_once 'views/vue_edit.php';
        }


        function edit2(){
            $id = $_GET['id'];
            $element= edit_data2($id);
            require_once 'views/vue_edit2.php';
        }


        function update(){
            $id = $_POST['id'];
            $date = $_POST['date'];
            $cv = $_POST['cv'];
            $lettre = $_POST['lettre'];
            update_data ($id,$date, $cv, $lettre);
            require_once 'index.php';
        }

        function update2(){
            $id = $_POST['id_skill'];
            $nom = $_POST['nom'];
            $niveau= $_POST['niveau'];
            $description = $_POST['description'];
            update_data2 ($id,$nom, $niveau, $description);
            require_once 'see_skills.php';
        }
        

        function new_id(){
            $nouvel_id  = generate_new_id(); //recup de l'id et l'envoyer vers vue
            return $nouvel_id;
            //require_once 'views/vue_create.php';
        }
        
        function new_id2(){
            $last_id = get_id2();
            $nouvel_id= $last_id + 1;
            //echo $nouvel_id;
            return $nouvel_id;
            //require_once 'views/vue_create.php';
        }


        function store2(){
            send_data2();
            require_once 'views/vue_skills.php';
        }


       // Contrôleur
    function afficher_comp($candidature_id){
        $competences = get_data_comp($candidature_id);
        require_once 'views/vue_cand_comp.php'; // La vue appropriée est appelée depuis le contrôleur
    }

        
    function get_last_id_cand(){
        $nvid = get_last_id_cand_requete();
        return $nvid;
    }





?>