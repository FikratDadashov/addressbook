<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Email;
use App\Models\Phone;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        $contacts = Contact::all();
        $data = ['contacts'=>$contacts];
        return view('index')->with($data);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $emails = $request->input('emails');
        $phones = $request->input('phones');
        $location = $request->input('location');
        try {
            $request->validate([
                'name' => ['required',  'unique:contacts,name'],
                'emails' => ['required', 'unique:emails,email'],
                'phones' => ['required', 'unique:phones,number']
            ]);

            $contact = Contact::create([
                'name'=>$name,
                'location'=>$location
            ]);

            $contact_id = $contact->id;

            foreach ($phones as $phone) {
                Phone::create([
                    'number' => $phone,
                    'contact_id' => $contact_id
                ]);
            }
            foreach ($emails as $email) {
                Email::create([
                    'email' => $email,
                    'contact_id' => $contact_id
                ]);
            }
            return redirect('/')->with('success', 'Address created successfully');
        }catch (Exception $e) {
            return back()->with('error',"Address wasn't added. It can be duplicate entry");
        }
    }

    public function edit($id)
    {
        $address = Contact::find($id);
        $data = ['address'=>$address];
        return view('edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $new_emails = $request->input('emails');
        $new_phones = $request->input('phones');
        $location = $request->input('location');

        if (!$new_phones) $new_phones = [];
        if (!$new_emails) $new_emails = [];

        $contact = Contact::find($id);
        $old_emails = [];
        $old_phones = [];

        foreach ($contact->phones as $phone) {
            array_push($old_phones, $phone->number);
        }

        foreach ($contact->emails as $email) {
            array_push($old_emails, $email->email);
        }

        try {

            $contact->update([
                'name' => $name,
                'location' => $location
            ]);

            $inserted_phones = array_diff($new_phones, $old_phones);
            $deleted_phones = array_diff($old_phones, $new_phones);
            $inserted_emails = array_diff($new_emails, $old_emails);
            $deleted_emails = array_diff($old_emails, $new_emails);

            foreach ($inserted_emails as $email)
            {
                if (!is_null($email)) {
                    Email::create([
                        'email' => $email,
                        'contact_id' => $id
                    ]);
                }
            }

            foreach ($inserted_phones as $phone)
            {
                if (!is_null($phone)) {
                    Phone::create([
                        'number' => $phone,
                        'contact_id' => $id
                    ]);
                }
            }

            foreach ($deleted_emails as $email)
            {
                Email::where([
                    'email' => $email,
                    'contact_id' => $id
                ])->delete();
            }

            foreach ($deleted_phones as $phone)
            {
                Phone::where([
                    'number' => $phone,
                    'contact_id' => $id
                ])->delete();
            }

            return redirect('/')->with('success', 'Address updated successfully');
        }
        catch (Exception $e) {
            return back()->with('error',"Address wasn't updated. It can be duplicate entry");
        }

    }

    public function destroy($id)
    {
        try {
            Contact::destroy($id);
            return redirect('/')->with('success', 'Address deleted successfully');
        }
        catch (Exception $e){
            return back()->with('error',"Address wasn't deleted");
        }

    }
}
