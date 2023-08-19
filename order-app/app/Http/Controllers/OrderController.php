<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use App\Models\Order;
use App\Models\User;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    protected $ordermodel;

    public function __construct(Order $order){
        $this->ordermodel = $order;
    }

    public function index(){
        $matchThese = ['id' => auth()->user()->id];
        $user = User::where($matchThese)->get();

        return view('dashboard.orders.userOrder' , array
        (
            'user'  =>  $user
        ));
    }

    public function add(){

            return view('dashboard.orders.add');

    }

    public function redirect_to_pending_orders(){
        return view('dashboard.orders.pendingOrders');
    }
    public function redirect_to_supervisor_orders(){
        return view('dashboard.orders.supervisorOrders');
    }

    public function editToAccepted($id){
        $matchThese = ['role' => 'supervisor'];
        $users = User::where($matchThese)->get();
        $order = Order::find($id);
        return view('dashboard.orders.editOrderToAccept', array
        (
            'order'    =>  $order,
            'users'  =>  $users
        ));
    }

    public function editToRejected($id){
        $order = Order::find($id);
        return view('dashboard.orders.editOrderToReject' , compact('order'));
    }

    public function updateToAccepted(Request $request , $id){
        $order = Order::find($id);
        $order->status = $request->input('status');
        $order->supervisor_id = $request->input('supervisor_id');
        $order->message = $request->input('message');
        $order->update();
        return redirect()->route('dashboard.orders.index');
    }
    public function updateToRejected(Request $request , $id){
        $order = Order::find($id);
        $order->status = $request->input('status');
        $order->message = $request->input('message');
        $order->update();
        return redirect()->route('dashboard.orders.index');
    }

    public function store(Request $request)
    {
        $matchThese = ['id' => auth()->user()->id];
        $user = User::where($matchThese)->get();
        $data = [
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'in:pending,accepted,rejected',
        ];
        $validatedData = $request->validate($data);
        $order= Order::create($request->all());
        $order->update(['user_id' => auth()->user()->id]);
        return view('dashboard.orders.userOrder' , array
        (
            'user'  =>  $user
        ));
    }

    public function getOrdersDatatable()
    {
        $data = Order::where('user_id' , auth()->user()->id);
        return DataTables::of($data)->addIndexColumn()
        ->make(true);
    }

    public function getSupervisorOrdersDatatable()
    {
        $data = Order::where('supervisor_id' , auth()->user()->id);
        return DataTables::of($data)->addIndexColumn()
        ->make(true);
    }

    public function getPendingOrdersDatatable()
    {
        $data = Order::where('status' , 'pending');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row){
            return $btn = '
            <a href = "' . Route('dashboard.order.editToAccepted' , $row->id) . '" class = "edit btn btn-success btn-sm" >Accept</a><a href = "' . Route('dashboard.order.editToRejected' , $row->id) . '" class = "reject btn btn-danger btn-sm" > Reject </a>';

        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
