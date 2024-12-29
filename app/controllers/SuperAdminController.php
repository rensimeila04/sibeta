<?php

class SuperAdminController
{
    private $superAdminModel;

    public function __construct($db)
    {
        $this->superAdminModel = new SuperAdminModel($db);
    }

    public function getMahasiswaCount(){
        $totalMahasiswa = $this->superAdminModel->getTotalStudents();
        return $totalMahasiswa;
    }

    public function getTechniciansCount()
    {
        return $this->superAdminModel->getTotalTechnicians();
    }

    public function getAdminProdiCount()
    {
        return $this->superAdminModel->getTotalAdminProdi();
    }

    public function getDocumentsCount()
    {
        return $this->superAdminModel->getTotalDocuments();
    }

    public function getMahasiswaByProdi()
    {
        return $this->superAdminModel->getStudentsByProdi();
    }

}