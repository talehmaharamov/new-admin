<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index()
    {
        checkPermission('mail index');
        $mails = Mail::all();
        return view('backend.mail.index', get_defined_vars());
    }

    public function delete(string $id)
    {
        checkPermission('mail delete');
        return CRUDHelper::remove_item('\App\Models\Mail', $id);
    }
}
