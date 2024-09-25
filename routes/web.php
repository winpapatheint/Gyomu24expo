<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HcompanyController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailTemplateController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('sendemailexhibit', [AdminController::class, 'sendemailexhibit'])
                ->middleware(['auth', 'verified'])->name('sendemailexhibit');

Route::post('/email-management', [AdminController::class, 'store'])->name('email.management.update');
Route::post('/email-management/store', [AdminController::class, 'storetemplate'])->name('email.management.store');

Route::post('deleteexhibit', [AdminController::class, 'deleteexhibit'])
                ->middleware(['auth', 'verified'])->name('deleteexhibit');
Route::post('saveexhibit', [AdminController::class, 'saveexhibit'])->name('saveexhibit');
Route::get('admin/exhibit', [AdminController::class, 'indexexhibit'])->middleware(['auth', 'verified','role:admin']);
Route::get('/editexhibit/{id}', [AdminController::class, 'editexhibit'])->middleware(['auth', 'verified','role:admin']);

Route::get('/printpdf/{type}', [AdminController::class, 'printpdf']);

Route::post('admin/registercoadmin', [AdminController::class, 'storecoadmin'])->name('registercoadmin');
Route::post('admin/registerpic', [AdminController::class, 'storepic'])->name('registerpic');
Route::post('admin/registernego', [AdminController::class, 'storenego'])->name('registernego');
Route::post('admin/registeragreement', [AdminController::class, 'storeagreement'])->name('registeragreement');

Route::get('/editcoadmin/{id}', [AdminController::class, 'editcoadmin'])->middleware(['auth', 'verified','role:admin']);
Route::get('/editpic/{id}', [AdminController::class, 'editpic'])->middleware(['auth', 'verified','role:admin']);
Route::get('/editnego/{id}', [AdminController::class, 'editnego'])->middleware(['auth', 'verified','role:admin']);
Route::get('/editagreement/{id}', [AdminController::class, 'editagreement'])->middleware(['auth', 'verified','role:admin']);

Route::get('admin/coadmin', [AdminController::class, 'indexcoadmin'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/pic', [AdminController::class, 'indexpic'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/nego', [AdminController::class, 'indexnego'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/agreement', [AdminController::class, 'indexagreement'])->middleware(['auth', 'verified','role:admin']);

Route::get('/order/{id}', [AdminController::class, 'ordertemplate']);
Route::get('admin/order', [AdminController::class, 'indexorder'])->middleware(['auth', 'verified','role:admin']);
Route::post('admin/registerorder', [AdminController::class, 'storeorder'])->name('registerorder');


Route::get('/invoice/{id}', [AdminController::class, 'invoicetemplate']);
Route::get('admin/invoice', [AdminController::class, 'indexinvoice'])->middleware(['auth', 'verified','role:admin']);
Route::post('admin/registerinvoice', [AdminController::class, 'storeinvoice'])->name('registerinvoice');


Route::get('/quotation/{id}', [AdminController::class, 'quotationtemplate']);
Route::get('admin/quotation', [AdminController::class, 'indexquotation'])->middleware(['auth', 'verified','role:admin']);
Route::post('admin/registerquotation', [AdminController::class, 'storequotation'])->name('registerquotation');

// Route::get('/admin/registerquotation', function () {return view('admin.registerquotation');});
Route::post('admin/gethcompany', [AdminController::class, 'gethcompany'])->name('gethcompany');
Route::get('/editdoc/{type}/{id}', [AdminController::class, 'editdoc'])->middleware(['auth', 'verified']);

Route::post('user/setmoneyinpaiddate', [UserController::class, 'setmoneyinpaiddate'])->name('setmoneyinpaiddate');

Route::get('/foremployee', [AdminController::class, 'foremployee']);

Route::get('/selectregister', function () {
    return view('selectregister');
});

Route::get('/downloadguidance', [HostController::class, 'downloadguidance'])->middleware(['auth', 'verified','role:host'])->name('downloadguidance');

Route::post('updatestatus', [AdminController::class, 'updatestatus'])->name('updatestatus');

Route::get('/editapplication/{id}', [UserController::class, 'edittask'])->middleware(['auth', 'verified']);

Route::post('user/getcomplist', [UserController::class, 'getcomplist'])->name('getcomplist');

Route::get('/makeapplication', function () {return view('user.makeapplication');});

Route::get('/registercompanydetail', function () {return view('user.registercompanydetail');});
Route::post('addcompanydetail', [UserController::class, 'addcompanydetail'])->name('addcompanydetail');

Route::get('/', [AdminController::class, 'welcome']);
// Route::get('/', function () {
//     return view('auth.loginadmin');
// });

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/exam', function () {
    return view('exam');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::post('inflhide', [AdminController::class, 'inflhide'])
                ->middleware(['auth', 'verified'])->name('inflhide');

Route::post('deleteevent', [AdminController::class, 'deleteevent'])
                ->middleware(['auth', 'verified'])->name('deleteevent');

Route::get('admin/events', [AdminController::class, 'indexevents'])->middleware(['auth', 'verified','role:admin']);

Route::post('updatezoomapi', [AdminController::class, 'updatezoomapi'])->name('updatezoomapi');

Route::post('deleteblog', [AdminController::class, 'deleteblog'])
                ->middleware(['auth', 'verified'])->name('deleteblog');

Route::get('/download', [AdminController::class, 'download']);

Route::post('msgread', [AdminController::class, 'msgread'])->name('msgread');
Route::post('getmsgnoti', [AdminController::class, 'getmsgnoti'])->name('getmsgnoti');

Route::post('assignpaydone', [AdminController::class, 'assignpaydone'])->name('assignpaydone');

Route::post('admin/registersubadmin', [AdminController::class, 'registersubadmin'])->name('registersubadmin');

Route::post('idlehost', [HcompanyController::class, 'idlehost'])
                ->middleware(['auth', 'verified'])->name('idlehost');

Route::post('storereport', [AdminController::class, 'storereport'])->name('storereport');
Route::get('/report/{assignid}/{taskhashid}', [AdminController::class, 'report']);

Route::post('registermoneyin', [AdminController::class, 'registermoneyin'])->name('registermoneyin');

Route::post('assignrespon', [HcompanyController::class, 'assignrespon'])->name('assignrespon');

Route::get('/message', function () {
    return view('message');
});
Route::get('/message/{roomnum}/{taskhashid}', [AdminController::class, 'message']);
Route::post('sendmsg', [AdminController::class, 'sendmsg'])->name('sendmsg');

Route::get('/influencerassign/{taskhashid}', [AdminController::class, 'influencerassign']);
Route::post('inflassign', [AdminController::class, 'inflassign'])->name('inflassign');

Route::post('hearing', [AdminController::class, 'hearing'])->name('hearing');
// Route::get('/influencerassign', function () {
//     return view('influencerassign');
// });

Route::get('/setlang', [AdminController::class, 'setlang']);

Route::post('user/savetask', [UserController::class, 'savetask'])->name('savetask');

Route::post('user/paymentdone', [UserController::class, 'paymentdone'])->name('paymentdone');

Route::get('/payreturn', [AdminController::class, 'payreturnget']);
Route::post('payreturn', [AdminController::class, 'payreturn'])->name('payreturn');

Route::post('contact', [AdminController::class, 'contact'])->name('contact');
// Route::post('blog', [AdminController::class, 'blog'])->name('blog');
Route::get('/blog', [AdminController::class, 'blog']);
Route::get('/news', [AdminController::class, 'blog']);
Route::get('/blog/{blogid}', [AdminController::class, 'blogdetail']);

Route::get('/gallery', [AdminController::class, 'gallery']);
Route::get('/sponsors', [AdminController::class, 'sponsor']);
Route::get('/scheduletab', [AdminController::class, 'scheduletab']);
Route::get('/hostlisting', [AdminController::class, 'hostlisting']);
Route::get('/aboutus', [AdminController::class, 'aboutus']);




Route::get('/{role}/login', [AdminController::class, 'adminlogin']);
Route::get('/adminlogin', function () {return view('auth.loginadmin');});
// Route::get('/admin/login', function () {return view('auth.loginadmin');});
Route::get('/agentlogin', function () {return view('auth.loginhcompany');});
// Route::get('/hcompany/login', function () {return view('auth.loginhcompany');});
Route::get('/candidatelogin', function () {return view('auth.loginhost');});
// Route::get('/host/login', function () {return view('auth.loginhost');});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','role:user'])->name('dashboard');

Route::get('/edit/{role}/{id}', [AdminController::class, 'editdata'])->middleware(['auth', 'verified']);

Route::post('edituser', [AdminController::class, 'updateuser'])->name('edituser');

Route::post('deleteuser', [AdminController::class, 'deleteuser'])
                ->middleware(['auth', 'verified'])->name('deleteuser');

Route::post('deletematters', [AdminController::class, 'deletematters'])
                ->middleware(['auth', 'verified'])->name('deletematters');

// Route::get('/about-us', ['as' => 'about-us', 'uses' => 'mattersController@aboutus']);
Route::get('/admin', [AdminController::class, 'indexuser'])->middleware(['auth', 'verified','role:admin'])->name('admin');
Route::get('admin/subadmin', [AdminController::class, 'indexsubadmin'])->middleware(['auth', 'verified','role:admin']);
Route::get('/admin/registersubadmin', function () {return view('admin.editprofile');});
Route::get('admin/agent', [AdminController::class, 'indexhcompany'])->middleware(['auth', 'verified','role:admin']);
Route::get('/admin/registerhcompany', function () {return view('admin.registerhcompany');});
Route::get('/admin/registerblog', function () {return view('admin.registerblog');})->middleware(['auth', 'verified','role:admin']);
Route::get('/registergallery', function () {return view('admin.registergallery');})->middleware(['role:admin,hcompany']);
Route::post('admin/registerhcompany', [AdminController::class, 'storehcompany'])->name('registerhcompany');
Route::get('/editblog/{blogid}', [AdminController::class, 'editblog'])->middleware(['auth', 'verified','role:admin']);
Route::get('/editgallery/{galleryid}', [AdminController::class, 'editgallery'])->middleware(['auth', 'verified','role:admin,hcompany']);

Route::post('admin/registerblog', [AdminController::class, 'storeblog'])->name('registerblog');
Route::post('admin/registergallery', [AdminController::class, 'storegallery'])->name('registergallery');

Route::get('/takeremote/{id}', [AdminController::class, 'takeremote'])->middleware(['auth', 'verified','role:admin']);
Route::get('/takeremotehost/{id}', [AdminController::class, 'takeremote'])->middleware(['auth', 'verified','role:hcompany,admin']);
Route::post('/returnadmin', [AdminController::class, 'returnadmin'])
                ->middleware(['auth', 'verified'])
                ->name('returnadmin');

Route::get('/admin/news', [AdminController::class, 'indexblog'])->middleware(['auth', 'verified','role:admin']);
Route::get('/admin/gallery', [AdminController::class, 'indexgallery'])->middleware(['auth', 'verified','role:admin']);
Route::get('/admin/topsetting', [AdminController::class, 'indextopsetting'])->middleware(['auth', 'verified','role:admin']);
Route::post('admin/registertopsetting', [AdminController::class, 'storetopsetting'])->name('registertopsetting');
Route::post('admin/registershowseminar', [AdminController::class, 'registershowseminar'])->name('registershowseminar');
Route::post('admin/hideseminar', [AdminController::class, 'hideseminar'])->name('hideseminar');

Route::get('admin/seminars', [AdminController::class, 'indexseminars'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/analayticmarketing', [AdminController::class, 'indexanalayticmarketing'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/analayticexam', [AdminController::class, 'indexanalayticexam'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/analayticdifficulty', [AdminController::class, 'indexanalayticdifficulty'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/sales', [AdminController::class, 'indexsales'])->middleware(['auth', 'verified','role:admin']);

Route::get('admin/candidate', [AdminController::class, 'indexhosts'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/types', [AdminController::class, 'indextypes'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/puchases', [AdminController::class, 'indexpuchases'])->middleware(['auth', 'verified','role:admin']);
Route::get('/admin/registertypes', function () {return view('admin.registertypes');});
Route::post('admin/registertypes', [AdminController::class, 'storetypes'])->name('registertypes');
Route::get('/edittype/{id}', [AdminController::class, 'edittype'])->middleware(['auth', 'verified','role:admin']);

Route::post('admin/gettypechild', [AdminController::class, 'gettypechild'])->name('gettypechild');
Route::post('getnoti', [AdminController::class, 'getnoti'])->name('getnoti');
Route::post('markread', [AdminController::class, 'markread'])->name('markread');
Route::get('admin/payment', [AdminController::class, 'indexpayment'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/bill', [AdminController::class, 'indexbill'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/indexresult', [AdminController::class, 'indexresult'])->name('indexresult');


Route::get('/hcompany/gallery', [HcompanyController::class, 'indexgallery'])->middleware(['auth', 'verified','role:hcompany']);
Route::get('/agent', [HcompanyController::class, 'indexhost'])->middleware(['auth', 'verified','role:hcompany'])->name('hcompany');
Route::get('/registerhost', function () {return view('registerhost');});
Route::get('/hcompany/registerhost', function () {return view('hcompany.registerhost');});
Route::post('hcompany/registerhost', [HcompanyController::class, 'storehost'])->name('registerhost');

Route::get('/hcompany/setzoomapi', function () {return view('hcompany.setzoomapi');});
Route::post('hcompany/setzoomapi', [HcompanyController::class, 'setzoomapi'])->name('setzoomapi');

Route::get('/agent/job', [HcompanyController::class, 'indexjob'])->middleware(['auth', 'verified','role:hcompany'])->name('indexjob');
Route::get('/hcompany/calender', [HcompanyController::class, 'indexcalender'])->middleware(['auth', 'verified','role:hcompany'])->name('indexcalender');
Route::get('/hcompany/sales', [HcompanyController::class, 'indexsales'])->middleware(['auth', 'verified','role:hcompany'])->name('indexsales');
Route::get('hcompany/analayticmarketing', [AdminController::class, 'indexanalayticmarketing'])->middleware(['auth', 'verified','role:hcompany']);
Route::get('hcompany/analayticexam', [AdminController::class, 'indexanalayticexam'])->middleware(['auth', 'verified','role:hcompany']);
Route::get('hcompany/analayticdifficulty', [AdminController::class, 'indexanalayticdifficulty'])->middleware(['auth', 'verified','role:hcompany']);

Route::post('hcompany/registerfee', [HcompanyController::class, 'registerfee'])->name('registerfee');
Route::get('hcompany/bill', [HcompanyController::class, 'indexbill'])->middleware(['auth', 'verified','role:hcompany']);


Route::get('/hcompany/registernotify/{semid}', [HcompanyController::class, 'registernotify'])->middleware(['auth', 'verified','role:hcompany']);
Route::post('hcompany/postnotify', [HcompanyController::class, 'postnotify'])->name('postnotify');
Route::get('hcompany/indexresult', [HcompanyController::class, 'indexresult'])->name('indexresult');


Route::get('/host', [HostController::class, 'indexschedule'])->middleware(['auth', 'verified','role:host'])->name('host');
Route::get('/host/registerseminar', function () {return view('host.registerseminar');});
Route::post('host/registerseminar', [HostController::class, 'storeseminar'])
                ->middleware(['auth', 'verified'])->name('registerseminar');
Route::get('host/seminars', [HostController::class, 'indexseminars'])->middleware(['auth', 'verified','role:host']);
Route::get('host/analayticmarketing', [AdminController::class, 'indexanalayticmarketing'])->middleware(['auth', 'verified','role:host']);
Route::get('host/analayticexam', [AdminController::class, 'indexanalayticexam'])->middleware(['auth', 'verified','role:host']);
Route::get('host/analayticdifficulty', [AdminController::class, 'indexanalayticdifficulty'])->middleware(['auth', 'verified','role:host']);
Route::get('host/payment', [HostController::class, 'indexpayment'])->middleware(['auth', 'verified','role:host']);
Route::get('/host/registerquestion', function () {return view('host.registerquestion');});
Route::post('host/registerquestion', [HostController::class, 'registerquestion'])
                ->middleware(['auth', 'verified'])->name('registerquestion');
Route::get('host/question', [HostController::class, 'indexquestion'])->middleware(['auth', 'verified','role:host']);
Route::get('/previewquestion/{id}', [HostController::class, 'previewquestion'])->middleware(['auth', 'verified','role:host']);
Route::get('/host/registertest', function () {return view('host.registertest');});
Route::post('host/registertest', [HostController::class, 'registertest'])->middleware(['auth', 'verified'])->name('registertest');
Route::post('host/addquetotest', [HostController::class, 'addquetotest'])->middleware(['auth', 'verified'])->name('addquetotest');
Route::get('host/test', [HostController::class, 'indextest'])->middleware(['auth', 'verified','role:host']);
Route::get('/testedit/{testid}', [HostController::class, 'testedit'])->middleware(['auth', 'verified'])->name('testedit');
Route::get('/questionedit/{questionid}', [HostController::class, 'questionedit'])->middleware(['auth', 'verified'])->name('questionedit');
Route::get('/questiondel/{questionid}', [HostController::class, 'questiondel'])->middleware(['auth', 'verified'])->name('questiondel');
Route::get('/previewtest/{id}', [HostController::class, 'previewtest'])->middleware(['auth', 'verified','role:host']);
Route::post('host/opentest', [HostController::class, 'opentest'])->name('opentest');
Route::post('host/updatelog', [HostController::class, 'updatelog'])->name('updatelog');
Route::post('host/submittest', [HostController::class, 'submittest'])->name('submittest');
Route::get('host/indexresult', [HostController::class, 'indexresult'])->name('indexresult');

Route::post('host/deletetest', [HostController::class, 'deletetest'])->name('deletetest');

Route::get('host/sales', [HostController::class, 'indexsales'])->middleware(['auth', 'verified','role:host']);

Route::get('/examdone', function () {return view('examdone');});


Route::get('/application', [UserController::class, 'indextask'])->middleware(['auth', 'verified','role:user'])->name('bookseminars');
Route::get('/application?test=1', [UserController::class, 'indextask'])->middleware(['auth', 'verified','role:user'])->name('bookseminars');
// Route::get('/makeapplication', function () {return view('hcompany.makeapplication');});

Route::get('/applyseminar', [UserController::class, 'indexapplyseminars'])->middleware(['auth', 'verified','role:user'])->name('applyseminar');

Route::get('/schedule', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('usermainpage');
Route::get('/joinedseminars', [UserController::class, 'indexjoinedseminars'])->middleware(['auth', 'verified','role:user'])->name('joinedseminars');
Route::post('applyseminar', [UserController::class, 'applyseminar'])->middleware(['auth', 'verified','role:user'])->name('applyseminar');
Route::get('/cart', [UserController::class, 'indexcart'])->middleware(['auth', 'verified','role:user'])->name('cart');
// Route::get('removefromcart/{semid}', [UserController::class, 'removefromcart'])->middleware(['auth', 'verified','role:user']);
Route::post('user/removefromcart/', [UserController::class, 'removefromcart'])
                ->middleware(['auth', 'verified','role:user'])->name('removefromcart');

Route::get('/examreview/{id}', [HostController::class, 'examreview'])->middleware(['auth', 'verified']);
Route::get('/exam/{id}', [HostController::class, 'exam'])->middleware(['auth', 'verified']);

Route::post('user/makepay', [UserController::class, 'makepay'])
                ->middleware(['auth', 'verified','role:user'])->name('makepay');
Route::get('/indexresult', [UserController::class, 'indexresult'])->middleware(['auth', 'verified'])->name('indexresult');


Route::get('/seminardetail/{seminarid}', [SeminarController::class, 'seminardetail'])
// ->middleware(['auth', 'verified'])
->name('seminardetail');
Route::get('/seminaredit/{seminarid}', [SeminarController::class, 'seminaredit'])->middleware(['auth', 'verified'])->name('seminaredit');
// http://seminar-test.asia-hd.com/seminaredit/3527819
Route::get('/booktest', [UserController::class, 'indexbooktest'])->middleware(['auth', 'verified','role:user'])->name('booktest');

Route::resource('seminars', SeminarController::class);

Route::get('admin/email-templates', [EmailTemplateController::class, 'index'])->middleware(['auth', 'verified','role:admin']);
Route::get('admin/email-templates/create', [EmailTemplateController::class, 'create'])
                ->middleware(['auth', 'verified'])->name('email-templates.create');

require __DIR__.'/auth.php';
