<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lottery;
use App\Models\Bid;
use App\Models\Winner;
use App\Models\WinningNumber;
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
        $bids = DB::table('bids')
            ->select(DB::raw('SUM(bid) as bid_total, number as num'))
            ->where('lottery_id', $request->lottery_id)
            ->groupBy('number')
            ->orderBy('bid_total','desc')
            ->get();

        $numero1;
        $numero2;
        $numero3;
        $apuestaTotal;
        if(count($bids)==0){
            $numero1 =0;
            $numero2 =0;
            $numero3 =0;
            $apuestaTotal=$request->bid*60;
        }
        elseif(count($bids)==1){
            $numero1 = $bids[0];
            $numero2 =0;
            $numero3 =0;
            $apuestaTotal= $numero1->bid_total*60+
            + $request->bid*60;

        }elseif(count($bids)==2){
            $numero1 = $bids[0];
            $numero2 = $bids[1];
            $numero3 =0;
            $apuestaTotal= $numero1->bid_total*60+
            $numero2->bid_total*10 + $request->bid*60;

        }elseif(count($bids)>=3){
            $numero1 = $bids[0];
            $numero2 = $bids[1];
            $numero3 = $bids[2];
            $apuestaTotal= $numero1->bid_total*60+
            $numero2->bid_total*10+
            $numero3->bid_total*5 + $request->bid*60;
        }

        $limite = $lottery->balance - $apuestaTotal;
        

        if($limite >=0){
            $newBalance = $request->bid + $lottery->balance;
            $lottery->update(['balance' => $newBalance]);
            Bid::create($request->all());
            return back()->with('success','Bid made successfully!');
        }
        elseif($limite <0){
            $maximo = ($request->bid*60 - $limite)/60;
            //return back() ->with('alert', 'Updated!');
            //return (['message' => $maximo]);
            return back()->with('success','Bid has reached the limit available');
        }
    }
}
