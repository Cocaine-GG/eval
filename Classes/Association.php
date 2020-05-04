<?php


class Association
{
    private $ass_id;
    private $ass_car_id;
    private $ass_car_mark;
    private $ass_car_model;
    private $ass_driver_id;
    private $ass_driver_name;

    /**
     * @return mixed
     */
    public function getAssId()
    {
        return $this->ass_id;
    }

    /**
     * @param mixed $ass_id
     */
    public function setAssId($ass_id): void
    {
        $this->ass_id = $ass_id;
    }

    /**
     * @return mixed
     */
    public function getAssCarId()
    {
        return $this->ass_car_id;
    }

    /**
     * @param mixed $ass_car_id
     */
    public function setAssCarId($ass_car_id): void
    {
        $this->ass_car_id = $ass_car_id;
    }

    /**
     * @return mixed
     */
    public function getAssCarMark()
    {
        return $this->ass_car_mark;
    }

    /**
     * @param mixed $ass_car_mark
     */
    public function setAssCarMark($ass_car_mark): void
    {
        $this->ass_car_mark = $ass_car_mark;
    }

    /**
     * @return mixed
     */
    public function getAssCarModel()
    {
        return $this->ass_car_model;
    }

    /**
     * @param mixed $ass_car_model
     */
    public function setAssCarModel($ass_car_model): void
    {
        $this->ass_car_model = $ass_car_model;
    }

    /**
     * @return mixed
     */
    public function getAssDriverId()
    {
        return $this->ass_driver_id;
    }

    /**
     * @param mixed $ass_driver_id
     */
    public function setAssDriverId($ass_driver_id): void
    {
        $this->ass_driver_id = $ass_driver_id;
    }

    /**
     * @return mixed
     */
    public function getAssDriverName()
    {
        return $this->ass_driver_name;
    }

    /**
     * @param mixed $ass_driver_name
     */
    public function setAssDriverName($ass_driver_name): void
    {
        $this->ass_driver_name = $ass_driver_name;
    }


}