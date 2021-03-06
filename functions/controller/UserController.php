<?php
    require_once '../functions/datalayer/UserDB.php';

    Class UserController {
        
        private $UserDB;   
    
        public function __construct(){
            $this->UserDB = new UserDB();
        }

        function getUsers($status) {
            // Creating a array
            $listUsers = array();

            $listUsers = $this->UserDB->getUsers($status);

            // Returning the list given from the Database class
            return $listUsers;
        }

        function getUsersCustomer($customerID, $status){
            // Creating a array
            $listUsers = array();

            $listUsers = $this->UserDB->getUsersCustomer($customerID, $status);

            // Returning the list given from the Database class
            return $listUsers;
        }

        // Getting all the departments of the user
        function getDepartmentsUser($userID, $status) {
             // Creating a array
             $listDepartmentsUser = array();

             $listDepartmentsUser = $this->UserDB->getDepartmentsUser($userID, $status);
 
             // Returning the list given from the Database class
             return $listDepartmentsUser;
        }

        // Getting al the contact
        function getDetailsUser($userID){
            // Creating a array
            $detailsUser = array();

            $detailsUser = $this->UserDB->getDetailsUser($userID);

            // Returning the list given from the Database class
            return $detailsUser;
        }

        function updateUser($userID, $contactID, $userName, $contactPhone, $userEmail, $userStatus, $contactCustomer, $contactComment) {
            if($this->UserDB->updateUser($userID, $contactID, $userName, $contactPhone, $userEmail, $userStatus, $contactCustomer, $contactComment)){
                // Getting the current url
                $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $newURL = $currentURL . "?error=none";
                // Reloading page with succes message
                echo '<script>location.replace("'.$newURL.'");</script>';
            } else {
                // Getting the current url
                $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $newURL = $currentURL . "?error=1";
                // Reloading page with succes message
                echo '<script>location.replace("'.$newURL.'");</script>';
            }
        }
    }
?>
