<?php



// абстратный класс от которого будут наследоваться все животные
abstract class FarmAnimal{
    public $idAnimal = 0;  // поля id уу животных
    public abstract function CollectProducts();
}

class Cow extends FarmAnimal
{

    public function setIdAnimal($id)
    {
        $this->idAnimal = $id;
    }
    public function getIdAnimal(){
        echo $this->idAnimal;
    }
    public function CollectProducts()
    {
        // TODO: Implement CollectProducts() method.

        return rand(8, 12);
    }
}

class Chicken extends FarmAnimal
{
    public function setIdAnimal($id)
    {
        $this->idAnimal = $id;
    }
    public function getIdAnimal(){
        echo $this->idAnimal;
    }
    public function CollectProducts()
    {
        // TODO: Implement CollectProducts() method.

        return rand(0, 1);
    }
}


class Farm
{
    // в массиве хранятся все животные фермы
    public $a = array();
    public $b = array();

    static $id;  // хранит статичный id всех животных


    function __construct() {
        $this->id = 0;
    }


    public function AddAnimal($animal){
        $animal->setIdAnimal(++$this->id);
        array_push($this->a, $animal);
        $this->b += [get_class($animal) => 0];
    }

    public function ShowAllAnimal(){
        // выводит всех животных и их номера
        foreach ($this->a as $value){
            echo ('Вид животного: ' . get_class($value) . ' Номер животного - ' . $value->idAnimal ."<BR>");
        }
        echo '-------------------------------------------------------------' . '<BR>';
        // это необходимо для подсчета количества голов определенного скота
        $arrLenght = count($this->a);
        $elementCount = array();
        // проверям если ли такое животное в массиве
        // если да, то учеличивает количество голов на 1
        // если нет, то создаем первое животное в массиве
        for($i = 0; $i < $arrLenght; $i++){
            $key = get_class($this->a[$i]);
            if(array_key_exists($key, $elementCount)){
                $elementCount[$key]++;
            }
            else {
                $elementCount[$key] = 1;
            }
        }
        foreach ($elementCount as $key => $value){
            echo ('Вид животного: ' . $key . ' кол-во животных - ' . $value . "<BR>");
        }
    }

    public function CollectAllProducts(){
        foreach ($this->a as $value){
            $this->b[get_class($value)] += $value->CollectProducts();
        }
    }

    public function ShowAllProducts(){
        foreach ($this->b as $value => $items)
        {
            echo ('Животное: ' . $value . ' | кол-во продукта : ' . $items . "<BR>");
        }
    }
}


$farm1 = new Farm();

for($i = 1; $i < 21; $i++){
    if($i<11){
        $cow = new Cow;
        $chicken = new Chicken();

        $test_1 = &$cow;
        $test_2 = &$chicken;
        $farm1->AddAnimal($test_1);
        $farm1->AddAnimal($test_2);
    }else{
        $chicken = new Chicken();
        $test_2 = &$chicken;
        $farm1->AddAnimal($test_2);
    }
}


echo '<BR>';
$farm1->ShowAllAnimal();
echo '<BR>';
for($i = 0; $i < 7; $i++){
    echo 'День' . $i+1 . '<BR>';
    $farm1->CollectAllProducts();
    $farm1->ShowAllProducts();
}


// добавляем 5 кур и 1 корову
$cow = new Cow();
$test_1 = &$cow;
$farm1->AddAnimal($test_1);
for($i = 1; $i < 6; $i++){
    $chicken = new Chicken();
    $test_2 = &$chicken;
    $farm1->AddAnimal($test_2);

}

echo '<BR>';
$farm1->ShowAllAnimal();
echo '<BR>';
for($i = 0; $i < 7; $i++){
    echo 'День' . $i+1 . '<BR>';
    $farm1->CollectAllProducts();
    $farm1->ShowAllProducts();
}






