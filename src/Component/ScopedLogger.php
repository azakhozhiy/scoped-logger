<?php

namespace AZakhozhiy\ScopedLogger\Component;

use AZakhozhiy\ScopedLogger\Contract\ScopedLoggerInterface;
use Psr\Log\LoggerInterface;

class ScopedLogger implements ScopedLoggerInterface, LoggerInterface
{
    protected array $scopes = [];
    protected string $cachedPrefix = '';
    protected string $messageDelimiter = ':';
    protected LoggerInterface $logger;

    public function setMessageDelimiter(string $value): static
    {
        $this->messageDelimiter = $value;

        return $this;
    }

    public function setLogger(LoggerInterface $logger): static
    {
        $this->logger = $logger;

        return $this;
    }

    public function getLogger(): LoggerInterface
    {
        return $this;
    }

    public function appendScope(string $scope): static
    {
        $this->scopes[] = $scope;
        $this->cachedPrefix = '';

        return $this;
    }

    public function removeScope(string $scope): static
    {
        foreach($this->scopes as $index => $value) {
            if($value === $scope) {
                unset($this->scopes[$index]);
                $this->cachedPrefix = '';
                break;
            }
        }

        return $this;
    }

    public function clearScope(): static{
        $this->scopes = [];
        $this->cachedPrefix = '';

        return $this;
    }

    public function getCombinedScope(): string{
        return implode(' ', $this->scopes);
    }

    public function getPrefix(): string{
        if(!empty($this->cachedPrefix)){
            return $this->cachedPrefix;
        }

        return $this->cachedPrefix = $this->getCombinedScope() . $this->messageDelimiter;
    }

    public function emergency($message, array $context = []): void
    {
        $this->logger->emergency($this->getPrefix().' '.$message, $context);
    }

    public function alert($message, array $context = []): void
    {
        $this->logger->alert($this->getPrefix().' '.$message, $context);
    }

    public function critical($message, array $context = []): void
    {
        $this->logger->critical($this->getPrefix().' '.$message, $context);
    }

    public function error($message, array $context = []): void
    {
        $this->logger->error($this->getPrefix().' '.$message, $context);
    }

    public function warning($message, array $context = []): void
    {
        $this->logger->warning($this->getPrefix().' '.$message, $context);
    }

    public function notice($message, array $context = []): void
    {
        $this->logger->notice($this->getPrefix().' '.$message, $context);
    }

    public function info($message, array $context = []): void
    {
        $this->logger->info($this->getPrefix().' '.$message, $context);
    }

    public function debug($message, array $context = []): void
    {
        $this->logger->debug($this->getPrefix().' '.$message, $context);
    }

    public function log($level, $message, array $context = []): void
    {
        $this->logger->log($level, $this->getPrefix().' '.$message, $context);
    }
}