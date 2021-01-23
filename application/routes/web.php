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

Route::get('/', 'website\ShowDataController@index');
Route::get('/index', 'website\ShowDataController@index')->name('indexpage');

Route::get('/slider-details/{id}', 'website\ShowDataController@slider_details')->name('slider-page');
Route::get('/about-history', 'website\ShowDataController@about_history')->name('about-history-page');
Route::get('/academic-calendar', 'website\ShowDataController@academic_calendar')->name('academic-calendar-page');
Route::get('/admission-circular', 'website\ShowDataController@admission_circular')->name('admission-circular-page');
Route::get('/admission-form', 'website\ShowDataController@admission_form')->name('admission-form-page');
Route::get('/admission-result', 'website\ShowDataController@admission_result')->name('admission-result-page');
Route::get('/book-list-and-syllabust', 'website\ShowDataController@book_list_and_syllabus')->name('book-list-and-syllabus-page');
Route::get('/class-routine', 'website\ShowDataController@class_routine')->name('class-routine-page');
Route::post('/showClassRoutins', 'website\ShowDataController@showClassRoutins')->name('showClassRoutins');
Route::get('/contact-us', 'website\ShowDataController@contact_us')->name('contact-us-page');
Route::get('/dress-code', 'website\ShowDataController@dress_code')->name('dress-code-page');
Route::get('/event', 'website\ShowDataController@event')->name('event-page');
Route::get('/event-description/{id}', 'website\ShowDataController@event_description')->name('event-description-page');
Route::get('/exam-routine', 'website\ShowDataController@exam_routine')->name('exam-routine-page');
Route::post('/showExamSchedule', 'website\ShowDataController@showExamSchedule')->name('showExamSchedule');
Route::get('/facilities', 'website\ShowDataController@facilities')->name('facilities-page');
Route::get('/fees-and-payments', 'website\ShowDataController@fees_and_payments')->name('fees-and-payments-page');
Route::get('/gallery', 'website\ShowDataController@gallery')->name('gallery-page');
Route::get('/governing-Body', 'website\ShowDataController@governing_Body')->name('governing-Body-page');
Route::get('/infrastructure', 'website\ShowDataController@infrastructure')->name('infrastructure-page');
Route::get('/it', 'website\ShowDataController@it')->name('it-page');
Route::get('/library', 'website\ShowDataController@library')->name('library-page');
Route::get('/mission-vision', 'website\ShowDataController@mission_vision')->name('mission-vision-page');

Route::get('/news', 'website\ShowDataController@news')->name('news-page');
Route::get('/news-description/{id}', 'website\ShowDataController@news_description')->name('news-description-page');

Route::get('/notice', 'website\ShowDataController@notice')->name('notice-page');
Route::get('/notice-description/{id}', 'website\ShowDataController@notice_description')->name('notice-description-page');

Route::get('/policies-and-guidelines', 'website\ShowDataController@policies_and_guidelines')->name('policies-and-guidelines-page');
Route::get('/chairman-message', 'website\ShowDataController@chairman_message')->name('chairman-message-page');
Route::get('/presidency-message', 'website\ShowDataController@presidency_message')->name('presidency-message-page');
Route::get('/principal-message', 'website\ShowDataController@principal_message')->name('principal-message-page');
Route::get('/prospectus', 'website\ShowDataController@prospectus')->name('prospectus-page');
Route::get('/result', 'website\ShowDataController@result')->name('result-page');
Route::get('/scholarships', 'website\ShowDataController@scholarships')->name('scholarships-page');
Route::get('/teachers-and-staffs', 'website\ShowDataController@teachers_and_staffs')->name('teachers-and-staffs-page');
Route::get('/teacher-details-page/{id}', 'website\ShowDataController@teacher_details')->name('teacher-details-page');
Route::post('/changelanguage', 'website\ShowDataController@changelanguage')->name('changelanguage');


Route::post('/saveAdmissionForm', 'website\ShowDataController@saveAdmissionForm')->name('saveAdmissionForm');


//Website ajax part
Route::get('/find_schedule/{id}','website\ShowDataController@find_schedule')->name('find_schedule');
Route::get('/find_sections/{id}','website\ShowDataController@find_sections')->name('find_sections');



Auth::routes();
Route::group(['middleware' => 'auth'], function(){

    //Website Admin login

     Route::get('/add_links', 'web_admin\ShowDataController@add_links')->name('add_links');
     Route::get('/manage_links', 'web_admin\ShowDataController@manage_links')->name('manage_links');
     Route::post('/submitLinks', 'web_admin\AddDataController@submitLinks')->name('submitLinks');
     Route::get('/edit_links/{id}', 'web_admin\ShowDataController@edit_links')->name('edit_links');
     Route::post('/updateLinks', 'web_admin\EditDataController@updateLinks')->name('updateLinks');
     Route::get('/delete_links/{id}', 'web_admin\DeleteDataController@delete_links')->name('delete_links');

     Route::get('/add-slider-page', 'web_admin\ShowDataController@add_slider')->name('add-slider-web');
     Route::get('/slider-page', 'web_admin\ShowDataController@slider')->name('slider-web');
     Route::get('/slider-description-page/{id}', 'web_admin\ShowDataController@slider_description')->name('slider-description-web');
     Route::get('/update-slider-page/{id}', 'web_admin\ShowDataController@update_slider')->name('update-slider-web');
     Route::get('/delete-slider-page/{id}', 'web_admin\DeleteDataController@delete_slider')->name('delete-slider-web');

     Route::get('/history-page', 'web_admin\ShowDataController@history')->name('history-web');
     Route::get('/update-history-page/{id}', 'web_admin\ShowDataController@update_history')->name('update-history-web');

     Route::get('/chairman-message-page', 'web_admin\ShowDataController@chairman_message')->name('chairman-message-web');
     Route::get('/update-chairman-message-page/{id}', 'web_admin\ShowDataController@update_chairman_message')->name('update-chairma-message-web');
     Route::get('/principal-message-page', 'web_admin\ShowDataController@principal_message')->name('principal-message-web');
     Route::get('/update-principal-message-page/{id}', 'web_admin\ShowDataController@update_principal_message')->name('update-principal-message-web');
     Route::get('/presidency-message-page', 'web_admin\ShowDataController@presidency_message')->name('presidency-message-web');
     Route::get('/update-presidency-message-page/{id}', 'web_admin\ShowDataController@update_presidency_message')->name('update-presidency-message-web');
     Route::get('/mission-vision-page', 'web_admin\ShowDataController@mission_vision')->name('mission-vision-web');
     Route::get('/update-mision-vision-page/{id}', 'web_admin\ShowDataController@update_mission_vision')->name('update-mision-vision-web');

     Route::get('/governing-body-page', 'web_admin\ShowDataController@governing_body')->name('governing-body-web');
     Route::get('/add-governing-body-page', 'web_admin\ShowDataController@add_governing_body')->name('add-governing-body-web');
     Route::get('/update-governing-body-page/{id}', 'web_admin\ShowDataController@update_governing_body')->name('update-governing-body-web');
     Route::get('/delete-governing-body-page/{id}', 'web_admin\DeleteDataController@delete_governing_body')->name('delete-governing-body-web');


     Route::get('/infrstructure-page', 'web_admin\ShowDataController@infrstructure')->name('infrstructure-web');
     Route::get('/update-infrastructure-page/{id}', 'web_admin\ShowDataController@update_infrstructure')->name('update-infrastructure-web');


     Route::get('/dress-code-page', 'web_admin\ShowDataController@dress_code')->name('dress-code-web');
     Route::get('/update-dress-code-page/{id}', 'web_admin\ShowDataController@update_dress_code')->name('update-dress-code-web');
     Route::get('/academic-calender-page', 'web_admin\ShowDataController@academic_calender')->name('academic-calender-web');
     Route::get('/update-academic-calender-page/{id}', 'web_admin\ShowDataController@update_academic_calender')->name('update-academic-calender-web');
     Route::get('/book-list-page', 'web_admin\ShowDataController@book_list')->name('book-list-web');
     Route::get('class-routine-page', 'web_admin\ShowDataController@class_routine')->name('class-routine-web');
     Route::get('exam-routine-page', 'web_admin\ShowDataController@exam_routine')->name('exam-routine-web');
     Route::get('teacher-staff-page', 'web_admin\ShowDataController@teacher_staff')->name('teacher-staff-web');

     Route::get('news-page', 'web_admin\ShowDataController@news')->name('news-web');
     Route::get('add-news-page', 'web_admin\ShowDataController@add_news')->name('add-news-web');
     Route::get('news-description-page/{id}', 'web_admin\ShowDataController@news_description')->name('news-description-web');
     Route::get('update-news-page/{id}', 'web_admin\ShowDataController@update_news')->name('update-news-web');
     Route::get('/delete-news-page/{id}', 'web_admin\DeleteDataController@delete_news')->name('delete-news-web');

     Route::get('notice-page', 'web_admin\ShowDataController@notice')->name('notice-web');
     Route::get('add-notice-page', 'web_admin\ShowDataController@add_notice')->name('add-notice-web');
     Route::get('notice-description-page/{id}', 'web_admin\ShowDataController@notice_description')->name('notice-description-web');
     Route::get('update-notice-page/{id}', 'web_admin\ShowDataController@update_notice')->name('update-notice-web');
     Route::get('/delete-notice-page/{id}', 'web_admin\DeleteDataController@delete_notice')->name('delete-notice-web');

     Route::get('event-page', 'web_admin\ShowDataController@event')->name('event-web');
     Route::get('add-event-page', 'web_admin\ShowDataController@add_event')->name('add-event-web');
     Route::get('event-description-page/{id}', 'web_admin\ShowDataController@event_description')->name('event-description-web');
     Route::get('update-event-page/{id}', 'web_admin\ShowDataController@update_event')->name('update-event-web');
     Route::get('/delete-event-page/{id}', 'web_admin\DeleteDataController@delete_event')->name('delete-event-web');


     Route::get('policies-page', 'web_admin\ShowDataController@policies')->name('policies-web');
     Route::get('update-polices/{id}', 'web_admin\ShowDataController@update_polices')->name('update-polices-web');

     Route::get('facilities-page', 'web_admin\ShowDataController@facilities')->name('facilities-web');
     Route::get('update-facility-page/{id}', 'web_admin\ShowDataController@update_facility')->name('update-facility-web');

     Route::get('library-page', 'web_admin\ShowDataController@library')->name('library-web');
     Route::get('update-library-page/{id}', 'web_admin\ShowDataController@update_library')->name('update-library-web');

     Route::get('it-page', 'web_admin\ShowDataController@it')->name('it-web');
     Route::get('updaate-it-page/{id}', 'web_admin\ShowDataController@update_it')->name('update-it-web');


     Route::get('admission-info-page', 'web_admin\ShowDataController@admission_info')->name('admission-info-web');
     Route::get('update-admission-info-page/{id}', 'web_admin\ShowDataController@update_admission_info')->name('update-admission-info-web');
     Route::get('admission-form-page', 'web_admin\ShowDataController@admission_form')->name('admission-form-web');
     Route::get('aadmission-result-page', 'web_admin\ShowDataController@admission_result')->name('admission-result-web');

     Route::get('fees-payment-page', 'web_admin\ShowDataController@fees_payment')->name('fees-payment-web');
     Route::get('update-admission-payment-info-page/{id}', 'web_admin\ShowDataController@update_admission_payment_info')->name('update-admission-payment-web');

     Route::get('admission-policy-page', 'web_admin\ShowDataController@admission_policy')->name('admission-policy-web');
     Route::get('update-admission-policy-page/{id}', 'web_admin\ShowDataController@update_admission_policy')->name('update-admission-policy-web');
     Route::get('prospectus-page', 'web_admin\ShowDataController@prospectus')->name('prospectus-web');
     Route::get('update-admission-prospectus-info-page/{id}', 'web_admin\ShowDataController@update_admission_prospectus_info')->name('update-admission-prospectus-info-web');
     Route::get('scholarships-page', 'web_admin\ShowDataController@scholarships')->name('scholarships-web');
     Route::get('update-admission-scholarship-info-page/{id}', 'web_admin\ShowDataController@update_admission_scholarship_info')->name('update-admission-scholarship-info-web');

     Route::get('recruitment-exam-page', 'web_admin\ShowDataController@recruitment_exam')->name('recruitment-exam-web');
     Route::get('add-recruitment-exam-page', 'web_admin\ShowDataController@add_recruitment_exam')->name('add-recruitment-exam-web');
     Route::get('add-gallery-page', 'web_admin\ShowDataController@add_gallery')->name('add-gallery-web');
     Route::get('manage-gallery-page', 'web_admin\ShowDataController@manage_gallery')->name('manage-gallery-web');
     Route::get('delete-gallery-page/{id}', 'web_admin\DeleteDataController@delete_gallery')->name('delete-gallery-web');


    
     Route::get('general-setting-page', 'web_admin\ShowDataController@general_setting')->name('general-setting-web');
     Route::get('update-general-setting-page/{id}', 'web_admin\ShowDataController@update_general_setting')->name('update-general-setting-web');


     Route::post('submitSlider', 'web_admin\AddDataController@submitSlider')->name('submitSlider');
     Route::post('submitUpdateSlider', 'web_admin\EditDataController@submitUpdateSlider')->name('submitUpdateSlider');
     Route::post('submitUpdateHistory', 'web_admin\EditDataController@submitUpdateHistory')->name('submitUpdateHistory');
     Route::post('submitUpdateChairmanMessage', 'web_admin\EditDataController@submitUpdateChairmanMessage')->name('submitUpdateChairmanMessage');
     Route::post('submitUpdatePrincipalMessage', 'web_admin\EditDataController@submitUpdatePrincipalMessage')->name('submitUpdatePrincipalMessage');
     Route::post('submitUpdatePresidencyMessage', 'web_admin\EditDataController@submitUpdatePresidencyMessage')->name('submitUpdatePresidencyMessage');
     Route::post('submitUpdateMissionVision', 'web_admin\EditDataController@submitUpdateMissionVision')->name('submitUpdateMissionVision');
     Route::post('submitGoverningBody', 'web_admin\AddDataController@submitGoverningBody')->name('submitGoverningBody');
     Route::post('submitUpdateGoverningBody', 'web_admin\EditDataController@submitUpdateGoverningBody')->name('submitUpdateGoverningBody');
     Route::post('submitUpdateInfrastructure', 'web_admin\EditDataController@submitUpdateInfrastructure')->name('submitUpdateInfrastructure');
     Route::post('submitUpdateDressCode', 'web_admin\EditDataController@submitUpdateDressCode')->name('submitUpdateDressCode');
     Route::post('submitUpdateAcademicCalender', 'web_admin\EditDataController@submitUpdateAcademicCalender')->name('submitUpdateAcademicCalender');
     Route::post('submitNews', 'web_admin\AddDataController@submitNews')->name('submitNews');
     Route::post('submitnotice', 'web_admin\AddDataController@submitnotice')->name('submitnotice');
     Route::post('submitUpdateNotice', 'web_admin\EditDataController@submitUpdateNotice')->name('submitUpdateNotice');
     Route::post('submitUpdateNews', 'web_admin\EditDataController@submitUpdateNews')->name('submitUpdateNews');
     Route::post('submitEvent', 'web_admin\AddDataController@submitEvent')->name('submitEvent');
     Route::post('submitUpdateEvent', 'web_admin\EditDataController@submitUpdateEvent')->name('submitUpdateEvent');
     Route::post('submitUpdatePolices', 'web_admin\EditDataController@submitUpdatePolices')->name('submitUpdatePolices');
     Route::post('submitUpdateFacility', 'web_admin\EditDataController@submitUpdateFacility')->name('submitUpdateFacility');
     Route::post('submitUpdateLibrary', 'web_admin\EditDataController@submitUpdateLibrary')->name('submitUpdateLibrary');
     Route::post('submitUpdateIt', 'web_admin\EditDataController@submitUpdateIt')->name('submitUpdateIt');
     Route::post('submitGallery', 'web_admin\AddDataController@submitGallery')->name('submitGallery');
     Route::post('submitUpdateGeneralSetting', 'web_admin\EditDataController@submitUpdateGeneralSetting')->name('submitUpdateGeneralSetting');
     Route::post('submitUpdateAdmissionInfo', 'web_admin\EditDataController@submitUpdateAdmissionInfo')->name('submitUpdateAdmissionInfo');
     Route::post('submitUpdateAdmissionPaymentInfo', 'web_admin\EditDataController@submitUpdateAdmissionPaymentInfo')->name('submitUpdateAdmissionPaymentInfo');
     Route::post('submitUpdateAdmissionPolicyInfo', 'web_admin\EditDataController@submitUpdateAdmissionPolicyInfo')->name('submitUpdateAdmissionPolicyInfo');
     Route::post('submitUpdateAdmissionProspectusInfo', 'web_admin\EditDataController@submitUpdateAdmissionProspectusInfo')->name('submitUpdateAdmissionProspectusInfo');
     Route::post('submitUpdateAdmissionScholarShipInfo', 'web_admin\EditDataController@submitUpdateAdmissionScholarShipInfo')->name('submitUpdateAdmissionScholarShipInfo');
     Route::get('machines', 'web_admin\ShowDataController@machines')->name('machines');
     Route::get('add_machine', 'web_admin\ShowDataController@add_machine')->name('add_machine');
     Route::get('delete-machine/{id}', 'web_admin\DeleteDataController@delete_machine')->name('delete-machine');
     Route::post('submitmachine', 'web_admin\AddDataController@submitmachine')->name('submitmachine');



    //SMS System Routes
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/userProfile', 'SMS\ShowDataController@userProfile')->name('userProfile');
    Route::get('/edit_user_profile/{id}', 'SMS\ShowDataController@edit_user_profile')->name('edit_user_profile');
    Route::post('/updateAdmin', 'SMS\UpdateDataController@updateAdmin')->name('updateAdmin');
    Route::get('/delete_user/{id}', 'SMS\DeleteDataController@delete_user')->name('delete_user');


    Route::get('/students', 'SMS\ShowDataController@students')->name('students');
    Route::get('/add-student', 'SMS\ShowDataController@add_student')->name('add-student');
    Route::get('/student-details/{id}', 'SMS\ShowDataController@student_details')->name('student-details');
    Route::post('/savestudent', 'SMS\AddDataController@savestudent')->name('savestudent');
    Route::get('/edit_student/{id}', 'SMS\ShowDataController@edit_student')->name('edit_student');
    Route::post('/updatestudent', 'SMS\UpdateDataController@updatestudent')->name('updatestudent');
    Route::post('/updatestudentProfile', 'SMS\UpdateDataController@updatestudentProfile')->name('updatestudentProfile');
    Route::get('/delete_student/{id}', 'SMS\DeleteDataController@delete_student')->name('delete_student');


    Route::get('/parents', 'SMS\ShowDataController@parents')->name('parents');
    Route::get('/add-parent', 'SMS\ShowDataController@add_parent')->name('add-parent');
    Route::get('/parent_details/{id}', 'SMS\ShowDataController@parent_details')->name('parent_details');
    Route::get('/edit_parents/{id}', 'SMS\ShowDataController@edit_parents')->name('edit_parents');
    Route::get('/delete_parent/{id}', 'SMS\DeleteDataController@delete_parent')->name('delete_parent');
    Route::post('/submitParentForm', 'SMS\AddDataController@submitParentForm')->name('submitParentForm');
    Route::post('/updateParentForm', 'SMS\UpdateDataController@updateParentForm')->name('updateParentForm');


    Route::get('/teachers', 'SMS\ShowDataController@teachers')->name('teachers');
    Route::get('/add-teacher', 'SMS\ShowDataController@add_teacher')->name('add-teacher');
    Route::post('/submitTeacherFrom', 'SMS\AddDataController@submitTeacherFrom')->name('submitTeacherFrom');
    Route::get('/teacher-details/{id}', 'SMS\ShowDataController@teacher_details')->name('teacher-details');
    Route::get('/edit_teacher/{teacher_id}', 'SMS\ShowDataController@edit_teacher')->name('edit_teacher');
    Route::post('/updateTeacherFrom', 'SMS\UpdateDataController@updateTeacherFrom')->name('updateTeacherFrom');
    Route::get('/delete_teacher/{id}', 'SMS\DeleteDataController@delete_teacher')->name('delete_teacher');

    Route::get('/users', 'SMS\ShowDataController@users')->name('users');
    Route::get('/add-user', 'SMS\ShowDataController@add_user')->name('add-user');

    Route::post('/submitUserInfoForm', 'SMS\AddDataController@submitUserInfoForm')->name('submitUserInfoForm');
    

    Route::get('/classes', 'SMS\ShowDataController@classes')->name('classes');
    Route::get('/add-class', 'SMS\ShowDataController@add_class')->name('add-class');
    Route::post('/submitClassFrom', 'SMS\AddDataController@submitClassFrom')->name('submitClassFrom');
    Route::get('/edit_class/{id}', 'SMS\ShowDataController@edit_class')->name('edit_class');
    Route::post('/updateClassFrom', 'SMS\UpdateDataController@updateClassFrom')->name('updateClassFrom');
    Route::get('/delete_class/{id}', 'SMS\DeleteDataController@delete_class')->name('delete_class');

    Route::get('/subjects', 'SMS\ShowDataController@subjects')->name('subjects');
    Route::get('/add-subject', 'SMS\ShowDataController@add_subject')->name('add-subject');
    Route::post('/submitSubjectFrom', 'SMS\AddDataController@submitSubjectFrom')->name('submitSubjectFrom');
    Route::get('/edit_subject/{id}', 'SMS\ShowDataController@edit_subject')->name('edit_subject');
    Route::post('/updateSubjectFrom', 'SMS\UpdateDataController@updateSubjectFrom')->name('updateSubjectFrom');
    Route::get('/delete_subject/{id}', 'SMS\DeleteDataController@delete_subject')->name('delete_subject');


    Route::get('/sections', 'SMS\ShowDataController@sections')->name('sections');
    Route::get('/add-section', 'SMS\ShowDataController@add_section')->name('add-section');
    Route::get('/edit_section/{id}', 'SMS\ShowDataController@edit_section')->name('edit_section');
    Route::get('/delete_section/{id}', 'SMS\DeleteDataController@delete_section')->name('delete_section');
    Route::post('/submitSectionFrom', 'SMS\AddDataController@submitSectionFrom')->name('submitSectionFrom');
    Route::post('/updateSectionFrom', 'SMS\UpdateDataController@updateSectionFrom')->name('updateSectionFrom');

    Route::get('/syllabuses', 'SMS\ShowDataController@syllabuses')->name('syllabuses');
    Route::get('/add-syllabus', 'SMS\ShowDataController@add_syllabus')->name('add-syllabus');
    Route::get('/view_syllabuses/{id}', 'SMS\ShowDataController@view_syllabuses')->name('view_syllabuses');
    Route::get('/edit_syllabuses/{id}', 'SMS\ShowDataController@edit_syllabuses')->name('edit_syllabuses');
    Route::get('/delete_syllabuses/{id}', 'SMS\DeleteDataController@delete_syllabuses')->name('delete_syllabuses');
    Route::post('/submitSyllabusesForm', 'SMS\AddDataController@submitSyllabusesForm')->name('submitSyllabusesForm');
    Route::post('/updateSyllabusesForm', 'SMS\UpdateDataController@updateSyllabusesForm')->name('updateSyllabusesForm');

    Route::get('/assignments', 'SMS\ShowDataController@assignments')->name('assignments');
    Route::get('/add-assignment', 'SMS\ShowDataController@add_assignment')->name('add-assignment');
    Route::get('/submited-assignment/{id}', 'SMS\ShowDataController@submited_assignment')->name('submited-assignment');
    Route::get('/view_assignment/{id}', 'SMS\ShowDataController@view_assignment')->name('view_assignment');
    Route::get('/edit_assignment/{id}', 'SMS\ShowDataController@edit_assignment')->name('edit_assignment');
    Route::get('/delete_assignment/{id}', 'SMS\DeleteDataController@delete_assignment')->name('delete_assignment');
    Route::post('/submitAssignmentForm', 'SMS\AddDataController@submitAssignmentForm')->name('submitAssignmentForm');
    Route::post('/updateAssignmentForm', 'SMS\UpdateDataController@updateAssignmentForm')->name('updateAssignmentForm');
    Route::post('/submit_assignment_marks', 'SMS\AddDataController@submit_assignment_marks')->name('submit_assignment_marks');

    Route::get('/routine', 'SMS\ShowDataController@routine')->name('routine');
    Route::get('/add-routine', 'SMS\ShowDataController@add_routine')->name('add-routine');
    Route::get('/edit_routine/{id}', 'SMS\ShowDataController@edit_routine')->name('edit_routine');
    Route::get('/delete_routine/{id}', 'SMS\DeleteDataController@delete_routine')->name('delete_routine');
    Route::post('/submitRoutineForm', 'SMS\AddDataController@submitRoutineForm')->name('submitRoutineForm');
    Route::post('/updateRoutineForm', 'SMS\UpdateDataController@updateRoutineForm')->name('updateRoutineForm');
    
    Route::get('/student-attendance', 'SMS\ShowDataController@student_attendance')->name('student-attendance');
    Route::post('/student_attendanceForm', 'SMS\ShowDataController@student_attendanceForm')->name('student_attendanceForm');
    Route::get('/add-student-attendance', 'SMS\ShowDataController@add_student_attendance')->name('add-student-attendance');
    Route::get('/view_attn/{id}', 'SMS\ShowDataController@view_attn')->name('view_attn');
    Route::get('/delete_student_attn/{id}', 'SMS\DeleteDataController@delete_student_attn')->name('delete_student_attn');
    Route::get('/teacher-attendance', 'SMS\ShowDataController@teacher_attendance')->name('teacher-attendance');
    Route::get('/add-teacher-attendance', 'SMS\ShowDataController@add_teacher_attendance')->name('add-teacher-attendance');
    Route::get('/delete_teacher_attn/{id}', 'SMS\DeleteDataController@delete_teacher_attn')->name('delete_teacher_attn');

    Route::get('/user-attendance', 'SMS\ShowDataController@user_attendance')->name('user-attendance');
    Route::get('/add-user-attendance', 'SMS\ShowDataController@add_user_attendance')->name('add-user-attendance');

    Route::post('/give_attendance', 'SMS\ShowDataController@give_attendance')->name('give_attendance');
    Route::post('/save_attendanceForm', 'SMS\AddDataController@save_attendanceForm')->name('save_attendanceForm');
    Route::post('/saveteacherForm', 'SMS\ShowDataController@saveteacherForm')->name('saveteacherForm');
    Route::post('/save_teacherAttendanceForm', 'SMS\AddDataController@save_teacherAttendanceForm')->name('save_teacherAttendanceForm');

    // Exam part

    Route::get('/exam', 'SMS\ShowDataController@exam')->name('exam');
    Route::get('/add_exam', 'SMS\ShowDataController@add_exam')->name('add_exam');
    Route::get('/edit_exam/{id}', 'SMS\ShowDataController@edit_exam')->name('edit_exam');
    Route::get('/delete_exam/{id}', 'SMS\DeleteDataController@delete_exam')->name('delete_exam');
    Route::post('/submitExamFrom', 'SMS\AddDataController@submitExamFrom')->name('submitExamFrom');
    Route::post('/updateExamFrom', 'SMS\UpdateDataController@updateExamFrom')->name('updateExamFrom');
    Route::get('quiz', 'SMS\ShowDataController@quiz')->name('quiz');
    Route::get('quiz_details/{id}', 'SMS\ShowDataController@quiz_details')->name('quiz_details');
    Route::get('get_result/{id}', 'SMS\ShowDataController@get_result')->name('get_result');
    Route::get('get_errors/{id}', 'SMS\ShowDataController@get_errors')->name('get_errors');
    Route::post('savequiz', 'SMS\AddDataController@savequiz')->name('savequiz');
    Route::post('answerquiz', 'SMS\AddDataController@answerquiz')->name('answerquiz');
   
    Route::get('/grade', 'SMS\ShowDataController@grade')->name('grade');
    Route::get('/add_grade', 'SMS\ShowDataController@add_grade')->name('add_grade');
    Route::get('/edit_grade/{id}', 'SMS\ShowDataController@edit_grade')->name('edit_grade');
    Route::get('/delete_grade/{id}', 'SMS\DeleteDataController@delete_grade')->name('delete_grade');
    Route::post('/submitGradeFrom', 'SMS\AddDataController@submitGradeFrom')->name('submitGradeFrom');
    Route::post('/updateGradeFrom', 'SMS\UpdateDataController@updateGradeFrom')->name('updateGradeFrom');


    Route::get('/exam_attendence', 'SMS\ShowDataController@exam_attendence')->name('exam_attendence');
    Route::post('/ExamAttendenceFrom', 'SMS\ShowDataController@ExamAttendenceFrom')->name('ExamAttendenceFrom');
    Route::post('/save_exam_attendanceForm', 'SMS\AddDataController@save_exam_attendanceForm')->name('save_exam_attendanceForm');

    Route::get('/examschedule', 'SMS\ShowDataController@examschedule')->name('examschedule');
    Route::get('/add_examschedule', 'SMS\ShowDataController@add_examschedule')->name('add_examschedule');
    Route::get('/view_exam_schedule/{id}', 'SMS\ShowDataController@view_exam_schedule')->name('view_exam_schedule');
    Route::get('/delete_exam_schedule/{id}', 'SMS\DeleteDataController@delete_exam_schedule')->name('delete_exam_schedule');
    Route::post('/updateExamScheduleFrom', 'SMS\UpdateDataController@updateExamScheduleFrom')->name('updateExamScheduleFrom');
    Route::post('/submitExamScheduleFrom', 'SMS\AddDataController@submitExamScheduleFrom')->name('submitExamScheduleFrom');
    

    // marks part

    Route::get('/marks','SMS\ShowDataController@marks')->name('marks');
    Route::post('/give_marks','SMS\ShowDataController@give_marks')->name('give_marks');

    Route::get('/markpercentage','SMS\ShowDataController@markpercentage')->name('markpercentage');
    Route::get('/add_marks','SMS\ShowDataController@add_marks')->name('add_marks');
    Route::get('/add_markpercentage','SMS\ShowDataController@add_markpercentage')->name('add_markpercentage');
    Route::get('/edit_per/{id}','SMS\ShowDataController@edit_per')->name('edit_per');
    Route::get('/delete_per/{id}','SMS\DeleteDataController@delete_per')->name('delete_per');

    Route::post('/save_marksForm', 'SMS\AddDataController@save_marksForm')->name('save_marksForm');
    Route::post('/show_marks', 'SMS\ShowDataController@show_marks')->name('show_marks');
    Route::post('/submitMarkPercentageFrom', 'SMS\AddDataController@submitMarkPercentageFrom')->name('submitMarkPercentageFrom');
    Route::post('/updateMarkPercentageFrom', 'SMS\UpdateDataController@updateMarkPercentageFrom')->name('updateMarkPercentageFrom');

    Route::get('/promotion','SMS\ShowDataController@promotion')->name('promotion');
    Route::post('/show_students_promotion', 'SMS\ShowDataController@show_students_promotion')->name('show_students_promotion');
    Route::get('/edit_promotion', 'SMS\ShowDataController@edit_promotion')->name('edit_promotion');
    Route::post('/edit_promotionForm', 'SMS\UpdateDataController@edit_promotionForm')->name('edit_promotionForm');
    Route::post('/save_promotionForm', 'SMS\UpdateDataController@save_promotionForm')->name('save_promotionForm');
    // transport part

    Route::get('/transport','SMS\ShowDataController@transport')->name('transport');
    Route::get('/add_transport','SMS\ShowDataController@add_transport')->name('add_transport');
    Route::get('/edit_transport/{id}','SMS\ShowDataController@edit_transport')->name('edit_transport');
    Route::get('/delete_transport/{id}','SMS\DeleteDataController@delete_transport')->name('delete_transport');
    Route::post('/submitTransportFrom','SMS\AddDataController@submitTransportFrom')->name('submitTransportFrom');
    Route::post('/updateTransportFrom','SMS\UpdateDataController@updateTransportFrom')->name('updateTransportFrom');

    Route::get('/transport_memeber', 'SMS\ShowDataController@transport_memeber')->name('transport_memeber');
    Route::get('/add_transport_member', 'SMS\ShowDataController@add_transport_member')->name('add_transport_member');
    Route::get('/edit_transport_member/{id}', 'SMS\ShowDataController@edit_transport_member')->name('edit_transport_member');
    Route::get('/delete_transport_member/{id}', 'SMS\DeleteDataController@delete_transport_member')->name('delete_transport_member');
    Route::post('/submitTransportMemberFrom', 'SMS\AddDataController@submitTransportMemberFrom')->name('submitTransportMemberFrom');
    Route::post('/updateTransportMemberFrom', 'SMS\UpdateDataController@updateTransportMemberFrom')->name('updateTransportMemberFrom');

    // hostel part

    Route::get('/hostel','SMS\ShowDataController@hostel')->name('hostel');
    Route::get('/add_hostel','SMS\ShowDataController@add_hostel')->name('add_hostel');
    Route::get('/edit_hostel/{id}','SMS\ShowDataController@edit_hostel')->name('edit_hostel');
    Route::get('/delete_hostel/{id}','SMS\DeleteDataController@delete_hostel')->name('delete_hostel');

     Route::get('/hostel_members','SMS\ShowDataController@hostel_members')->name('hostel_members');
     Route::get('/add_hostel_members','SMS\ShowDataController@add_hostel_members')->name('add_hostel_members');
     Route::get('/edit_member/{id}','SMS\ShowDataController@edit_member')->name('edit_member');
     Route::get('/delete_member/{id}','SMS\DeleteDataController@delete_member')->name('delete_member');

    Route::post('/submitHostelFrom','SMS\AddDataController@submitHostelFrom')->name('submitHostelFrom');
    Route::post('/submitHostelMemberFrom','SMS\AddDataController@submitHostelMemberFrom')->name('submitHostelMemberFrom');
    Route::post('/updateHostelMemberFrom','SMS\UpdateDataController@updateHostelMemberFrom')->name('updateHostelMemberFrom');
    Route::post('/ShowHostelMembers','SMS\ShowDataController@ShowHostelMembers')->name('ShowHostelMembers');
    Route::post('/updateHostelFrom','SMS\UpdateDataController@updateHostelFrom')->name('updateHostelFrom');

    // Library part

    Route::get('/library_members','SMS\ShowDataController@library_members')->name('library_members');
    Route::get('/library_members_student','SMS\ShowDataController@library_members')->name('library_members_student');
    Route::get('/library_members_teachers','SMS\ShowDataController@library_members_teachers')->name('library_members_teachers');
    Route::get('/books','SMS\ShowDataController@books')->name('books');
    Route::get('/return_book/{id}','SMS\UpdateDataController@return_book')->name('return_book');
    

    Route::get('/add_library_member_student','SMS\ShowDataController@add_library_member_student')->name('add_library_member_student');
    Route::get('/add_library_member_teacher','SMS\ShowDataController@add_library_member_teacher')->name('add_library_member_teacher');
        Route::get('/edit_library_member_teacher/{id}','SMS\ShowDataController@edit_library_member_teacher')->name('edit_library_member_teacher');
    Route::get('/edit_library_student_member/{id}','SMS\ShowDataController@edit_library_student_member')->name('edit_library_student_member');
    Route::get('/delete_library_member/{id}','SMS\DeleteDataController@delete_library_member')->name('delete_library_member');

    Route::post('/submitLibraryMemberFrom','SMS\AddDataController@submitLibraryMemberFrom')->name('submitLibraryMemberFrom');
    Route::post('/updateLibraryTeacherMemberFrom','SMS\UpdateDataController@updateLibraryTeacherMemberFrom')->name('updateLibraryTeacherMemberFrom');
    Route::post('/updateLibraryStudentMemberFrom','SMS\UpdateDataController@updateLibraryStudentMemberFrom')->name('updateLibraryStudentMemberFrom');

     // Library part
    Route::get('/add_book','SMS\ShowDataController@add_book')->name('add_book');
    Route::get('/edit_book/{id}','SMS\ShowDataController@edit_book')->name('edit_book');
    Route::get('/delete_book/{id}','SMS\DeleteDataController@delete_book')->name('delete_book');

    Route::post('/submitBooksFrom','SMS\AddDataController@submitBooksFrom')->name('submitBooksFrom');
    Route::post('/updateBooksFrom','SMS\UpdateDataController@updateBooksFrom')->name('updateBooksFrom');

    Route::get('/add_book_issue','SMS\ShowDataController@add_book_issue')->name('add_book_issue');
    Route::get('/book_issue_students','SMS\ShowDataController@book_issue_students')->name('book_issue_students');
    Route::get('/book_issue_teachers','SMS\ShowDataController@book_issue_teachers')->name('book_issue_teachers');
    Route::get('/edit_issue_student/{id}','SMS\ShowDataController@edit_issue_student')->name('edit_issue_student');
    Route::get('/edit_issue_teacher/{id}','SMS\ShowDataController@edit_issue_teacher')->name('edit_issue_teacher');
    Route::get('/delete_issue/{id}','SMS\DeleteDataController@delete_issue')->name('delete_issue');

    Route::post('/submitBooksIssueFrom','SMS\AddDataController@submitBooksIssueFrom')->name('submitBooksIssueFrom');
    Route::post('/updateBooksIssuestudentFrom','SMS\UpdateDataController@updateBooksIssuestudentFrom')->name('updateBooksIssuestudentFrom');
    Route::post('/submitBooksIssueTeacherFrom','SMS\UpdateDataController@submitBooksIssueTeacherFrom')->name('submitBooksIssueTeacherFrom');
   Route::get('/mcq_marks_update_form/{id}/{marks}','SMS\UpdateDataController@mcq_marks_update_form')->name('mcq_marks_update_form');
   Route::get('/theory_marks_update_form/{id}/{theory_marks}','SMS\UpdateDataController@theory_marks_update_form')->name('theory_marks_update_form');
   Route::get('/pr_marks_update_form/{id}/{pr_marks}','SMS\UpdateDataController@pr_marks_update_form')->name('pr_marks_update_form');
   Route::get('/ca_marks_update_form/{id}/{ca_marks}','SMS\UpdateDataController@ca_marks_update_form')->name('ca_marks_update_form');


// Account part
     Route::get('/fee_types','SMS\ShowDataController@fee_types')->name('fee_types');
     Route::get('/add_fee_types','SMS\ShowDataController@add_fee_types')->name('add_fee_types');
     Route::get('/edit_fee_type/{id}','SMS\ShowDataController@edit_fee_type')->name('edit_fee_type');
     Route::get('/delete_fee_type/{id}','SMS\DeleteDataController@delete_fee_type')->name('delete_fee_type');

     Route::post('/submitFeeTypeFrom', 'SMS\AddDataController@submitFeeTypeFrom')->name('submitFeeTypeFrom');
     Route::post('/updateFeeTypeFrom', 'SMS\UpdateDataController@updateFeeTypeFrom')->name('updateFeeTypeFrom');

     Route::get('/invoice','SMS\ShowDataController@invoice')->name('invoice');
     Route::get('/add_invoice','SMS\ShowDataController@add_invoice')->name('add_invoice');
     Route::get('/edit_invoice/{id}','SMS\ShowDataController@edit_invoice')->name('edit_invoice');
     Route::get('/view_invoice/{id}','SMS\ShowDataController@view_invoice')->name('view_invoice');
     Route::get('/delete_invoice/{id}','SMS\DeleteDataController@delete_invoice')->name('delete_invoice');
     Route::get('/delete_single_invoice/{id}/{random}/{fee_type}','SMS\DeleteDataController@delete_single_invoice')->name('delete_single_invoice');

     Route::post('/submitInvoiceFrom', 'SMS\AddDataController@submitInvoiceFrom')->name('submitInvoiceFrom');
     Route::post('/updateInvoiceFrom', 'SMS\UpdateDataController@updateInvoiceFrom')->name('updateInvoiceFrom');

     Route::get('/payment_history','SMS\ShowDataController@payment_history')->name('payment_history');
     Route::post('/showpayment_history', 'SMS\ShowDataController@showpayment_history')->name('showpayment_history');
     

     Route::get('/expense','SMS\ShowDataController@expense')->name('expense');
     Route::get('/add_expance','SMS\ShowDataController@add_expance')->name('add_expance');
     Route::get('/edit_expense/{id}','SMS\ShowDataController@edit_expense')->name('edit_expense');
     Route::get('/delete_expense/{id}','SMS\DeleteDataController@delete_expense')->name('delete_expense');

     Route::get('/add_company_paid','SMS\ShowDataController@add_company_paid')->name('add_company_paid');
     Route::get('/company_paid','SMS\ShowDataController@company_paid')->name('company_paid');
     Route::post('/submitPaymentFrom','SMS\AddDataController@submitPaymentFrom')->name('submitPaymentFrom');


     Route::post('/submitexpenseFrom', 'SMS\AddDataController@submitexpenseFrom')->name('submitexpenseFrom');
     Route::post('/updateexpenseFrom', 'SMS\UpdateDataController@updateexpenseFrom')->name('updateexpenseFrom');
     
     Route::get('/income','SMS\ShowDataController@income')->name('income');
     Route::get('/add_income','SMS\ShowDataController@add_income')->name('add_income');
     Route::get('/edit_income/{id}','SMS\ShowDataController@edit_income')->name('edit_income');
     Route::get('/delete_income/{id}','SMS\DeleteDataController@delete_income')->name('delete_income');

     Route::post('/submitincomeFrom', 'SMS\AddDataController@submitincomeFrom')->name('submitincomeFrom');
     Route::post('/updateincomeFrom', 'SMS\UpdateDataController@updateincomeFrom')->name('updateincomeFrom');


     Route::get('/profit','SMS\ShowDataController@profit')->name('profit');
     Route::post('/show_profit','SMS\ShowDataController@show_profit')->name('show_profit');

     // report part

     Route::get('/class_report','SMS\ShowDataController@class_report')->name('class_report');
     Route::post('/show_class_report','SMS\ShowDataController@show_class_report')->name('show_class_report');

     Route::get('/admit_card','SMS\ShowDataController@admit_card')->name('admit_card');
     Route::post('/adminCardFrom','SMS\ShowDataController@adminCardFrom')->name('adminCardFrom');

     Route::get('/id_card','SMS\ShowDataController@id_card')->name('id_card');
     Route::post('/idCardFrom','SMS\ShowDataController@idCardFrom')->name('idCardFrom');

     Route::get('/routine_report','SMS\ShowDataController@routine_report')->name('routine_report');
     Route::post('/showRoutine','SMS\ShowDataController@showRoutine')->name('showRoutine');
     
     Route::get('/examschedulereport','SMS\ShowDataController@examschedulereport')->name('examschedulereport');
     Route::post('/showexamschedulereport','SMS\ShowDataController@showexamschedulereport')->name('showexamschedulereport');
     
     Route::get('/terminalReport','SMS\ShowDataController@terminalReport')->name('terminalReport');
     Route::post('/showterminalReport','SMS\ShowDataController@showterminalReport')->name('showterminalReport');
     
     Route::get('/student_report','SMS\ShowDataController@student_report')->name('student_report');
     Route::post('/showStudentReport','SMS\ShowDataController@showStudentReport')->name('showStudentReport');

     Route::get('/meritstagereport','SMS\ShowDataController@meritstagereport')->name('meritstagereport');
     Route::post('/showMeritstagereport','SMS\ShowDataController@showMeritstagereport')->name('showMeritstagereport');

     Route::get('/tabulationsheetreport','SMS\ShowDataController@tabulationsheetreport')->name('tabulationsheetreport');
     Route::post('/showTabulationsheetreport','SMS\ShowDataController@showTabulationsheetreport')->name('showTabulationsheetreport');

     Route::get('/certificate','SMS\ShowDataController@certificate')->name('certificate');
     Route::post('/showCertificatereport','SMS\ShowDataController@showCertificatereport')->name('showCertificatereport');

     Route::get('/transectionreport','SMS\ShowDataController@transectionreport')->name('transectionreport');
     Route::post('/showTransectionreport','SMS\ShowDataController@showTransectionreport')->name('showTransectionreport');

     Route::get('/balancefeesreport','SMS\ShowDataController@balancefeesreport')->name('balancefeesreport');
     Route::post('/showBalancefeesreport','SMS\ShowDataController@showBalancefeesreport')->name('showBalancefeesreport');
     
     Route::get('/progresscardreport','SMS\ShowDataController@progresscardreport')->name('progresscardreport');
     Route::post('/showProgresscardreport','SMS\ShowDataController@showProgresscardreport')->name('showProgresscardreport');

     Route::get('/feeReport','SMS\ShowDataController@feeReport')->name('feeReport');
     Route::post('/showFeesreport','SMS\ShowDataController@showFeesreport')->name('showFeesreport');

     Route::get('/attendanceReport','SMS\ShowDataController@attendanceReport')->name('attendanceReport');
     Route::post('/showAttendance','SMS\ShowDataController@showAttendance')->name('showAttendance');

     // online_admission
     Route::get('/online_admission','SMS\ShowDataController@online_admission')->name('online_admission');
     Route::get('/delete_application/{id}','SMS\DeleteDataController@delete_application')->name('delete_application');
     Route::get('/view_application/{id}','SMS\ShowDataController@view_application')->name('view_application');
     Route::get('/submitOnlineApplicationForm/{id}','SMS\ShowDataController@submitOnlineApplicationForm')->name('submitOnlineApplicationForm');

     Route::post('/processAdmissionForm','SMS\AddDataController@processAdmissionForm')->name('processAdmissionForm');



     // notification
     Route::get('/read_notification/{id}','SMS\ShowDataController@read_notification')->name('read_notification');
     Route::get('/absence','SMS\ShowDataController@absence')->name('absence');
     Route::get('/insert-absence-data','SMS\ShowDataController@insert_absence_data')->name('insert-absence-data');
     // Inbox
     Route::get('/inbox','SMS\ShowDataController@inbox')->name('inbox');
     Route::get('/add_inbox','SMS\ShowDataController@add_inbox')->name('add_inbox');
     Route::post('/submitInboxFrom','SMS\AddDataController@submitInboxFrom')->name('submitInboxFrom');
     Route::get('/count-messages','SMS\ShowDataController@count_messages')->name('count-messages');
     Route::get('/get-messages','SMS\ShowDataController@get_messages')->name('get-messages');
     Route::get('/view_msg/{id}','SMS\ShowDataController@view_msg')->name('view_msg');
     Route::get('/delete_inbox/{id}','SMS\DeleteDataController@delete_inbox')->name('delete_inbox');
     
    // Games Part
    Route::get('/play-game/','HomeController@playgame')->name('play_game');
    
    
    // ajax route

    Route::get('/find-students/{id}','SMS\ShowDataController@find_students')->name('find-students');
    Route::get('/find-parents/{id}','SMS\ShowDataController@find_parents')->name('find-parents');
    Route::get('/find-section/{id}','SMS\ShowDataController@find_section')->name('find-section');
    Route::get('/find-teacher/{id}','SMS\ShowDataController@find_teacher')->name('find-teacher');
    Route::get('/find-section-teacher/{id}','SMS\ShowDataController@find_section_teacher')->name('find-section-teacher');
    Route::get('/find-assignment/{id}','SMS\ShowDataController@find_assignment')->name('find-assignment');
    Route::get('/find-assignment-subject/{id}','SMS\ShowDataController@find_assignment_subject')->name('find-assignment-subject');

    Route::get('/find-routine-section/{id}','SMS\ShowDataController@find_routine_section')->name('find-routine-section');
    Route::get('/find-routine-subject/{id}','SMS\ShowDataController@find_routine_subject')->name('find-routine-subject');
    Route::get('/find-routine-teacher/{id}','SMS\ShowDataController@find_routine_teacher')->name('find-routine-teacher');
    Route::get('/find-exam-schedule/{id}','SMS\ShowDataController@find_exam_schedule')->name('find-exam-schedule');
    Route::get('/find-exam-subject/{id}','SMS\ShowDataController@find_exam_subject')->name('find-exam-subject');
    Route::get('/find-transport-student/{id}','SMS\ShowDataController@find_transport_student')->name('find-transport-student');
    Route::get('/find-transport-section/{id}','SMS\ShowDataController@find_transport_section')->name('find-transport-section');
    Route::get('/find-section-student/{class_id}/{section_id}','SMS\ShowDataController@find_section_student')->name('find-section-student');
    Route::get('/find-fee-type-invoice/{id}','SMS\ShowDataController@find_fee_type_invoice')->name('find-fee-type-invoice');
    Route::get('/find-fee-type/{id}','SMS\ShowDataController@find_fee_type')->name('find-fee-type');
    Route::get('/find-student-class/{id}','SMS\ShowDataController@find_student_class')->name('find-student-class');
    Route::get('/find-academic-student/{id}/{id2}/{id3}','SMS\ShowDataController@find_academic_student')->name('find-academic-student');

    Route::get('/insert-data-per-time','SMS\ShowDataController@insert_data_per_time')->name('insert-data-per-time');
    
    /************************************* Social ****************************************/
     Route::get('/social','social\NewsfeedController@Index');
     Route::get('/social/news-feed','social\NewsfeedController@Index')->name('index');

     /************************* Profile ******************************/
     Route::get('profile','social\ProfileController@Profile')->name('profile');
     Route::get('profile/timeline','social\ProfileController@Timeline')->name('timeline');
     Route::get('profile/about','social\ProfileController@About')->name('about');
     Route::get('profile/groups','social\ProfileController@Groups')->name('my_groups');
     Route::get('profile/photos','social\ProfileController@Photos')->name('photos');
     Route::get('profile/videos','social\ProfileController@Videos')->name('videos');


     /************************* Groups ******************************/
     Route::get('groups','social\GroupController@Index')->name('groups');

     /************************* Members ******************************/
     Route::get('members','social\MemberController@Index')->name('members');

     /************************* Contests ******************************/
     Route::get('contest','social\ContestController@Index')->name('contest');

     /************************* Quests ******************************/
     Route::get('quests','social\QuestsController@Index')->name('quests');

     /************************* Polls ******************************/
     Route::get('polls','social\QuestsController@Index')->name('polls');

     /************************* Events ******************************/
     Route::get('events','social\EventController@Index')->name('events');
});
