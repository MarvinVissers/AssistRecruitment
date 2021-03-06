<?php
    require_once 'database.class.php';

    Class DepartmentDB {
        
        private $db;   
    
        public function __construct(){
            //maakt een nieuwe connectie 
            $database = new Database();
            $this->db = $database->getConnection();
        }

        // Function to get departments for all customers
        function getDepartments($statusDepartment){
            // Creating a array
            $listDepartments = array();

            // Making a query to get the scans of the customer out the database
            $query = "SELECT dp.departmentID, dp.departmentName, dp.departmentComment, dp.departmentStatus, dp.customerID, c.customerName
                        FROM department dp
                        INNER JOIN customer c ON dp.customerID = c.customerID
                        WHERE dp.departmentStatus = ?
                        ORDER BY dp.departmentName ASC";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $statusDepartment);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $department){
                    // Putting it in the modal
                    $entDepartment = new entDepartment($department->departmentID, $department->departmentName, $department->departmentComment, $department->departmentStatus, $department->customerID, $department->customerName);
                    array_push($listDepartments, $entDepartment);
                }
                // Returning the full list
                return $listDepartments;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
            }
        }

        // Function to get departments for 1 customer
        function getDepartmentsCustomer($customerID, $departmentStatus){
            // Creating a array
            $listDepartments = array();

            // Making a query to get the scans of the customer out the database
            $query = "SELECT dp.departmentID, dp.departmentName, dp.departmentComment, dp.departmentStatus, dp.customerID, c.customerName
                      FROM department dp
                      INNER JOIN customer c ON dp.customerID = c.customerID
                      WHERE c.customerID = ? AND dp.departmentStatus = ?
                      ORDER BY dp.departmentName ASC";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $customerID);
            $stm->bindParam(2, $departmentStatus);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $department){
                    // Putting it in the modal
                    $entDepartment = new EntDepartment($department->departmentID, $department->departmentName, $department->departmentComment, $department->departmentStatus, $department->customerID, $department->customerName);
                    array_push($listDepartments, $entDepartment);
                }
                // Returning the full list
                return $listDepartments;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
            }
        }

        // Function to get departments for 1 user
        function getDepartmentsUser($userID, $departmentStatus){
            // Creating a array
            $listDepartments = array();

            // Making a query to get the scans of the customer out the database
            $query = "SELECT dp.departmentID, dp.departmentName, dp.departmentComment, dp.departmentStatus, dp.customerID, c.customerName
                      FROM department dp
                      INNER JOIN customer c ON dp.customerID = c.customerID
                      WHERE c.customerID = ? AND dp.departmentStatus = ?
                      ORDER BY dp.departmentName ASC";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $customerID);
            $stm->bindParam(2, $departmentStatus);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $department){
                    // Putting it in the modal
                    $entDepartment = new EntDepartment($department->departmentID, $department->departmentName, $department->departmentComment, $department->departmentStatus, $department->customerID, $department->customerName);
                    array_push($listDepartments, $entDepartment);
                }
                // Returning the full list
                return $listDepartments;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
            }
        }

        // Function to add a department
        public function createDepartment($departmentName, $departmentComment, $customerID) {
            $departmentStatus = 'Active';
    
            //A query is create here and values are being bound to the parameters inside the query.
            $stmt = $this->db->prepare("INSERT INTO department (departmentID, departmentName, departmentComment, departmentStatus, customerID) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $departmentID);
            $stmt->bindParam(2, $departmentName);
            $stmt->bindParam(3, $departmentComment);
            $stmt->bindParam(4, $departmentStatus);
            $stmt->bindParam(5, $customerID);
            //The previous query statement will be executed here.
            try {
                return $stmt->execute();
            } catch (PDOException $exception){
                return false;
            }
        }

        // Function to get department details
        function getDetailsDepartment($departmentID){
            // Creating a array
            $detailsDepartment = array();

            // Making a query to get the scans of the customer out the database
            $query = "SELECT dp.departmentID, dp.departmentName, dp.departmentComment, dp.departmentStatus, dp.customerID, c.customerName
                      FROM department dp
                      INNER JOIN customer c ON dp.customerID = c.customerID
                      WHERE dp.departmentID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $departmentID);
            if($stm->execute()){
                // Getting the results fromm the database
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the results
                foreach($result as $department){
                    // Putting it in the modal
                    $entDepartment = new entDepartment($department->departmentID, $department->departmentName, $department->departmentComment, $department->departmentStatus, $department->customerID, $department->customerName);
                    array_push($detailsDepartment, $entDepartment);
                }
                // Returning the full list
                return $detailsDepartment;    
            }
            // Showing a error when the query didn't execute
            else{
                echo "Er is iets fout gegaan waardoor er geen functies opgehaald konden worden";
            }
        }

        function updateDepartment($departmentID, $departmentName, $departmentStatus, $departmentComment, $departmentCustomer) {
            // Query aanmaken om alle functies uit de database te halen
            $query = "UPDATE department SET departmentName = ?, departmentComment = ?, departmentStatus = ?, customerID = ? WHERE departmentID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $departmentName);
            $stm->bindParam(2, $departmentComment);
            $stm->bindParam(3, $departmentStatus);
            $stm->bindParam(4, $departmentCustomer);
            $stm->bindParam(5, $departmentID);
            if($stm->execute()){
                // Sending true back for succes message
                return true;
            } else{
                // Sending false back for an error
                return false;
            }
        }

        function deleteDepartment($departmentID){
            // Create Query to update Customer Status
            $query = "UPDATE department SET departmentStatus = 'Deleted' WHERE departmentID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $departmentID);
            if($stm->execute()){
                echo 'Het is gelukt';
            }
            // Error Text
            else {
                echo "Er is iets fout gegaan";
            }
        }

        function archiveDepartment($departmentID){
            // Create Query to update Customer Status
            $query = "UPDATE department SET departmentStatus = 'Archived' WHERE departmentID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $departmentID);
            if($stm->execute()){
                echo 'Het is gelukt';
            }
            // Error Text
            else {
                echo "Er is iets fout gegaan";
            }
        }
    
    }
?>
