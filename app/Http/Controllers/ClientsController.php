<?php

namespace App\Http\Controllers;

use App\Exports\ClientsExport;
use App\Http\Requests\ClientRequest;
use App\Imports\ClientsImport;
use App\Models\Client;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-clients|edit-clients|delete-clients', ['only' => ['index','show']]);
        $this->middleware('permission:create-clients', ['only' => ['create','store']]);
        $this->middleware('permission:edit-clients', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-clients', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('client.index', [
            'clients' => Client::latest()->paginate(3)
        ]);
    }
    public function create()
    {
        return view('client.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        //
        Client::create($request->all());
        return redirect()->route('client.index')
            ->withSuccess('New client is added successfully.');
    }
    public function show(Client $client)
    {
        return view('client.show', [
            'client' => $client
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
        return view('client.edit', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client)
    {
        //
            $client->update($request->all());
            return redirect()->route('client.index')
                ->withSuccess('Clients is updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $clients=Client::find($id);
        $clients->delete();
        return redirect()->route('client.index')
            ->withSuccess('Clients is deleted successfully.');
    }
    public function export()
    {
        return Excel::download(new ClientsExport(), 'clients.xlsx');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import()
    {
        Excel::import(new ClientsImport(),request()->file('file'));

        return back()->withSuccess('Client is import  successefuly');
    }
    public function downloadPDF()
    {
        $clients = Client::all();

        $pdf = PDF::loadView('client.clientPdf', array('clients' =>  $clients))
            ->setPaper('a4', 'portrait');

        return $pdf->download('clients-details.pdf');
    }
    public function viewPDF()
    {
        $clients = Client::all();

        $pdf = PDF::loadView('client.clientPdf', array('clients' =>  $clients))
            ->setPaper('a4', 'portrait');

        return $pdf->stream();

    }

}
