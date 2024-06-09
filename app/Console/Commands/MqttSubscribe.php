<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\DataController;

class MqttSubscribe extends Command
{
    protected $signature = 'mqtt:subscribe';
    protected $description = 'Subscribe to MQTT topics and save data to database';

    protected $dataController;

    public function __construct(DataController $dataController)
    {
        parent::__construct();
        $this->dataController = $dataController;
    }

    public function handle()
    {
        $this->dataController->subscribeToMqtt();
    }
}
