<?

class Animal {
    public $id;
    public $kindOfAnimal = "Undefined animal";
    public $nameProduction = "Undefined production";

    public function getProduction() {
        throw new Exception("Undefined animal");
    }
    function __construct($id, $kindOfAnimal = null) {
        $this->id = $id;
        if ($kindOfAnimal !== null) 
            $this->kindOfAnimal = $kindOfAnimal;
    }
}

class Chicken extends Animal {
    public $kindOfAnimal = "chicken";
    public $nameProduction = "eggs";

    public function getProduction() {
        return rand(0, 1);
    }
}

class Cow extends Animal {
    public $kindOfAnimal = "cow";
    public $nameProduction = "milk (liters)";

    public function getProduction() {
        return rand(8, 12);
    }
}

class Farm {
    private $animal = [];

    public function addAnimal(Animal $animal) {
        $this->animal[] = $animal;  
    }

    public function getProduction() {
        $produnction = [];
        foreach($this->animal as $animal) {
            $produnction[$animal->nameProduction] += $animal->getProduction();
        }
        return $produnction;
    }
}

$myFarm = new Farm();

for ($i = 0; $i < 10; $i++) {
    $id = md5(random_bytes(15));
    $myFarm->addAnimal(new Cow($id));
}

for ($i = 0; $i < 20; $i++) {
    $id = md5(random_bytes(15));
    $myFarm->addAnimal(new Chicken($id));
}

$myFarm->getProduction();
echo json_encode($myFarm->getProduction(), JSON_UNESCAPED_UNICODE);