<?php 
namespace OurApplication\Routing;

class Router{
    private static $nomatch = true;
    private static function getUrl() {
        return $_SERVER['REQUEST_URI'];
    }

    private static function getMatches( $patern ) {
        $url = self::getUrl();

        if(preg_match($patern, $url, $matches ) ){
           return $matches;
        }

        return false;
    }

    static function process($pattern, $callback) { 
        $pattern = "~^{$pattern}/?~"; 
        //$pattern = "~^{$pattern}/?~"; 

        $params = self::getMatches($pattern);
        if($params) {
            $functionArguments = array_slice($params,1); // firsrt ta bad dea sob gula nita hobe
            self::$nomatch = false;
            if(is_callable($callback)) {
               
                if(is_array($callback)){
                    $className = $callback[0];
                    $methodName = $callback[1];

                    $instance = $className::getInstance();
                    $instance->$methodName(...$functionArguments);
                } else {
                    
                    $callback(...$functionArguments); // splite operator
                }
                
            } else{
                $parts = explode("@",$callback);
                $className = "OurApplication\Controller\\".$parts[0];
                $methodName = $parts[1];

                $instance = $className::getInstance();
                $instance->$methodName(...$functionArguments);
            }
        }
    }
    static function get($pattern, $callback) {  

        if($_SERVER['REQUEST_METHOD'] != 'GET'){
            return;
        }

        self::process($pattern, $callback);
       
        
    }

    static function post($pattern, $callback) {  
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            return;
        }

        self::process($pattern, $callback);
    }

    static function delete($pattern, $callback) {  
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            return;
        }

        self::process($pattern, $callback);
    }

    static function cleanup(){
        if(self::$nomatch){
            echo "no routes match";
        }
    }
}