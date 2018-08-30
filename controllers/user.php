<?php

class User extends MasterApi {
    private $table_name = 'users';
    private $notConnected = "Cannot connect to database.";

    // Get All User
    public function getUsers(){
        if(!$this->isConnected){
            $this->send404($notConnected);
        }

        $query = "SELECT * FROM " . $this->table_name;
        $user_data = $this->dbh->prepare($query);
        $user_data->execute();
        Flight::json($user_data->fetchAll());
    }

    public function getUserById($id){
        if(!$this->isConnected){
            $this->send404($notConnected);
        }

        $query = "SELECT *
                FROM " . $this->table_name.
                "WHERE id=" . $id;
        
        $user_data = $this->dbh->prepare($query);
        $user_data->execute();

        // If target data isn't found
        // in the database then give
        // 404 return
        if($user_data->num_rows == 0){
            $this->send404("Data not found");
        }

        Flight::json($user_data->fetchAll());
    }

    public function insertUser(){
        if(!$this->isConnected()){
            $this->send404($notConnected);
        }

        if(!isset(Flight::request()->data->name))
            $this->send404("name must be filled");
        if(!isset(Flight::request()->data->email))
            $this->send404("email must be filled");
        if(!isset(Flight::request()->data->password))
            $this->send404("password must be filled");
        if(!isset(Flight::request()->data->avatar))
            $this->send404("avatar must be filled");
        if(!isset(Flight::request()->data->user_detail_id))
            $this->send404("user_detail_id must be filled");
        if(!isset(Flight::request()->data->created_at))
            $this->send404("created_at must be filled");
        if(!isset(Flight::request()->data->updated_at))
            $this->send404("updated_at must be filled"); 

        $name = Flight::request()->data->name;
        $email = Flight::request()->data->email;
        $password = Flight::request()->data->password;
        $avatar = Flight::request()->data->avatar;
        $user_detail_id = Flight::request()->data->user_detail_id;
        $created_at = Flight::request()->data->created_at;
        $updated_at = Flight::request()->data->updated_at;

        try{
            $query = "SELECT * FROM " . $this->table_name . " WHERE email=" . $email;
            $data = $this->dbh->prepare($query);
            $data->execute();
            
            if(data->num_rows == 0){
                $q = "INSERT INTO " . $this->table_name . "("
            }

        }catch(Exception e){
            
        }
    }

    public function updateUser(){

    }

    public function deleteUser(){
        
    }

}