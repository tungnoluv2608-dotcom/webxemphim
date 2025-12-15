<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdsNetWork;
use App\Models\AdsNetWorkScript;

class AdsNetWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_adsnetwork_script($id){
        $ads_script = AdsNetWorkScript::find($id);
        $ads = AdsNetwork::orderBy('id','DESC')->get();
        return view('admincp.adsnetwork.edit_script',compact('ads','ads_script'));
    }
    public function put_script_adsnetwork(Request $request,$id){
        $data = $request->all();

        $ads = AdsNetworkScript::find($id);
        $ads->script = $data['script'];
        $ads->status = $data['status'];
        $ads->adsnetwork_id = $data['adsnetwork_id'];
        $ads->title = $data['title'];

        $ads->save();
        toastr()->success('Thành công','Cập nhật script thành công.');
        return redirect()->route('add-ads-script');
    }
    public function store_script_adsnetwork(Request $request){
        $data = $request->all();

        $ads = new AdsNetworkScript();
        $ads->script = $data['script'];
        $ads->status = $data['status'];
        $ads->adsnetwork_id = $data['adsnetwork_id'];
        $ads->title = $data['title'];

        $ads->save();
        toastr()->success('Thành công','Thêm script thành công.');
        return redirect()->back();
    }
    public function add_ads_script(){
        $ads_script = AdsNetWorkScript::with('adsnetwork')->orderBy('id','DESC')->get();
        $ads = AdsNetwork::orderBy('id','DESC')->get();
        return view('admincp.adsnetwork.ads_script',compact('ads','ads_script'));
    }
    public function index()
    {
        
        return view('admincp.adsnetwork.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ads = AdsNetwork::orderBy('id','DESC')->get();
        return view('admincp.adsnetwork.create',compact('ads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $ads = new AdsNetwork();
        $ads->link_confirmed = $data['link_confirmed'];
        $ads->status = $data['status'];
        $ads->title = $data['title'];

        $ads->save();
        toastr()->success('Thành công','Thêm ads network thành công.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ads = AdsNetwork::find($id);
        return view('admincp.adsnetwork.edit',compact('ads'));
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
        $data = $request->all();

        $ads = AdsNetwork::find($id);
        $ads->link_confirmed = $data['link_confirmed'];
        $ads->status = $data['status'];
        $ads->title = $data['title'];

        $ads->save();
        toastr()->success('Thành công','Cập nhật ads network thành công.');
        return redirect()->route('adsnetwork.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
