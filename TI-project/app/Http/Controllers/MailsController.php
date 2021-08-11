<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailsController extends Controller
{
    public function sendEmail(){
        $prizes = DB::select('select winners.*, bids.*, lotteries.name as ltname, users.*
        from winners, bids, lotteries, users
        where winners.bid_id = bids.id
        AND bids.lottery_id = lotteries.id
        AND bids.user_id = users.id');

        foreach($prizes as $prize){
            if($prize != null){
                $details =[
                    'tittle' => 'Winner Notification',
                    'greeting' => 'Hello '.$prize->name,
                    'body' => 'We are happy to announce that you have been awarded with $'.$prize->profit.' for your bid on the '.$prize->ltname.'
                    with the number '.$prize->number
                ];
    
                Mail::to($prize->email)->send(new SendMail($details));
            }
        }
        
        return view('emails.confirmation', ['prizes'=> $prizes]);
    }
}
