<?php

class Transaction extends MasterApi {
    private $table_name = 'transaction_bid';
    private $noConnection = "Cannot connect to database.";

    public function getByProductId($id){
        
        if(!parent::isConnected()){
            $this->send404($this->noConnection);
        }
        
        $query = "SELECT *
                FROM " . $this->table_name.
                " WHERE products_id=" . $id;
        
        $trans_data = $this->dbh->prepare($query);
        $trans_data->execute();

        if(count($trans_data->fetchAll()) == 0){
            $message = "product id not exist";
            Flight::json([
                "code" => 400,
                "message" => $message
              ]);
        } else Flight::json(parseAndTransformToJSON($trans_data));
    }

    public function insertTransactionBid(){
        if(!parent::isConnected()){
            $this->send404($this->noConnection);
        }

        $userid = Flight::request()->data->user_id;
        $productid = Flight::request()->data->product_id;
        $price = Flight::request()->data->price;
        $created_at = time();
        $updated_at = time();

        $query = "INSERT INTO TABLE ".$this->table_name.
                 "VALUES(".$userid.",".$productid.",".$price.","
                 .$created_at.",".$updated_at.")";
        
        $user_data = $this->dbh->prepare($query);
        $user_data->execute();

        $query = "SELECT * FROM ".$this->table_name." WHERE u
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

}