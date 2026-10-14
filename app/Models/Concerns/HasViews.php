<?php

namespace App\Models\Concerns;

trait HasViews
{
    public function recordView(): void
    {
        $this->increment('views');
    }
}
