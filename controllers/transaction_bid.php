<?php

class Transaction extends MasterApi {
    private $table_name = 'transaction_bid';
    private $noConnection = "Cannot connect to database.";

    public function getByProductId($id){
        if(!parent::isConnected()){
            $this->send404($this->noConnection);
        }
        
        $query = "
            SELECT tr.id as trans_id,
            u.id as user_id,
            p.id as product_id,
            tr.price,
            tr.created_at,
            tr.updated_at,
            p.imageurl,
            p.name,
            p.product_condition,
            p.min_price,
            p.next_bid,
            p.expired,
            u.name as bidder_name,
            u.email,
            u.avatar,
            (
                SELECT COUNT(DISTINCT(tr.user_id))
                WHERE product_id = p.id
            ) AS total_bidder
            FROM transaction_bid tr
            INNER JOIN products p
                ON tr.product_id = p.id
            INNER JOIN users u
                ON tr.user_id = u.id 
            WHERE product_id=" . $id ."
            GROUP BY tr.id
            ORDER BY tr.price DESC";
        // echo $query;
        $trans_data = $this->dbh->prepare($query);
        $trans_data->execute();
        $trans_data = $trans_data->fetchAll();
        // echo count($trans_data);
        if(count($trans_data) == 0){
            $message = "product id not exist";
            Flight::json([
                "code" => 400,
                "message" => $message
              ]);
        } else Flight::json($this->parseToJson2($trans_data));
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

        $query = "SELECT * FROM ".$this->table_name." WHERE product_id=".$id." ORDER BY price DESC";
        
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
            "price" => (int)$data["price"],
            "created_at" => $data["created_at"],
            "updated_at" => $data["updated_at"],
        );
        return $res;
    }

    public function parseToJson2($trans_data){
        $res = array(
            "code" => 200,
            "message" => "success",
            "data" => []
        );
        foreach($trans_data as $result){
            $res["data"][] = [
                "transaction_id" => (int) $result["trans_id"],
                "price" => (int) $result["price"],
                "created_at" => $result["created_at"],
                "updated_at" => $result["updated_at"],
                "product" => [
                    "product_id" => (int) $result['product_id'],
                    "imageurl" => $result['imageurl'],
                    "name"     => $result['name'],
                    "next_bid" => (int) $result['next_bid'],
                    "product_condition" => (int) $result['product_condition'],
                    "min_price" => (int) $result['min_price'],
                    "next_bid"  => (int) $result['next_bid'],
                    "expired"   => $result['expired'],
                    "total_bidder" => $result["total_bidder"]
                ],
                "bidder" => [
                    "user_id" => (int) $result["user_id"],
                    "email" => $result["email"],
                    "avatar" => $result["avatar"]
                ]
                
            ];
        }
        return $res;
    }

    public function parseExtractedToJson($trans_data){
        $res = [];
        foreach($trans_data as $data){
            $res[] = [
                "id" => $data["id"],
                "user_id" => $data["user_id"],
                "product_id" => $data["product_id"],
                "price" => (int)$data["price"],
                "created_at" => $data["created_at"],
                "updated_at" => $data["updated_at"]
            ];
        }
        return $res;
    }

    public function compressData($trans_data){
        $res = array(array());
        foreach($trans_data as $data){
            if(isset($res[$data["user_id"]])){

            }else{
                // $res[$data["user_id"]] = 
            }
        }
    }
}