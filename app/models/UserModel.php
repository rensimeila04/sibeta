<?php

class UserModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
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
}
