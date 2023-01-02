<?php

namespace App\Console\Commands;

use App\Mail\ExpireAdMail;
use App\Models\Ad;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ExpireAd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ExpireAd:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow();
        $ads = Ad::whereDay('end_date', '=', $tomorrow)->with('Advertiser')->get();

        foreach($ads as $key => $ad)
        {
            $advertiser = $ad->advertiser;
            $email = $advertiser->email;

            Mail::to($email)->send(new ExpireAdMail($advertiser));
        }
    }
}
