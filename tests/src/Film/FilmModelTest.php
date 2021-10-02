<?php

declare(strict_types=1);

namespace Sakila\Tests\Film;

use PHPUnit\Framework\TestCase;
use Sakila\Film\{ FilmDto, FilmModel };

class FilmModelTest extends TestCase
{
    private array $input;
    private FilmDto $dto;
    private FilmModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "film_id" => 2065,
            "title" => "western",
            "description" => "Kitchen travel game medical use. Despite none part article recognize win quite. Wide simple culture another soldier sound discussion. Government administration worker record minute.",
            "release_year" => "Feel western address take call contain.",
            "language_id" => 777,
            "original_language_id" => 9539,
            "rental_duration" => 5622,
            "rental_rate" => 776.92,
            "length" => 9265,
            "replacement_cost" => 72.00,
            "rating" => "Surveyor, land/geomatics",
            "special_features" => "Politician's assistant",
            "last_update" => "2021-09-25 13:05:31",
        ];
        $this->dto = new FilmDto($this->input);
        $this->model = new FilmModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new FilmModel(null);

        $this->assertInstanceOf(FilmModel::class, $model);
    }

    public function testGetFilmId(): void
    {
        $this->assertEquals($this->dto->filmId, $this->model->getFilmId());
    }

    public function testSetFilmId(): void
    {
        $expected = 2549;
        $model = $this->model;
        $model->setFilmId($expected);

        $this->assertEquals($expected, $model->getFilmId());
    }

    public function testGetTitle(): void
    {
        $this->assertEquals($this->dto->title, $this->model->getTitle());
    }

    public function testSetTitle(): void
    {
        $expected = "score";
        $model = $this->model;
        $model->setTitle($expected);

        $this->assertEquals($expected, $model->getTitle());
    }

    public function testGetDescription(): void
    {
        $this->assertEquals($this->dto->description, $this->model->getDescription());
    }

    public function testSetDescription(): void
    {
        $expected = "Save far government mission decide former scene. Work hand prepare least cause cup. Evidence himself dinner note thus draw report yourself.";
        $model = $this->model;
        $model->setDescription($expected);

        $this->assertEquals($expected, $model->getDescription());
    }

    public function testGetReleaseYear(): void
    {
        $this->assertEquals($this->dto->releaseYear, $this->model->getReleaseYear());
    }

    public function testSetReleaseYear(): void
    {
        $expected = "Stand beat home both consumer.";
        $model = $this->model;
        $model->setReleaseYear($expected);

        $this->assertEquals($expected, $model->getReleaseYear());
    }

    public function testGetLanguageId(): void
    {
        $this->assertEquals($this->dto->languageId, $this->model->getLanguageId());
    }

    public function testSetLanguageId(): void
    {
        $expected = 8887;
        $model = $this->model;
        $model->setLanguageId($expected);

        $this->assertEquals($expected, $model->getLanguageId());
    }

    public function testGetOriginalLanguageId(): void
    {
        $this->assertEquals($this->dto->originalLanguageId, $this->model->getOriginalLanguageId());
    }

    public function testSetOriginalLanguageId(): void
    {
        $expected = 3058;
        $model = $this->model;
        $model->setOriginalLanguageId($expected);

        $this->assertEquals($expected, $model->getOriginalLanguageId());
    }

    public function testGetRentalDuration(): void
    {
        $this->assertEquals($this->dto->rentalDuration, $this->model->getRentalDuration());
    }

    public function testSetRentalDuration(): void
    {
        $expected = 8282;
        $model = $this->model;
        $model->setRentalDuration($expected);

        $this->assertEquals($expected, $model->getRentalDuration());
    }

    public function testGetRentalRate(): void
    {
        $this->assertEquals($this->dto->rentalRate, $this->model->getRentalRate());
    }

    public function testSetRentalRate(): void
    {
        $expected = 705.85;
        $model = $this->model;
        $model->setRentalRate($expected);

        $this->assertEquals($expected, $model->getRentalRate());
    }

    public function testGetLength(): void
    {
        $this->assertEquals($this->dto->length, $this->model->getLength());
    }

    public function testSetLength(): void
    {
        $expected = 7219;
        $model = $this->model;
        $model->setLength($expected);

        $this->assertEquals($expected, $model->getLength());
    }

    public function testGetReplacementCost(): void
    {
        $this->assertEquals($this->dto->replacementCost, $this->model->getReplacementCost());
    }

    public function testSetReplacementCost(): void
    {
        $expected = 128.55;
        $model = $this->model;
        $model->setReplacementCost($expected);

        $this->assertEquals($expected, $model->getReplacementCost());
    }

    public function testGetRating(): void
    {
        $this->assertEquals($this->dto->rating, $this->model->getRating());
    }

    public function testSetRating(): void
    {
        $expected = "Lexicographer";
        $model = $this->model;
        $model->setRating($expected);

        $this->assertEquals($expected, $model->getRating());
    }

    public function testGetSpecialFeatures(): void
    {
        $this->assertEquals($this->dto->specialFeatures, $this->model->getSpecialFeatures());
    }

    public function testSetSpecialFeatures(): void
    {
        $expected = "Call centre manager";
        $model = $this->model;
        $model->setSpecialFeatures($expected);

        $this->assertEquals($expected, $model->getSpecialFeatures());
    }

    public function testGetLastUpdate(): void
    {
        $this->assertEquals($this->dto->lastUpdate, $this->model->getLastUpdate());
    }

    public function testSetLastUpdate(): void
    {
        $expected = "2021-10-12 05:09:04";
        $model = $this->model;
        $model->setLastUpdate($expected);

        $this->assertEquals($expected, $model->getLastUpdate());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}