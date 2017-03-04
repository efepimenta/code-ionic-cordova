<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminClientRequest;
use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\ClientService;

class ClientsController extends Controller
{

    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ClientService
     */
    private $clientService;

    public function __construct(ClientRepository $clientRepository, UserRepository $userRepository, ClientService $clientService)
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
        $this->clientService = $clientService;
    }

    public function index()
    {
        $clients = $this->clientRepository->paginate(5);

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        $categories = $this->userRepository->lists('name', 'id');
        return view('admin.clients.create');
    }

    public function store(AdminClientRequest $request)
    {
        $this->clientService->create($request->all());
        return redirect()->route('admin.clients.index');
    }

    public function edit($id)
    {
        $client = $this->clientRepository->find($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(AdminClientRequest $request, $id)
    {
        $this->clientService->update($request->all(), $id);
        return redirect()->route('admin.clients.index');
    }
}
