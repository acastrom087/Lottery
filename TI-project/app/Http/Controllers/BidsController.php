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
        //Bid::create($request->all());

        $bids = Bid::select('bid')
                    ->where('lottery_id', $request->lottery_id)
                    ->orderByRaw('bid DESC')
                    ->get();

        $topBid = 0;
        $midBid = 0;
        $bottomBid = 0;
        
        if ($bids != null) {
            if(!$bids[0] == null){
                $topBid = $bids[0]->bid * 60;
            }
            if(!$bids[1] == null){
                $topBid = $bids[0]->bid * 60;
                $midBid = $bids[1]->bid * 10;
            }
            if(!$bids[2] == null){
                $topBid = $bids[0]->bid * 60;
                $midBid = $bids[1]->bid * 10;
                $bottomBid = $bids[2]->bid * 5;
            }
        }

        $apuestaTotal = $topBid + $midBid + $bottomBid;
        $limite = $newBalance - $apuestaTotal;
        
        return $apuestaTotal; 
        
        /*if($limite >= 0){
            $lottery->update(['balance' => $newBalance]);
            return back()->with('success','Bid Creado');
        }
        elseif($limite < 0){
            $bid = Bid::all();
            $eliminar = $bid->last();
            Bid::destroy($eliminar->id);

            if($bids->count() < 1){
                $limit = (($limite / 60) * 0.0165) + $limite / 60;
            }
            elseif($bids->count() == 1){
                $limit = ((($limTopBid + $limite) / 10) * 0.055) + (($limTopBid + $limite) / 10);
            }
            elseif($bids->count() == 2){
                $limit = ((($limTopBid + $limMidBid + $limite) / 5) * 0.115) + (($limTopBid + $limMidBid + $limite) / 5);
            }
            elseif($bids->count() > 3){
                $limit = ($bottomBid / 5) - 1;
            }

            return back()->with('success','Bid has reached the limit available, please make a bid less than $'.$limit);
        }*/
        

        

        
        
    }

    
  
}
