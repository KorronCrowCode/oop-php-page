<?php

class Post
{
    private string $owner_name;
    private string $content;
    public function __construct(string $owner_name, string $content){
        $this->owner_name = $owner_name;
        $this->content = $content;
    }

    public function getOwnerName(): string{
        return $this->owner_name;
    }
    public function getContent(): string{
        return $this->content;
    }
}