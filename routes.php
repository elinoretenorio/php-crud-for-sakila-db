<?php

declare(strict_types=1);

$router->get("/actor", "Sakila\Actor\ActorController::getAll");
$router->post("/actor", "Sakila\Actor\ActorController::insert");
$router->group("/actor", function ($router) {
    $router->get("/{actor_id:number}", "Sakila\Actor\ActorController::get");
    $router->post("/{actor_id:number}", "Sakila\Actor\ActorController::update");
    $router->delete("/{actor_id:number}", "Sakila\Actor\ActorController::delete");
});

$router->get("/address", "Sakila\Address\AddressController::getAll");
$router->post("/address", "Sakila\Address\AddressController::insert");
$router->group("/address", function ($router) {
    $router->get("/{address_id:number}", "Sakila\Address\AddressController::get");
    $router->post("/{address_id:number}", "Sakila\Address\AddressController::update");
    $router->delete("/{address_id:number}", "Sakila\Address\AddressController::delete");
});

$router->get("/category", "Sakila\Category\CategoryController::getAll");
$router->post("/category", "Sakila\Category\CategoryController::insert");
$router->group("/category", function ($router) {
    $router->get("/{category_id:number}", "Sakila\Category\CategoryController::get");
    $router->post("/{category_id:number}", "Sakila\Category\CategoryController::update");
    $router->delete("/{category_id:number}", "Sakila\Category\CategoryController::delete");
});

$router->get("/city", "Sakila\City\CityController::getAll");
$router->post("/city", "Sakila\City\CityController::insert");
$router->group("/city", function ($router) {
    $router->get("/{city_id:number}", "Sakila\City\CityController::get");
    $router->post("/{city_id:number}", "Sakila\City\CityController::update");
    $router->delete("/{city_id:number}", "Sakila\City\CityController::delete");
});

$router->get("/country", "Sakila\Country\CountryController::getAll");
$router->post("/country", "Sakila\Country\CountryController::insert");
$router->group("/country", function ($router) {
    $router->get("/{country_id:number}", "Sakila\Country\CountryController::get");
    $router->post("/{country_id:number}", "Sakila\Country\CountryController::update");
    $router->delete("/{country_id:number}", "Sakila\Country\CountryController::delete");
});

$router->get("/customer", "Sakila\Customer\CustomerController::getAll");
$router->post("/customer", "Sakila\Customer\CustomerController::insert");
$router->group("/customer", function ($router) {
    $router->get("/{customer_id:number}", "Sakila\Customer\CustomerController::get");
    $router->post("/{customer_id:number}", "Sakila\Customer\CustomerController::update");
    $router->delete("/{customer_id:number}", "Sakila\Customer\CustomerController::delete");
});

$router->get("/film", "Sakila\Film\FilmController::getAll");
$router->post("/film", "Sakila\Film\FilmController::insert");
$router->group("/film", function ($router) {
    $router->get("/{film_id:number}", "Sakila\Film\FilmController::get");
    $router->post("/{film_id:number}", "Sakila\Film\FilmController::update");
    $router->delete("/{film_id:number}", "Sakila\Film\FilmController::delete");
});

$router->get("/film-actor", "Sakila\FilmActor\FilmActorController::getAll");
$router->post("/film-actor", "Sakila\FilmActor\FilmActorController::insert");
$router->group("/film-actor", function ($router) {
    $router->get("/{actor_id:number}", "Sakila\FilmActor\FilmActorController::get");
    $router->post("/{actor_id:number}", "Sakila\FilmActor\FilmActorController::update");
    $router->delete("/{actor_id:number}", "Sakila\FilmActor\FilmActorController::delete");
});

$router->get("/film-category", "Sakila\FilmCategory\FilmCategoryController::getAll");
$router->post("/film-category", "Sakila\FilmCategory\FilmCategoryController::insert");
$router->group("/film-category", function ($router) {
    $router->get("/{category_id:number}", "Sakila\FilmCategory\FilmCategoryController::get");
    $router->post("/{category_id:number}", "Sakila\FilmCategory\FilmCategoryController::update");
    $router->delete("/{category_id:number}", "Sakila\FilmCategory\FilmCategoryController::delete");
});

$router->get("/film-text", "Sakila\FilmText\FilmTextController::getAll");
$router->post("/film-text", "Sakila\FilmText\FilmTextController::insert");
$router->group("/film-text", function ($router) {
    $router->get("/{film_id:number}", "Sakila\FilmText\FilmTextController::get");
    $router->post("/{film_id:number}", "Sakila\FilmText\FilmTextController::update");
    $router->delete("/{film_id:number}", "Sakila\FilmText\FilmTextController::delete");
});

$router->get("/inventory", "Sakila\Inventory\InventoryController::getAll");
$router->post("/inventory", "Sakila\Inventory\InventoryController::insert");
$router->group("/inventory", function ($router) {
    $router->get("/{inventory_id:number}", "Sakila\Inventory\InventoryController::get");
    $router->post("/{inventory_id:number}", "Sakila\Inventory\InventoryController::update");
    $router->delete("/{inventory_id:number}", "Sakila\Inventory\InventoryController::delete");
});

$router->get("/payment", "Sakila\Payment\PaymentController::getAll");
$router->post("/payment", "Sakila\Payment\PaymentController::insert");
$router->group("/payment", function ($router) {
    $router->get("/{payment_id:number}", "Sakila\Payment\PaymentController::get");
    $router->post("/{payment_id:number}", "Sakila\Payment\PaymentController::update");
    $router->delete("/{payment_id:number}", "Sakila\Payment\PaymentController::delete");
});

$router->get("/rental", "Sakila\Rental\RentalController::getAll");
$router->post("/rental", "Sakila\Rental\RentalController::insert");
$router->group("/rental", function ($router) {
    $router->get("/{rental_id:number}", "Sakila\Rental\RentalController::get");
    $router->post("/{rental_id:number}", "Sakila\Rental\RentalController::update");
    $router->delete("/{rental_id:number}", "Sakila\Rental\RentalController::delete");
});

$router->get("/staff", "Sakila\Staff\StaffController::getAll");
$router->post("/staff", "Sakila\Staff\StaffController::insert");
$router->group("/staff", function ($router) {
    $router->get("/{staff_id:number}", "Sakila\Staff\StaffController::get");
    $router->post("/{staff_id:number}", "Sakila\Staff\StaffController::update");
    $router->delete("/{staff_id:number}", "Sakila\Staff\StaffController::delete");
});

$router->get("/store", "Sakila\Store\StoreController::getAll");
$router->post("/store", "Sakila\Store\StoreController::insert");
$router->group("/store", function ($router) {
    $router->get("/{store_id:number}", "Sakila\Store\StoreController::get");
    $router->post("/{store_id:number}", "Sakila\Store\StoreController::update");
    $router->delete("/{store_id:number}", "Sakila\Store\StoreController::delete");
});

