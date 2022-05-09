<?php

class ErrorController
{
    /**
     * Control the error page.
     * @param string $askPage
     * @return void
     */
    public function error404(string $askPage)
    {
        require __DIR__ . '/../Partials/error/error.php';
    }


    /**
     * Display an error on missed functions parameters.
     * @return void
     */
    public function missingParameters()
    {
        require __DIR__ . '/../Partials/error/missing-param.php';
    }
}