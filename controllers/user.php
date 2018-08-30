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

    public function parseToJson($user_data){

        $datas = [];
        foreach ($user_data->fetchAll() as $data) {
            $datas[] = [
              "name" => $data['name'],
              "email" => $data['email'],
              "password" => $data['password'],
              "avatar" => $data['avatar'],
              "created_at" => $data['created_at'],
              "updated_at" => $data['updated_at']
            ];
        }

        return $datas;
    }

    public function login(){
        if(!parent::isConnected()){
            $this->send404($this->notConnected);
        }
        
        $email = Flight::request()->data->email;
        $password = Flight::request()->data->password;
        $query = "SELECT * FROM " . $this->table_name . " WHERE email='" . $email . "'";
        
        $user_data = $this->dbh->prepare($query);
        $user_data->execute();
        $user_data = $user_data->fetchAll();

        $total_data = count($user_data);
        
        // Email not exist
        // if($total_data == 0){
        //     Flight::json([
        //         "code" => 400,
        //         "message" => "email tidak terdaftar"
        //     ]);
        //     return;
        // }

        // $row = $user_data[0];
        // if(!password_verify($password, $row["password"])){
        //     Flight::json([
        //         "code" => 400,
        //         "message" => "password salah"
        //     ]);
        // } else {
        //     Flight::json([
        //         "code" => 200,
        //         "message" => "login success",
        //         "data" => [
        //             "id" => $row["id"],
        //             "name" => $row["name"],
        //             "email" => $row["email"],
        //             "avatar" => $row["avatar"],
        //             "created_at" => $row["created_at"],
        //             "updated_at" => $row["updated_at"]
        //         ]
        //     ]);
        // }
        
        
    }
}