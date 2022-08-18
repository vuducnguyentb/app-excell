<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Player2Controller extends Controller
{
    public function uploadContentWithPackage(Request $request)
    {
        if ($request->file) {
            $file = $request->file;
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $fileSize = $file->getSize(); //Get size of uploaded file in bytes
//Checks to see that the valid file types and sizes were uploaded
            $this->checkUploadedFileProperties($extension, $fileSize);
            $import = new PlayersImport();
            Excel::import($import, $request->file);
            foreach ($import->data as $user) {
//sends email to all users
                $this->sendEmail($user->email, $user->name);
            }
//Return a success response with the number if records uploaded
            return response()->json([
                'message' => $import->data->count() . " records successfully uploaded"
            ]);
        } else {
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }
}
