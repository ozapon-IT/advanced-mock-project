<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Announce;

class UpdateSentAtJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $announce;

    /**
     * Create a new job instance.
     */
    public function __construct(Announce $announce)
    {
        $this->announce = $announce;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->announce->update([
            'sent_at' => now(),
        ]);
    }
}
