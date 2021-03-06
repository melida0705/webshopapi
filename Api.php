<?php 

	//getting the dboperation class
	require_once 'DbOperation.php';
	function getSkocko(){
		//	echo rand(5, 15);
			$skocko=array();
			
			$prvi=rand(1, 6);
			$drugi=rand(1, 6);
			$treci=rand(1, 6);
			$cetvrti=rand(1,6);
			
			$finalni=$prvi+$drugi+$treci+$cetvrti;
			array_push($skocko,$prvi);
			array_push($skocko,$drugi);
			array_push($skocko,$treci);
			array_push($skocko,$cetvrti);
			$finalni=1254;
			// for(int i=0;i<4;i++){
			// 	array_push(rand(1, 6));
			// }
			return $finalni;
		}
	//function validating all the paramters are available
	//we will pass the required parameters to this function 
	function isTheseParametersAvailable($params){
		//assuming all parameters are available 
		$available = true; 
		$missingparams = ""; 
		
		foreach($params as $param){
			if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
				$available = false; 
				$missingparams = $missingparams . ", " . $param; 
			}
		}
		
		//if parameters are missing 
		if(!$available){
			$response = array(); 
			$response['error'] = true; 
			$response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
			
			//displaying error
			echo json_encode($response);
			
			//stopping further execution
			die();
		}
	}
	
	//an array to display response
	$response = array();
	
	//if it is an api call 
	//that means a get parameter named api call is set in the URL 
	//and with this parameter we are concluding that it is an api call
	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
			
			//the CREATE operation
			//if the api call value is 'createhero'
			//we will create a record in the database
			case 'getSlike':
				$db = new DbOperation();
				// $response['error'] = false; 
				$response['message'] = 'Request successfully completed';
				$response['slike'] = $db->getSlike();
			break; 
			case 'skocko':
				//$db = new DbOperation();
				// $response['error'] = false; 
				$response['message'] = 'Request successfully completed';
				$response['skocko'] = getSkocko();
                
			break;
			case 'like':

				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['id'])){
					$db = new DbOperation();
					if($db->like($_GET['id'], $_GET['like'])){
						$response['error'] = false; 
						$response['message'] = 'Like updated successfully';
					}else{
						$response['error'] = true; 
						$response['message'] = 'Some error occurred please try again';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nothing to delete, provide an id please';
				}
			break; 
			case 'user':

				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['id'])){
					$db = new DbOperation();
					if($db->login($_GET['username'], $_GET['password'])){
						$response['error'] = false; 
						$response['message'] = 'Like updated successfully';
						$response['user']=getUser();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Some error occurred please try again';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nothing to delete, provide an id please';
				}
			break; 
			case 'createhero':
				//first check the parameters required for this request are available or not 
				isTheseParametersAvailable(array('name','realname','rating','teamaffiliation'));
				
				//creating a new dboperation object
				$db = new DbOperation();
				
				//creating a new record in the database
				$result = $db->createHero(
					$_POST['name'],
					$_POST['realname'],
					$_POST['rating'],
					$_POST['teamaffiliation']
				);
				

				//if the record is created adding success to response
				if($result){
					//record is created means there is no error
					$response['error'] = false; 

					//in message we have a success message
					$response['message'] = 'Hero addedd successfully';

					//and we are getting all the heroes from the database in the response
					$response['heroes'] = $db->getHeroes();
				}else{

					//if record is not added that means there is an error 
					$response['error'] = true; 

					//and we have the error message
					$response['message'] = 'Some error occurred please try again';
				}
				
			break; 
			case 'createimage':
				//first check the parameters required for this request are available or not 
				//isTheseParametersAvailable(array('opis','lajkovi'));
				
					$db = new DbOperation();
					if($db->createImage($_GET['opis'], $_GET['lajkovi'])){
						$response['error'] = false; 
						$response['message'] = 'Like updated successfully';
					}else{
						$response['error'] = true; 
						$response['message'] = 'Some error occurred please try again';
						$response['posalto']= $_GET['opis'];
					}
				
				//creating a new dboperation object
// 				$db = new DbOperation();
				
// 				//creating a new record in the database
// 				$result = $db->createImage(
// 					$_GET['opis'],
// 					$_GET['lajkovi'],
					
// 				);
				

				//if the record is created adding success to response
// 				if($result){
// 					//record is created means there is no error
// 					$response['error'] = false; 

// 					//in message we have a success message
// 					$response['message'] = 'Hero addedd successfully';

// 					//and we are getting all the heroes from the database in the response
// 					$response['heroes'] = $db->getSlike();
// 				}else{

// 					//if record is not added that means there is an error 
// 					$response['error'] = true; 

// 					//and we have the error message
// 					$response['message'] = 'Some error occurred please try again';
// 				}
				
			break; 
			//the READ operation
			//if the call is getheroes
			case 'getheroes':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Request successfully completed';
				$response['heroes'] = $db->getHeroes();
			break; 
			
			
			//the UPDATE operation
			case 'updatehero':
				isTheseParametersAvailable(array('id','name','realname','rating','teamaffiliation'));
				$db = new DbOperation();
				$result = $db->updateHero(
					$_POST['id'],
					$_POST['name'],
					$_POST['realname'],
					$_POST['rating'],
					$_POST['teamaffiliation']
				);
				
				if($result){
					$response['error'] = false; 
					$response['message'] = 'Hero updated successfully';
					$response['heroes'] = $db->getHeroes();
				}else{
					$response['error'] = true; 
					$response['message'] = 'Some error occurred please try again';
				}
			break; 
			
			//the delete operation
			case 'deletehero':

				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['id'])){
					$db = new DbOperation();
					if($db->deleteHero($_GET['id'])){
						$response['error'] = false; 
						$response['message'] = 'Hero deleted successfully';
						$response['heroes'] = $db->getHeroes();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Some error occurred please try again';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nothing to delete, provide an id please';
				}
			break; 
				case 'deleteimage':

				//for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
				if(isset($_GET['id'])){
					$db = new DbOperation();
					if($db->deleteImage($_GET['id'])){
						$response['error'] = false; 
						$response['message'] = 'Hero deleted successfully';
						$response['slike'] = $db->getSlike();
					}else{
						$response['error'] = true; 
						$response['message'] = 'Some error occurred please try again';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Nothing to delete, provide an id please';
				}
			break; 
		}
		
	}else{
		//if it is not api call 
		//pushing appropriate values to response array 
		$response['error'] = true; 
		$response['message'] = 'Invalid API Call';
	}
	
	//displaying the response in json structure 
	echo json_encode($response);
	
	
