<?php namespace App\Http\Controllers;

use App\Models\Contact;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller {

    public function index() {
        $data = Contact::orderBy('id','desc')->paginate(10)->setPath('contacts');
        return view('admin.contacts.index',compact(['data']));
    }

    public function create() {
        return view('admin.contacts.create');
    }

    public function store(Request $request) {
        $request->validate([
         'name' => 'required',
         'email' => 'required|email',
         'phone' => 'required'
        ]);

        Contact::create($request->all());
        return redirect()->back()->with('success','Create Successfully');
    }

    public function show($id) {
       $data =  Contact::find($id);
       return view('admin.contacts.show',compact(['data']));
    }

    public function edit($id) {
       $data = Contact::find($id);
       return view('admin.contacts.edit',compact(['data']));
    }

    public function update(Request $request, $id) {
        $request->validate([
         'name' => 'required',
         'email' => 'required|email',
         'phone' => 'required'
        ]);

        Contact::where('id',$id)->update($request->all());
        return redirect()->back()->with('success','Update Successfully');
        
    }

    public function destroy($id) {
        Contact::where('id',$id)->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }

}