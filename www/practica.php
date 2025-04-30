<?php

    // echo sirve para mostrar en html
    echo  "Hola mundo desde php ";

    function espacio(){
        echo "<br />";
    }
    espacio();
    
    function sumar($var1 ,$var2){
        return $var1 + $var2;
    }
    // Las variables inician con signo de dolar 
    $resultado = sumar(2, 6);
    
    if($resultado > 10){
        echo "error, el maximo es 10 no: $resultado";
    }
    else{
        echo $resultado;
    }

    espacio();

    // print tambien sirve para mostrar html
    print $resultado;

    espacio();

    $floatente = 2.5;
    echo $floatente;
    espacio();

    for($i = 0; $i < 10; $i++){
        echo "el valor de i es de: $i";
        espacio();
    }
    espacio();

    $i = 0;
    while($i <= 10){
        echo "el valor de i es de: $i";
        espacio();
        $i++;
    }

    class Cybertronian{
        #propiedades
        function __constructor(){
            $this->age = $age = 0;
            $this->genero = $genero = null;
            $this->hasChispa = $hasChispa = true;
            $this->canFly = $canFly = false;
        }

        #metodos
        function setAge($age){
            $this->age = $age;
        }

        function getAge(){
            return $this->age;
        }


        function transform(){
            return null;
        }

        function getFaction(){
            return "tibio";
        }        
    }

    
    class Autobot extends Cybertronian{
        function __constructor(){
            parent::__constructor() ;
        }

        function getFaction(){
            return "Autobot";
        }
    }

    class Decepticons extends Cybertronian{
        function __constructor(){
            parent::__constructor() ;
            $this-> canFly = true;
        }

        function getFaction(){
            return "Autobot";
        }
    }

?>