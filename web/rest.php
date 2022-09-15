<?php
  require_once "model.php";
  $id = ConnectDB(); //---CONNEXION A LA BDD
//---SELECTIONNER TT LES USERS
  /*$req = "select * from utilisateur";
  $tableauDeDonnees = array();
  $res = executerRequete($id,$req,$tableauDeDonnees);
  print_r($res);*/

//---RECUP LES INFOS DE LA REQUETE
  $req_type = $_SERVER["REQUEST_METHOD"];
  $req_path = $_SERVER["PATH_INFO"];
  $req_data = explode("/", $req_path);

//---GET
  if($req_type == "GET")
  {
    //---SI LA REQUETE CONTIENS VOLS
    if($req_data[1] == "vols")
    {
      //---SI LA REQUETE CONTIENS UN NOM D'UTILISATEUR
      if(isset($req_data[2]))
      {
        //---
      }
    }
    //---SI LA REQUETE CONTIENS UTILISATEURS
    if($req_data[1] == "utilisateurs")
    {
      //---SI LA REQUETE CONTIENS UN NOM D'UTILISATEUR
      if(isset($req_data[2]))
      {
        //---
      }
    }
  }

//---POST
  else if($req_type == "POST")
  {
    $donneesVolJSON = file_get_contents("php://input"); //---RECUP LE CONTENU DU FICHIER JSON ENVOYE DANS LE REQUETE
    $donneesVolAssoc = json_decode($donneesVolJSON, true);

    //---SI LA REQUETE CONTIENS VOLS
    if($req_data[1] == "vols")
    {
      $nomVol = $donneesVolAssoc["donneesVol"]["nom"];
      $time = $donneesVolAssoc["donneesVol"]["time"];
      $dateVol = date('Y-m-d H-i-s', $time);
      $numeroDrone = $donneesVolAssoc["donneesVol"]["numero"];
      $etatsVol = $donneesVolAssoc["donneesVol"]["etats"];

      //---SELECTIONNER L'ID UTILISATEUR EN CONNAISSANT LE NOM
      $reqUtilisateur = "select idutilisateur from utilisateur where nom = ?";
      $tableauDeDonnees = array($nomVol);
      $resUtilisateur = executerRequete($id,$reqUtilisateur,$tableauDeDonnees);

      //---SELECTIONNER L'ID DRONE EN CONNAISSANT LA REF DU DRONE
      $reqDrone = "select iddrone from drone where refdrone = ?";
      $tableauDeDonnees = array($numeroDrone);
      $resDrone = executerRequete($id,$reqDrone,$tableauDeDonnees);

      //---SI LE DRONE EXISTE
      if(!empty($resDrone))
      {
        $idDrone = $resDrone["0"]["iddrone"];
        //setcookie("iddrone", $idDrone, "time()+3600","http://172.20.21.208/~nikola/MW08/web/rest.php");
      }

      //---SI LE DRONE N'EXISTE PAS
      if(!isset($idDrone))
      {
        $reqDrone = "insert into drone (refdrone) values (?)";
        $tableauDeDonnees = array($numeroDrone);
        $resDrone = executerRequete($id, $reqDrone, $tableauDeDonnees);
        //$idCookie = recupererLeDernierIdInserer($id);
        //setcookie("iddrone", $idCookie, "time()+3600","http://172.20.21.208/~nikola/MW08/web/rest.php");
      }

      //---SI L'UTILISATEUR EXISTE
      if(!empty($resUtilisateur))
      {
        $idUtilisateur = $resUtilisateur["0"]["idutilisateur"];
        //setcookie("idutilisateur", $idUtilisateur, "time()+3600","http://172.20.21.208/~nikola/MW08/web/rest.php");

        //---SELECTIONNER L'ID VOL EN CONNAISSANT L'ID UTILISATEUR, LA DATE ET L'ID DU DRONE
        $reqVol = "select idvol from vol where idutilisateur = ? and datevol = ? and iddrone = ?";
        $tableauDeDonnees = array($idUtilisateur, $dateVol, $idDrone);
        $resVol = executerRequete($id,$reqVol,$tableauDeDonnees);

        //---SI LE VOL EXISTE
        if(!empty($resVol))
        {
          $idVol = $resVol["0"]["idvol"];
          //setcookie("idvol", $idVol, "time()+3600","http://172.20.21.208/~nikola/MW08/web/rest.php");

          for($i = 0; $i < count($etatsVol); $i++)
          {
            foreach ($donneesVolAssoc["donneesVol"]["etats"][$i] as $cle => $valeur)
            {
              $$cle = $valeur;
            }
          }
          //---INSERER L'ETAT DE VOL DANS ETAT DRONE
          $reqEtat = "insert into etat (idvol, pitch, roll, yaw, vgx, vgy, vgz, templ, temph, tof, h, bat, baro, time, agx, agy, agz) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
          $tableauDeDonnees = array($idVol, $pitch, $roll, $yaw, $vgx, $vgy, $vgz, $templ, $temph, $tof, $h, $bat, $baro, $time, $agx, $agy, $agz);
          $resEtat = executerRequete($id,$reqEtat,$tableauDeDonnees);

        }

        //---SI LE VOL N'EXISTE PAS
        if(!isset($idVol))
        {
          $reqVol = "insert into vol (idutilisateur, datevol, iddrone) values (?,?,?)";
          $tableauDeDonnees = array($idUtilisateur, $dateVol, $idDrone);
          $resVol = executerRequete($id, $reqVol, $tableauDeDonnees);
          //$idCookie = recupererLeDernierIdInserer($id);
          //setcookie("idvol", $idCookie, "time()+3600","http://172.20.21.208/~nikola/MW08/web/rest.php");
        }
      }

      //---SI L'UTILISATEUR N'EXISTE PAS
      if(!isset($idUtilisateur))
      {
        $reqUtilisateur = "insert into utilisateur (nom) values (?)";
        $tableauDeDonnees = array($nomVol);
        $resUtilisateur = executerRequete($id, $reqUtilisateur, $tableauDeDonnees);
        //$idCookie = recupererLeDernierIdInserer($id);
        //setcookie("idutilisateur", $idCookie, "time()+3600","http://172.20.21.208/~nikola/MW08/web/rest.php");
      }

      //---SI LA REQUETE CONTIENS UN NOM D'UTILISATEUR
      if(isset($req_data[2]))
      {
        //---
      }
    }

    //---SI LA REQUETE CONTIENS UTILISATEUR
    if($req_data[1] == "utilisateurs")
    {
      //---SI LA REQUETE CONTIENS UN NOM D'UTILISATEUR
      if(isset($req_data[2]))
      {
        //---
      }
    }
  }

//---Modèle Requète---
  /*$mydb=new PDO("mysql:host=localhost;dbname=MW04_drone_nikola;charset=utf8","nikola","snirlla");
  $req="select nom,prenom from utilisateur";
  $reqpreparer=$mydb->prepare($req);
  $tableauDeDonnees=array();
  $reqpreparer->execute($tableauDeDonnees);
  $reponse=$reqpreparer->fetchAll(PDO::FETCH_ASSOC);
  print_r($reponse);*/
?>
