<?php
class StaffModel
{
    private $conn;

    private $userid;
    private $nip;
    private $username;
    private $password;
    private $nama;
    private $photo_profile_path;
    private $roleid;
    private $rolename;
    private $isactive;

    public function getUserID()
    {
        return $this->userid;
    }

    public function setUserID($userid)
    {
        $this->userid = $userid;
    }

    public function getNIP()
    {
        return $this->nip;
    }

    public function setNIP($nip)
    {
        $this->nip = $nip;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function setNama($nama)
    {
        $this->nama = $nama;
    }

    public function getPhotoProfilePath()
    {
        return $this->photo_profile_path;
    }

    public function setPhotoProfilePath($photo_profile_path)
    {
        $this->photo_profile_path = $photo_profile_path;
    }

    public function getRoleID()
    {
        return $this->roleid;
    }

    public function setRoleID($roleid)
    {
        $this->roleid = $roleid;
    }

    public function getRoleName()
    {
        return $this->rolename;
    }

    public function setRoleName($rolename)
    {
        $this->rolename = $rolename;
    }

    public function getIsActive()
    {
        return $this->isactive;
    }

    public function setIsActive($isactive)
    {
        $this->isactive = $isactive;
    }

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getStaffByNip($nip)
    {
        try {
            $query = "SELECT s.UserID, 
                         s.NIP, 
                         u.Username, 
                         u.Nama, 
                         u.photo_profile_path, 
                         r.RoleID, 
                         r.RoleName, 
                         u.isActive 
                    FROM Staff s 
                    INNER JOIN Users u ON s.UserID = u.UserID
                    INNER JOIN Roles r ON u.RoleID = r.RoleID
                    WHERE s.NIP = :nip";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nip', $nip, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function updateStaffProfile($userID, $nama, $nip)
    {
        try {
            // Mulai transaksi
            $this->conn->beginTransaction();

            // Query pertama: Update Nama di tabel Users
            $queryUpdateName = "UPDATE Users SET Nama = :nama WHERE UserID = :userID";
            $stmtUpdateName = $this->conn->prepare($queryUpdateName);
            $stmtUpdateName->bindParam(':nama', $nama, PDO::PARAM_STR);
            $stmtUpdateName->bindParam(':userID', $userID, PDO::PARAM_INT);

            // Query kedua: Update NIP di tabel Staff
            $queryUpdateNIP = "UPDATE Staff SET NIP = :nip WHERE UserID = :userID";
            $stmtUpdateNIP = $this->conn->prepare($queryUpdateNIP);
            $stmtUpdateNIP->bindParam(':nip', $nip, PDO::PARAM_STR);
            $stmtUpdateNIP->bindParam(':userID', $userID, PDO::PARAM_INT);

            // Eksekusi kedua query
            $stmtUpdateName->execute();
            $stmtUpdateNIP->execute();

            // Commit transaksi jika kedua query berhasil
            $this->conn->commit();

            return true; // Berhasil
        } catch (PDOException $e) {
            // Rollback transaksi jika ada query yang gagal
            $this->conn->rollBack();
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }


    public function updateStaffPassword($userID, $password)
    {
        try {
            $queryUpdatePassword = "UPDATE Users SET Password = :password WHERE UserID = :userID";
            $stmtUpdatePassword = $this->conn->prepare($queryUpdatePassword);
            $stmtUpdatePassword->bindParam(':password', $password, PDO::PARAM_STR);
            $stmtUpdatePassword->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmtUpdatePassword->execute();

            return true;
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }
}
