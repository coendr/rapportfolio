<?php

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

Route::get('/', function () {
    return view('login');
});

//registreren
Route::get('/register', 'RegistratieController@create')->name('register');
Route::post('/registreren', 'RegistratieController@store')->name('registerstore');

//login
Route::get('/login', 'UserController@LogIn')->name('login');
Route::post('/loggedin', 'UserController@PostLogIn')->name('loggedin');

//force_password_change
Route::post('/wachtwoord/veranderen/{id}', 'UserController@ForcePasswordChange')->name('change');


Route::group(['middleware' => 'auth'], function () {


//login-logout

    Route::get('/logout', 'UserController@LogOut')->name('logout');

//profile
    Route::get('/profile', 'UserController@Profile')->name('profile');
    Route::post('/changepassword', 'UserController@ChangePassword')->name('changepassword');
    Route::post('/link', 'UserController@Leerlinglink')->name('link');
    Route::get('/unlink/{id}', 'UserController@Deletelink')->name('unlink');
    Route::get('/unlink/ouder/{id}', 'UserController@Deleteouderlink')->name('unlinkouder');
    Route::get('/pending', 'UserController@PendingLink')->name('pending');
    Route::get('/pending/accept/{id}', 'UserController@acceptLink')->name('acceptLink');
    Route::get('/pending/delete/{id}', 'UserController@rejectLink')->name('rejectLink');

    Route::get('/home', 'HomeController@home')->name('home');

//rapport
    Route::group(['prefix' => 'rapport'], function () {
        Route::get('/kiesvak', 'CijferController@GetVakinvul')->name('kiesvak');
        Route::get('/invullen1/{id}', 'CijferController@CijferInvullen1')->name('invullen1');
        Route::post('/invullen1/{id}', 'CijferController@InsertCijfer1')->name('InsertCijfer1');
        Route::get('/invullen2/{id}', 'CijferController@CijferInvullen2')->name('invullen2');
        Route::post('/invullen2/{id}', 'CijferController@InsertCijfer2')->name('InsertCijfer2');
        Route::get('/bekijken', 'CijferController@GetLeerlingbekijk')->name('bekijken');
        Route::get('/jaar/{id}', 'CijferController@GetJaar')->name('jaar');
        Route::get('/jaar/{id}/{jaar}', 'CijferController@Bekijkenrapport')->name('bekijkrap');
        Route::get('/ouder/bekijken', 'CijferController@OudersCijfers')->name('oudersbekijk');
        Route::get('/bekijkenleerling', 'CijferController@GetJaarLeerling')->name('getjaar');
        Route::get('/wijzig', 'CijferController@GetLeerlingwijzig')->name('wijzig');
        Route::get('/wijzig/{id}', 'CijferController@ShowWijzigen')->name('wijziginv');
        Route::post('/wijzig/{id}', 'CijferController@UpdateCijfer');
    });

//portfolio
    Route::group(['prefix' => 'portfolio'], function () {
        Route::get('/invoegen/namen', 'PortfolioController@InvullenNamen')->name('invoegennamen');
        Route::get('/invoegen/{id}', 'PortfolioController@PortfolioInvoegen')->name('portfolioinvoegen');
        Route::post('/invoegen/{id}', 'PortfolioController@PortfolioUploaden')->name('uploaden');
        Route::get('/bekijken', 'PortfolioController@GetLeerlingbekijk')->name('portbekijk');
        Route::get('/bekijken/{id}', 'PortfolioController@GetPortfolio')->name('portfoliobekijken');
        Route::get('/ouder/bekijken', 'PortfolioController@OudersPortfolio')->name('oudersportfolio');
        Route::get('/leerling/bekijken', 'PortfolioController@LeerlingPortfolio')->name('leerlingportfolio');
        Route::get('/delete/{id}', 'PortfolioController@DeletePortfolio')->name('verwijderen');
    });

    //knap
    Route::group(['prefix' => 'knap'], function () {
        Route::get('/invoegen/namen', 'KnapController@InvullenNamen')->name('knapinvullennamen');
        Route::get('/invoegen1/{id}', 'KnapController@getKnapLeerkracht1')->name('knapinvullenleerkracht1');
        Route::post('/invoegen1/{id}', 'KnapController@InvullenKnapLeerkracht1')->name('invullenknapleerkracht1');
        Route::get('/invoegen2/{id}', 'KnapController@getKnapLeerkracht2')->name('knapinvullenleerkracht2');
        Route::post('/invoegen2/{id}', 'KnapController@InvullenKnapLeerkracht2')->name('invullenknapleerkracht2');
        Route::get('/invoegenleerling', 'KnapController@KiezenLeerling')->name('leerlingkiezen');
        Route::get('/invoegenleerling1/{id}', 'KnapController@getKnapLeerling1')->name('knapinvullenleerling1');
        Route::post('/invoegenleerling1/{id}', 'KnapController@InvullenKnapLeerling1')->name('invullenknapleerling1');
        Route::get('/invoegenleerling2/{id}', 'KnapController@getKnapLeerling2')->name('knapinvullenleerling2');
        Route::post('/invoegenleerling2/{id}', 'KnapController@InvullenKnapLeerling2')->name('invullenknapleerling2');
    });

// Eh... ik weet niet waar ik deez moet laten dus ik zet hem wel hier neer :D
    Route::get('/rapportbekijkenleerling', 'CijferController@GetJaarLeerling')->name('getjaar');
    Route::get('/bekijkenleerling/{jaar}', 'CijferController@BekijkenrapportLeerling')->name('bekijkrapleer');

    //pdf
    Route::get('/pdf1/{leerlingid}/{jaar}', 'PdfController@pdfview1')->name('pdfrap1');
    Route::get('/pdf2/{leerlingid}/{jaar}', 'PdfController@pdfview2')->name('pdfrap2');

    //notitie
    Route::group(['prefix' => 'notitie'], function () {
        Route::get('/invullen', 'NotitieController@index')->name('notitie');
        Route::get('/invullen1/{id}', 'NotitieController@getLeerling1')->name('notinvullen1');
        Route::get('/invullen2/{id}', 'NotitieController@getLeerling2')->name('notinvullen2');
        Route::post('/invullen1/{id}', 'NotitieController@InsertNotitie1')->name('notinsert1');
        Route::post('/invullen2/{id}', 'NotitieController@InsertNotitie2')->name('notinsert2');
        Route::get('/invullen/leerling', 'NotitieController@NotitieLeerling')->name('leerlingnotitie');
        Route::get('/invullen/1/leerling/{id}', 'NotitieController@LeerlingNotitie1')->name('notitieleerling1');
        Route::get('/invullen/2/leerling/{id}', 'NotitieController@LeerlingNotitie2')->name('notitieleerling2');
        Route::post('/invullen/1/leerling/{id}', 'NotitieController@InvullenLeerling1')->name('notitieinvullenleerling1');
        Route::post('/invullen/2/leerling/{id}', 'NotitieController@InvullenLeerling2')->name('notitieinvullenleerling2');
    });

//importeren
    Route::group(['prefix' => 'import'], function () {
        Route::get('/leerling', 'AdminController@importLeerling')->name('importleerling');
        Route::post('/leerling', 'AdminController@importLeerlingExcel')->name('importleerling');
        Route::get('/leerkracht', 'AdminController@importLeerkracht')->name('importleerkracht');
        Route::post('/leerkracht', 'AdminController@importLeerkrachtExcel')->name('importleerkracht');
        Route::get('/vak', 'AdminController@importVak')->name('importvak');
        Route::post('/vak', 'AdminController@importVakExcel')->name('importvak');
    });
//aanpassen
    Route::group(['prefix' => 'aanpassen'], function () {
        Route::get('/leerling', 'AdminController@getGroep')->name('getgroep');
        Route::get('/leerkracht', 'AdminController@getLeerkracht')->name('getleerkracht');
        Route::get('/leerling/{groep}', 'AdminController@getLeerling')->name('getleerling');
        Route::get('/leerling/{groep}/{id}', 'AdminController@verwijderleerling')->name('verwijderleerling');
        Route::get('/leerkracht/{id}', 'AdminController@deleteleerkracht')->name('verwijderleerkracht');
        Route::get('/ouder/{id}', 'AdminController@deleteouder')->name('verwijderouder');
        Route::get('/leerkracht/edit/{id}', 'AdminController@editleerkracht')->name('editleerkracht');
        Route::get('/leerling/edit/{groep}/{id}', 'AdminController@editleerling')->name('editleerling');
        Route::post('/leerkracht/update/{id}', 'AdminController@aanpassenleerkracht')->name('aanpassenleerkracht');
        Route::post('/leerling/update/{id}', 'AdminController@aanpassenleerling')->name('aanpassenleerling');
        Route::get('/vak', 'AdminController@aanpassenVak')->name('aanpassenvak');
        Route::get('/vak/{id}', 'AdminController@deleteVak')->name('verwijdervak');
        Route::get('/vak/aanpassen/{id}', 'AdminController@editVak')->name('editvak');
        Route::post('/vak/aanpassen/{id}', 'AdminController@updateVak')->name('updatevak');
        Route::get('/leerkracht/wachtwoord/{id}', 'AdminController@forcepasswordleerkracht')->name('forcechangeleerkracht');
        Route::get('/wachtwoord/{id}', 'AdminController@forcepasswordleerling')->name('forcepasswordleerling');
        Route::get('/groep', 'AdminController@aanpassenGroep')->name('aanpassengroep');
        Route::get('/groep/verwijderen/{id}', 'AdminController@deleteGroep')->name('deletegroep');
        Route::get('/groep/aanpassen/{id}', 'AdminController@editGroep')->name('editgroep');
        Route::post('/groep/aanpassen/{id}', 'AdminController@updateGroep')->name('updategroep');
        Route::get('/groep/toevoegen', 'AdminController@toevoegenGroep')->name('toevoegengroep');
        Route::post('/groep/toevoegen', 'AdminController@addGroep')->name('addgroep');
        Route::get('/groep/overzetten', 'AdminController@changeGroep')->name('changegroep');
        Route::post('/groep/overetten', 'AdminController@overzettenGroep')->name('overzettengroep');
    });
});
