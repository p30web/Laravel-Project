Hi,


**Serve Project**

1- run : 

`php artisan serve`

2- create personal access :

`php artisan passport:client --personal`

3- create permission.


---------------------------------------


**Filter**

{{url}}/v1/search?sale&brand_id=30&model_id=1&city_id=2&placestain_id=6&production_id=1,3&color_id=5&in_place=true&cash=4&chassis_type=5&gearbox_status=1&car_status=3&differential=2

| url | descripton | example
| ------ | ------ | ------ |
| search | display all advers | /v1/search |
| sale | show all sale advers when status equal 1 | /v1/search?sale |
| expert | show all expert advers when status qual 1 |  /v1/search?expert |
| city_id | filter with city |  /v1/search?sale&city_id=26 Or /v1/search?expert&city_id=26 |
| placestain_id | filter with placestain | /v1/search?sale&placestain_id=26 |
| production_id | filter with production | /v1/search?sale&production_id=1 or /v1/search?sale&production_id=1,5
| brand_id | filter with brand | /v1/search?sale&brand_id=12 |
| model_id | filter with model | /v1/search?sale&model_id=20 |