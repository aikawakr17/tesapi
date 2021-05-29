<?php


namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\Masjid;
use App\Http\Resources\Masjid as MasjidResource;

class MasjidController extends BaseController
{

    public function index()
    {
        $masjids = Masjid::all();
        return $this->sendResponse(MasjidResource::collection($masjids), 'Posts fetched.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $masjid = Masjid::create($input);
        return $this->sendResponse(new MasjidResource($masjid), 'Post created.');
    }


    public function show($id)
    {
        $masjid = Masjid::find($id);
        if (is_null($masjid)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse(new MasjidResource($masjid), 'Post fetched.');
    }


    public function update(Request $request, Masjid $masjid)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $masjid->title = $input['title'];
        $masjid->description = $input['description'];
        $masjid->save();

        return $this->sendResponse(new MasjidResource($masjid), 'Post updated.');
    }

    public function destroy(Masjid $masjid)
    {
        $masjid->delete();
        return $this->sendResponse([], 'Post deleted.');
    }
}
