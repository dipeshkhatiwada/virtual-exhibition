<?php
//session_start();
use Spatie\Sitemap\SitemapGenerator;
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
//\URL::forceScheme('https');

Route::group(['prefix' => 'admin'], function()
{

    Route::get('/', 'admin\AdminController@dashboard');
    Route::get('/dashboard', ['as'=>'admin.dashboard','uses'=>'admin\AdminController@dashboard']);


    Route::get('/setting', 'admin\SettingController@index');
    Route::get('/setting/edit/{id}', 'admin\SettingController@edit');
    Route::post('/setting/update', 'admin\SettingController@update');


    Route::get('/user', 'admin\UserController@index');
    Route::get('/user/addnew', 'admin\UserController@addnew');
    Route::post('/user/save', 'admin\UserController@save');
    Route::get('/user/delete/{id}', 'admin\UserController@delete');
    Route::get('/user/edit/{id}', 'admin\UserController@edit');
    Route::post('/user/update', 'admin\UserController@update');

    Route::get('/usergroup', 'admin\UserGroupController@index');
    Route::get('/usergroup/addnew', 'admin\UserGroupController@addnew');
    Route::post('/usergroup/save', 'admin\UserGroupController@save');
    Route::get('/usergroup/delete/{id}', 'admin\UserGroupController@delete');
    Route::get('/usergroup/edit/{id}', 'admin\UserGroupController@edit');
    Route::post('/usergroup/update', 'admin\UserGroupController@update');
    Route::get('/usergroup/autocomplete', 'admin\UserGroupController@autocomplete');



    Route::get('/event_category', 'admin\EventcategoryController@index');
    Route::get('/event_category/addnew', 'admin\EventcategoryController@addnew');
    Route::post('/event_category/save', 'admin\EventcategoryController@save');
    Route::get('/event_category/delete/{id}', 'admin\EventcategoryController@delete');
    Route::get('/event_category/edit/{id}', 'admin\EventcategoryController@edit');
    Route::post('/event_category/update', 'admin\EventcategoryController@update');

    Route::get('/event', 'admin\EventController@index');
    Route::get('/event/addnew', 'admin\EventController@addnew');
    Route::post('/event/save', 'admin\EventController@save');
    Route::get('/event/delete/{id}', 'admin\EventController@delete');
    Route::get('/event/edit/{id}', 'admin\EventController@edit');
    Route::post('/event/update', 'admin\EventController@update');

    //Enroll Part
    Route::get('/enroll', 'admin\EnrollController@index')->name('enroll.index');
    Route::get('/enroll/add', 'admin\EnrollController@create')->name('enroll.add');
    Route::post('/enroll-type/save', 'admin\EnrollController@saveType')->name('enroll_type.save');
    Route::match(['get', 'post'],'/enroll/add-category/{id}', 'admin\EnrollController@addCategory')->name('enroll.addCategory');
    Route::post('/enroll-category/save', 'admin\EnrollController@saveCategory')->name('enroll_category.save');

    Route::get('/enroll-details/edit/{id}', 'admin\EnrollController@editCategory')->name('enroll.editCategory');
    Route::post('/enroll-details/update/{id}', 'admin\EnrollController@updateCategory')->name('enroll.updateCategory');

    Route::get('/enroll/delete-category/{id}', 'admin\EnrollController@destroyCategory')->name('enroll.destroyCategory');
    Route::get('/enroll/delete-type/{id}', 'admin\EnrollController@destroyType')->name('enroll.destroyType');

    Route::get('/enroll/reservation', 'admin\EnrollReservationController@detailReservation')->name('enroll_reservation.detail');
    Route::post('/enroll/update-publish-status/{id}', 'admin\EnrollReservationController@updatePublishStatus');

    Route::get('/enroll/reservation/delete/{id}', 'admin\EnrollReservationController@destroyReservation')->name('enroll_reservation.destroy');
    Route::post('/enroll/update-platform', 'admin\EnrollReservationController@updatePlatform');

    //Booth/Stall
    Route::get('/enroll/booth/create', 'admin\BoothController@create')->name('booth.create');
    Route::match(['get', 'post'],'/enroll/booth/add/{id}', 'admin\BoothController@addBooth')->name('booth.add');


    Route::post('/enroll_booth/save','admin\BoothController@save')->name('enroll_booth.save');
    Route::get('/enroll_booth/detail','admin\BoothController@detail')->name('enroll_booth.detail');
    Route::get('/enroll_booth/delete/{id}', 'admin\BoothController@delete')->name('enroll_booth.delete');
    Route::post('/enroll_booth-type/save','admin\BoothController@saveBoothTicket')->name('enroll_booth_ticket.save');
    Route::get('/enroll_booth_type/edit/{id}', 'admin\BoothController@editBoothAttribute')->name('enroll.editBoothAttr');
    Route::post('/enroll_booth_type/update/{id}', 'admin\BoothController@updateBoothAttribute')->name('enroll.updateBootAttr');
    Route::get('/enroll_booth_type/delete/{id}', 'admin\BoothController@deleteBoothAttribute')->name('enroll.deleteBoothAttr');

    Route::get('/enroll/invoice', 'admin\EnrollController@invoice');
    Route::get('/enroll/invoice-view/{invoice}', 'admin\EnrollController@showInvoice');


});
Route::group(['prefix' => 'employee'], function () {
    Route::get('/ticket', function(){ return view ('mail.event_ticket');});
    Route::get('/', 'employee\EmployeeController@dashboard');
    Route::get('/profile/{employee_url}', 'employee\EmployeeController@profile');
    Route::get('/dashboard', ['as'=>'employee.dashboard','uses'=>'employee\EmployeeController@dashboard']);
    Route::get('/changepassword', 'employee\EmployeeController@changePassword');
    Route::post('/updatelogin', 'employee\EmployeeController@updatelogin');
    Route::get('/editprofile', 'employee\EmployeeController@editProfile');
    Route::post('/updateprofile', 'employee\EmployeeController@updateProfile');
    Route::post('/getfaculty', 'employee\EmployeeController@getfaculty');
    Route::get('/educations', 'employee\EmployeeController@educations');
    Route::post('/deleteeducation', 'employee\EmployeeController@deleteEducation');
    Route::post('/updateeducation', 'employee\EmployeeController@updateEducation');
    Route::post('/educations/save', 'employee\EmployeeController@saveEducation');



    Route::post('/uploadimage', 'employee\EmployeeController@uploadImage');

    Route::get('/location', 'employee\EmployeeController@location');
    Route::post('/location/update', 'employee\EmployeeController@updateLocation');

    Route::get('/event/apply/delete/{id}', 'employee\EmployeeController@DeleteEventApply');
    Route::get('/event/apply/{event}', 'employee\EmployeeController@EventApply');
    Route::get('/event_applied', 'employee\EmployeeController@EventApplied');
    Route::get('/event_applied', 'employee\EmployeeController@EventApplied');

    Route::post('/event/buy', 'employee\IndividualCartController@addToIndividualCart')->name('event-buy');
    Route::post('/event/{event}/book', 'front\EventReservationControler@bookEvent');
    Route::get('/event/{event_id}/comment', 'front\EventsCommentController@showComment');
    Route::POST('/event/{event_id}/comment/{comment_id}/reply', 'front\EventsCommentController@commentReply');
    Route::post('/event/{event_id}/review', 'front\EventsReviewController@addReview');
    Route::post('/event/{event}/comment', 'front\EventsCommentController@addComment');
    Route::get('/cart', 'employee\IndividualCartController@showCart');
    Route::delete('/cart/{cart}', 'employee\IndividualCartController@delete');
    Route::get('/checkout', 'employee\EmployeeController@checkout');
    Route::post('/checkout/payment', 'employee\EmployeeController@payment');

    Route::post('/bank/success', 'employee\payments\BankController@success');
    Route::get('/esewa/success', 'employee\payments\EsewaController@success');
    Route::post('/khalti/verify', 'employee\payments\KhaltiController@verify');
    Route::get('/invoice', 'employee\InvoiceController@index');
    Route::get('/event/report', 'employee\EmployeeController@invoice');
    Route::get('/invoice/view/{invoice}', 'employee\InvoiceController@show');
    Route::get('/invoice/delete/{invoice_id}', 'employee\InvoiceController@delete');
    Route::post('/invoice/add-history', 'employee\InvoiceController@addHistory');
    Route::get('/invoice/print/{invoice}', 'employee\InvoiceController@print');
  });



Route::group(['prefix' => 'employer'], function () {
        Route::get('/', 'employer\EmployerController@dashboard');
        Route::get('/dashboard', ['as'=>'employer.dashboard','uses'=>'employer\EmployerController@dashboard']);
        Route::get('/purna', 'employer\EmployerController@testdash');
        Route::get('/viewprofile', 'employer\EmployerController@profile');
        Route::get('/changepassword', 'employer\EmployerController@changePassword');
        Route::post('/updatelogin', 'employer\EmployerController@updatelogin');
        Route::get('/editprofile', 'employer\EmployerController@editProfile');
        Route::get('/feditprofile', 'employer\EmployerController@feditProfile');




        Route::get('/cart', 'employer\EmployerController@cart');

        Route::get('/esewa/success', 'employer\payments\EsewaController@success');
        Route::post('/bank/success', 'employer\payments\BankController@success');

       Route::get('/checkout', 'employer\EmployerController@checkout');

       Route::post('/checkout/payment', 'employer\EmployerController@payment');


        Route::get('/filemanager', 'employer\FileController@index');
            Route::post('//filemanager/upload', 'employer\FileController@upload');
            Route::post('/filemanager/folder', 'employer\FileController@folder');
            Route::get('/filemanager/delete', 'employer\FileController@delete');
            Route::get('/filemanager/select_multiple', 'employer\FileController@select_multiple');


        Route::match(['get', 'post'],'/enroll/addnew', 'employer\EnrollController@addnew')->name('enroll.addnew');
        Route::get('/enroll/payment-detail', 'employer\EnrollController@paymentDetail');
        Route::get('/enroll/all-detail', 'employer\EnrollController@enrollDetail');
        Route::get('/enroll/all-delete/{id}', 'employer\EnrollController@deleteEnroll');
        Route::get('/enroll/edit/{id}', 'employer\EnrollController@editEnroll');
        Route::post('/enroll/update/{id}', 'employer\EnrollController@updateEnroll')->name('enroll-update-nroll');
        Route::get('/enroll/delete-booth/{id}', 'employer\EnrollController@deleteBooth');


        Route::get('/enroll/delete/{id}', 'employer\EnrollController@delete');
        Route::get('/enroll/get-booth-type/{id}', 'employer\EnrollController@getBoothType');
        Route::get('/enroll/get-booth-price/{id}', 'employer\EnrollController@getBoothPrice');

        //Payment
        Route::post('/booth/reserve', 'employer\IndividualEnrollCartController@addToIndividualCart')->name('booth-reserve');
        Route::get('/booth/cart', 'employer\IndividualEnrollCartController@showCart');
        Route::post('/booth/khalti/verify', 'employer\payments\KhaltiController@verify');
        Route::get('/enroll/report', 'employer\EnrollInvoiceController@invoiceEnroll');
        Route::get('/enroll-invoice/view/{invoice}', 'employer\EnrollInvoiceController@show');
        Route::get('/enroll-invoice/print/{invoice}', 'employer\EnrollInvoiceController@print');

        //Chat
        Route::get('/get_participate_users', 'employer\EnrollController@getParticipateUsers');
        Route::get('/get_chat_box/{id}', 'employer\EnrollController@GetChatBox');
        Route::post('/send-message', 'employer\EnrollController@sendMessage');
        //

        //enroll dashboard, livestrea,
        Route::get('/dashboard/enroll', 'employer\EnrollController@dashboard');
        Route::get('/enroll/livestream/{slug}', 'employer\EnrollController@checkLivestreamPlatform');
        Route::post('/enroll/livestream/{slug}/store-stime', 'employer\EnrollController@storeStartTime');
        Route::post('/enroll/livestream/{slug}/store-etime', 'employer\EnrollController@storeEndTime');

        //Zoom
        Route::get('/enroll/zoom-videocall/{slug}', 'employer\EnrollController@zoomVideoCall');
        Route::get('/access', 'employer\EnrollController@access');

        //videocall
        Route::get('/enroll/video-call/{slug}','employer\EnrollController@checkVideoCallPlatform');
        Route::post('/enroll/video-call/{slug}', 'employer\EnrollController@saveVideoCallChannel');
        Route::delete('/enroll/video-call/finish/{slug}', 'employer\EnrollController@deleteVideoCallChannel');


        //end

        Route::get('/event', 'employer\EventController@index');
        Route::get('/event/addnew', 'employer\EventController@addnew');
        Route::post('/event/save', 'employer\EventController@save');
        Route::get('/event/delete/{id}', 'employer\EventController@delete');
        Route::get('/event/edit/{id}', 'employer\EventController@edit');
        Route::post('/event/update', 'employer\EventController@update');

          Route::get('/training', 'employer\TrainingController@index');
        Route::get('/training/addnew', 'employer\TrainingController@addnew');
        Route::post('/training/save', 'employer\TrainingController@save');
        Route::get('/training/delet/{id}', 'employer\TrainingController@delete');
        Route::get('/training/edit/{id}', 'employer\TrainingController@edit');
        Route::post('/training/update', 'employer\TrainingController@update');





    });




Auth::routes();

Route::get('/faq/{type}', 'front\FaqController@index');

Route::get('/women','front\WomenController@index');
Route::get('/able','front\WomenController@able');
Route::get('/retired','front\WomenController@retaired');
Route::get('/blogs/{category_id}/{category}','front\BlogController@categoryBlog');
Route::get('/blog/{category}/{seo_url}','front\BlogController@blogDetail');
Route::post('/comments/blog', 'front\BlogController@postComment');
Route::post('/comments/blog/like', 'front\BlogController@LikeDislike');


Route::get('/skill-test', 'front\SkillTestController@index');
Route::post('/skill-test/test/get-question', 'front\SkillTestController@getQuestion');
Route::get('/skill-test/finish-test', 'front\SkillTestController@finishTest');
Route::get('/skill-test/{exam}', 'front\SkillTestController@getTest');
Route::post('/skill-test/submit-answer', 'front\SkillTestController@submitAnswer');
Route::post('/skill-test/post-comment', 'front\SkillTestController@postComment');
Route::get('/tenders', 'front\TendersController@index');
 Route::get('/tenders/business/{url}', 'front\TendersController@employer');
 Route::get('/tenders/{tender}', 'front\TendersController@detail');
 Route::get('/tenders/category', 'front\TendersController@category');
 Route::get('/tenders/category/{category}', 'front\TendersController@categoryTender');
 Route::get('/tenders/search/{search}', 'front\TendersController@searchTender');

Route::get('/projects', 'front\ProjectsController@index');
 Route::get('/projects/business/{url}', 'front\ProjectsController@employer');
 Route::get('/projects/{project}', 'front\ProjectsController@detail');
 Route::get('/projects/category', 'front\ProjectsController@category');
 Route::get('/projects/category/{category}', 'front\ProjectsController@categoryProject');
 Route::get('/projects/search/{search}', 'front\ProjectsController@searchProject');
 Route::get('/projects/tags/{tags}', 'front\ProjectsController@tagsProject');
  Route::get('/projects/bidder_detail/{id}', 'front\ProjectsController@BidderDetail');
  Route::post('/projects/bidder_detail/comment', 'front\ProjectsController@BidderComment');



    //Ganga
    Route::get('/enroll/{slug}', 'front\EnrollController@show')->name('enroll_singlepage.show');
    Route::get('/enroll/company/{slug}', 'front\EnrollController@homePage')->name('enroll_companyDetail.homepage');


    Route::get('/enroll/company/{slug}/show-business-user/{id}', 'front\EnrollController@getBusinessUser');
    Route::get('/enroll/company/{slug}/get_chat_box/{id}', 'front\EnrollController@GetChatBox');
    Route::post('/enroll/company/{slug}/send-message', 'front\EnrollController@sendMessage');

    // Route::get('/enroll/business-profile/download/{id}','front\EnrollController@downloadBusinessProfile')->name('downlaod.businessprofile');

    //LiveStreaming
    Route::get('/enroll/audience/{slug}', 'front\EnrollController@joinLiveStream')->name('enroll.audience');
    Route::post('/enroll/audience/{slug}','front\EnrollController@updateJoinedLivestream');
    Route::post('/enroll/audience/{slug}/leave', 'front\EnrollController@streamLeave');

    // Group Video call
    Route::get('/enroll/group-video/{slug}', 'front\EnrollController@joinVideoCallChannel');
    Route::post('/enroll/group-video/{slug}', 'front\EnrollController@updateJoinVideoCall');
    Route::post('/enroll/group-video/leave', 'front\EnrollController@leaveVideoCall');


    //end here


    Route::get('/events/enroll', 'front\EnrollController@index');

 Route::get('/events', 'front\EventsController@index');
 Route::get('/events/business/{url}', 'front\EventsController@employer');
 Route::get('/events/{event}', 'front\EventsController@detail');
 Route::get('/events/category', 'front\EventsController@category');
 Route::get('/events/category/{category}', 'front\EventsController@categoryEvent');
 Route::get('/events/search/{search}', 'front\EventsController@searchEvent');

 Route::get('/trainings', 'front\TrainingsController@index');
 Route::get('/trainings/business/{url}', 'front\TrainingsController@employer');
 Route::get('/trainings/{training}', 'front\TrainingsController@detail');
 Route::get('/trainings/category', 'front\TrainingsController@category');
 Route::get('/trainings/category/{category}', 'front\TrainingsController@categoryTraining');
  Route::get('/trainings/search/{search}', 'front\TrainingsController@searchTraining');


    Route::get('/admin/filemanager', 'FileController@index');
    Route::get('/business/{url}', 'front\EmployerController@detail');
    Route::post('/admin/filemanager/upload', 'FileController@upload');
    Route::post('/admin/filemanager/folder', 'FileController@folder');
    Route::get('/admin/filemanager/delete', 'FileController@delete');
    Route::get('/admin/filemanager/select_multiple', 'FileController@select_multiple');
    Route::get('/admin/invoice', 'admin\InvoiceController@index');
    Route::get('/admin/invoice/view/{invoice}', 'admin\InvoiceController@show');
    Route::get('/admin/invoice/delete/{invoice_id}', 'admin\InvoiceController@delete');
    Route::post('/admin/invoice/add-history', 'admin\InvoiceController@addHistory');
    Route::get('/admin/invoice/print/{invoice}', 'admin\InvoiceController@print');

    Route::get('employee/login', 'employee\EmployeeLoginController@getLogin');

    Route::get('employee/poplogin', 'employee\EmployeeLoginController@popLogin');
    Route::get('employee/register', 'employee\EmployeeLoginController@getregister');
    Route::post('employer/register/getName', 'employer\EmployerLoginController@getName');
    Route::get('employee/validate-email', 'employee\EmployeeLoginController@regValidation');
     Route::get('employer/validate-email', 'employer\EmployerLoginController@regValidation');

    Route::post('employee/register', 'employee\EmployeeLoginController@register');
    Route::get('employer/login', 'employer\EmployerLoginController@getLogin');
    Route::get('admin/login', 'admin\AdminLoginController@getLogin');
    Route::post('employer/login', 'employer\EmployerLoginController@employerAuth');
    Route::post('employee/login', 'employee\EmployeeLoginController@employeeAuth');
    Route::post('employee/poplogin', 'employee\EmployeeLoginController@employeePop');
    Route::post('admin/login', 'admin\AdminLoginController@adminAuth');
    Route::post('employee/logout', 'employee\EmployeeLoginController@logout');
    Route::get('employee/logout', 'employee\EmployeeLoginController@logout');
     Route::get('employer/logout', 'employer\EmployerLoginController@logout');

     Route::post('employer/password/email', 'employer\EmployerLoginController@validateemail');
      Route::post('employee/password/email', 'employee\EmployeeLoginController@validateemail');

     Route::get('employee/password', 'employee\EmployeeLoginController@askemail');
     Route::get('employer/password', 'employer\EmployerLoginController@askemail');

     Route::get('employer/passwordreset', 'employer\EmployerLoginController@passwordreset');
     Route::get('employee/passwordreset', 'employee\EmployeeLoginController@passwordreset');

     Route::post('employer/password/reset', 'employer\EmployerLoginController@resetpassword');
     Route::post('employee/password/reset', 'employee\EmployeeLoginController@resetpassword');
     Route::get('jobapply', 'front\JobController@jobapply');
     Route::post('jobs/review', 'front\JobController@review');
     Route::post('jobs/apply', 'front\JobController@apply');
     Route::get('/jobs/search', 'front\JobController@searchJob');

      Route::get('employer/register', 'employer\EmployerLoginController@getregister');
        Route::post('employer/register', 'employer\EmployerLoginController@postregister');

    Route::get('marketer/login', 'marketer\MarketerLoginController@getLogin');
    Route::get('marketer/validate-email', 'marketer\MarketerLoginController@regValidation');
    Route::post('marketer/login', 'marketer\MarketerLoginController@marketerAuth');
    Route::post('marketer/logout', 'marketer\MarketerLoginController@logout');
    Route::post('marketer/password/email', 'marketer\MarketerLoginController@validateemail');
    Route::get('marketer/password', 'marketer\MarketerLoginController@askemail');
    Route::get('marketer/passwordreset', 'marketer\MarketerLoginController@passwordreset');
    Route::post('marketer/password/reset', 'marketer\MarketerLoginController@resetpassword');

    Route::post('/getfaculty', 'front\JobController@getfaculty');
     Route::get('/referencevalidation', 'front\ReferenceController@index');
     Route::post('/referencevalidation/save', 'front\ReferenceController@save');
     Route::get('/reference/success', 'front\ReferenceController@success');
    Route::get('/', 'front\Common\HomeController@index');
Route::get('/home', 'front\Common\HomeController@index')->name('home');

Route::get('/jobs', 'front\JobsController@index');
Route::post('/addInquery', 'front\ContactController@inquery');
Route::post('/refer_friend', 'front\ContactController@referFriend');
Route::post('/addContact', 'front\ContactController@save');
Route::get('/photo/{data}', 'front\PhotoGalleryController@index');
Route::get('/video/{data}', 'front\VideoDisplayController@index');
Route::get('/web/success', 'front\JobController@success');
Route::get('/web/article/{href}', 'front\ArticleController@index');
Route::get('/web/{href}', 'front\MenuController@index');
Route::get('/careers', 'front\StatusController@careers');
Route::get('/status', 'front\EmployerController@status');
Route::get('/jobs/validate-email', 'front\JobController@validateEmail');
Route::get('/googlemap', 'front\GooglemapController@index');
Route::get('/{url}', 'front\EmployerController@detail');
Route::get('/jobs/categories', 'front\JobController@JobCategories');
  Route::get('/jobs/category/{category}', 'front\JobController@categoryJobs');
  Route::get('/jobs/function/{function}', 'front\JobController@functionJobs');
  Route::get('/jobs/location/{location}', 'front\JobController@locationJobs');
  Route::get('/jobs/types/{type}', 'front\JobController@typesJobs');
 Route::get('/jobs/{employer}/{job}', 'front\JobController@detail');
 Route::get('/business/blog/{url}/{blog}','front\EmployerController@blogDetail');
Route::get('/sitemap/generate/new',function(){
    SitemapGenerator::create('http://rollingnexus.com')->writeToFile('sitemap.xml');
    return 'Generated';
});
Route::post('fetch-url', 'front\HomeController@FetchUrl');

