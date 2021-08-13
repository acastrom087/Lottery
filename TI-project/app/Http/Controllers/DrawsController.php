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

class DrawsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user->can('AccessDraws')) {
            return view('errors.403', ['message' => 'User is not Authorized to access this page']);
        }

        $draws = Lottery::all();
        return view ('draws.index', ['lotteries' => $draws->sortBy('id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user->can('CreateDraws')) {
            return view('errors.403', ['message' => 'User is not Authorized to access this page']);
        }

        return view ('draws.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Lottery::create($request->all());
        return redirect('/manage-draws');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        if (!$user->can('AccessDraws')) {
            return view('errors.403', ['message' => 'User is not Authorized to access this page']);
        }

        $lottery = Lottery::find($id);
        $bids = Bid::with('user')->where('lottery_id', $id);
        $prizes = DB::select('select winners.*, numbers.*, bids.*, users.*
                                from winners, numbers, bids, users
                                where winners.bid_id = bids.id
                                AND numbers.lottery_id = ?
                                AND bids.user_id = users.id', [$id]);

        $bids1 = DB::table('bids')
            ->select(DB::raw('SUM(bid) as bid_total, number as num'))
            ->where('lottery_id', $id)
            ->groupBy('number')
            ->orderBy('bid_total','desc')
            ->get();

            $bids2 = DB::table('bids')
            ->select(DB::raw('SUM(bid) as bid_total, number as num'))
            ->where('lottery_id', $id)
            ->groupBy('number')
            ->orderBy('bid_total')
            ->paginate(8);
        
        $numero1;
        $numero2;
        $numero3;
        $gananciaMinima;
        $peorCaso;
        if(count($bids1)==0){
            $numero1 =0;
            $numero2 =0;
            $numero3 =0;
            $gananciaMinima = $lottery->balance;
            $peorCaso = 0;
        }
        elseif(count($bids1)==1){
            $numero1 = $bids1[0];
            $numero2 =0;
            $numero3 =0;
            $gananciaMinima = $lottery->balance-($numero1->bid_total*60);
            $peorCaso = $numero1->bid_total*60;

        }elseif(count($bids1)==2){
            $numero1 = $bids1[0];
            $numero2 = $bids1[1];
            $numero3 =0;
            $gananciaMinima = $lottery->balance-($numero1->bid_total*60+
            $numero2->bid_total*10);
            $peorCaso = $numero1->bid_total*60+
            $numero2->bid_total*10;
            

        }elseif(count($bids1)>=3){
            $numero1 = $bids1[0];
            $numero2 = $bids1[1];
            $numero3 = $bids1[2];
            $gananciaMinima = $lottery->balance-($numero1->bid_total*60+
            $numero2->bid_total*10+
            $numero3->bid_total*5);
            $peorCaso = $numero1->bid_total*60+
            $numero2->bid_total*10 +$numero3->bid_total*5;
            
        }

        $numero4;
        $numero5;
        $numero6;
        $gananciaMaxima;
        
        if(count($bids2)<=97){
            $numero4 =0;
            $numero5 =0;
            $numero6 =0;
            $gananciaMaxima = $lottery->balance;
        }
        elseif(count($bids2)==98){
            $numero4 =$bids2[0];
            $numero5 =0;
            $numero6 =0;
            $gananciaMaxima = $lottery->balance-($numero4->bid_total*60);
            

        }elseif(count($bids2)==99){
            $numero4 =$bids2[0];
            $numero5 =$bids2[1];
            $numero6 =0;
            $gananciaMaxima = $lottery->balance-($numero4->bid_total*60+
            $numero5->bid_total*10);
            
            

        }elseif(count($bids2)==100){
            $numero4 = $bids2[0];
            $numero5 = $bids2[1];
            $numero6 = $bids2[2];
            $gananciaMaxima = $lottery->balance-($numero4->bid_total*60+
            $numero5->bid_total*10+
            $numero6->bid_total*5);
            
        }
         
        return view('draws.view-draw', ['lottery' => $lottery, 'bids' => $bids->paginate(8), 'prizes' => $prizes, 'bids1'=>$bids1,
                    'gananciaMaxima'=>$gananciaMaxima, 'gananciaMinima'=>$gananciaMinima, 'peorCaso'=>$peorCaso ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        if (!$user->can('UpdateDraws')) {
            return view('errors.403', ['message' => 'User is not Authorized to access this page']);
        }

        $lottery = Lottery::find($id);
        $start = date('Y-m-d\TH:i', strtotime($lottery->start));
        $deadline = date('Y-m-d\TH:i', strtotime($lottery->deadline));
        return view('draws.edit', [
            'lottery' => $lottery, 
            'start' => $start,
            'deadline' => $deadline]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lottery = Lottery::find($id);
        $lottery->update($request->all());
        return redirect('/manage-draws');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lottery = Lottery::find($id);
        $lottery::destroy($id);
        return redirect('/manage-draws');
    }

    public function draws()
    {
        $draws = DB::table('lotteries')
                        ->where('is_active', true)
                        ->where('deadline', '>=', date('Y-m-d H:i:s'));

        return view ('draws.showDraw', ['draws' => $draws->get()
        ]);
    }

    public function generateNumber($id)
    {
        $lottery = Lottery::find($id);

        return view('draws.win-number', ['lottery' => $lottery]);
    }

    public function saveWinner(Request $request)
    {
        Number::create($request->all());

        $bids = Bid::where('lottery_id', $request->lottery_id)->get();
        $lottery = Lottery::find($request->lottery_id);

        foreach($bids as $bid){
            $profit = 0;

            if($bid->number == $request->st_number){
                $profit = $bid->bid*60;
            }
            elseif($bid->number == $request->nd_number){
                $profit = $bid->bid*10;
            }
            elseif($bid->number == $request->rd_number){
                $profit = $bid->bid*5;
            }

            if($profit > 0){
                Winner::create(['bid_id' => $bid->id, 'profit' => $profit]);

                $newBalance = $lottery->balance - $profit;
                $lottery->update(['is_active' => false, 'balance' => $newBalance]);
            }
        }
        return back()->with('success','Congratulations to the winners');
    }
}
