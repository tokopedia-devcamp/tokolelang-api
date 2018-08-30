<?php

class User extends MasterApi {
    private $table_name = 'users';

    // Get All User
    public function getUsers(){
        if(!isConnected){
            $this->send404("Cannot connect to database.");
        }

        $query = "SELECT * FROM " . $this->table_name;
        $user_data = $this->dbh->prepare($query);
        $user_data->execute();
        Flight::json($user_data->fetchAll());
    }

    public function getUserById($id){
        if(!isConnected){
            $this->send404("Cannot connect to database.");
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

    }

    public function updateUser(){

    }

    public function deleteUser(){
        
    }
}