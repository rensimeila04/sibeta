<?php 
class StaffController{
    private $staffModel;

    public function __construct($db){
        $this->staffModel = new StaffModel($db);

    }

    public function getStaff($nip){
        return $this->staffModel->getStaffByNip($nip);
    }

    public function updateStaffProfile($userID, $nama, $nip){
        return $this->staffModel->updateStaffProfile($userID, $nama, $nip);
    }

    public function updateStaffPassword($userID, $password){
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $this->staffModel->updateStaffPassword($userID, $passwordHash);
    }
    
}
?>