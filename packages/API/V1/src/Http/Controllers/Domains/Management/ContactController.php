<?php

namespace Loctour\API\V1\Http\Controllers\Domains\Core;

use App\Domain\Core\Models\Contact;
use Loctour\API\V1\Http\Controllers\APIController;
use Loctour\API\V1\Http\Requests\ContactRequest;
use Loctour\API\V1\Resources\ContactResource;

class ContactController extends APIController
{

    public function index()
    {
        return $this->success(ContactResource::paginate(
            Contact::paginate(20)
        ));
    }

    public function store(ContactRequest $request)
    {
        $contact = Contact::create($request->validated());
        return $this->success(new ContactResource($contact));
    }

    public function update(Contact $contact, ContactRequest $request)
    {
        $contact->update($request->validated());
        return $this->success(new ContactResource($contact));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return $this->executed();
    }
}
