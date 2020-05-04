<?php
//Draw all drivers
$associations = new AssociationTools($dbTools);
$associations = $associations->getAllAssociation();
/*
For select
*/
$drivers = new DriverTools($dbTools);
$drivers = $drivers->getAllDrivers();
$cars = new CarTools($dbTools);
$cars = $cars->getAllCars();

foreach ($associations as $association){

    if(isset($_POST['delete']) && $_POST['delete']===$association->getAssId()){
        $associations = new AssociationTools($dbTools);
        $associations->deleteAss($association->getAssId());
        $associations = $associations->getAllAssociation(); //Draw new results
    }

    if(isset($_POST['newAssDriver'])
        && isset($_POST['newAssCar'])
        && isset($_POST['rename'])
        && $_POST['newAssDriver']!==''
        && $_POST['newAssCar']!=='') {
        if($_POST['rename'] === $association->getAssId()){
            $associations = new AssociationTools($dbTools);
            $associations->updateAss($association->getAssId(),$_POST['newAssDriver'],$_POST['newAssCar']);
            $associations = $associations->getAllAssociation(); //Draw new results
        }
    }
}
/*
Add new ass
*/

if(isset($_POST['selectDriver'])
    && isset($_POST['selectCar'])){
    $newAssociations = new Association();
    foreach ($drivers as $driver){
        if ($_POST['selectDriver']===$driver->getId()){
           $newAssociations->setAssDriverId($driver->getId());
        }
    }
    foreach ($cars as $car){
        if ($_POST['selectCar']===$car->getId()){
            $newAssociations->setAssCarId($car->getId());
        }
    }
    $associationsTools = new AssociationTools($dbTools);
    $associations = $associationsTools->addNewAssociation($newAssociations);
}
?>

<h2 class="text-center">All Association(<?= count($associations)?>)</h2>

<table class="table table-striped w-75 mx-auto text-center">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Association ID</th>
        <th scope="col">Driver</th>
        <th scope="col">Car</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($associations as $association){ ?>
        <tr>
            <th scope="row"><?= ($association->getAssId()) ?></th>
            <td>
                <div><?= $association->getAssDriverName() ?></div>
                <div><?= $association->getAssDriverId() ?></div>
            </td>
            <td>
                <div><?= $association->getAssCarMark() ?> <span><?= $association->getAssCarModel() ?></span></div>
                <div><?= $association->getAssCarId() ?></div>
            </td>
            <td><form method="post">
                    <button type="submit" name="edit" value="<?= ($association->getAssId()) ?>" class="btn btn-warning text-dark w-auto">
                        <i class="fas fa-pencil-alt d-block"></i></i></button></form></td>
            <td><form method="post">
                    <button type="submit" name="delete" value="<?= ($association->getAssId()) ?>" class="btn btn-danger text-dark w-auto">
                        <i class="fas fa-times d-block"></i></button></form></td>
        </tr>
        <!--Drawing this row when clicked button Edit-->
        <?php if(isset($_POST['edit']) && $_POST['edit']===$association->getAssId()){?>
            <tr class="p-0">
                <form method="post">
                        <td class="p-0"></td>
                        <td class="p-0">
                            <select name="newAssDriver" class="form-control" id="selectDriver">
                                <?php foreach ($drivers as $driver){ ?>
                                    <option value="<?= $driver->getId() ?>"><?= $driver->getName() ?> - ID <?= $driver->getId() ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td class="p-0">
                            <select name="newAssCar" class="form-control" id="selectDriver">
                                <?php foreach ($cars as $car){ ?>
                                    <option value="<?= $car->getId() ?>"><?= $car->getMark() ?> - ID <?= $car->getId() ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td class="p-0"><button type="submit" name="rename" value="<?=$association->getAssId()?>" class="btn btn-success">Ok</button></td>
                        <td class="p-0"></td>
                </form>
            </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>

<form method="post" class="w-75 mx-auto">
    <div class="form-group">
        <label for="selectDriver">Driver</label>
        <select name="selectDriver" class="form-control" id="selectDriver">
            <option selected>Choice Driver</option>
            <?php foreach ($drivers as $driver){ ?>
            <option value="<?= $driver->getId() ?>"><?= $driver->getName() ?> - ID <?= $driver->getId() ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="selectCar">Car</label>
        <select name="selectCar" class="form-control" id="selectCar">
            <option selected>Choice Car</option>
            <?php foreach ($cars as $car){ ?>
                <option value="<?= $car->getId() ?>"><?= $car->getMark() ?> - ID <?= $car->getId() ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-info d-block mr-0">Add New Associations</button>
    </div>
</form>
