<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coa;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		return view('coa.list_org')->with('coas', Coa:: get());;

	}

    public function download1($coa_name)
    {
        return Storage::disk('s3')->download( $coa_name);
    }
    public function download_regular($id)
    {
        $coa = Coa::find($id);
        return Storage::disk('s3')->download( $coa->coa_name);
    }

}
