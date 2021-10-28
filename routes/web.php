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


Auth::routes();
Route::group(['middleware' => 'prevent-back-history'],function(){
	// front pages
Route::match(['get', 'post'], '/', 'Front@index')->name('index');

Route::get('/aboutus', 'Front@aboutus')->name('aboutus');
Route::get('/listings', 'Front@listings');
Route::get('/bricks_listing', 'Front@bricks_listing');
Route::get('/brickdetails/{id}', 'Front@brick_details');
Route::get('/brands_listing', 'Front@brands_listing');
Route::get('/logout', 'Front@logout');
Route::get('/branddetails/{id}', 'Front@brands_details');
Route::get('/full_space_listing', 'Front@full_space_listing');
Route::get('/fullspacedetails/{id}', 'Front@fullspace_details');
Route::get('/partial_space_listing', 'Front@partial_space_listing');
Route::get('/partialspacedetails/{id}', 'Front@partialspace_details');
Route::get('/popup_store_listing', 'Front@popup_store_listing');
Route::get('/popupstoredetails/{id}', 'Front@popupstore_details');
Route::get('/event_fair_listing', 'Front@event_fair_listing');
Route::get('/eventdetails/{id}', 'Front@event_details');
Route::get('/categories', 'Front@categories')->name('categories');
Route::get('/resource', 'Front@resources')->name('resources');
Route::get('/resource_details/{id}', 'Front@resource_details')->name('resource_details');
Route::get('/contact', 'Front@contact')->name('contact');
Route::get('/help', 'Front@help')->name('help');
Route::get('/login', 'Front@login')->name('login');
Route::get('/signup', 'Front@signup')->name('signup');
Route::get('/forgot-password', 'Front@forgotpassword')->name('forgot-password');
Route::get('/privacy-policy', 'Front@privacypolicy')->name('privacy-policy');
Route::get('/terms-conditions', 'Front@termsconditions')->name('terms-conditions');
Route::post('/do_login', 'Front@do_login')->name('do_login');
Route::post('/do_signup', 'Front@do_signup')->name('do_signup');
Route::post('/do_contactus', 'Front@contactus')->name('do_contactus');
Route::post('/checking_user', 'Front@checking_user')->name('checking_user');
Route::post('/checking_user_forgot', 'Front@checking_user_forgot')->name('checking_user_forgot');
Route::post('/forgot_password', 'Front@forgot_password')->name('forgot_password');
Route::get('/resetpassword/{token}', 'Front@resetpassword')->name('resetpassword');
Route::get('/verify-email/{token}', 'Front@verify_email')->name('verify_email');
Route::post('/set_password', 'Front@set_password')->name('set_password');
Route::post('/search-resources', 'Front@search_resources')->name('search_resources');
Route::get('/view-profile/{id}', 'Front@view_profile')->name('view_profile');
Route::get('/featured-listing', 'Front@featured_listing');

// user pages
Route::get('/add-brick', 'User@addbrick')->name('add-brick');
Route::get('/add-brand', 'User@addbrand')->name('add-brand');
Route::get('/add-full-space-landlord', 'User@addfullspacelandlord')->name('add-full-space-landlord');
Route::get('/add-partial-space-landlord', 'User@addpartialspacelandlord')->name('add-partial-space-landlord');
Route::get('/add-popup-landlord', 'User@addpopuplandlord')->name('add-popup-landlord');
Route::get('/add-events-fairs-markets', 'User@addeventsfairsmarkets')->name('add-events-fairs-markets');
Route::get('/profile-settings', 'User@profilesettings')->name('profile-settings');
Route::get('/user-categories', 'User@categories')->name('user-categories');
Route::get('/user-bricks', 'User@userbricks')->name('user-bricks');
Route::get('/user-brands', 'User@userbrands')->name('user-brands');
Route::get('/user-full-space', 'User@userfullspace')->name('user-full-space');
Route::get('/user-partial-spaces', 'User@userpartialspaces')->name('user-partial-spaces');
Route::get('/user-popup-landloard', 'User@userpopuplandloard')->name('user-popup-landloard');
Route::get('/user-events-fairs', 'User@usereventsfairs')->name('user-events-fairs');
Route::get('/bookings', 'User@bookings')->name('bookings');
Route::get('/sent-bookings', 'User@sent_bookings')->name('sent-bookings');
Route::get('/partners', 'User@partners')->name('partners');
Route::get('/partner-details', 'User@partnerdetails')->name('partner-details');
Route::get('/transactions', 'User@transactions')->name('transactions');
Route::get('/pricing', 'User@pricing')->name('pricing');
Route::get('/payment-cards', 'User@paymentcards')->name('payment-cards');
Route::get('/add-retail-category', 'User@addretailcategory')->name('add-retail-category');
Route::get('/saved-searches', 'User@saved_searches')->name('saved-searches');
Route::post('/update_profile', 'User@update_profile')->name('update_profile');
Route::get('/edit-brick/{brick_id}', 'User@edit_brick')->name('edit_brick');
Route::get('/edit-brand/{brand_id}', 'User@edit_brand')->name('edit_brand');
Route::get('/edit-full-space-landlord/{fullspace_id}', 'User@edit_fullspace')->name('edit_fullspace');
Route::get('/edit-partial-space-landlord/{partialspace_id}', 'User@edit_partialspace')->name('edit_partialspace');
Route::get('/edit-popup-landlord/{popup_id}', 'User@edit_popuplandlord')->name('edit_popuplandlord');
Route::get('/edit-events-fairs-markets/{eventfairs_id}', 'User@edit_eventsfairs')->name('edit_eventsfairs');
Route::post('/save_card', 'User@save_card')->name('save_card');
Route::post('/add_resource_comment', 'User@add_resource_comment')->name('add_resource_comment');
Route::post('/delete_card', 'User@delete_card')->name('delete_card');
Route::post('/delete_search_history', 'User@delete_search_history')->name('delete_search_history');

//listing start here
Route::post('/upload_files', 'Listing@upload_files')->name('upload_files');
Route::post('/upload_resource_files', 'Listing@upload_resource_files')->name('upload_resource_files');
Route::post('/delete_listing_image', 'Listing@delete_listing_image')->name('delete_listing_image');
Route::post('/delete_listing', 'Listing@delete_listing')->name('delete_listing');
Route::post('/add_brand', 'Listing@add_brand')->name('add_brand');
Route::post('/add_fullspace', 'Listing@add_fullspace')->name('add_fullspace');
Route::post('/add_partialspace', 'Listing@add_partialspace')->name('add_partialspace');
Route::post('/add_events_fairs', 'Listing@add_events_fairs')->name('add_events_fairs');
Route::post('/add_brickform', 'Listing@add_brickform')->name('add_brickform');
Route::post('/add_popuplandlord', 'Listing@add_popuplandlord')->name('add_popuplandlord');
Route::post('/get_brand_detals_ajax', 'Listing@get_brand_detals_ajax')->name('get_brand_detals_ajax');
Route::post('/get_listing_details_ajax', 'Listing@get_listing_details_ajax')->name('get_listing_details_ajax');
Route::post('/get_listing_details_associated_ajax', 'Listing@get_listing_details_associated_ajax')->name('get_listing_details_associated_ajax');
Route::post('/search_listing', 'Listing@search_listing')->name('search_listing');
Route::post('/load_more_listing', 'Listing@load_more_listing')->name('load_more_listing');
Route::post('/apply_listing', 'Listing@apply_listing')->name('apply_listing');
Route::post('/send_message', 'Listing@send_message')->name('send_message');
Route::post('/accept_reject_invite', 'Listing@accept_reject_invite')->name('accept_reject_invite');
Route::get('/chat/{booking_id}', 'Listing@chat')->name('chat');
Route::post('/save_listing_message', 'Listing@save_listing_message')->name('save_listing_message');
Route::post('/get_chat', 'Listing@get_chat')->name('get_chat');
Route::post('/update_booking_status', 'Listing@update_booking_status')->name('update_booking_status');
// Route::post('/searched-listings', 'Listing@searched_listings')->name('searched_listings');
Route::get('/searched-listings', 'Listing@searched_listings')->name('searched_listings');
Route::post('/get_members_dropdown', 'Listing@get_members_dropdown')->name('get_members_dropdown');

});



// admin pages
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
	Route::get('/', 'Front@admin_login')->name('admin_login');
	Route::post('/admin_do_login', 'Front@admin_do_login')->name('admin_do_login');
	Route::get('/dashboard', 'Admin@dashboard')->name('dashboard');
	Route::get('/users', 'Admin@users')->name('users');
	Route::get('/retail-users', 'Admin@retail_users')->name('retail_users');
	Route::get('/logout', 'Admin@logout')->name('logout');
	Route::post('/change_user_status', 'Admin@change_user_status')->name('change_user_status');
	Route::post('/change_cat_status', 'Admin@change_cat_status')->name('change_cat_status');
	Route::post('/change_tag_status', 'Admin@change_tag_status')->name('change_tag_status');
	Route::post('/change_ques_status', 'Admin@change_ques_status')->name('change_ques_status');
	Route::post('/change_resource_status', 'Admin@change_resource_status')->name('change_resource_status');
	Route::post('/change_partial_space_cat_status', 'Admin@change_partial_space_cat_status')->name('change_partial_space_cat_status');
	Route::post('/change_retail_cat_status', 'Admin@change_retail_cat_status')->name('change_retail_cat_status');
	Route::post('/change_ideal_cat_status', 'Admin@change_ideal_cat_status')->name('change_ideal_cat_status');
	Route::post('/change_amenities_cat_status', 'Admin@change_amenities_cat_status')->name('change_amenities_cat_status');
	Route::post('/change_space_cat_status', 'Admin@change_space_cat_status')->name('change_space_cat_status');
	Route::post('/change_comment_status', 'Admin@change_comment_status')->name('change_comment_status');
	Route::get('/add-user', 'Admin@add_user')->name('add_user');
	Route::get('/add-retail-user', 'Admin@add_retail_user')->name('add_retail_user');
	Route::get('/edit_user/{user_id}', 'Admin@edit_user')->name('add_user');
	Route::get('/edit_faq_cat/{user_id}', 'Admin@edit_faq_cat')->name('edit_faq_cat');
	Route::get('/edit_resource/{user_id}', 'Admin@edit_resource')->name('edit_resource');
	Route::get('/edit_tag/{user_id}', 'Admin@edit_tag')->name('edit_tag');
	Route::get('/edit-partial-space-category/{user_id}', 'Admin@edit_partial_space_cat')->name('edit_partial_space_cat');
	Route::get('/edit-retail-category/{user_id}', 'Admin@edit_retail_cat');
	Route::get('/edit-ideal-category/{user_id}', 'Admin@edit_ideal_cat');
	Route::get('/edit-amenities/{user_id}', 'Admin@edit_amenities');
	Route::get('/edit-space-category/{user_id}', 'Admin@edit_space_cat');
	Route::get('/edit_question/{user_id}', 'Admin@edit_question')->name('edit_question');
	Route::get('/faq/{cat_id}', 'Admin@faq')->name('faq');
	Route::get('/add-faq-cat', 'Admin@add_faq_category')->name('add_faq_category');
	Route::get('/add-faq-question/{id}', 'Admin@add_faq_question')->name('add_faq_category');
	Route::post('/add_new_user', 'Admin@add_new_user')->name('add_new_user');
	Route::post('/add_faq_cat', 'Admin@add_faq_cat')->name('add_faq_cat');
	Route::post('/add_edit_faq', 'Admin@add_edit_faq')->name('add_edit_faq');
	Route::get('/viewenquiry/{enq_id}', 'Admin@viewenquiry')->name('viewenquiry');
	Route::get('/brick-listings', 'Admin@listings')->name('listings');
	Route::get('/brand-listings', 'Admin@brand_listings')->name('brand_listings');
	Route::get('/full-space-listings', 'Admin@full_space_listings')->name('full_space_listings');
	Route::get('/partial-space-listings', 'Admin@partial_space_listings')->name('partial_space_listings');
	Route::get('/popup-store-listings', 'Admin@popup_store_listings')->name('popup_store_listings');
	Route::get('/event-fairs-listings', 'Admin@event_fairs_listings')->name('event_fairs_listings');
	Route::get('/locations', 'Admin@locations')->name('locations');
	Route::get('/bookings', 'Admin@bookings')->name('bookings');
	Route::get('/verifications', 'Admin@verifications')->name('verifications');
	Route::get('/enquiries', 'Admin@contactus')->name('contactus');
	Route::get('/flags', 'Admin@flags')->name('flags');
	Route::get('/transactions', 'Admin@transactions')->name('transactions');
	Route::get('/profile', 'Admin@profile')->name('profile');
	Route::get('/booking-details/{booking_id}', 'Admin@bookingdetails')->name('bookingdetails');
	Route::get('/report-details/{flag_id}', 'Admin@flagsdetails')->name('flagsdetails');
	Route::get('/transaction-details/{trans_id}', 'Admin@transactiondetails')->name('transactiondetails');
	Route::get('/edit_location/{location_id}', 'Admin@edit_location')->name('edit_location');
	Route::post('/change_listing_status', 'Admin@change_listing_status')->name('change_listing_status');
	Route::post('/remove_listing', 'Admin@remove_listing')->name('remove_listing');
	Route::post('/set_featured_listing', 'Admin@set_featured_listing')->name('set_featured_listing');
	Route::post('/delete_enquiry', 'Admin@delete_enquiry')->name('delete_enquiry');
	Route::post('/delete_flag', 'Admin@delete_flag')->name('delete_flag');
	Route::post('/edit_profile', 'Admin@edit_profile')->name('edit_profile');
	Route::post('/update_password', 'Admin@update_password')->name('update_password');
	Route::post('/delete_location', 'Admin@delete_location')->name('delete_location');
	Route::post('/update_location', 'Admin@update_location')->name('update_location');
	Route::post('/change_booking_status', 'Admin@change_booking_status')->name('change_booking_status');
	Route::post('/update_verification', 'Admin@update_verification')->name('update_verification');
	Route::get('/edit-brick/{location_id}', 'Admin@edit_brick')->name('edit_listing');
	Route::get('/edit-brand/{location_id}', 'Admin@edit_brand');
	Route::get('/edit-full-space/{location_id}', 'Admin@edit_full_space');
	Route::get('/edit-partial-space/{location_id}', 'Admin@edit_partial_space');
	Route::get('/edit-popup-store/{location_id}', 'Admin@edit_popup_store');
	Route::get('/edit-event-fairs/{location_id}', 'Admin@edit_event_fairs');
	Route::get('/resource-comments/{id}', 'Admin@resource_comments');
	Route::get('/verification-details/{ver_id}', 'Admin@verification_details')->name('verification_details');
	Route::get('/settings', 'Admin@settings')->name('settings');
	Route::get('/manageterms', 'Admin@manageterms')->name('manageterms');
	Route::get('/manageprivacy', 'Admin@manageprivacy')->name('manageprivacy');
	Route::get('/managehome', 'Admin@managehome')->name('managehome');
	Route::get('/manage-aboutus', 'Admin@manageaboutus')->name('manageaboutus');
	Route::get('/resources-tags', 'Admin@resourcestags')->name('resourcestags');
	Route::get('/faq-categories', 'Admin@faq_categories')->name('faq_categories');
	Route::post('/update_settings', 'Admin@update_settings')->name('update_settings');
    Route::post('/update_page_info', 'Admin@update_page_info')->name('update_page_info');
    Route::post('/check_tag_name', 'Admin@check_tag_name')->name('check_tag_name');
    Route::post('/check_partial_cat_name', 'Admin@check_partial_cat_name')->name('check_partial_cat_name');
    Route::post('/check_retail_cat_name', 'Admin@check_retail_cat_name')->name('check_retail_cat_name');
    Route::post('/check_ideal_cat_name', 'Admin@check_ideal_cat_name')->name('check_ideal_cat_name');
    Route::post('/check_space_cat_name', 'Admin@check_space_cat_name')->name('check_space_cat_name');
    Route::get('/resources-list', 'Admin@resourceslist')->name('resourceslist');
    Route::get('/partial-space-categories', 'Admin@partial_space_categories_list')->name('partial_space_categories_list');
    Route::get('/retail-categories', 'Admin@retail_categories_list');
    Route::get('/space-categories', 'Admin@space_categories_list');
    Route::get('/ideal-categories', 'Admin@ideal_categories_list');
    Route::get('/amenties', 'Admin@amenties_list');
    Route::post('/add_tag', 'Admin@add_tag')->name('add_tag');
    Route::post('/add_partial_cat', 'Admin@add_partial_cat')->name('add_partial_cat');
    Route::post('/add_retail_cat', 'Admin@add_retail_cat')->name('add_retail_cat');
    Route::post('/add_ideal_cat', 'Admin@add_ideal_cat')->name('add_ideal_cat');
    Route::post('/add_amenities_cat', 'Admin@add_amenities_cat')->name('add_amenities_cat');
    Route::post('/add_space_cat', 'Admin@add_space_cat')->name('add_space_cat');
    Route::post('/add_resource_submit', 'Admin@add_resource_submit')->name('add_resource_submit');
    Route::get('/add-resources-tag', 'Admin@add_resourcestag')->name('add_resourcestag');
    Route::get('/add-resource', 'Admin@add_resource')->name('add_resource');
    Route::get('/add-partial-space-category', 'Admin@add_partial_space_category')->name('add_partial_space_category');
    Route::get('/add-retail-category', 'Admin@add_retail_category')->name('add_retail_category');
    Route::get('/add-space-category', 'Admin@add_space_category')->name('add_space_category');
    Route::get('/add-ideal-category', 'Admin@add_ideal_category')->name('add_ideal_category');
    Route::get('/add-amenities', 'Admin@add_amenities_category')->name('add_amenities_category');
});


// retail pages
Route::group(['prefix' => 'retail', 'as' => 'retail.'], function () {
	Route::group(['middleware' => 'prevent-back-history'],function(){
	// front pages
		Route::match(['get', 'post'], '/', 'Retailfront@index')->name('index');
		Route::get('/aboutus', 'Retailfront@aboutus')->name('aboutus');
		Route::get('/listings', 'Retailfront@listings');
		Route::post('/add_meeting', 'Retailuser@add_meeting')->name('add_meeting');
		Route::get('/calender', 'Retailfront@calender');
		Route::get('/bricks_listing', 'Retailfront@bricks_listing');
		Route::get('/brickdetails/{id}', 'Retailfront@brick_details');
		Route::get('/brands_listing', 'Retailfront@brands_listing');
		Route::get('/logout', 'Retailfront@logout');
		Route::get('/branddetails/{id}', 'Retailfront@brands_details');
		Route::get('/full_space_listing', 'Retailfront@full_space_listing');
		Route::get('/fullspacedetails/{id}', 'Retailfront@fullspace_details');
		Route::get('/partial_space_listing', 'Retailfront@partial_space_listing');
		Route::get('/partialspacedetails/{id}', 'Retailfront@partialspace_details');
		Route::get('/popup_store_listing', 'Retailfront@popup_store_listing');
		Route::get('/popupstoredetails/{id}', 'Retailfront@popupstore_details');
		Route::get('/event_fair_listing', 'Retailfront@event_fair_listing');
		Route::get('/eventdetails/{id}', 'Retailfront@event_details');
		Route::get('/categories', 'Retailfront@categories')->name('categories');
		Route::get('/resource', 'Retailfront@resources')->name('resources');
		Route::get('/resource_details/{id}', 'Retailfront@resource_details')->name('resource_details');
		Route::get('/contact', 'Retailfront@contact')->name('contact');
		Route::get('/help', 'Retailfront@help')->name('help');
		Route::get('/login', 'Retailfront@login')->name('login');
		Route::get('/signup', 'Retailfront@signup')->name('signup');
		Route::get('/forgot-password', 'Retailfront@forgotpassword')->name('forgot-password');
		Route::get('/privacy-policy', 'Retailfront@privacypolicy')->name('privacy-policy');
		Route::get('/terms-conditions', 'Retailfront@termsconditions')->name('terms-conditions');
		Route::post('/do_login', 'Retailfront@do_login')->name('do_login');
		Route::post('/do_signup', 'Retailfront@do_signup')->name('do_signup');
		Route::post('/do_contactus', 'Retailfront@contactus')->name('do_contactus');
		Route::post('/checking_user', 'Retailfront@checking_user')->name('checking_user');
		Route::post('/checking_user_forgot', 'Retailfront@checking_user_forgot')->name('checking_user_forgot');
		Route::post('/forgot_password', 'Retailfront@forgot_password')->name('forgot_password');
		Route::get('/resetpassword/{token}', 'Retailfront@resetpassword')->name('resetpassword');
		Route::get('/verify-email/{token}', 'Retailfront@verify_email')->name('verify_email');
		Route::post('/set_password', 'Retailfront@set_password')->name('set_password');
		Route::post('/search-resources', 'Retailfront@search_resources')->name('search_resources');
		Route::get('/view-profile/{id}', 'Retailfront@view_profile')->name('view_profile');
		Route::get('/featured-listing', 'Retailfront@featured_listing');

		// user pages
		Route::get('/add-brick', 'Retailuser@addbrick')->name('add-brick');
		Route::get('/add-services', 'Retailuser@addservices')->name('add-services');
		Route::post('/add_service', 'Listing@add_service')->name('add_service');
		Route::get('/edit-service/{brand_id}', 'Retailuser@edit_service')->name('edit_service');
		Route::get('/user-services', 'Retailuser@userservices')->name('user-services');
		Route::get('/add-brand', 'Retailuser@addbrand')->name('add-brand');
		Route::get('/add-full-space-landlord', 'Retailuser@addfullspacelandlord')->name('add-full-space-landlord');
		Route::get('/add-partial-space-landlord', 'Retailuser@addpartialspacelandlord')->name('add-partial-space-landlord');
		Route::get('/add-popup-landlord', 'Retailuser@addpopuplandlord')->name('add-popup-landlord');
		Route::get('/add-events-fairs-markets', 'Retailuser@addeventsfairsmarkets')->name('add-events-fairs-markets');
		Route::get('/profile-settings', 'Retailuser@profilesettings')->name('profile-settings');
		Route::get('/user-categories', 'Retailuser@categories')->name('user-categories');
		Route::get('/user-bricks', 'Retailuser@userbricks')->name('user-bricks');
		Route::get('/user-brands', 'Retailuser@userbrands')->name('user-brands');
		Route::get('/user-full-space', 'Retailuser@userfullspace')->name('user-full-space');
		Route::get('/user-partial-spaces', 'Retailuser@userpartialspaces')->name('user-partial-spaces');
		Route::get('/user-popup-landloard', 'Retailuser@userpopuplandloard')->name('user-popup-landloard');
		Route::get('/user-events-fairs', 'Retailuser@usereventsfairs')->name('user-events-fairs');
		Route::get('/bookings', 'Retailuser@bookings')->name('bookings');
		Route::get('/sent-bookings', 'Retailuser@sent_bookings')->name('sent-bookings');
		Route::get('/partners', 'Retailuser@partners')->name('partners');
		Route::get('/partner-details', 'Retailuser@partnerdetails')->name('partner-details');
		Route::get('/transactions', 'Retailuser@transactions')->name('transactions');
		// Route::get('/pricing', 'Retailuser@pricing')->name('pricing');
		Route::get('/pricing', 'Listing@pricing')->name('pricing');
		Route::get('/payment-cards', 'Retailuser@paymentcards')->name('payment-cards');
		Route::get('/add-retail-category', 'Retailuser@addretailcategory')->name('add-retail-category');
		Route::get('/saved-searches', 'Retailuser@saved_searches')->name('saved-searches');
		Route::post('/update_profile', 'Retailuser@update_profile')->name('update_profile');
		Route::get('/edit-brick/{brick_id}', 'Retailuser@edit_brick')->name('edit_brick');
		Route::get('/edit-brand/{brand_id}', 'Retailuser@edit_brand')->name('edit_brand');
		Route::get('/edit-full-space-landlord/{fullspace_id}', 'Retailuser@edit_fullspace')->name('edit_fullspace');
		Route::get('/edit-partial-space-landlord/{partialspace_id}', 'Retailuser@edit_partialspace')->name('edit_partialspace');
		Route::get('/edit-popup-landlord/{popup_id}', 'Retailuser@edit_popuplandlord')->name('edit_popuplandlord');
		Route::get('/edit-events-fairs-markets/{eventfairs_id}', 'Retailuser@edit_eventsfairs')->name('edit_eventsfairs');
		Route::post('/save_card', 'Retailuser@save_card')->name('save_card');
		Route::post('/add_resource_comment', 'Retailuser@add_resource_comment')->name('add_resource_comment');
		Route::post('/delete_card', 'Retailuser@delete_card')->name('delete_card');
		Route::post('/delete_search_history', 'Retailuser@delete_search_history')->name('delete_search_history');
		Route::get('/messages/{brick_id}', 'Retailuser@brickMessages')->name('messages');

		//listing start here
		Route::post('/upload_files', 'Listing@upload_files')->name('upload_files');
		Route::post('/delete_listing_image', 'Listing@delete_listing_image')->name('delete_listing_image');
		Route::post('/delete_listing_res_image', 'Listing@delete_listing_res_image')->name('delete_listing_res_image');
		Route::post('/delete_listing', 'Listing@delete_listing')->name('delete_listing');
		Route::post('/add_brand', 'Listing@add_brand')->name('add_brand');
		Route::post('/add_fullspace', 'Listing@add_fullspace')->name('add_fullspace');
		Route::post('/add_partialspace', 'Listing@add_partialspace')->name('add_partialspace');
		Route::post('/add_events_fairs', 'Listing@add_events_fairs')->name('add_events_fairs');
		Route::post('/add_brickform', 'Listing@add_brickform')->name('add_brickform');
		Route::post('/add_popuplandlord', 'Listing@add_popuplandlord')->name('add_popuplandlord');
		Route::post('/get_brand_detals_ajax', 'Listing@get_brand_detals_ajax')->name('get_brand_detals_ajax');
		Route::post('/get_listing_details_ajax', 'Listing@get_listing_details_ajax')->name('get_listing_details_ajax');
		Route::post('/get_listing_details_associated_ajax', 'Listing@get_listing_details_associated_ajax')->name('get_listing_details_associated_ajax');
		Route::post('/search_listing', 'Listing@search_listing')->name('search_listing');
		Route::post('/load_more_listing', 'Listing@load_more_listing')->name('load_more_listing');
		Route::post('/apply_listing', 'Listing@apply_listing')->name('apply_listing');
		Route::post('/accept_reject_invite', 'Listing@accept_reject_invite')->name('accept_reject_invite');
		Route::get('/chat/{booking_id}', 'Listing@chat')->name('chat');
		Route::post('/save_listing_message', 'Listing@save_listing_message')->name('save_listing_message');
		Route::post('/get_chat', 'Listing@get_chat')->name('get_chat');
		Route::post('/update_booking_status', 'Listing@update_booking_status')->name('update_booking_status');
		// Route::post('/searched-listings', 'Listing@searched_listings')->name('searched_listings');
		Route::get('/searched-listings', 'Listing@searched_listings')->name('searched_listings');
		Route::post('/get_members_dropdown', 'Listing@get_members_dropdown')->name('get_members_dropdown');
		//group chat
		Route::get('/groups', 'Listing@add_group')->name('add-group');
		Route::post('/save-group', 'Listing@save_group')->name('save-group');
		Route::get('/invite-group-users/{group_id}', 'Listing@invite_group_members')->name('invite-group-users');
		Route::post('/save-group-users', 'Listing@add_group_users')->name('save-group-users');
		Route::get('/group-chat/{group_id}', 'Listing@group_chat')->name('group-chat');
		Route::post('/get-group-chat', 'Listing@get_group_chat')->name('get-group-chat');
		Route::post('/save-group-msg', 'Listing@save_group_msgs')->name('save-group-msg');
		Route::post('/left-group', 'Listing@left_group')->name('left-group');
		Route::post('/delete-msg', 'Listing@deleteMsg')->name('delete-msg');
		

		//File Tab
		Route::post('/upload-file', 'FilesController@uploadFiles')->name('upload-file');
		Route::post('/get-files', 'FilesController@getChatFiles')->name('get-files');
		
		Route::post('/mark-as-read', 'Listing@mark_as_read')->name('mark-as-read');

		//Reminders
		Route::get('/create-reminder', 'Listing@create_reminder')->name('create-reminder');
		Route::post('/save-reminder', 'Listing@save_reminder')->name('save-reminder');

		//Calendar
		Route::get('/get-calendar', 'Retailfront@getCalendar')->name('get-calendar');
		
		//Member tasks
		Route::get('member-task', 'MemberTask@index')->name('member.task');
		Route::get('member-task/setting/{task_id?}','MemberTask@createEdit')->name('member.task.create-edit');
		Route::post('member-task/setting','MemberTask@storeUpdate')->name('member.task.store-update');
		Route::get('member-task/delete/{task_id?}','MemberTask@delete')->name('member.task.delete');
		Route::post('/get-member-task', 'Retailfront@getTasks')->name('get-member-task');
		Route::post('/update-note', 'Retailfront@updateNote')->name('update-note');
		Route::post('/get-task-note', 'Retailfront@getTaskNote')->name('get-task-note');
		Route::post('/complete-task', 'MemberTask@completeTask')->name('complete-task');
		Route::post('/save-task-msg', 'MemberTask@save_task_msgs')->name('save-task-msg');
		Route::post('/get-task-by-id', 'MemberTask@getTaskById')->name('get-task-by-id');


		//Member appointments
		Route::get('member-appointment/{group_id}', 'MemberAppointment@index')->name('member.appointment');
		Route::get('member-appointment/setting/{group_id}/{appointment_id?}','MemberAppointment@createEdit')->name('member.appointment.create-edit');
		Route::post('member-appointment/setting','MemberAppointment@storeUpdate')->name('member.appointment.store-update');
		Route::get('member-appointment/delete/{group_id?}/{appointment_id?}','MemberAppointment@delete')->name('member.appointment.delete');

		Route::get('brick-group-members','Retailuser@brick_list_members')->name('brick.members');
		Route::post('update-brick-members','Retailuser@update_brick_members')->name('update-brick-members');
		Route::post('add-brick-member','Retailuser@addBrickMembers')->name('add-brick-member');
	});
});
