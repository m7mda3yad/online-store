<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\ContactRepository;

class ContactsController extends Controller
{
    protected $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $contacts = $this->repository->paginate(10);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $contacts,
            ]);
        }

        return view('contacts.index', compact('contacts'));
    }

    public function store(ContactRequest $request)
    {
        try {
            $contact = $this->repository->create($request->all());
            $response = [
                'message' => 'Contact created.',
                'data'    => $contact->toArray(),
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
        $contact = $this->repository->findOrFail($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $contact,
            ]);
        }
        return view('contacts.show', compact('contact'));
    }

    public function edit($id)
    {
        $contact = $this->repository->findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    public function update(ContactRequest $request, $id)
    {
        try {
            $contact = $this->repository->update($request->all(), $id);
            $response = [
                'message' => 'Contact updated.',
                'data'    => $contact->toArray(),
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
                'message' => 'Contact deleted.',
                'deleted' => $deleted,
            ]);
        }
        return redirect()->back()->with('message', 'Contact deleted.');
    }
}
