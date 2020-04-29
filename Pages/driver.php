<?php

//Draw all drivers
$drivers = new DriverTools($dbTools);
$drivers = $drivers->getAllDrivers();

foreach ($drivers as $driver){
    if(isset($_POST['delete']) && $_POST['delete']===$driver->getId()){
        $drivers = new DriverTools($dbTools);
        $drivers->deleteDriver($driver->getId());
        $drivers = $drivers->getAllDrivers();
    }
}

?>
<h2 class="text-center">All drivers</h2>
<table class="table w-75 mx-auto">
    <thead>
    <tr>
        <th scope="col">Driver ID</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($drivers as $driver){ ?>
    <tr>
        <th scope="row"><?= ($driver->getId()) ?></th>
        <td><?= $driver->getName() ?></td>
        <td><?= $driver->getSurname() ?></td>
        <td><form method="post"><button type="submit" name="edit" value="<?= ($driver->getId()) ?>" class="btn btn-success"><i class="far fa-edit"></i></button></form></td>
        <td><form method="post"><button type="submit" name="delete" value="<?= ($driver->getId()) ?>" class="btn btn-danger"><i class="fas fa-times"></i></button></form></td>
    </tr>
    <?php } ?>
    </tbody>
</table>


<form method="post" class="w-50 mx-auto d-flex">
    <div class="form-group mr-2">
        <input name="name_driver" type="text" class="form-control" placeholder="Name">
    </div>
    <div class="form-group mr-2">
        <input name="surname_driver" type="text" class="form-control" placeholder="Surname">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info d-block mr-0">Add new Driver</button>
    </div>
</form>