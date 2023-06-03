<?php

namespace App\Jobs;

use App\Services\BalanceService;
use App\Services\HatService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BuyHat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $product_id,
        public string $user_id,
        public int $count = 1
    ) {

    }

    /**
     * Execute the job.
     */
    public function handle(HatService $service): void
    {
        $service->_buyHat(
            $this->user_id,
            $this->product_id,
            $this->count
        );
    }
}