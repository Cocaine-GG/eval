<?php


class CarTools
{
    private $dbTools;

    public function __construct($dbTools)
    {
        $this->dbTools = $dbTools;
    }

    public function getAllCars(){
        $results = $this->dbTools->executeQuery("SELECT * FROM `Car`");
        $cars=[];
        foreach ($results as $result){
            $car = new Car();
            $car->setId($result['car_id']);
            $car->setMark($result['car_mark']);
            $car->setModel($result['car_model']);
            $car->setColor($result['car_color']);
            $car->setRegistration($result['car_registration']);
            array_push($cars,$car);
        }
        return $cars;
    }
    public function addNewCar ($car){
        $param = [
            "car_mark"=>$car->getMark(),
            "car_model"=>$car->getModel(),
            "car_color"=>$car->getColor(),
            "car_registration"=>$car->getRegistration()
        ];
        $this->dbTools->insertQuery("INSERT INTO `Car` (car_mark, car_model,car_color, car_registration)
                                        VALUE (:car_mark, :car_model,:car_color,:car_registration)", $param);
        return $this->getAllCars();
    }

    public function deleteCar($id){
        $this->dbTools->executeQuery("DELETE FROM `Car` WHERE car_id = {$id}");
        return $this->getAllCars();
    }

    public function updateCar($id, $new_mark_car, $new_model_car, $new_color_car, $new_registration_car){
        $this->dbTools->executeQuery("UPDATE `Car`
                                      SET `car_mark` = '$new_mark_car', `car_model` = '$new_model_car',
                                          `car_color` = '$new_color_car', `car_registration` = '$new_registration_car'
                                      WHERE `Car`.`car_id` = $id");
        return $this->getAllCars();
    }
}