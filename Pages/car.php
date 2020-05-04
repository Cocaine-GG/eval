<?php
//Draw all drivers
$cars = new CarTools($dbTools);
$cars = $cars->getAllCars();

foreach ($cars as $car){
    if(isset($_POST['delete']) && $_POST['delete']===$car->getId()){
        $cars = new CarTools($dbTools);
        $cars->deleteCar($car->getId());
        $cars = $cars->getAllCars(); //Draw new results
    }
    if(isset($_POST['new_mark_car'])
        && isset($_POST['new_model_car'])
        && isset($_POST['new_color_car'])
        && isset($_POST['new_registration_car'])
        && $_POST['new_mark_car']!==''
        && $_POST['new_model_car']!==''
        && $_POST['new_color_car']!==''
        && $_POST['new_registration_car']!==''
        && isset($_POST['rename'])) {
        if($_POST['rename'] === $car->getId()){
            $cars = new CarTools($dbTools);
            $cars->updateCar($car->getId(),
                $_POST['new_mark_car'],
                $_POST['new_model_car'],
                $_POST['new_color_car'],
                $_POST['new_registration_car']);
            $cars = $cars->getAllCars(); //Draw new results
        }
    }
}
if(isset($_POST['car_mark'])
    && isset($_POST['car_model'])
    && isset($_POST['car_color'])
    && isset($_POST['car_registration'])
    && ($_POST['car_mark'] !== '')
    && ($_POST['car_model'] !== '')
    && ($_POST['car_color'] !== '')
    && $_POST['car_registration'] !== ''){
    $newCar = new Car();
    $newCar->setMark($_POST['car_mark']);
    $newCar->setModel($_POST['car_model']);
    $newCar->setColor($_POST['car_color']);
    $newCar->setRegistration($_POST['car_registration']);
    $carTools = new CarTools($dbTools);
    $cars = $carTools->addNewCar($newCar);
}

?>
<h2 class="text-center">All Car(<?= count($cars)?>)</h2>
<table class="table table-striped w-75 mx-auto text-center">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Car ID</th>
        <th scope="col">Mark</th>
        <th scope="col">Model</th>
        <th scope="col">Color</th>
        <th scope="col">Registration</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($cars as $car){ ?>
        <tr>
            <th scope="row"><?= ($car->getId()) ?></th>
            <td><?= $car->getMark() ?></td>
            <td><?= $car->getModel() ?></td>
            <td><?= $car->getColor() ?></td>
            <td><?= $car->getRegistration() ?></td>
            <td><form method="post">
                    <button type="submit" name="edit" value="<?= ($car->getId()) ?>" class="btn btn-warning text-dark w-auto">
                        <i class="fas fa-pencil-alt d-block"></i></i></button></form></td>
            <td><form method="post">
                    <button type="submit" name="delete" value="<?= ($car->getId()) ?>" class="btn btn-danger text-dark w-auto">
                        <i class="fas fa-times d-block"></i></button></form></td>
        </tr>
<!--Drawing this row when clicked button Edit-->
        <?php if(isset($_POST['edit']) && $_POST['edit']===$car->getId()){?>
            <tr class="p-0">
                <form method="post">
                        <td class="p-0"></td>
                        <td class="p-0"><div class=""><input required name="new_mark_car" type="text" class="form-control w-auto text-center mx-auto" placeholder="&uarr; Mark"></div></td>
                        <td class="p-0"><div class=""><input required name="new_model_car" type="text" class="form-control w-auto text-center mx-auto" placeholder="&uarr; Model"></div></td>
                        <td class="p-0"><div class=""><input required name="new_color_car" type="text" class="form-control w-auto text-center mx-auto" placeholder="&uarr; Color"></div></td>
                        <td class="p-0"><div class=""><input required name="new_registration_car" type="text" class="form-control w-auto text-center mx-auto" placeholder="&uarr; Registration"></div></td>
                        <td class="p-0"><div class=""><button type="submit" name="rename" value="<?=$car->getId()?>" class="btn btn-success">Ok</button></div></td>
                        <td class="p-0"></td>
                </form>
            </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>

<form method="post" class="w-50 mx-auto">
    <div class="form-group mr-2">
        <label for="car_mark">Mark</label>
        <input required name="car_mark" type="text" class="form-control" placeholder="Mark" id="car_mark">
    </div>
    <div class="form-group mr-2">
        <label for="car_model">Model</label>
        <input required name="car_model" type="text" class="form-control" placeholder="Model" id="car_model">
    </div>
    <div class="form-group mr-2">
        <label for="car_color">Color</label>
        <input required name="car_color" type="text" class="form-control" placeholder="Color" id="car_color">
    </div>
    <div class="form-group mr-2">
        <label for="car_registration">Registration</label>
        <input required name="car_registration" type="text" class="form-control" placeholder="Registration" id="car_registration">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info d-block mr-0">Add New Car</button>
    </div>
</form>