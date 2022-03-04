<?php 
namespace OurApplication\Controller;

class PriceController {
    // static function showPrice() {
    //     echo "<br/>Price is 10 tk<br/>";
    // }

    private static $instance;
    static function getInstance(){
        if(!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
   

    public function showPrice() {
        echo "<br/>Price is 10 tk<br/>";
    }
}