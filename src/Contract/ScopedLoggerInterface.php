<?php

declare(strict_types=1);

namespace AZakhozhiy\ScopedLogger\Contract;

use Psr\Log\LoggerInterface;

interface ScopedLoggerInterface
{
    public function setLogger(LoggerInterface $logger): static;

    public function getLogger(): LoggerInterface;

    public function appendScope(string $scope): static;

    public function removeScope(string $scope): static;

    public function clearScope(): static;

    public function setMessageDelimiter(string $value): static;
}
