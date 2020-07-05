<?php

namespace App\Http\Controllers\Dashboard;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $clients = Client::when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%');
        })->latest()->paginate(5);
        return view('dashboard.clients.index', compact('clients'));
    }


    public function create()
    {
        return view('dashboard.clients.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required'
        ]);
        Client::create($request->all());
        flash()->success(trans('admin.addedsuccessfully'));
        return redirect(url(route('clients.index')));
    }


    public function show(Client $client)
    {
        //
    }


    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));

    }


    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required'
        ]);
        $client->update($request->all());
        flash()->success(trans('admin.updatedsuccessfully'));
        return redirect(url(route('clients.index')));
    }


    public function destroy(Client $client)
    {
        $client->delete();
        flash()->success(trans('admin.deletedsuccessfully'));
        return redirect(url(route('clients.index')));
    }
}
