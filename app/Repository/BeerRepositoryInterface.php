<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Beer;

interface BeerRepositoryInterface
{
    public function get(int $beerId);
    public function all();
    public function allPaginated(int $limit);
    public function best();
    public function stats();
    public function scoreStatS();
    public function approvedFilterBy(?string $phrase, string $style, int $size);
    public function unapprovedPaginated(int $limit);
    public function approve(int $beerId);
    public function getWithAvgScore(int $beerId);



}
