<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class MainWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'container_widget'=> ''
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('widgets.main_widget', [
            'config' => $this->config,
        ]);
    }
}
