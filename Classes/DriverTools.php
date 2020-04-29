<?php

class DriverTools
{
    private $dbTools;

    public function __construct($dbTools)
    {
        $this->dbTools = $dbTools;
    }
    public function getAllDrivers(){
        $results = $this->dbTools->executeQuery("SELECT driver_id, driver_name ,driver_surname FROM Drivers");
        $drivers=[];
        foreach ($results as $result){
            $driver = new Driver();
            $driver->setId($result['driver_id']);
            $driver->setName($result['driver_name']);
            $driver->setSurname($result['driver_surname']);
            array_push($drivers,$driver);
        }
        return $drivers;
    }
    public function deleteDriver($id){
        $this->dbTools->executeQuery("DELETE FROM `Drivers` WHERE driver_id = {$id}");
        return $this->getAllDrivers();
    }
    public function addNewDriver($driver){
        $param = ["driver_name"=>$driver->getName(), "driver_surname"=>$driver->getSurname()];
        $this->dbTools->insertQuery("INSERT INTO `Drivers` (driver_name, driver_surname)
                                        VALUE (:driver_name, :driver_surname)", $param);
        return $this->getAllDrivers();
    }
}