<?php

class UserModel
{
    private $conn;

    private $UserID;
    private $Username;
    private $Password;
    private $Nama;
    private $photo_profile_path;
    private $RoleID;
    private $IsActive;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function setUserID($UserID){
        $this->UserID = $UserID;
    }

    public function setUsername($Username){
        $this->Username = $Username;
    }

    public function setPassword($Password){
        $this->Password = $Password;
    }

    public function setNama($Nama){
        $this->Nama = $Nama;
    }

    public function getNama(){
        return $this->Nama;
    }

    public function getphoto_profile_path(){
        return $this->photo_profile_path;
    }

    public function getRoleID(){
        return $this->RoleID;
    }

    public function getIsActive(){
        return $this->IsActive;
    }

    public function setphoto_profile_path($photo_profile_path){
        $this->photo_profile_path = $photo_profile_path;
    }

    public function setRoleID($RoleID){
        $this->RoleID = $RoleID;
    }

    public function setIsActive($IsActive){
        $this->IsActive = $IsActive;
    }

    



    public function getUserByID($UserID){
        try {
            $sql = "SELECT * FROM Users WHERE UserID = :UserID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':UserID', $UserID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getUserByUsername($username)
    {
        try {
            $sql = "SELECT u.UserID, u.Username, u.Password, r.RoleName
                    FROM Users u
                    JOIN Roles r ON u.RoleID = r.RoleID
                    WHERE u.Username = :username AND u.IsActive = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getMahasiswaDetails($userID)
    {
        try {
            $sql = "SELECT u.Nama, u.photo_profile_path, m.NIM
                FROM Users u
                JOIN Mahasiswa m ON u.UserID = m.UserID
                WHERE u.UserID = :userID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getStaffDetails($userID)
    {
        try {
            $sql = "SELECT u.Nama, u.photo_profile_path, a.NIP
                FROM Users u
                JOIN staff a ON u.UserID = a.UserID
                WHERE u.UserID = :userID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function updateUserPhoto($id, $photo_name){
        try {
            $sql = "UPDATE Users SET photo_profile_path = :photo_name WHERE UserID = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':photo_name', $photo_name, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }
}
