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

    public function getAllStaff()
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
                    INNER JOIN Roles r ON u.RoleID = r.RoleID";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function getStaffByNip($nip)
    {
        try {
            $query = "SELECT s.UserID, 
                         s.NIP, 
                         u.UserID,
                         u.Nama, 
                         u.Username, 
                         u.Password, 
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

    public function getAllStaffByRole($roleID)
    {
        try {
            $query = "SELECT s.UserID, 
                         s.NIP, 
                         u.Username, 
                         u.Password,
                         u.Nama,
                         u.photo_profile_path, 
                         r.RoleID, 
                         r.RoleName, 
                         u.IsActive 
                    FROM Staff s 
                    INNER JOIN Users u ON s.UserID = u.UserID
                    INNER JOIN Roles r ON u.RoleID = r.RoleID
                    WHERE r.RoleID = :roleID";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':roleID', $roleID, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Query gagal: " . $e->getMessage());
        }
    }

    public function updateProfile($userID, $newData)
    {
        try {
            $this->conn->beginTransaction();

            // Query pertama: Update Nama di tabel Users
            $queryUpdateName = "UPDATE Users SET Nama = :nama WHERE UserID = :userID";
            $stmtUpdateName = $this->conn->prepare($queryUpdateName);
            $stmtUpdateName->bindParam(':nama', $newData['nama'], PDO::PARAM_STR);
            $stmtUpdateName->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmtUpdateName->execute();

            // Query kedua: Update NIP di tabel Staff
            $queryUpdateNIP = "UPDATE Staff SET NIP = :nip WHERE UserID = :userID";
            $stmtUpdateNIP = $this->conn->prepare($queryUpdateNIP);
            $stmtUpdateNIP->bindParam(':nip', $newData['nip'], PDO::PARAM_STR);
            $stmtUpdateNIP->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmtUpdateNIP->execute();

            // Commit transaksi jika kedua query berhasil
            $this->conn->commit();

            return true; // Berhasil
        } catch (PDOException $e) {
            $this->conn->rollback();
            error_log("Update profile error: " . $e->getMessage());
            throw new Exception("Update gagal: " . $e->getMessage());
        }
    }

    public function updateProfileSuperAdmin($userID, $newData)
    {
        try {
            $this->conn->beginTransaction();

            // Query pertama: Update Nama di tabel Users
            $queryUpdateName = "UPDATE Users SET Username = :username, Nama = :nama, RoleID = :roleID WHERE UserID = :userID";
            $stmtUpdateName = $this->conn->prepare($queryUpdateName);
            $stmtUpdateName->bindParam(':username', $newData['username'], PDO::PARAM_STR);
            $stmtUpdateName->bindParam(':nama', $newData['nama'], PDO::PARAM_STR);
            $stmtUpdateName->bindParam(':roleID', $newData['roleID'], PDO::PARAM_INT);
            $stmtUpdateName->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmtUpdateName->execute();

            // Query kedua: Update NIP di tabel Staff
            $queryUpdateNIP = "UPDATE Staff SET NIP = :nip WHERE UserID = :userID";
            $stmtUpdateNIP = $this->conn->prepare($queryUpdateNIP);
            $stmtUpdateNIP->bindParam(':nip', $newData['nip'], PDO::PARAM_STR);
            $stmtUpdateNIP->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmtUpdateNIP->execute();

            // Commit transaksi jika kedua query berhasil
            $this->conn->commit();

            return true; // Berhasil
        } catch (PDOException $e) {
            $this->conn->rollback();
            error_log("Update profile error: " . $e->getMessage());
            throw new Exception("Update gagal: " . $e->getMessage());
        }
    }


    public function updatePassword($userID, $newPassword)
    {
        try {
            // Debug: Print input parameters
            error_log("Attempting to update password for UserID: " . $userID);

            // Hash the password
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            // Debug: Confirm hash was created
            error_log("Password hash created successfully");

            // Use SQL Server JOIN syntax
            $sql = "UPDATE Users SET Password = :password WHERE UserID = :userID";

            // Debug: Print the SQL (without sensitive data)
            error_log("Executing SQL: " . str_replace(":password", "[HIDDEN]", $sql));

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_STR);

            $success = $stmt->execute();

            // Debug: Check execution result
            error_log("Query execution result: " . ($success ? "success" : "failed"));
            error_log("Rows affected: " . $stmt->rowCount());

            if ($stmt->rowCount() === 0) {
                error_log("No rows were updated in the database");
                throw new Exception("Tidak ada perubahan yang dilakukan pada kata sandi.");
            }

            error_log("Password update completed successfully");
            return true;
        } catch (PDOException $e) {
            error_log("Database error during password update: " . $e->getMessage());
            throw new Exception("Gagal mengubah kata sandi: " . $e->getMessage());
        }
    }

    public function addStaff($newData)
    {
        try {

            // Memulai transaksi
            $this->conn->beginTransaction();

            // Query Pertama: Insert data ke tabel Users
            $sql = "INSERT INTO Users (Username, Password, Nama, photo_profile_path, RoleID) VALUES (:username, :password, :nama, :foto_profil, :roleID)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $newData['username'], PDO::PARAM_STR);
            $stmt->bindParam(':password', $newData['kata_sandi'], PDO::PARAM_STR);
            $stmt->bindParam(':nama', $newData['nama'], PDO::PARAM_STR);
            $stmt->bindParam(':foto_profil', $newData['foto_profil'], PDO::PARAM_STR);
            $stmt->bindParam(':roleID', $newData['roleID'], PDO::PARAM_INT);
            $stmt->execute();
            $userID = $this->conn->lastInsertId();

            // Query Kedua: Insert data ke tabel Staff
            $query = "INSERT INTO Staff (UserID, NIP) VALUES (:userID, :nip)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->bindParam(':nip', $newData['nip'], PDO::PARAM_STR);
            $stmt->execute();

            // Commit transaksi jika kedua query berhasil
            $this->conn->commit();

            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            error_log("Add staff error: " . $e->getMessage());
            throw new Exception("Tambah staff gagal: " . $e->getMessage());
        }
    }

    public function getStaffByID($userID)
    {
        try {
            $query = "SELECT s.UserID, 
                         s.NIP, 
                         u.Username, 
                         u.Password,
                         u.Nama,
                         u.photo_profile_path, 
                         r.RoleID, 
                         r.RoleName, 
                         u.IsActive 
                    FROM Staff s 
                    INNER JOIN Users u ON s.UserID = u.UserID
                    INNER JOIN Roles r ON u.RoleID = r.RoleID
                    WHERE s.UserID = :userID";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function deleteStaffByUserID($UserID)
    {
        try {
            $this->conn->beginTransaction();
            $sqlDeleteStaff = "DELETE FROM Staff WHERE UserID = :UserID";
            $stmt = $this->conn->prepare($sqlDeleteStaff);
            $stmt->bindParam(':UserID', $UserID, PDO::PARAM_INT);
            $stmt->execute();

            $sqlDeleteUser = "DELETE FROM Users WHERE UserID = :UserID";
            $stmt = $this->conn->prepare($sqlDeleteUser);
            $stmt->bindParam(':UserID', $UserID, PDO::PARAM_INT);
            $stmt->execute();

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollback();
            error_log("Delete staff error: " . $e->getMessage());
            throw new Exception("Delete staff gagal: " . $e->getMessage());
        }
    }

    
}
