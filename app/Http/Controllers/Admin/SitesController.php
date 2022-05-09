<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Http\Requests\SiteRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\SiteRepository;
use Prettus\Validator\Exceptions\ValidatorException;
class SitesController extends Controller{
    protected $repository;

    public function __construct(SiteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $site = $this->repository->first();
        return view('sites.index', compact('site'));
    }

    public function store(SiteRequest $request)
    {
        $site = $this->repository->first();
        if($site)
        $site = $this->repository->update($request->all(), $site->id);
        else
        $site = $this->repository->create($request->all());

        if($request->hasFile('logo')){
            $secvice=new MediaService();
            $site->logo=$secvice->fileUpload('site',$request->logo);
            $site->save();
        }

        return redirect()->back()->with('message', "Site Updated");
    }
}
