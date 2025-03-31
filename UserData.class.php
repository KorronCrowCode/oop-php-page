<?php
class UserData{
    private string $name;
    private string $password;
    public function __construct($name,$password){
        $this->name = $name;
        $this->password = $password;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }


}