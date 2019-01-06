<?
class Read
{
  public $id;
  public $seq;
  public $quality;
}

$myCar = new Read();
$myCar->color = 'red';
$myCar->type = 'sedan';

$yourCar = new Read();
$yourCar->color = 'blue';
$yourCar->type = 'suv';

$cars = array($myCar, $yourCar);

foreach ($cars as $car) {
    echo 'This car is a ' . $car->color . ' ' . $car->type . "\n";
}
?>
