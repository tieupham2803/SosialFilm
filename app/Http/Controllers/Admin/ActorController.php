<?php

namespace App\Http\Controllers\Admin;

use App\Actor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActorFormRequest;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class ActorController extends Controller
{
    public function index()
    {
        $actors = Actor::all();

        return view('backend.actors.index', compact('actors'));
    }

    public function create()
    {
        return view('backend.actors.create');
    }

    public function store(ActorFormRequest $request)
    {
        $data = $request->all();
        $data['name'] = $request->get('name');
        $data['birthday'] = Carbon::parse($request->birthday);
        $data['infor'] = $request->get('information');
        $data['country_id'] = $request->get('country');
        $slug = uniqid();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $slug . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/images/actors/', $name);
            $data['avarta'] = '/images/actors/' . $name;
            $imagePath = public_path() . '/images/actors/' . $name;
            Image::make($imagePath)->resize(250, 250)->save();
        } else {
            $data['avarta'] = '/images/actors/default-actor-avatar.png';
            $imagePath = public_path() . '/images/actors/default-actor-avatar.png';
            Image::make($imagePath)->resize(250, 250)->save();
        }
        Actor::create($data);

        return redirect()->route('actors.index')->with('status', __('Actor has been created'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $actor = Actor::findOrFail($id);

        return view('backend.actors.edit', compact('actor'));
    }

    public function update(ActorFormRequest $request, $id)
    {
        $actor = Actor::findOrFail($id);
        $actor->name = $request->name;
        $actor->birthday = date_create($request->birthday);
        $actor->country_id = $request->country;

        $data = $request->all();
        $slug = uniqid();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $slug . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/images/actors/', $name);
            $data['avarta'] = '/images/actors/' . $name;
            $imagePath = public_path() . '/images/actors/' . $name;
            $image = Image::make($imagePath)->resize(250, 250)->save();
            $actor->avarta = $data['avarta'];
        }
        $actor->save();

        return redirect()->route('actors.index')->with('status', __('Your review has been created'));
    }

    public function destroy($id)
    {
        $actor = Actor::findOrFail($id);
        $actor->delete();

        return back()->with('success', trans('message.success-delete'));
    }
}
