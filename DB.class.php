<?php
require_once '../scripts/autoloader.script.php';

class DB
{
    private mysqli $conn;

    public function __construct(){
        $this->connectToDB();
    }
    private function connectToDB(): void
    {
        $this->conn = new mysqli("localhost", "root", "", "chatroom");
    }

    private function addUserQuery($name, $password):mysqli_stmt{
        $query = $this->conn->prepare("INSERT INTO users (name, password) VALUES (?, ?)");
        $query->bind_param("ss", $name, $password);
        return $query;
    }

    //Returns false if name is taken
    public function addUser($name, $password):bool|UserData{
        if(!$this->isNameTaken($name)){
            $this->addUserQuery($name, $password)->execute();
            return new UserData($name, $password);
        }else{
            return false;
        }
    }

    //Returns true if name is taken, false if name is free
    private function isNameTaken($name):bool{
        $query = $this->conn->prepare("SELECT * FROM users WHERE name = ?");
        $query->bind_param("s", $name);
        $query->execute();
        $result = $query->get_result();

        return ($result->num_rows)>0;
    }

    private function sendPostQuery($name, $password, $content):mysqli_stmt{
        $id = $this->getValidatedId($name, $password);
        $query = $this->conn->prepare("INSERT INTO `posts`(`owner_id`, `content`) VALUES (?, ?);");
        $query->bind_param("is", $id, $content);
        return $query;
    }

    public function sendPost($name, $password, $content) : bool{
        $query = $this->sendPostQuery($name, $password, $content);
        return $query->execute();
    }

    private function findAllPostsQuery():mysqli_stmt{
        return $this->conn->prepare("SELECT u.name, p.content FROM posts p INNER JOIN users u ON p.owner_id = u.id ORDER BY p.post_id DESC");
    }

    private function findAllPosts():mysqli_result{
        $query = $this->findAllPostsQuery();
        $query->execute();
        return $query->get_result();
    }

    public function getAllPosts(): array
    {
        $posts = array();
        foreach($this->findAllPosts() as $p){
            $post = new Post($p["name"], $p["content"]);
            array_push($posts, $post);
        }
        return $posts;
    }

    private function findUserQuery($name, $password):mysqli_stmt{
        $query = $this->conn->prepare("SELECT u.name, u.password, u.id FROM users u WHERE u.name=? AND u.password=? LIMIT 1");
        $query->bind_param("ss", $name, $password);
        return $query;
    }

    private function findUser($name, $password):mysqli_result{
        $query = $this->findUserQuery($name, $password);
        $query->execute();
        return $query->get_result();

    }

    private function getValidatedId($name, $password):null|int{
        $id=null;
        $result = $this->findUser($name, $password);
        while($row = $result->fetch_array()){
            $id = $row["id"];
        }
        return $id;
    }

    public function getUser($name, $password):null|UserData{
        $user = null;
        $result = $this->findUser($name, $password);

        while($row = $result->fetch_assoc()){
            $user = new UserData($row["name"],$row["password"]);
        }

        return $user;
    }

}