<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade\Pdf;

class CreateReport implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    /** @var string */
    protected $view;

    /** @var array */
    protected $data;

    /**
     * Create a new job instance.
     * 
     * @param string $view
     *
     * @return void
     */
    public function __construct(string $view, array $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pdf = Pdf::loadView($this->view, $this->data)->setPaper('a4', 'landscape')->output();

        Storage::disk('public')->put('default.pdf', $pdf);
    }
}
