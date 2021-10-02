curl -X GET "localhost:8080/actor"

curl -X POST "localhost:8080/actor" -H 'Content-Type: application/json' -d'
{
  "first_name": "east",
  "last_name": "structure",
  "last_update": "2021-10-12 23:10:02"
}
'

curl -X POST "localhost:8080/actor/8442" -H 'Content-Type: application/json' -d'
{
  "actor_id": 8442,
  "first_name": "east",
  "last_name": "structure",
  "last_update": "2021-10-12 23:10:02"
}
'

curl -X GET "localhost:8080/actor/8442"

curl -X DELETE "localhost:8080/actor/8442"

# --

curl -X GET "localhost:8080/address"

curl -X POST "localhost:8080/address" -H 'Content-Type: application/json' -d'
{
  "address": "nice",
  "address2": "seem",
  "city_id": 9654,
  "district": "along",
  "last_update": "2021-10-14 11:19:10",
  "phone": "fill",
  "postal_code": "scientist"
}
'

curl -X POST "localhost:8080/address/8991" -H 'Content-Type: application/json' -d'
{
  "address": "nice",
  "address2": "seem",
  "address_id": 8991,
  "city_id": 9654,
  "district": "along",
  "last_update": "2021-10-14 11:19:10",
  "phone": "fill",
  "postal_code": "scientist"
}
'

curl -X GET "localhost:8080/address/8991"

curl -X DELETE "localhost:8080/address/8991"

# --

curl -X GET "localhost:8080/category"

curl -X POST "localhost:8080/category" -H 'Content-Type: application/json' -d'
{
  "last_update": "2021-09-20 19:28:16",
  "name": "friend"
}
'

curl -X POST "localhost:8080/category/4051" -H 'Content-Type: application/json' -d'
{
  "category_id": 4051,
  "last_update": "2021-09-20 19:28:16",
  "name": "friend"
}
'

curl -X GET "localhost:8080/category/4051"

curl -X DELETE "localhost:8080/category/4051"

# --

curl -X GET "localhost:8080/city"

curl -X POST "localhost:8080/city" -H 'Content-Type: application/json' -d'
{
  "city": "process",
  "country_id": 2273,
  "last_update": "2021-10-02 23:37:31"
}
'

curl -X POST "localhost:8080/city/5905" -H 'Content-Type: application/json' -d'
{
  "city": "process",
  "city_id": 5905,
  "country_id": 2273,
  "last_update": "2021-10-02 23:37:31"
}
'

curl -X GET "localhost:8080/city/5905"

curl -X DELETE "localhost:8080/city/5905"

# --

curl -X GET "localhost:8080/country"

curl -X POST "localhost:8080/country" -H 'Content-Type: application/json' -d'
{
  "country": "idea",
  "last_update": "2021-09-23 03:00:20"
}
'

curl -X POST "localhost:8080/country/840" -H 'Content-Type: application/json' -d'
{
  "country": "idea",
  "country_id": 840,
  "last_update": "2021-09-23 03:00:20"
}
'

curl -X GET "localhost:8080/country/840"

curl -X DELETE "localhost:8080/country/840"

# --

curl -X GET "localhost:8080/customer"

curl -X POST "localhost:8080/customer" -H 'Content-Type: application/json' -d'
{
  "active": true,
  "address_id": 7428,
  "create_date": "2021-10-04 10:42:06",
  "email": "robert34@example.com",
  "first_name": "floor",
  "last_name": "see",
  "last_update": "2021-09-26 23:02:06",
  "store_id": 4910
}
'

curl -X POST "localhost:8080/customer/5280" -H 'Content-Type: application/json' -d'
{
  "active": true,
  "address_id": 7428,
  "create_date": "2021-10-04 10:42:06",
  "customer_id": 5280,
  "email": "robert34@example.com",
  "first_name": "floor",
  "last_name": "see",
  "last_update": "2021-09-26 23:02:06",
  "store_id": 4910
}
'

curl -X GET "localhost:8080/customer/5280"

curl -X DELETE "localhost:8080/customer/5280"

# --

curl -X GET "localhost:8080/film"

curl -X POST "localhost:8080/film" -H 'Content-Type: application/json' -d'
{
  "description": "Information role coach conference. Area as put personal occur rather so. Almost everybody answer upon study address.",
  "language_id": 7570,
  "last_update": "2021-10-05 05:15:12",
  "length": 3300,
  "original_language_id": 2384,
  "rating": "Acupuncturist",
  "release_year": "Hand structure wear garden.",
  "rental_duration": 1860,
  "rental_rate": 594.0,
  "replacement_cost": 428.2,
  "special_features": "Loss adjuster, chartered",
  "title": "wife"
}
'

curl -X POST "localhost:8080/film/5843" -H 'Content-Type: application/json' -d'
{
  "description": "Information role coach conference. Area as put personal occur rather so. Almost everybody answer upon study address.",
  "film_id": 5843,
  "language_id": 7570,
  "last_update": "2021-10-05 05:15:12",
  "length": 3300,
  "original_language_id": 2384,
  "rating": "Acupuncturist",
  "release_year": "Hand structure wear garden.",
  "rental_duration": 1860,
  "rental_rate": 594.0,
  "replacement_cost": 428.2,
  "special_features": "Loss adjuster, chartered",
  "title": "wife"
}
'

curl -X GET "localhost:8080/film/5843"

curl -X DELETE "localhost:8080/film/5843"

# --

curl -X GET "localhost:8080/film-actor"

curl -X POST "localhost:8080/film-actor" -H 'Content-Type: application/json' -d'
{
  "film_id": 3288,
  "last_update": "2021-10-11 11:29:12"
}
'

curl -X POST "localhost:8080/film-actor/1702" -H 'Content-Type: application/json' -d'
{
  "actor_id": 1702,
  "film_id": 3288,
  "last_update": "2021-10-11 11:29:12"
}
'

curl -X GET "localhost:8080/film-actor/1702"

curl -X DELETE "localhost:8080/film-actor/1702"

# --

curl -X GET "localhost:8080/film-category"

curl -X POST "localhost:8080/film-category" -H 'Content-Type: application/json' -d'
{
  "film_id": 2746,
  "last_update": "2021-10-09 02:54:51"
}
'

curl -X POST "localhost:8080/film-category/9557" -H 'Content-Type: application/json' -d'
{
  "category_id": 9557,
  "film_id": 2746,
  "last_update": "2021-10-09 02:54:51"
}
'

curl -X GET "localhost:8080/film-category/9557"

curl -X DELETE "localhost:8080/film-category/9557"

# --

curl -X GET "localhost:8080/film-text"

curl -X POST "localhost:8080/film-text" -H 'Content-Type: application/json' -d'
{
  "description": "Election against would against public president realize. West modern get small with this defense. Message office live outside the water.",
  "title": "project"
}
'

curl -X POST "localhost:8080/film-text/4771" -H 'Content-Type: application/json' -d'
{
  "description": "Election against would against public president realize. West modern get small with this defense. Message office live outside the water.",
  "film_id": 4771,
  "title": "project"
}
'

curl -X GET "localhost:8080/film-text/4771"

curl -X DELETE "localhost:8080/film-text/4771"

# --

curl -X GET "localhost:8080/inventory"

curl -X POST "localhost:8080/inventory" -H 'Content-Type: application/json' -d'
{
  "film_id": 4478,
  "last_update": "2021-09-28 18:41:21",
  "store_id": 6302
}
'

curl -X POST "localhost:8080/inventory/9656" -H 'Content-Type: application/json' -d'
{
  "film_id": 4478,
  "inventory_id": 9656,
  "last_update": "2021-09-28 18:41:21",
  "store_id": 6302
}
'

curl -X GET "localhost:8080/inventory/9656"

curl -X DELETE "localhost:8080/inventory/9656"

# --

curl -X GET "localhost:8080/payment"

curl -X POST "localhost:8080/payment" -H 'Content-Type: application/json' -d'
{
  "amount": 68.6,
  "customer_id": 9630,
  "last_update": "2021-10-03 22:05:27",
  "payment_date": "2021-10-14 15:13:58",
  "rental_id": 2398,
  "staff_id": 8167
}
'

curl -X POST "localhost:8080/payment/1951" -H 'Content-Type: application/json' -d'
{
  "amount": 68.6,
  "customer_id": 9630,
  "last_update": "2021-10-03 22:05:27",
  "payment_date": "2021-10-14 15:13:58",
  "payment_id": 1951,
  "rental_id": 2398,
  "staff_id": 8167
}
'

curl -X GET "localhost:8080/payment/1951"

curl -X DELETE "localhost:8080/payment/1951"

# --

curl -X GET "localhost:8080/rental"

curl -X POST "localhost:8080/rental" -H 'Content-Type: application/json' -d'
{
  "customer_id": 3064,
  "inventory_id": 1293,
  "last_update": "2021-10-06 14:16:01",
  "rental_date": "2021-10-09 00:08:54",
  "return_date": "2021-09-30 23:45:45",
  "staff_id": 6270
}
'

curl -X POST "localhost:8080/rental/6881" -H 'Content-Type: application/json' -d'
{
  "customer_id": 3064,
  "inventory_id": 1293,
  "last_update": "2021-10-06 14:16:01",
  "rental_date": "2021-10-09 00:08:54",
  "rental_id": 6881,
  "return_date": "2021-09-30 23:45:45",
  "staff_id": 6270
}
'

curl -X GET "localhost:8080/rental/6881"

curl -X DELETE "localhost:8080/rental/6881"

# --

curl -X GET "localhost:8080/staff"

curl -X POST "localhost:8080/staff" -H 'Content-Type: application/json' -d'
{
  "active": true,
  "address_id": 3517,
  "email": "fbrown@example.com",
  "first_name": "different",
  "last_name": "listen",
  "last_update": "2021-10-14 00:04:19",
  "password": "way",
  "picture": "Possible professional rock than.",
  "store_id": 2829,
  "username": "police"
}
'

curl -X POST "localhost:8080/staff/74" -H 'Content-Type: application/json' -d'
{
  "active": true,
  "address_id": 3517,
  "email": "fbrown@example.com",
  "first_name": "different",
  "last_name": "listen",
  "last_update": "2021-10-14 00:04:19",
  "password": "way",
  "picture": "Possible professional rock than.",
  "staff_id": 74,
  "store_id": 2829,
  "username": "police"
}
'

curl -X GET "localhost:8080/staff/74"

curl -X DELETE "localhost:8080/staff/74"

# --

curl -X GET "localhost:8080/store"

curl -X POST "localhost:8080/store" -H 'Content-Type: application/json' -d'
{
  "address_id": 22,
  "last_update": "2021-09-30 09:31:04",
  "manager_staff_id": 7149
}
'

curl -X POST "localhost:8080/store/2483" -H 'Content-Type: application/json' -d'
{
  "address_id": 22,
  "last_update": "2021-09-30 09:31:04",
  "manager_staff_id": 7149,
  "store_id": 2483
}
'

curl -X GET "localhost:8080/store/2483"

curl -X DELETE "localhost:8080/store/2483"

# --

