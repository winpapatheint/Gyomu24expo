<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class AuthLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $exhibits = DB::table('exhibit')      
                ->orderBy('taskdate', 'desc')
                ->paginate(9999);

        $email_data = DB::table('email_templates')      
                        ->orderBy('created_at', 'desc')
                        ->first();
        return view('layouts.auth', [
            'exhibits' => $exhibits,
            'emailData' => $email_data,
        ]);
    }
}
