<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestParameter;

class ServicesController extends Controller
{
    /**
     * @var ServiceService
     */
    protected $serviceService;

    /**
     * ServicesController constructor.
     * @param ServiceService $serviceService
     */
    public function __construct(
        ServiceService $serviceService
    ) {
        $this->serviceService = $serviceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = config('constant.number.service.paginate.admin');
        $number = (RequestParameter::get('page','1') - 1)* $limit + 1;
        $services = $this->serviceService->getAllService();
        return view('admin.pages.services.index', compact('services', 'number'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.services.create');
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
        $result = $this->serviceService->createService($data);
        if ($result) {
            return redirect()->route('services.index')->with('success', 'Create new data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when save data')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Services  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Services $service)
    {
        return view('admin.pages.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Services  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Services $service)
    {
        $data = $request->except('_token', '_method');
        $result = $this->serviceService->updateService($service->id, $data);
        if ($result) {
            return redirect()->route('services.index')->with('success', 'Update data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when update data')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Services  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Services $service)
    {
        $result = $this->serviceService->deleteService($service->id);
        if ($result) {
            return redirect()->route('blog.index')->with('success', 'Delete data successfully!');
        } else {
            return redirect()->back()->with('error', 'Having error when delete data')->withInput();
        }
    }
}
