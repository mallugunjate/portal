<?php

namespace App\Http\Controllers\Communication;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommunicationImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info($request->all());
        $file = $request->file('upload');
        $banner_id = $request->banner_id;
        $directory = public_path() . '/images/communication-images';
        $extension = $file->getClientOriginalExtension();
        $originalName = $file->getClientOriginalName();
        $modifiedName = str_replace(" ", "_", $originalName);
        $modifiedName = str_replace(".", "_", $modifiedName);
        // $modifiedName = "Banner" . $banner_id . "~" .  $modifiedName;
        $uniqueHash = sha1(time() . time());
        $filename  = $modifiedName . "_" . $uniqueHash . "." . $extension;
        $upload_success = $file->move($directory, $filename); //move and rename file

        if($upload_success) {
            
            $imagesrc = $filename;
            $imagefile = public_path() . '/js/custom/ckeditor-imagebrowser/images_list.json';
            $imagefileContent = json_decode(file_get_contents($imagefile));
            
            array_push($imagefileContent , ['image' => '/images/communication-images/' . $filename ]);
            file_put_contents($imagefile, json_encode($imagefileContent));

            $response = [
                            "uploaded" => 1,
                            "fileName" => $filename,
                            "url"=> "/images/communication-images/".$filename,
                        ];

            return json_encode($response);
        }

        $response =  [
                        "uploaded"=> 0,
                        "error" => [ "message"=> "File is too big."]
                        
                    ];
        return json_encode($response);
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
        //
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
        //
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
