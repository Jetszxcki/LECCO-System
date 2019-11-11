<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Member;
use App\Share;
use App\ColumnUtil;

class SharesController extends Controller
{
    public function index()
    {
        $shares = Share::all();
        $members = Member::orderBy('first_name', 'asc')->get()
                    ->reject(function ($member) {
                        return sizeof($member->shares) === 0;
                    });
        
		return view('shares.index', compact('shares', 'members'));
    }

    public function create()
    {
        $attrWithChoices = $this->attributesWithChoices();
    	$columns = ColumnUtil::getColNamesAndTypes('shares', $attrWithChoices);
    	$model = new Share();
        
    	return view('shares.create', compact('columns', 'model'));
    }

    public function store(Request $request)
    {
    	$data = $request->validate([
            'member_id' => 'required',
    		'total' => 'required',
    		'price' => 'required',
            'amount' => ''
    	]);
        
    	$new_share = Share::create($data);

    	return redirect('shares')->with([
            'message' => "A new share has been added to {$new_share->member->full_name}.",
            'styles' => 'alert-success'
        ]);
    }

    public function show(Member $member)
    {
        // for sqlite testing only
        // $shares = Share::selectRaw("strftime('%m', shares.created_at) as month,
        //                             strftime('%Y', shares.created_at) as year,
        //                             sum(total) as total_no_shares, 
        //                             sum(price) as total_price, 
        //                             sum(amount) as total_amount")
        //         ->where('shares.member_id', $member->id)
        //         ->orderBy('Month', 'asc', 'Year', 'asc')
        //         ->groupBy(DB::raw("strftime('%m', shares.created_at)"), DB::raw("strftime('%Y', shares.created_at)"))
        //         ->get();

        $shares = Share::selectRaw('MONTH(shares.created_at) as month, 
                                    YEAR(shares.created_at) as year, 
                                    sum(total) as total_no_shares, 
                                    sum(price) as total_price, 
                                    sum(amount) as total_amount')
                ->where('shares.member_id', $member->id)
                ->orderBy('Month', 'asc', 'Year', 'asc')
                ->groupBy(DB::raw("MONTH(shares.created_at)"), DB::raw("YEAR(shares.created_at)"))
                ->get();

        $total_ns = $shares->sum('total_no_shares');
        $total_p = $shares->sum('total_price');
        $total_a = $shares->sum('total_amount');
        $totals = array($total_ns, $total_p, $total_a);

        return view('shares.show', compact('shares', 'totals', 'member'));
    }
	
    private function attributesWithChoices()
    {
        return [
            'member_id' => Member::names()->get()->pluck('full_name', 'id')
        ];
    }
}
