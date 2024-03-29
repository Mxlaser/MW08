<?php
/****** Connexion au serveur de BdD *******/
function ConnectDB() {
	$ini = parse_ini_file("app.ini", true);
	$db = $ini['database'];
	$id = new PDO('mysql:host='.$db['host'].';dbname='.$db['name'].';charset=utf8', $db['user'], $db['pass']);
	return $id;
}

function executerRequete($id,$req,$tableauDeDonnees){
	$res=preparerRequete($id,$req);
	$res=executerRequetePrepare($res,$tableauDeDonnees);
	return extraireDonneesRequetePrepare($res);

}

function preparerRequete($id,$req){
	$res=$id->prepare($req, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	return $res;
}

function executerRequetePrepare($res,$tableauDeDonnees){
	$res->execute($tableauDeDonnees);
  return $res;
}

function extraireDonneesRequetePrepare($res){
	  return $res->fetchAll(PDO::FETCH_ASSOC);
}

function recupererLeDernierIdInserer($id){
	  return $id->lastInsertId();
}

function fermerCursor($res){
	$res->closeCursor();
}

function executerRequeteCurl($donnees,$method){
  $url='http://172.20.21.208/~nikola/MW08/web/rest.php';
  $url.=$donnees;
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL,$url );
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));

  $tabListMission=curl_exec($curl);curl_error($curl);
	curl_close($curl);
  $ListMissionJSON=json_decode($tabListMission,true);

  return $ListMissionJSON;
}
?>
