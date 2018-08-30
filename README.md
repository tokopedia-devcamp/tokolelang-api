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
      "product_id": "2",
      "imageurl": "http://cdn.onlinewebfonts.com/svg/img_231353.png",
      "name": "Uang 10 ribu seri unik",
      "product_condition": "1",
      "min_price": "5000",
      "next_bid": "3000",
      "expired": "2018-09-03 00:00:00",
      "category": "Uang",
      "seller_id": "1",
      "seller_name": "Sebastion Mualim",
      "created_at": "2018-08-30 12:55:44",
      "updated_at": "2018-08-30 12:55:44"
    },
    {...}
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
