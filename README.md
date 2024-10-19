<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

*Place your API key in the apikey-file at the root of the project.*

#### If you want to use to use city name search, compose the json-file as shown in the example
GET /api/weather/city

{

"city":"Moscow"

}


#### If you want to use the search by the coordinates of your area, compose the json file as indicated in the example. Get the coordinates of your place from the geolocation system of your smartphone
*GET /api/weather/geo*

{

"lon": "your longitude",

"lat": "your latitude"

}
