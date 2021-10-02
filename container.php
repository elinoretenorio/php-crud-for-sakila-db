<?php

declare(strict_types=1);

// Core

$container->add("Pdo", PDO::class)
    ->addArgument("mysql:dbname={$_ENV["DB_NAME"]};host={$_ENV["DB_HOST"]}")
    ->addArgument($_ENV["DB_USER"])
    ->addArgument($_ENV["DB_PASS"])
    ->addArgument([]);
$container->add("Database", Sakila\Database\PdoDatabase::class)
    ->addArgument("Pdo");

// Actor

$container->add("ActorRepository", Sakila\Actor\ActorRepository::class)
    ->addArgument("Database");
$container->add("ActorService", Sakila\Actor\ActorService::class)
    ->addArgument("ActorRepository");
$container->add(Sakila\Actor\ActorController::class)
    ->addArgument("ActorService");

// Address

$container->add("AddressRepository", Sakila\Address\AddressRepository::class)
    ->addArgument("Database");
$container->add("AddressService", Sakila\Address\AddressService::class)
    ->addArgument("AddressRepository");
$container->add(Sakila\Address\AddressController::class)
    ->addArgument("AddressService");

// Category

$container->add("CategoryRepository", Sakila\Category\CategoryRepository::class)
    ->addArgument("Database");
$container->add("CategoryService", Sakila\Category\CategoryService::class)
    ->addArgument("CategoryRepository");
$container->add(Sakila\Category\CategoryController::class)
    ->addArgument("CategoryService");

// City

$container->add("CityRepository", Sakila\City\CityRepository::class)
    ->addArgument("Database");
$container->add("CityService", Sakila\City\CityService::class)
    ->addArgument("CityRepository");
$container->add(Sakila\City\CityController::class)
    ->addArgument("CityService");

// Country

$container->add("CountryRepository", Sakila\Country\CountryRepository::class)
    ->addArgument("Database");
$container->add("CountryService", Sakila\Country\CountryService::class)
    ->addArgument("CountryRepository");
$container->add(Sakila\Country\CountryController::class)
    ->addArgument("CountryService");

// Customer

$container->add("CustomerRepository", Sakila\Customer\CustomerRepository::class)
    ->addArgument("Database");
$container->add("CustomerService", Sakila\Customer\CustomerService::class)
    ->addArgument("CustomerRepository");
$container->add(Sakila\Customer\CustomerController::class)
    ->addArgument("CustomerService");

// Film

$container->add("FilmRepository", Sakila\Film\FilmRepository::class)
    ->addArgument("Database");
$container->add("FilmService", Sakila\Film\FilmService::class)
    ->addArgument("FilmRepository");
$container->add(Sakila\Film\FilmController::class)
    ->addArgument("FilmService");

// FilmActor

$container->add("FilmActorRepository", Sakila\FilmActor\FilmActorRepository::class)
    ->addArgument("Database");
$container->add("FilmActorService", Sakila\FilmActor\FilmActorService::class)
    ->addArgument("FilmActorRepository");
$container->add(Sakila\FilmActor\FilmActorController::class)
    ->addArgument("FilmActorService");

// FilmCategory

$container->add("FilmCategoryRepository", Sakila\FilmCategory\FilmCategoryRepository::class)
    ->addArgument("Database");
$container->add("FilmCategoryService", Sakila\FilmCategory\FilmCategoryService::class)
    ->addArgument("FilmCategoryRepository");
$container->add(Sakila\FilmCategory\FilmCategoryController::class)
    ->addArgument("FilmCategoryService");

// FilmText

$container->add("FilmTextRepository", Sakila\FilmText\FilmTextRepository::class)
    ->addArgument("Database");
$container->add("FilmTextService", Sakila\FilmText\FilmTextService::class)
    ->addArgument("FilmTextRepository");
$container->add(Sakila\FilmText\FilmTextController::class)
    ->addArgument("FilmTextService");

// Inventory

$container->add("InventoryRepository", Sakila\Inventory\InventoryRepository::class)
    ->addArgument("Database");
$container->add("InventoryService", Sakila\Inventory\InventoryService::class)
    ->addArgument("InventoryRepository");
$container->add(Sakila\Inventory\InventoryController::class)
    ->addArgument("InventoryService");

// Payment

$container->add("PaymentRepository", Sakila\Payment\PaymentRepository::class)
    ->addArgument("Database");
$container->add("PaymentService", Sakila\Payment\PaymentService::class)
    ->addArgument("PaymentRepository");
$container->add(Sakila\Payment\PaymentController::class)
    ->addArgument("PaymentService");

// Rental

$container->add("RentalRepository", Sakila\Rental\RentalRepository::class)
    ->addArgument("Database");
$container->add("RentalService", Sakila\Rental\RentalService::class)
    ->addArgument("RentalRepository");
$container->add(Sakila\Rental\RentalController::class)
    ->addArgument("RentalService");

// Staff

$container->add("StaffRepository", Sakila\Staff\StaffRepository::class)
    ->addArgument("Database");
$container->add("StaffService", Sakila\Staff\StaffService::class)
    ->addArgument("StaffRepository");
$container->add(Sakila\Staff\StaffController::class)
    ->addArgument("StaffService");

// Store

$container->add("StoreRepository", Sakila\Store\StoreRepository::class)
    ->addArgument("Database");
$container->add("StoreService", Sakila\Store\StoreService::class)
    ->addArgument("StoreRepository");
$container->add(Sakila\Store\StoreController::class)
    ->addArgument("StoreService");

