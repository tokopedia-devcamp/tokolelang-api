<?php

class Transaction extends MasterApi {
    private $table_name = 'transaction_bid';
    private $noConnection = "Cannot connect to database.";

    public function getByProductId($id){
        
        if(!parent::isConnected()){
            $this->send404($this->noConnection);
        }
        // $this->send404();
        $query = "SELECT *
                FROM " . $this->table_name.
                " WHERE products_id=" . $id;
        echo $query;
        $trans_data = $this->dbh->prepare($query);
        $trans_data->execute();

        // If target data isn't found
        // in the database then give
        // 404 return
        if(count($trans_data->fetchAll()) == 0){
            $this->send404("Data not found");
        } else Flight::json($trans_data->fetchAll());
    }

    public function insertTransactionBid(){
        if(!parent::isConnected()){
            $this->send404($this->noConnection);
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

}