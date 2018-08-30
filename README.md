# Tokolelang RESTful API
Group #3

Built with [Flight Micro-Framework](http://flightphp.com/)

### Requests
#### Products
```
GET url://products
{
  "code": 200,
  "message": "OK",
  "data": [
    {
      "product_id": 4,
      "imageurl": "http://devcamp3.000webhostapp.com/uploads/p/tokolelang-yXlh8yCBqGxV4Zr1L6PRq6ysdtzpqGxrrtHaK00WkGpZn",
      "name": "Sandal Antik",
      "next_bid": 2000,
      "product_condition": 1,
      "min_price": 10000,
      "expired": "2018-08-31 20:00:00",
      "category": {
        "id": 1,
        "name": "Barang Antik"
      },
      "seller": {
        "id": 2,
        "name": "Isfhani",
        "email": "",
        "avatar": ""
      },
      "created_at": "2018-08-30 20:18:21",
      "updated_at": "2018-08-30 20:18:21",
      "total_bidder": "0"
    }
  ]
}
```

```
POST url://products
PNG and JPG only

Product POST Request
{
  "name": "",
  "product_condition": 0,
  "min_price": 0,
  "next_bid": 0,
  "expired": "0000-00-00 00:00:00",
  "product_category": 0,
  "user_id": 0,
  "encoded_image": ""
}

Return on type denied
{
  "code": 400,
  "message": "Bad Request"
}

Return on success
{
  "code": 200,
  "message": "OK",
  "data": {
    "image_url": "http://devcamp3.000webhostapp.com/uploads/p/tokolelang-N4eR7yixTj.png
  }
}
```

#### Product Category
```
GET url://product_category
{
  "code": 200,
  "message": "OK",
  "data": [
    {
      "id": 1,
      "name": "Barang Antik"
    },
    {
      "id": 2,
      "name": "Uang"
    },
    {
      "id": 3,
      "name": "Guci"
    }
  ]
}
```

#### User
```
GET url://user/login/

Return on no email address on database
{
    "code": 400,
    "message": "email tidak terdaftar"
}

Return on wrong password
{
    "code": 400,
    "message": "password salah"
}

Return on success
{
    "code": 200,
    "message": "login success",
    "data": {
        "id": "1",
        "name": "Sebastion Mualim",
        "email": "bastian@example.com",
        "avatar": "https://cdn.iconscout.com/icon/free/png-512/avatar-372-456324.png",
        "created_at": "2018-08-30 14:18:55",
        "updated_at": "2018-08-30 14:18:55"
    }
}
```

#### Transaction Bid

POST TRANSACTION
```
GET url://tr/postbid/
Return on success
{
    "code": 200,
    "message": "success"
}
```

GET BID WINNER ON PRODUCT ID
```
GET url://tr/bidwinner/:id
return on failure to found data
{
    "code": 404,
    "message": "Data not found"
}

return on found data
{
    "id": "21",
    "user_id": "3",
    "product_id": "2",
    "price": "50000",
    "created_at": "2018-08-30 09:39:02",
    "updated_at": "2018-08-30 09:39:02"
}
```

GET USER'S BID LIST ON PRODUCT
```
GET url:://tr/userid/:userid/:productid
[
    {
        "id": "14",
        "user_id": "1",
        "product_id": "2",
        "price": "13000",
        "created_at": "2018-08-30 12:12:00",
        "updated_at": "2018-08-30 18:35:13"
    }, {...}
]
```

GET PRODUCT BIDDER LIST
```
GET url:://tr/productid/@id
[
    {
        "id": "11",
        "user_id": "1",
        "product_id": "1",
        "price": "20000",
        "created_at": "2018-08-30 12:00:00",
        "updated_at": "2018-08-30 18:35:13"
    }, {...}
]
```

#### Winner Bid
```
POST url://winner

Winner POST Request
{
  "user_id": 0,
  "product_id": 0,
  "message": "Hello world",
  "price": 0,
}

Winner POST Response
{
  "code": 200,
  "message": "OK"
}
```

#### Logistics
```
GET url://logistics
{
  "code": 200,
  "message": "OK",
  "data": [
    {
      "id": 0,
      "name": "",
      "price": 0
    },
    {...}
  ]
}
```