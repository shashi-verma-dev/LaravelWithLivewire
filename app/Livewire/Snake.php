<?php

namespace App\Livewire;

use Livewire\Component;

class Snake extends Component
{
    public $xPosition = 0; // for frontend movement on x axis
    public $yPosition = 0; // for frontend movement on y axis 

    public $action = ''; // last action done
    public $actionBackgroundColor = 'black'; // last action button color

    public $xAxis = 'x'; // for backend to check x axis and manuplate position
    public $yAxis = 'y'; // for backend to check y axis and manuplate position


    public $buttons = [
        '<- left' =>  ['L', 'red', '-', '50', 'x'],
        'right ->' => ['R', 'green', '+', '50', 'x'],
        '^ top' =>    ['T', 'blue', '-', '50', 'y'],
        'bottom v' => ['B', 'purple', '+', '50', 'y'],
    ];

    public function setCommonValues($action, $actionBackgroundColor, $position, $steps, $axis)
    {
        $this->action = $action;
        $this->actionBackgroundColor = $actionBackgroundColor;

        if ($axis === $this->xAxis) {

            if ($position === '+') {
                $this->xPosition +=  $steps;
            } elseif ($position === '-') {
                $this->xPosition -= $steps;
            } else {
                dd('invalid position on x axis !!');
            }
        } elseif ($axis === $this->yAxis) {

            if ($position === '+') {
                $this->yPosition +=  $steps;
            } elseif ($position === '-') {
                $this->yPosition -= $steps;
            } else {
                dd('invalid position on y axis !!');
            }
        } else {
            dd('invalid axis not allowed !!');
        }

        $this->action =  $action;
        $this->actionBackgroundColor = $actionBackgroundColor;
    }

    public function render()
    {
        return view('livewire.snake');
    }
}
