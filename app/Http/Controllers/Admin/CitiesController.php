<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Entities\Admin\Country;
use App\Http\Requests;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CityRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\CityRepository;

class CitiesController extends Controller
{
    protected $repository;

    public function __construct(CityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $cities = $this->repository->all();
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $cities,
            ]);
        }
        $countries=Country::all();
        return view('admin.cities.index', compact('cities','countries'));
    }

    // public function store(CityRequest $request)
    public function store(Request $request)
    {
        // return $request->area ;
        $key = [         "Category", "Derive", "Ilap", "Silap", "Clop", "Series", "Ilapf", "Silapf", "None", "Logical", "terminatethis",         "Replywith", "Seop", "Program", "End", "+", "-", "*", "/", "&&", "||", "~", "==", "<", ">", "!=", "<=", ">=",         "=", ".", "{", "}", "[", "]", "“", "’", "Using"];
        $value = [ "Class", "Inheritance", "Integer", "SInteger", "Character", "String", "Float", "SFloat", "Void",         "Boolean", "Break immediately from a loop", "Return", "Struct", "Stat Statement", "End Statement",         "Arithmetic Operation", "Arithmetic Operation", "Arithmetic Operation", "Arithmetic Operation",         "Logic operators", "Logic operators", "Logic operators", "relational operators", "relational operators",         "relational operators", "relational operators", "relational operators", "relational operators",         "Assignment operators", "Access operators", "Braces", "Braces", "Braces", "Braces", "Quotation mark",         "Quotation mark", "Inclusion"];
        $data = [];
        for ($i = 0; $i < 37; $i++)
        {
            $data+=[ $key[$i] => $value[$i] ];
        }
        $i = 0;     $count = 0;
        $line=[];
        while (isset($request->area[$i]) ){
        if( $request->area[$i] != "\0") {
            if($request->area[$i] != "\n" && $request->area[$i] != "\r")
                if(isset($line[$count]))
                    $line[$count]=$line[$count].$request->area[$i] ;
                else
                    $line[$count]=$request->area[$i] ;

            if($request->area[$i] == "\n")
           $count++;
                //       if ($request->area[$i] == null)
                //  return "TokenText: " . $arr[$i] . "Token Type: Identifier";
                //   else
                //    return "TokenText: " . $arr[$i] . "Token Type: " . $data[$arr[$i]];
              }
                    $i++;
        }
        $words[]=null;
        $word=null;
        $i=0;
        for ($wordCount=0; $wordCount <=$count ; $wordCount++) {
            $next = $line[$wordCount];
            while(isset($next[$i]))
            {
                if($next[$i]!=' '){
                    $word = $word.$next[$i];
                }
                else
                {
                        $words[$wordCount][]=$word ;
                        $word=null;
                }
                $i++;
            }
            $words[$wordCount][]=$word ;
            $i=0;
            $word=null;
        }
        for ($wordCount=0; $wordCount <=$count ; $wordCount++) {
            $arr=$words[$wordCount];
            $i=0;
            if($arr[0]=='//'){
                echo "<br>"."Comment";
            }
            else{
                while(isset($arr[$i]))
                {
                    if(isset($data[$arr[$i]]))
                    echo "<br>". "TokenText: " . $arr[$i] . " Token Type: " . $data[$arr[$i]];
                    else
                    echo "<br>"."TokenText: " . $arr[$i] . " Token Type: Identifier";
                    $i++;
                }
            }
        }
            return ;

        // $city = $this->repository->create($request->all());
            // return redirect()->back()->with('message', 'City created');}
    }

    public function show($id)
    {
        $city = $this->repository->findOrFail($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $city,
            ]);
        }
        return view('admin.cities.show', compact('city'));
    }

    public function edit($id)
    {
        $city = $this->repository->findOrFail($id);
        $countries=Country::all();
        return view('admin.cities.edit', compact('city','countries'));
    }

    public function update(CityRequest $request, $id)
    {
        try {
            $city = $this->repository->update($request->all(), $id);
            $response = [
                'message' => 'City updated.',
                'data'    => $city->toArray(),
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
                'message' => 'City deleted.',
                'deleted' => $deleted,
            ]);
        }
        return redirect()->back()->with('message', 'City deleted.');
    }
}
