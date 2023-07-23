<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;

class ContactRequestController extends Controller
{
    public function store(Request $request, $id)
    {
        // $project = Project::where("id", "=", $id)->first();
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors()
                ]
            );
        }

        $myData = $validator->validated();
        $myData['project_id'] = $id;
        $newContactRequest = new ContactRequest();
        $newContactRequest->fill($myData);
        $newContactRequest->save();

        $newMail = new NewContact($myData);
        Mail::to($newContactRequest->project->user->email)->send($newMail);

        return response()->json(
            [
                'success' => true
            ]
        );
    }
}
