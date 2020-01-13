<?

class Animal {
    public $id;
    public $kindOfAnimal = "Undefined animal";
    public $nameProduction = "Undefined production";
    public $isValid = false;

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
    public $isValid = true;

    public function getProduction() {
        return rand(0, 1);
    }
}

class Cow extends Animal {
    public $kindOfAnimal = "cow";
    public $nameProduction = "milk (liters)";
    public $isValid = true;

    public function getProduction() {
        return rand(8, 12);
    }
}

class Farm {
    private static $count = 0;
    private $animal = [];

    public function addAnimal($animal) {
        switch($animal) {
            case "cow":
                array_push($this->animal, new Cow(self::$count++));
            break;
            case "chicken":
                array_push($this->animal, new Chicken(self::$count++));  
            break;
            default:
                array_push($this->animal, new Animal(self::$count++, $animal));
        }        
    }

    public function getProduction() {
        $produnction = [];
        foreach($this->animal as $animal) {
            if($animal->isValid)
                $produnction[$animal->nameProduction] += $animal->getProduction();
        }
        return $produnction;
    }
}

$myFarm = new Farm();

for ($i = 0; $i < 10; $i++) {
    $myFarm->addAnimal("cow");
}

for ($i = 0; $i < 20; $i++) {
    $myFarm->addAnimal("chicken");
}

$myFarm->getProduction();
echo json_encode($myFarm->getProduction(), JSON_UNESCAPED_UNICODE);