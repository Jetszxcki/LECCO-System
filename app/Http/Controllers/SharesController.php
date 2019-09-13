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
		return view('shares.index', compact('shares'));
    }

    public function create()
    {
        $fieldsWithChoices = $this->attributesWithChoices()[0];
        $choices = $this->attributesWithChoices()[1];
    	$columns = ColumnUtil::getColNamesAndTypes('shares', ['amount'], $fieldsWithChoices);
    	$model = new Share();
    	// $members = Member::names()->get();
        
    	return view('shares.create', compact('columns', 'model', 'choices'));
    }

    public function store(Request $request)
    {
    	$data = $request->validate([
            'member_id' => 'required',
    		'total' => 'required',
    		'price' => 'required',
            'amount' => ''
    	]);
        
    	Share::create($data);
    	return redirect('shares')->with([
            'message' => 'New share successfully added.',
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
            [
                'member_id'
            ],

            [
                1,
                Member::names()->get()->pluck('full_name', 'id')
            ]
        ];
    }

	#transforms_column data for more user defined arguments
	// private function getFormData()
	// {
	// 	$columns = ColumnUtil::getColNamesAndTypes('shares');
	// 	foreach ($columns as $column_name => $column_type){
	// 		$columns[$column_name] = [
	// 			'type' => $column_type,
	// 			'choices' => null,
	// 		];
	// 	}
		
	// 	$columns['member_id']['choices'] = Member::names()->get()->pluck('full_name', 'id');
	// 	return $columns;
	// }
}
