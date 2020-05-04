<?php


class AssociationTools
{
    private $dbTools;

    public function __construct($dbTools)
    {
        $this->dbTools = $dbTools;
    }

    public function getAllAssociation(){
        $results = $this->dbTools->executeQuery("SELECT ass_id, driver_id, driver_name, car_id, car_model, car_mark
                                                 FROM `Association`
                                                 INNER JOIN Car ON ass_car = car_id
                                                 INNER Join Drivers ON ass_driver = driver_id");
        $associations=[];
        foreach ($results as $result){
            $association = new Association();
            $association->setAssId($result['ass_id']);
            $association->setAssDriverId($result['driver_id']);
            $association->setAssDriverName($result['driver_name']);
            $association->setAssCarId($result['car_id']);
            $association->setAssCarModel($result['car_model']);
            $association->setAssCarMark($result['car_mark']);
            array_push($associations,$association);
        }
        return $associations;
    }

    public function addNewAssociation($association){
        $param = [
            "ass_car"=>$association->getAssCarId(),
            "ass_driver"=>$association->getAssDriverId()
        ];
        $this->dbTools->insertQuery("INSERT INTO `Association` (ass_car, ass_driver)
                                        VALUE (:ass_car, :ass_driver)", $param);
        return $this->getAllAssociation();
    }

    public function deleteAss($id){
        $this->dbTools->executeQuery("DELETE FROM `Association` WHERE ass_id = {$id}");
        return $this->getAllAssociation();
    }

    public function updateAss($id, $newAssDriver, $newAssCar){
        $this->dbTools->executeQuery("UPDATE `Association` SET `ass_driver` = '$newAssDriver', `ass_car` = '$newAssCar' WHERE `Association`.`ass_id` = $id");
        return $this->getAllAssociation();
    }
}


