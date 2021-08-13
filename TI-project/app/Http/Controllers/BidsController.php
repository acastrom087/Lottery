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
        $bidTop3=[0,0,0];
        
        Bid::create($request->all());
        $bids2 = DB::table('bids')
            ->select(DB::raw('SUM(bid) as bid_total, number as num'))
            ->where('lottery_id', $request->lottery_id)
            ->groupBy('number')
            ->orderBy('bid_total','desc')
            ->get();
            
            
            for ($i=0; $i <count($bids2) ; $i++) { 
                $bidTop3[$i]= $bids2[$i]->bid_total;
                if($i==3){
                    break;
                }
            }
        $apuestaTotal = $bidTop3[0]*60+ $bidTop3[1]*10+ $bidTop3[2]*5;
        $limite = $lottery->balance - $apuestaTotal;

        if($limite >=0){
            $newBalance = $request->bid + $lottery->balance;
            $lottery->update(['balance' => $newBalance]);
            //Bid::create($request->all());
            return back()->with('success','Bid Creado');
        }
        elseif($limite <0){
            $bid = Bid::all();
            $eliminar = $bid->last();
            Bid::destroy($eliminar->id);
            //return back() ->with('alert', 'Updated!');
            //return (['message' => $maximo]);
            return back()->with('success','Bid has reached the limit available');
        }
        
    }

    
  
}
