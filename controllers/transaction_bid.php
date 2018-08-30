<?php

class Transaction extends MasterApi {
    private $table_name = 'transaction_bid';
    private $noConnection = "Cannot connect to database.";

    public function getByProductId($id){
        
        if(!parent::isConnected()){
            $this->send404($this->noConnection);
        }
        
        $query = "SELECT * FROM " . $this->table_name." WHERE product_id=" . $id;
        
        $trans_data = $this->dbh->prepare($query);
        $trans_data->execute();
        $trans_data = $trans_data->fetchAll();
        
        if(count($trans_data) == 0){
            $message = "product id not exist";
            Flight::json([
                "code" => 400,
                "message" => $message
              ]);
        } else Flight::json($this->parseExtractedToJson($trans_data));
    }

    public function getByUserId($userId, $productId){
        if(!parent::isConnected()){
            $this->send404($this->noConnection);
        }

        $query = "SELECT * FROM ".$this->table_name." WHERE user_id=".$userId." AND product_id=".$productId;
        $trans_data = $this->dbh->prepare($query);
        $trans_data->execute();
        $trans_data = $trans_data->fetchAll();
        
        if(count($trans_data) == 0){
            $message = "user's bid not exist";
            Flight::json([
                "code" => 400,
                "message" => $message
            ]);
        }else Flight::json($this->parseExtractedToJson($trans_data));
    }

    public function insertTransactionBid(){
        if(!parent::isConnected()){
            $this->send404($this->noConnection);
        }

        $userid = (int) Flight::request()->data->user_id;
        $productid = (int) Flight::request()->data->product_id;
        $price = (int) Flight::request()->data->price;
        // date_default_timezone_set('Australia/Melbourne');
        
        $created_at = date('Y/m/d h:i:s', time());;
        $updated_at = date('Y/m/d h:i:s', time());;

        $query = "INSERT INTO ".$this->table_name.
                 "(user_id, product_id, price, created_at, updated_at) VALUES("
                 .$userid.",".$productid.",".$price.",'"
                 .$created_at."','".$updated_at."')";
        
        $user_data = $this->dbh->prepare($query);
        $user_data->execute();

        Flight::json([
            "code" => 200,
            "message" => "success"
        ]);
    }

    public function getBidWinner($id){
        if(!parent::isConnected()){
            $this->send404($this->noConnection);
        }

        $query = "SELECT *
                FROM " . $this->table_name
                . " WHERE product_id=" . $id . " ORDER BY price DESC";
        
        $user_data = $this->dbh->prepare($query);
        $user_data->execute();
        $user_data = $user_data->fetchAll();

        $total_data = count($user_data);
        
        // If target data isn't found
        // in the database then give
        // 404 return
        if($total_data == 0){
            $this->send404("Data not found");
            return;
        }

        Flight::json($this->parseExtractedToJson1($user_data[0]));
    }

    // Parse single extracted data
    public function parseExtractedToJson1($data){
        $res = array(
            "id" => $data["id"],
            "user_id" => $data["user_id"],
            "product_id" => $data["product_id"],
            "price" => $data["price"],
            "created_at" => $data["created_at"],
            "updated_at" => $data["updated_at"],
        );
        return $res;
    }

    public function parseExtractedToJson($trans_data){
        $res = [];
        foreach($trans_data as $data){
            $res[] = [
                "id" => $data["id"],
                "user_id" => $data["user_id"],
                "product_id" => $data["product_id"],
                "price" => $data["price"],
                "created_at" => $data["created_at"],
                "updated_at" => $data["updated_at"]
            ];
        }
        return $res;
    }

    public function compressData($trans_data){
        // $res = [];
        // foreach($trans_data as $data){
        //     if(isset($res[$data["user_id"]])){

        //     }else{
        //         // $res[$data["user_id"]] = 
        //     }
        // }
    }
}