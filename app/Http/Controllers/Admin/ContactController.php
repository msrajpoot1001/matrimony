<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Contact;
 use App\Http\Controllers\Controller; 

class ContactController extends Controller
{

    public function contactRecords()
    {
        $contacts = Contact::where("type","contact")->where("type","")->latest()->paginate(10);
        return view('dashboard.pages.admin.services.contact', compact('contacts'));
    }
    
    public function queryRecords()
    {
        $contacts = Contact::where("type","query")->latest()->paginate(10);
        return view('dashboard.pages.admin.services.query', compact('contacts'));
    }


    public function delteContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()
            ->route('admin.contact.records')
            ->with('success', 'Contact message deleted successfully.');
    }


}
