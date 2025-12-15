<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\AdsPosition;


class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ads_gif($id)
    {
        $id = $id;
        $ads = Ads::with('ads_position')->where('ads_position',$id)->orderBy('id','DESC')->get();
        $ads_position = AdsPosition::get();
        return view('admincp.ads.ads_gif',compact('id','ads','ads_position'));
    }

    public function index()
    {
       
        $ads = Ads::with('ads_position')->orderBy('id','DESC')->take(10)->get();
        $ads_position = AdsPosition::orderBy('ads_position_name')->get();
        return view('admincp.ads.index',compact('ads','ads_position'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ads_position = AdsPosition::pluck('ads_position_name','id');
        return view('admincp.ads.form',compact('ads_position'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'ads_name' => 'required|max:100',
                'ads_link' => 'required|max:200',
                'ads_position' => 'required',
                'ads_gif' => 'required',
                'ads_status' => 'required',
            ],
            [
                'ads_name.required' => 'Tên ads phải có',
                'ads_link.required' => 'Link ads phải có',
                'ads_position.required' => 'Vị trí ads phải có',
                'ads_gif.required' => 'Hình ảnh ads phải có',
            ]
        );

        $ads = new Ads();
        $ads->ads_name = $data['ads_name'];
        $ads->ads_link = $data['ads_link'];
        $ads->ads_position = $data['ads_position'];
       
        $ads->ads_status = $data['ads_status'];
        $ads_gif = $request->file('ads_gif');

        if($ads_gif){

            $get_name_image = $ads_gif->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$ads_gif->getClientOriginalExtension();
            $ads_gif->move('uploads/ads/',$new_image);
            $ads->ads_gif = $new_image;
        }
        $ads->save();
        toastr()->success('Thành công','Thêm ads thành công.');
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
        
        $ads = Ads::find($id);
        $ads_position = AdsPosition::pluck('ads_position_name','id');
        return view('admincp.ads.form',compact('ads_position','ads'));
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
        $data = $request->validate(
            [
                'ads_name' => 'required|max:100',
                'ads_link' => 'required|max:200',
                'ads_position' => 'required',
               
                'ads_status' => 'required',
            ],
            [
                'ads_name.required' => 'Tên ads phải có',
                'ads_link.required' => 'Link ads phải có',
                'ads_position.required' => 'Vị trí ads phải có',
               
            ]
        );

        $ads = Ads::find($id);
        $ads->ads_name = $data['ads_name'];
        $ads->ads_link = $data['ads_link'];
        $ads->ads_position = $data['ads_position'];
       
        $ads->ads_status = $data['ads_status'];
        $ads_gif = $request->file('ads_gif');

        if($ads_gif){

            $get_name_image = $ads_gif->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$ads_gif->getClientOriginalExtension();
            $ads_gif->move('uploads/ads/',$new_image);
            $ads->ads_gif = $new_image;
        }
        $ads->save();
        toastr()->success('Thành công','Cập nhật ads thành công.');
        return redirect()->route('ads.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ads::find($id)->delete();
        toastr()->success('Thành công','Xóa thành công.');
        return redirect()->route('ads.index');
    }
    public function turn_onoff_ads(Request $request,$id){
        $data = $request->all();
        $ads = AdsPosition::find($id);
       
           
            $ads->ads_position_status = $data['ads_status'];
            $ads->save();
            //update ads
            $ads_ads = Ads::where('ads_position',$id)->get();
            foreach($ads_ads as $key => $ad){
                $ad->ads_status = $data['ads_status'];
                $ad->save();
            }
           
            toastr()->success('Thành công','Cập nhật thành công.');
        return redirect()->route('ads.index');

    }
}
