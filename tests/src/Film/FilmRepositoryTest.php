<?php

declare(strict_types=1);

namespace Sakila\Tests\Film;

use PHPUnit\Framework\TestCase;
use Sakila\Database\DatabaseException;
use Sakila\Film\{ FilmDto, IFilmRepository, FilmRepository };

class FilmRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private FilmDto $dto;
    private IFilmRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Sakila\Database\IDatabase");
        $this->result = $this->createMock("Sakila\Database\IDatabaseResult");
        $this->input = [
            "film_id" => 492,
            "title" => "seem",
            "description" => "Mouth the what service month all financial. History wide skill save daughter movement fly they. Question age say course. One ready consumer window adult.",
            "release_year" => "Final international sea anything fly generation agree various.",
            "language_id" => 865,
            "original_language_id" => 9815,
            "rental_duration" => 7638,
            "rental_rate" => 764.67,
            "length" => 1836,
            "replacement_cost" => 764.00,
            "rating" => "Logistics and distribution manager",
            "special_features" => "Armed forces training and education officer",
            "last_update" => "2021-09-29 09:39:25",
        ];
        $this->dto = new FilmDto($this->input);
        $this->repository = new FilmRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 874;

        $sql = "INSERT INTO `film` (`title`, `description`, `release_year`, `language_id`, `original_language_id`, `rental_duration`, `rental_rate`, `length`, `replacement_cost`, `rating`, `special_features`, `last_update`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->title,
                $this->dto->description,
                $this->dto->releaseYear,
                $this->dto->languageId,
                $this->dto->originalLanguageId,
                $this->dto->rentalDuration,
                $this->dto->rentalRate,
                $this->dto->length,
                $this->dto->replacementCost,
                $this->dto->rating,
                $this->dto->specialFeatures,
                $this->dto->lastUpdate
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 2092;

        $sql = "UPDATE `film` SET `title` = ?, `description` = ?, `release_year` = ?, `language_id` = ?, `original_language_id` = ?, `rental_duration` = ?, `rental_rate` = ?, `length` = ?, `replacement_cost` = ?, `rating` = ?, `special_features` = ?, `last_update` = ?
                WHERE `film_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->title,
                $this->dto->description,
                $this->dto->releaseYear,
                $this->dto->languageId,
                $this->dto->originalLanguageId,
                $this->dto->rentalDuration,
                $this->dto->rentalRate,
                $this->dto->length,
                $this->dto->replacementCost,
                $this->dto->rating,
                $this->dto->specialFeatures,
                $this->dto->lastUpdate,
                $this->dto->filmId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $filmId = 2040;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($filmId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $filmId = 3468;

        $sql = "SELECT `film_id`, `title`, `description`, `release_year`, `language_id`, `original_language_id`, `rental_duration`, `rental_rate`, `length`, `replacement_cost`, `rating`, `special_features`, `last_update`
                FROM `film` WHERE `film_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$filmId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($filmId);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `film_id`, `title`, `description`, `release_year`, `language_id`, `original_language_id`, `rental_duration`, `rental_rate`, `length`, `replacement_cost`, `rating`, `special_features`, `last_update`
                FROM `film`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $filmId = 4548;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($filmId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $filmId = 7401;
        $expected = 8926;

        $sql = "DELETE FROM `film` WHERE `film_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$filmId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($filmId);
        $this->assertEquals($expected, $actual);
    }
}