<?php

namespace App\Console\Commands;

use App\Service\SlotService;
use Illuminate\Console\Command;

class RunSlot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slot:run';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the slot time machine command';

    protected $slotService;

    /**
     * Create a new command instance.
     * @param SlotService $slotService
     */
    public function __construct(SlotService $slotService)
    {
        parent::__construct();
        $this->slotService = $slotService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        return $this->info($this->slotService->checkForSimilarities());
    }
}
