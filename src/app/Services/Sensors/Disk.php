<?php

namespace LaravelEnso\ControlPanelApi\App\Services\Sensors;

use LaravelEnso\Helpers\App\Classes\DiskSize;

class Disk extends Sensor
{
    public function value()
    {
        return DiskSize::forHumans(disk_free_space('/'));
    }

    public function tooltip(): string
    {
        $total = DiskSize::forHumans(disk_total_space('/'));

        return "available free space from a total of {$total}";
    }

    public function icon(): array
    {
        return ['fad', 'hdd'];
    }

    public function order(): int
    {
        return 300;
    }
}
