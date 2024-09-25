<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailTemplateController extends Controller
{
    public function index()
    {   $limit = 10;
        $templates = DB::table('email_templates')->paginate($limit);
        $ttl = $templates->total();
        $ttlpage = ceil($ttl / $limit);
        return view('admin.email_templates.index', compact('templates', 'ttlpage', 'ttl'));
    }

    public function create()
    {
        return view('admin.email_templates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);

        EmailTemplate::create($request->all());
        return redirect()->route('email-templates.index');
    }

    public function edit(EmailTemplate $template)
    {
        return view('admin.email_templates.edit', compact('template'));
    }

    public function update(Request $request, EmailTemplate $template)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);

        $template->update($request->all());
        return redirect()->route('email-templates.index');
    }

    public function destroy(EmailTemplate $template)
    {
        $template->delete();
        return redirect()->route('email-templates.index');
    }
}

