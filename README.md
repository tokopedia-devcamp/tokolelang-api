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
