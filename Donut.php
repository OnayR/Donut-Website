<?php
include_once "config.php";



class Donut {
           public $name;
           public $price;
           
            function __construct($name, $price) {
                  $this->name = $name;
                  $this->price = $price;
              }

            public function print_donut() {
                  echo $this->name . "<br>";
                  echo $this->price . "<br>";
                  echo "----<br>"; 
        }

            public function get_name() {
              return $this->name;
        }
            
            public function get_price() {
                return $this->price;
            }

            public function add() {
                $this->price++;
            }

            public function remove() {
                $this->price--;
            }

            public function delete() {
                $this->price = 0;
            }


    }
?>