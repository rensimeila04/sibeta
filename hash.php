<?php
require_once 'config/database.php';

// Contoh penggunaan
$database = new Database();
$db = $database->getConnection();

$updatePassword = new UpdatePassword($db);
$result = $updatePassword->hashExistingPasswords();
echo $result;

class UpdatePassword
{
    private $conn;
    private $table_name = "Users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Fungsi untuk meng-hash dan memperbarui semua password
    public function hashExistingPasswords()
    {
        try {
            // Ambil semua data pengguna
            $query = "SELECT UserID, Password FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            // Iterasi setiap pengguna dan hash password
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user) {
                $hashedPassword = password_hash($user['Password'], PASSWORD_DEFAULT);

                // Update password yang telah di-hash
                $updateQuery = "UPDATE " . $this->table_name . " 
                                SET Password = :hashedPassword 
                                WHERE UserID = :userID";
                $updateStmt = $this->conn->prepare($updateQuery);

                $updateStmt->bindParam(':hashedPassword', $hashedPassword);
                $updateStmt->bindParam(':userID', $user['UserID']);
                $updateStmt->execute();
            }

            return "Semua password berhasil di-hash dan diperbarui.";
        } catch (PDOException $exception) {
            return "Error: " . $exception->getMessage();
        }
    }
}
?>