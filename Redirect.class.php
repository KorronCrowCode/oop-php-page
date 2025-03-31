<?php


class Redirect
{
    private string $dest;
    public function __construct(string $dest)
    {
        $this->dest = $dest;
    }

    public function redirectPage($statusCode=303): void
    {

        $url = $this->dest . ".page.php";
        header('Location: ' . $url, true, $statusCode);

        die();
    }

}