<?php
 
class DbOperation
{
    //Database connection link
    private $con;
 
    //Class constructor
    function __construct()
    {
        //Getting the DbConnect.php file
        require_once dirname(__FILE__) . '/DbConnect.php';
 
        //Creating a DbConnect object to connect to the database
        $db = new DbConnect();
 
        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->con = $db->connect();
	}
	
	function getSlike(){
		$stmt = $this->con->prepare("SELECT id,url,opis,lajkovi FROM image");
		$stmt->execute();
		$stmt->bind_result($id, $url, $opis, $lajkovi);
		
		$slike = array(); 
		
		while($stmt->fetch()){
			$slika  = array();
			$slika['id'] = $id; 
			$slika['url'] = $url; 
			$slika['lajkovi'] = $lajkovi; 
			$slika['opis'] = $opis; 
			
			array_push($slike, $slika); 
		}
		
		return $slike; 
	}
    function getSkocko(){
	//	echo rand(5, 15);
		$skocko=array();
		
		$prvi=rand(1, 6);
		$drugi=rand(1, 6);
		$treci=rand(1, 6);
		$cetvrti=rand(1,6);
		array_push($skocko,$prvi);
		array_push($skocko,$drugi);
		array_push($skocko,$treci);
		array_push($skocko,$cetvrti);
		$niz['res'] = $skocko; 
		// for(int i=0;i<4;i++){
		// 	array_push(rand(1, 6));
		// }
		return $niz;
	}
	function like($id, $likes){
		$updatedLike = $likes + 1;
		$stmt = $this->con->prepare("UPDATE image SET lajkovi = ? WHERE id = ?");
		$stmt->bind_param("ii", $updatedLike, $id);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	
	/*
	* The create operation
	* When this method is called a new record is created in the database
	*/
	function createHero($name, $realname, $rating, $teamaffiliation){
		$stmt = $this->con->prepare("INSERT INTO heroes (name, realname, rating, teamaffiliation) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssis", $name, $realname, $rating, $teamaffiliation);
		if($stmt->execute())
			return true; 
		return false; 
	}
function createImage($opis, $lajkovi){
		$stmt = $this->con->prepare("INSERT INTO image (opis,lajkovi) VALUES (?,?)");
		$stmt->bind_param("si", $opis,$lajkovi);
		if($stmt->execute())
			return true; 
		return false; 
	}
	/*
	* The read operation
	* When this method is called it is returning all the existing record of the database
	*/
	function getHeroes(){
		$stmt = $this->con->prepare("SELECT id, name, realname, rating, teamaffiliation FROM heroes");
		$stmt->execute();
		$stmt->bind_result($id, $name, $realname, $rating, $teamaffiliation);
		
		$heroes = array(); 
		
		while($stmt->fetch()){
			$hero  = array();
			$hero['id'] = $id; 
			$hero['name'] = $name; 
			$hero['realname'] = $realname; 
			$hero['rating'] = $rating; 
			$hero['teamaffiliation'] = $teamaffiliation; 
			
			array_push($heroes, $hero); 
		}
		
		return $heroes; 
	}
	
	/*
	* The update operation
	* When this method is called the record with the given id is updated with the new given values
	*/
	function updateHero($id, $name, $realname, $rating, $teamaffiliation){
		$stmt = $this->con->prepare("UPDATE heroes SET name = ?, realname = ?, rating = ?, teamaffiliation = ? WHERE id = ?");
		$stmt->bind_param("ssisi", $name, $realname, $rating, $teamaffiliation, $id);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	
	/*
	* The delete operation
	* When this method is called record is deleted for the given id 
	*/
	function deleteHero($id){
		$stmt = $this->con->prepare("DELETE FROM heroes WHERE id = ? ");
		$stmt->bind_param("i", $id);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	function deleteImage($id){
		$stmt = $this->con->prepare("DELETE FROM image WHERE id = ? ");
		$stmt->bind_param("i", $id);
		if($stmt->execute())
			return true; 
		
		return false; 
	}
	
}
