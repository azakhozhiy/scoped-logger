<?php

namespace AZakhozhiy\ScopedLogger\Trait;

use AZakhozhiy\ScopedLogger\Contract\ScopedLoggerInterface;

trait HasScopedLogger
{
    protected ScopedLoggerInterface $scopedLogger;

    public function setScopedLogger(ScopedLoggerInterface $scopedLogger): static{
        $this->scopedLogger = $scopedLogger;

        return $this;
    }

    public function getScopedLogger(): ScopedLoggerInterface{
        return $this->scopedLogger;
    }
}