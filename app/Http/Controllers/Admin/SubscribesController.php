<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SubscribeRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\SubscribeRepository;

class SubscribesController extends Controller
{
    protected $repository;

    public function __construct(SubscribeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $Subscribes = $this->repository->paginate(10);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $Subscribes,
            ]);
        }

        return view('Subscribes.index', compact('Subscribes'));
    }

    public function store(SubscribeRequest $request)
    {
        try {
            $Subscribe = $this->repository->firstOrCreate($request->only('email'));
            $response = [
                'message' => 'Subscribe created.',
                'data'    => $Subscribe->toArray(),
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
        $Subscribe = $this->repository->findOrFail($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $Subscribe,
            ]);
        }
        return view('Subscribes.show', compact('Subscribe'));
    }

    public function edit($id)
    {
        $Subscribe = $this->repository->findOrFail($id);
        return view('Subscribes.edit', compact('Subscribe'));
    }

    public function update(SubscribeRequest $request, $id)
    {
        try {
            $Subscribe = $this->repository->update($request->all(), $id);
            $response = [
                'message' => 'Subscribe updated.',
                'data'    => $Subscribe->toArray(),
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
                'message' => 'Subscribe deleted.',
                'deleted' => $deleted,
            ]);
        }
        return redirect()->back()->with('message', 'Subscribe deleted.');
    }
}
