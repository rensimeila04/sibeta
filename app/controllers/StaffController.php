<?php
class StaffController
{
    private $staffModel;

    public function __construct($db)
    {
        $this->staffModel = new StaffModel($db);
    }

    public function getStaff($nip)
    {
        return $this->staffModel->getStaffByNip($nip);
    }


    public function handleUpdateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nip = $_SESSION['nip'];
            $newData = [
                'nama' => $_POST['nama'],
                'nip' => $_POST['nip'],
            ];

            try {
                $this->staffModel->updateProfile($nip, $newData);
                header('Location: /sibeta/public/index?profile_staff=success');
            } catch (Exception $e) {
                header('Location: /sibeta/app/views/profil.php?error=' . urlencode($e->getMessage()));
            }
            exit();
        }
    }
    public function handleUpdateProfileName()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nip = $_SESSION['nip'];
            $nama = $_POST['name'];

            if (empty($nama)) {
                throw new Exception("Nama tidak boleh kosong.");
            }

            $newData = [
                'nama' => $nama,
                'nip' => $nip,
            ];

            try {
                $getUserID = $this->getStaff($nip);
                $userID = $getUserID['UserID'];
                $result = $this->staffModel->updateProfile($userID, $newData);
                if ($result) {
                    $_SESSION['nama'] = $nama;
                    return true;
                }
                return false;
            } catch (Exception $e) {
                throw new Exception("Gagal mengupdate profil: " . $e->getMessage());
            }
        }
        return false;
    }


    public function handleUpdatePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nip = $_SESSION['nip'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            try {
                // Validate password
                if (empty($newPassword)) {
                    throw new Exception("Password cannot be empty!");
                }

                if (strlen($newPassword) < 6) {
                    throw new Exception("Password must be at least 6 characters long!");
                }

                if ($newPassword !== $confirmPassword) {
                    throw new Exception("Password confirmation does not match!");
                }
                $getUserID = $this->getStaff($nip);
                $userID = $getUserID['UserID'];
                $result = $this->staffModel->updatePassword($userID, $newPassword);

                if ($result) {
                    header('Location: /sibeta/public/index.php?page=profile_staff&success=updatePassword');
                } else {
                    throw new Exception("Failed to update password!");
                }
            } catch (Exception $e) {
                header('Location: /sibeta/public/index.php?page=profile_staff&error=' . urlencode($e->getMessage()));
            }
            exit();
        }
    }
}
