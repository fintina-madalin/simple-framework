<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Request;
use App\Models\City;
use App\Models\Contact;

class ContactsController extends BaseController
{
    public function list(): void
    {
        $contacts = Contact::all();
        $this->render('contacts/list', ['contacts' => $contacts, 'title' => 'Contact list']);
    }
    public function add(): void
    {
        if($this->request->getMethod() === Request::POST) {
            Contact::create($this->request->post());
            $this->redirect('/');
        }

        $cities = City::all();
        $this->render('contacts/add', ['cities' => $cities, 'title' => 'Add contact']);
    }

    public function edit(): void
    {

        if($this->request->getMethod() === Request::POST) {
            Contact::update($this->request->post('id'), $this->request->post());
            $this->redirect('/');
        }
        $contact = Contact::find($this->request->get('id'));
        $cities = City::all();
        $this->render('contacts/edit', ['contact' => $contact, 'cities' => $cities, 'title' => 'Edit contact']);
    }
    public function delete(): void
    {
        Contact::delete($this->request->get('id'));
        $this->redirect('/');
    }
}