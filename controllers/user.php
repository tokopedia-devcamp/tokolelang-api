<?php

class User extends MasterApi {
    private $table_name = 'users';
    private $notConnected = "Cannot connect to database.";
    
    // Get All User
    public function getUsers(){
        // echo 'test';
        if(!parent::isConnected()){
            $this->send404($this->notConnected);
        }
        $query = "SELECT * FROM " . $this->table_name;
        
        $user_data = $this->dbh->prepare($query);
        $user_data->execute();
        
        Flight::json($this->parseToJson($user_data));
    }

    public function getUserById($id){
        if(!parent::isConnected()){
            $this->send404($this->notConnected);
        }

        $query = "SELECT * FROM " . $this->table_name. " WHERE id=" . $id;
        // echo $query;
        $user_data = $this->dbh->prepare($query);
        $user_data->execute();

        // If target data isn't found
        // in the database then give
        // 404 return
        
        if(count($user_data->fetchAll()) == 0){
            $this->send404("Data not found");
        }

        Flight::json($user_data->fetchAll());
    }

    public function insertUser(){
        if(!parent::isConnected()){
            $this->send404($this->notConnected);
        }

        if(!isset(Flight::request()->data->name))
            $this->send404("name must be filled");

        if(!isset(Flight::request()->data->email))
            $this->send404("email must be filled");

        if(!isset(Flight::request()->data->password))
            $this->send404("password must be filled");

        if(!isset(Flight::request()->data->avatar))
            $this->send404("avatar must be filled");

        // if(!isset(Flight::request()->data->user_detail_id))
        //     $this->send404("user_detail_id must be filled");

        if(!isset(Flight::request()->data->created_at))
            $this->send404("created_at must be filled");

        if(!isset(Flight::request()->data->updated_at))
            $this->send404("updated_at must be filled"); 

        $name = Flight::request()->data->name;
        $email = Flight::request()->data->email;
        $password = Flight::request()->data->password;
        $avatar = Flight::request()->data->avatar;
        // $user_detail_id = Flight::request()->data->user_detail_id;
        $created_at = Flight::request()->data->created_at;
        $updated_at = Flight::request()->data->updated_at;

        try{
            $query = "SELECT * FROM " . $this->table_name . " WHERE email=" . $email;
            $data = $this->dbh->prepare($query);
            $data->execute();
            
            if($data->fetchColumn() == 0){
                $query = "INSERT INTO " . $this->table_name . "(";
                $temp = $this->dbh->prepare($query);
                if(!$data->execute()){
                    throw new Exception("Query Error");
                }
                $show = array(
                    "status" => 200,
                    "data" => array(
                        "name" => $name,
                        "email" => $email,
                        "password" => $password,
                        "avatar" => $avatar,
                        "user_detail_id" => $user_detail_id,
                        "created_at" => $created_at,
                        "updated_at" => $updated_at
                    )
                );

                Flight::json($show);
            }

        }catch(Exception $e){
            $this->send404("Query Error!");
        }
    }

    public function updateUser(){
        
    }

    public function deleteUser(){
        
    }

    public function parseToJson($user_data){

        $datas = [];
        foreach ($user_data->fetchAll() as $data) {
            $datas[] = [
              "name" => $data['name'],
              "email" => $data['email'],
              "password" => $data['password'],
              "avatar" => $data['avatar'],
            //   "user_detail_id" => $data['user_detail_id'],
              "created_at" => $data['created_at'],
              "updated_at" => $data['updated_at']
            ];
        }

        return $datas;
    }
}