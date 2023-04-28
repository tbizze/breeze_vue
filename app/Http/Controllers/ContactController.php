<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tabelaList = Contact::orderBy('id', 'desc')
                      ->paginate(4);
        $registros = Contact::all();
        
        //dd($tabelaList);


        return Inertia::render('Contact/Index',[
            'contacts' => $registros,
            /* 'contacts' => Contact::paginate(4), */
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Contact/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        // Chama as validações.
        $input = $request->validated();
        
        // Passado nas validações, persiste o $input no DB.
        Contact::create($input);

        // Redireciona para index.
        return redirect()->route('contacts.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //dd('show');
        return Inertia::render('Contact/Show',[
            'contact' => $contact,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return Inertia::render('Contact/Edit',[
            'contact' => $contact,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    /* public function update(ContactRequest $request, Contact $contact) */
    public function update(ContactRequest $request)
    {
        
        $contact = Contact::find($request->id);
        $contact->nome = $request->nome;
        $contact->idade = $request->idade;
        $contact->save();

        // Redireciona para index.
        return redirect()->route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy (Contact $contact)
    {
        // Exclui do DB o registro.
        $contact->delete();
        
        // Redireciona para index.
        return redirect()->route('contacts.index');
    }
}
