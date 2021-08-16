<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lottery;
use App\Models\Bid;
use App\Models\Winner;
use App\Models\Number;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BidsController extends Controller
{
    
   
    public function createBid(Type $var = null)
    {
        $user = Auth::user();

        $bids =  Bid::with('lottery', 'user')->where( 'user_id', $user->id);
        $prizes = DB::select('select winners.*, bids.*, lotteries.name as ltname, users.*
                                from winners, bids, lotteries, users
                                where winners.bid_id = bids.id
                                AND bids.lottery_id = lotteries.id
                                AND bids.user_id = users.id
                                AND users.id = ?', [$user->id]);

        return view('bids.user-bids', ['bids' => $bids->paginate(8), 'prizes' => $prizes]);

    }
    
    public function bid($id)
    {
        $user = Auth::user();

        $lottery = Lottery::find($id);
        
        $date1 = Carbon::parse($lottery->deadline);
        $date2 = Carbon::now();

        $result = $date2->gte($date1);

        return view('bids.create', ['lottery' => $lottery, 'user' => $user, 'result' => $result]);
    }

    
    public function makeBid(Request $request)
    {
        $lottery = Lottery::find($request->lottery_id);
        
        $newBalance = $request->bid + $lottery->balance;
        Bid::create($request->all());

        $bids = Bid::select('bid')
                    ->where('lottery_id', $lottery->id)
                    ->orderByRaw('bid DESC')
                    ->get();

        $topBid = 0;
        $midBid = 0;
        $bottomBid = 0;
        
        if ($bids != null) {
            $top3 = collect([]);
            for ($i=0; $i < $bids->count(); $i++) { 
                $top3[$i] = $bids[$i]->bid;
            }

            if($top3->count() == 1){
                $topBid = $top3[0] * 60;
            }
            elseif($top3->count() == 2){
                $topBid = $top3[0] * 60;
                $midBid = $top3[1] * 10;
            }
            elseif($top3->count() >= 3){
                $topBid = $top3[0] * 60;
                $midBid = $top3[1] * 10;
                $bottomBid = $top3[2] * 5;
            }
        }

        $apuestaTotal = $topBid + $midBid + $bottomBid;
        $limite = $newBalance - $apuestaTotal;
        
        
        if($limite >= 0){
            $lottery->update(['balance' => $newBalance]);
            return back()->with('success','Bid made');
        }
        elseif($limite < 0){
            $bid = Bid::all();
            $eliminar = $bid->last();
            Bid::destroy($eliminar->id);

            $bids2 = Bid::select('bid')
                            ->where('lottery_id', $lottery->id)
                            ->orderByRaw('bid DESC')
                            ->get();

            $limit = 0;

            if($bids2->count() == 0){
                $limit = ($newBalance / 60) - 5;
            }
            elseif($bids2->count() == 1){
                $limit = (($newBalance - $topBid) / 10) - 5;
            }
            elseif($bids2->count() == 2){
                $limit = (($newBalance - $topBid - $midBid)  / 5) - 5;
            }
            elseif($bids2->count() >=  3){
                $bottom = $bids2[2]->bid;
                $limit = ($bottom) - 1;
            }

            return back()->with('success','Limit reached, please make a bid equal or less than $'.$limit);
        }
        
    }

}
