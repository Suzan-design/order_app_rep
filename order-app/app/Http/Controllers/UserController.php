<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\Datatables;

class UserController extends Controller
{
    protected $usermodel;

    public function __construct(User $user){
        $this->usermodel = $user;
    }

    public function index(){
        if (auth()->user()->can('viewAny' ,auth()->user())) {
            return view('dashboard.users.index');
        }

    }
    public function add(){
        if (auth()->user()->can('viewAny' , auth()->user())) {
            return view('dashboard.users.add');
        }

    }

    public function store(Request $request)
    {
        $data = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'role' => 'nullable|in:admin,supervisor,client',
        ];
        $validatedData = $request->validate($data);
        User::create($request->all());
        $user = User::first();
        $user->role = 'admin';
        $user->save();

        return view('dashboard.users.index');
    }

    public function getUsersDatatable()
    {
        $data = User::select('*');
        return DataTables::of($data)->addIndexColumn()
        ->make(true);
    }
}
