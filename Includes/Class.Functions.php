<?php
//create function class
class Functions
{
	//Construct Function
	function __construct()
	{
		//Includes the php that contains the connection to the database
		include("Config.php");
		$this->_db = $db;
	}

	//Add User function
	public function addUser() //Linh
	{ //Function to create new account
		if (isset($_POST['register'])) { //When submit button pressed
			if (empty($_POST['fullname']) || empty($_POST['username']) || empty($_POST['password'])) { //Check if fields are empty
				$error = "You must enter an email and password to register."; //Send error
			} else {
				$fullname = $_POST["fullname"];
				$username = $_POST["username"];
				$password = password_hash($_POST["password"], PASSWORD_DEFAULT); //Hash password

				try {
					$query = $this->_db->prepare("INSERT INTO login (fullname, username, password) VALUES (:fullname, :username, :password)");
					$query->bindParam(":fullname", $fullname, PDO::PARAM_STR);
					$query->bindParam(":username", $username, PDO::PARAM_STR);
					$query->bindParam(":password", $password, PDO::PARAM_STR);
					$query->execute();

					header("location: https://aab.uogs.co.uk/Pages/LoginRegister/login.php"); //Once new account made, send to login page

				} catch (PDOException $e) {
					echo $e->getMessage(); //Send error
				}
			}
		}
	}

	//Log in function
	public function login() //Adam
	{
		global $error; //Variable to store error message
		if (isset($_POST['login'])) { //When the summit button is pressed		
			if (empty($_POST['username']) || empty($_POST['password'])) {  //If username or password is not correct
				$error = "Username or Password is invalid";  //Create this error  
			} else {    //If username or password is correct
				$username = $_POST['username'];
				$password = $_POST['password'];

				//Un-quotes the quoted string
				$username = stripslashes($username);
				$password = stripslashes($password);
				try {
					//Select data from the table in the database
					$query = $this->_db->prepare("SELECT * FROM login WHERE username=:username");
					//Binds a parameter to the specified variable name
					$query->bindParam(":username", $username, PDO::PARAM_STR);
					//Carry out the query
					$query->execute();
					//Catch an error raised by PDO.
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
				//Fetch data
				$row = $query->fetch();
				if ($row) {
					if (password_verify($password, $row['password'])) //If the password is correct
					{
						$_SESSION['session_id'] = session_id();
						$_SESSION['fullname'] = $row['fullname'];
						$_SESSION['username'] = $username;
						$_SESSION['loginid'] = $row['login_id'];
						header("location: https://aab.uogs.co.uk/Pages/Map/map.php"); //Redirecting to Map page
					} else {

						$error = "Password is invalid";
					}
				} else {
					$error = "Username is invalid";
				}
			}
		}
	}

	//Check if the user is logged in function
	public function checkLoggedIn() //Linh
	{
		try {
			$query = $this->_db->prepare("SELECT username FROM login WHERE username=:username");
			$query->bindParam(":username", $_SESSION['username'], PDO::PARAM_STR);
			$query->execute();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		$row = $query->fetch();
		$loggedInUser = $row['username'];
		//if the user is not logged in
		if (!isset($loggedInUser)) {
			//head to the log in page
			header("location: https://aab.uogs.co.uk/Pages/LoginRegister/login.php");
		}
	}

	//Check if the user has already logged in, if so take them to the CMS page (needs to be seperate to checkLoggedIn otherwise would force them to login page)
	public function checkLoginPage() { //Adam
		try {
			$query = $this->_db->prepare("SELECT username FROM login WHERE username=:username");
			$query->bindParam(":username", $_SESSION['username'], PDO::PARAM_STR);
			$query->execute();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}

		$row = $query->fetch();
		$loggedInUser = $row['username'];

		if(isset($loggedInUser)) {
			header('location: https://aab.uogs.co.uk/Pages/CMS/cmshome.php');
		}
	}

	public function getAllHunts($loginID) { //Function to get all hunts related to their ID - Adam
		try {
			$query = $this->_db->prepare("SELECT treasure_hunt_id, treasure_hunt_name, login_id FROM treasure_hunts WHERE login_id = :loginID ORDER BY treasure_hunt_id DESC");
			$query->bindParam(':loginID', $loginID, PDO::PARAM_INT);
			$query->execute();

		} catch (PDOException $e) {
			echo $e->getMessage(); //Send error
		}
		return $query; //Return results
	}

	public function getAllTreasureHunts() { // Function to get all treasure hunts - Adam
		try {
			$query = $this->_db->prepare("SELECT * FROM treasure_hunts ORDER BY treasure_hunt_created DESC");
			$query->execute();
			$data = $query->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getTreasureHuntInfo($treasureHuntID) { //Function to get all treasure hunt info - Adam
		try {
			$query = $this->_db->prepare("SELECT * FROM treasure_hunts_info WHERE treasure_hunt_id = :treasureHuntID ORDER BY info_created ASC");
			$query->bindParam(":treasureHuntID", $treasureHuntID, PDO::PARAM_INT);
			$query->execute();
			$data = $query->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function addHuntGroup() { //Create a hunt - Adam
		global $errorHunt;

		if(isset($_POST['btn-submit-hunt'])) {
			$_POST = array_map('stripslashes', $_POST);
			extract($_POST); //Get the name of the hunt group

			if($treasureHuntName == '') {
				$errorHunt[] = 'Please enter a name.';
			}

			if(!isset($errorHunt)) {
				try {
					$query = $this->_db->prepare('INSERT INTO treasure_hunts (treasure_hunt_name, login_id) VALUES (:treasureHuntName, :loginID)');
					$query->execute(array( //Insert hunt group name into database
						':treasureHuntName' => $treasureHuntName,
						':loginID' => $_SESSION['loginid']
					));

					echo("<script type='text/javascript'>alert('Hunt Added!');</script>"); //Alert the user it has been added
					header("Location: https://aab.uogs.co.uk/Pages/CMS/cmshome.php");
				} catch(PDOException $e) {
					echo $e->getMessage();
				}
			}
		}
	}

	public function addHuntMarkers() { //Create a marker - Adam
		global $errorMarker;

		if(isset($_POST['btn-submit-marker'])) {
			$_POST = array_map('stripslashes', $_POST);
			extract($_POST); //Get information from form

			if($markerName == '') {
				$errorMarker[] = 'Please enter a name.';
			}
			if($markerDesc == '') {
				$errorMarker[] = 'Please enter a description.';
			}
			if($markerLat == '') {
				$errorMarker[] = 'Please enter a latitude.';
			}
			if($markerLng == '') {
				$errorMarker[] = 'Please enter a longitude.';
			}

			if(!isset($errorMarker)) {
				try {
					$query = $this->_db->prepare('INSERT INTO treasure_hunts_info (info_name, info_description, info_lat, info_lng, treasure_hunt_id) VALUES (:markerName, :markerDesc, :markerLat, :markerLng, :treasureHuntID)');
					$query->execute(array( //Insert marker information to database with the ID of whichever hunt group has been chosen
						':treasureHuntID' => $huntGroup,
						':markerName' => $markerName,
						':markerDesc' => $markerDesc,
						':markerLat' => $markerLat,
						':markerLng' => $markerLng
					));

					echo("<script type='text/javascript'>alert('Hunt Marker Added!');</script>"); //Alert user it's been added to the database
					header("Location: https://aab.uogs.co.uk/Pages/CMS/cmshome.php");
				} catch(PDOException $e) {
					echo $e->getMessage();
				}
			}
		}
	}

	public function getTreasureHuntByID($treasureHuntID) { //Get treasure hunts by ID - Adam
		try {
			$query = $this->_db->prepare("SELECT * FROM treasure_hunts WHERE treasure_hunt_id = :treasureHuntID ORDER BY treasure_hunt_created ASC");
			$query->bindParam(":treasureHuntID", $treasureHuntID, PDO::PARAM_INT);
			$query->execute();

		} catch (PDOException $e) {
			echo $e->getMessage(); //Send error
		}
		return $query; //Return results
	}

	public function getTreasureHuntInfoByID($treasureHuntID) { //Get treasure hunt info by ID - Adam
		try {
			$query = $this->_db->prepare("SELECT * FROM treasure_hunts_info WHERE treasure_hunt_id = :treasureHuntID ORDER BY info_created ASC");
			$query->bindParam(":treasureHuntID", $treasureHuntID, PDO::PARAM_INT);
			$query->execute();

		} catch (PDOException $e) {
			echo $e->getMessage(); //Send error
		}
		return $query; //Return results
	}

	public function editHunt() { //Edit treasure hunts - Adam
		global $editError;

		if(isset($_POST['btn-submit-edit'])) { //Get edited information
			if($_POST['markerName'] == '') {
				$errorMarker[] = 'Please enter a name.';
			}
			if($_POST['markerDesc'] == '') {
				$errorMarker[] = 'Please enter a description.';
			}
			if($_POST['markerLat'] == '') {
				$errorMarker[] = 'Please enter a latitude.';
			}
			if($_POST['markerLng'] == '') {
				$errorMarker[] = 'Please enter a longitude.';
			}

			if(!isset($editError)) {
				try {
					$query = $this->_db->prepare('UPDATE treasure_hunts SET treasure_hunt_name=:treasureHuntName WHERE treasure_hunt_id=:treasureHuntID');
					$query->bindParam(':treasureHuntName', $_POST['treasureHuntName'], PDO::PARAM_STR);
					$query->bindParam(':treasureHuntID', $_POST['treasureHuntID'], PDO::PARAM_INT);
					$query->execute(); //Update database with new hunt name

					foreach($_POST['huntInfoID'] as $huntInfoID) { //For each marker listed, update the database with new marker information
						$query = $this->_db->prepare('UPDATE treasure_hunts_info SET info_name=:infoName, info_description=:infoDesc, info_lat=:infoLat, info_lng=:infoLng WHERE treasure_hunt_id=:treasureHuntID AND hunt_info_id=:huntInfoID');
						$query->execute(array(
							':infoName' => $_POST['markerName'][$huntInfoID],
							':infoDesc' => $_POST['markerDesc'][$huntInfoID],
							':infoLat' => $_POST['markerLat'][$huntInfoID],
							':infoLng' => $_POST['markerLng'][$huntInfoID],
							':treasureHuntID' => $_POST['treasureHuntID'],
							':huntInfoID' => $huntInfoID
						));
					}

					echo("<script type='text/javascript'>alert('Hunt Information Updated!');</script>"); //Alert the user it was edited successfully
					header("Location: https://aab.uogs.co.uk/Pages/CMS/cmshome.php");
				} catch (PDOException $e) {
					echo $e->getMessage(); //Send error
				}
			}
		}
	}

	public function deleteHuntGroup($treasureHuntID) { //Delete a hunt group - Adam
		try {
			$query = $this->_db->prepare("DELETE FROM treasure_hunts_info WHERE treasure_hunt_id = :treasureHuntID");
			$query->bindParam('treasureHuntID', $treasureHuntID, PDO::PARAM_INT);
			$query->execute(); //First remove the markers relating to that group so they aren't left

			$query = $this->_db->prepare("DELETE FROM treasure_hunts WHERE treasure_hunt_id = :treasureHuntID");
			$query->bindParam('treasureHuntID', $treasureHuntID, PDO::PARAM_INT);
			$query->execute(); //Then remove the group itself
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function deleteHuntMarker($treasureHuntID) { //Delete a hunt marker - Adam
		try {
			$query = $this->_db->prepare("DELETE FROM treasure_hunts_info WHERE hunt_info_id = :treasureHuntID");
			$query->bindParam('treasureHuntID', $treasureHuntID, PDO::PARAM_INT);
			$query->execute(); //Delete the hunt marker depending on what it's ID is
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
    
    public function addLeaderboardScore(){ //Add the leaderboard score to database - Linh
        try{
            $query=$this->_db->prepare("UPDATE login SET leaderboard_score = leaderboard_score + 1  WHERE login_id= :loginID"); //Update the leaderboard score row +1
            $query->bindParam('loginID', $_SESSION["loginid"], PDO::PARAM_INT);
            $query->execute(); 
        } catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getLeaderboardScore() { //Get the leaderboard score to show on leaderboard page - Linh
		try{
			$query = $this->_db->prepare("SELECT login_id, fullname, username, leaderboard_score FROM login ORDER BY leaderboard_score DESC"); //Get all information and order by highest score
			$query->execute();
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		return $query;
	}
}