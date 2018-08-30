<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clients;
use App\Http\Controllers\Controller;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestParameter;

class ClientsController extends Controller
{
    /**
     * @var ClientService
     */
    protected $clientService;

    /**
     * ClientsController constructor.
     * @param ClientService $clientService
     */
    public function __construct(
        ClientService $clientService
    ) {
        $this->clientService = $clientService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = config('constant.number.client.paginate.admin');
//        $number = (RequestParameter::get('page','1') - 1)* $limit + 1;
        $client = $this->clientService->getAllClient($limit)->first();
        return view('admin.pages.clients.index', compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $result = $this->clientService->createClient($data);
        if ($result) {
            return redirect()->route('clients.index')->with('success', 'Create new data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when save data')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clients  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Clients $client)
    {
        return view('admin.pages.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clients  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clients $client)
    {
        $data = $request->except('_token', '_method');
        $result = $this->clientService->updateClient($client->id, $data);
        if ($result) {
            return redirect()->route('clients.index')->with('success', 'Update data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when update data')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clients  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clients $client)
    {
        $result = $this->clientService->deleteClient($client->id);
        if ($result) {
            return redirect()->route('blog.index')->with('success', 'Delete data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when delete data')->withInput();
        }
    }
}
