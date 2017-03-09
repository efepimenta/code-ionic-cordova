<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminCupomRequest;
use CodeDelivery\Repositories\CupomRepository;

class CupomsController extends Controller
{

    /**
     * @var CupomRepository
     */
    private $repository;

    public function __construct(CupomRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $cupoms = $this->repository->paginate(5);
        return view('admin.cupoms.index', compact('cupoms'));
    }

    public function create()
    {
        return view('admin.cupoms.create');
    }

    public function store(AdminCupomRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('admin.cupoms.index');
    }

    public function edit($id)
    {
        $cupom = $this->repository->find($id);
        return view('admin.cupoms.edit', compact('cupom'));
    }

    public function update(AdminCupomRequest $request, $id)
    {
        if ($request->used) {
            $request->used == 'on' ? $request->used = 1 : $request->used = 0;
            $save = ['code' => $request->code, 'value' => $request->value, 'used' => $request->used];
            $this->repository->update($save, $id);
        } else {
            $this->repository->update($request->all(), $id);
        }
        return redirect()->route('admin.cupoms.index');
    }
}
