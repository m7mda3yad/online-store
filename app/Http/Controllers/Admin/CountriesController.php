<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CountryRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\CountryRepository;

class CountriesController extends Controller
{
    protected $repository;

    public function __construct(CountryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $countries = $this->repository->paginate(10);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $countries,
            ]);
        }

        return view('admin.countries.index', compact('countries'));
    }

    public function store(CountryRequest $request)
    {
        try {
            $country = $this->repository->create($request->all());
            $response = [
                'message' => 'Country created.',
                'data'    => $country->toArray(),
            ];
            if ($request->wantsJson()) {
                return response()->json($response);
            }
            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function show($id)
    {
        $country = $this->repository->findOrFail($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $country,
            ]);
        }
        return view('admin.countries.show', compact('country'));
    }

    public function edit($id)
    {
        $country = $this->repository->findOrFail($id);
        return view('admin.countries.edit', compact('country'));
    }

    public function update(CountryRequest $request, $id)
    {
        try {
            $country = $this->repository->update($request->all(), $id);
            $response = [
                'message' => 'Country updated.',
                'data'    => $country->toArray(),
            ];
            if ($request->wantsJson()) {
                return response()->json($response);
            }
            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Country deleted.',
                'deleted' => $deleted,
            ]);
        }
        return redirect()->back()->with('message', 'Country deleted.');
    }
}
