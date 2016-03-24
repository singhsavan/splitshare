<?php

interface Observer {
    public function add(Company $subject);
    public function notify($price);
}

class StockSim implements Observer {
    private $companies;
    
    public function __construct() {
        $this->companies = array();
    }

    public function add(Company $subject) {
        array_push($this->companies, $subject);
        echo "<p> added company to simulator";
    }

    public function updateprices() {
        $this->notify(rand(23.99, 199.42));
    }
    
    public function notify($price) {
        foreach ($this->companies as $comp) {
            $comp->update($price + rand(23.99, 199.42));
        }
    }
}

interface Company {
    public function update($price);
}

class Google implements Company {
    private $price;

    public function __construct($price) {
        $this->price = $price;
        echo "<p> creating google at \${$price}</p>";
    }
    public function update($price) {
        $this->price = $price;
        echo "<p> Google setting  for \${$price}</p>";
    }
}

class Wallmart implements Company {
    private $price;

    public function __construct($price) {
        $this->price = $price;
        echo "<p> creating wallmart at \${$price}</p>";
    }
    public function update($price) {
        $this->price = $price;
        echo "<p> Wallmart setting  for \${$price}</p>";
    }
}

$stocksim = new StockSim();
$comp1 = new Google(19.99);
$comp2 = new Wallmart(15.99);
$comp3 = new Google(19.99);
$comp4 = new Wallmart(15.99);

$stocksim->add($comp1);
$stocksim->add($comp2);
$stocksim->add($comp3);
$stocksim->add($comp4);

echo "<hr/>";

$stocksim->updateprices();