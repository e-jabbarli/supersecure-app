<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FormManagementController extends Controller
{
    public function index()
    {
        $forms = DB::select('SELECT * FROM forms');

        return view('forms.index', compact('forms'));
    }

    public function create()
    {
        return view('forms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:forms,email',
        ]);

        DB::insert('INSERT INTO forms (first_name, last_name, email) VALUES (?, ?, ?)', [
            $request->first_name,
            $request->last_name,
            $request->email,
        ]);

        return redirect()->route('forms.index')->with('success', 'Form created successfully.');
    }

    public function edit($id)
    {
        $form = DB::select('SELECT * FROM forms WHERE id = ?', [$id]);

        if (empty($form)) {
            return redirect()->route('forms.index')->with('error', 'Form not found.');
        }

        return view('forms.edit', compact('form'))->with('form', $form[0]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:forms,email,' . $id,
        ]);


        DB::update('UPDATE forms SET first_name = ?, last_name = ?, email = ? WHERE id = ?', [
            $request->first_name,
            $request->last_name,
            $request->email,
            $id,
        ]);

        return redirect()->route('forms.index')->with('success', 'Form updated successfully.');
    }


    public function destroy(Request $request, $id)
    {
        $sql = "DELETE FROM forms WHERE (id = (" . $id . "))";
    
        DB::statement($sql);
    
        return redirect()->route('forms.index')->with('success', 'Form deleted successfully.');
    }


    public function show(Form $form)
    {
        return view('forms.show', compact('form'));
    }
    
   
}
