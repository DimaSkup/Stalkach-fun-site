<?php

namespace App\Http\Controllers\Patterns;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Patterns\PatternsCode\BaseDecorator;
use App\Http\Controllers\Patterns\PatternsCode\Component;
use App\Http\Controllers\Patterns\PatternsCode\ConcreteComponent;
use App\Http\Controllers\Patterns\PatternsCode\ConcreteDecorator1;
use App\Http\Controllers\Patterns\PatternsCode\ConcreteDecorator2;


class PatternsController extends Controller
{
    public function decorator()
    {
        try
        {
            $component = new ConcreteComponent();


            echo "Concrete Component print():<br>";
            $this->clientCode($component);
            echo "<br><br>";

            echo "Decorated Component print():<br>";
            $decorator1 = new ConcreteDecorator1($component);
            $decorator2 = new ConcreteDecorator2($decorator1);
            $this->clientCode($decorator2);


        }
        catch (\Exception $e)
        {
            dd($e->getTrace(), $e->getLine(), $e->getMessage());
        }
    }

    private function clientCode(Component $component): void
    {
        echo "RESULT: " . $component->operation();
    }

}
