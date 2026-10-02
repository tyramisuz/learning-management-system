<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserCheckController;
use App\Http\Controllers\QrCodeController;


Route::get('/' , [WelcomeController::class, 'index']);
Route::post('/quizzes/sorting', [FilterController::class, 'sorting'])->name('quizzes.sorting');
Route::get('/quizzes/search/welcome', [FilterController::class, 'searchWelcome'])->name('quizzes.search.welcome');
Route::post('/view/{id}/group', [UserCheckController::class, 'checkUser'])->name('groups.view');
Route::get('/join/{id}/group', [UserCheckController::class, 'entry'])->name('groups.join');
Route::get('/scan-qr', [QrCodeController::class, 'showQrScanner'])->name('qr.scan');
Route::get('/check-group', [QrCodeController::class, 'checkGroup'])->name('groups.check');






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/quizzes/search', [FilterController::class, 'search'])->name('quizzes.search');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [QuizController::class, 'dashboard'])->name('dashboard');
    Route::get('quizzes/{id}/participants', [QuizController::class, 'showParticipants'])->name('quizzes.participants');
    Route::get('quizzes/{id}/participants/first', [QuizController::class, 'showFirst'])->name('quizzes.firstattempt');
    Route::get('quizzes/{id}/participants/subsequent', [QuizController::class, 'showSubsequent'])->name('quizzes.subsequentattempt');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
    Route::get('/quizzes/index', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/history', [QuizController::class, 'history'])->name('quizzes.history');
    Route::get('/questions/create/{quiz_id}', [QuestionController::class, 'create'])->name('questions.create');
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::post('/questions/edit/store', [QuestionController::class, 'storeEdit'])->name('questions.storeEdit');
    Route::get('/questions/{id}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::get('/quizzes/{id}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');
    Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
    Route::put('/quizzes/{id}/update', [QuizController::class, 'update'])->name('quizzes.update');
    Route::delete('/questions/{id}/delete', [QuestionController::class, 'destroy'])->name('questions.destroy');
    Route::PUT('/quizzes/{id}/delete', [QuizController::class, 'destroy'])->name('quizzes.destroy');
    Route::put('/quizzes/publish/{id}', [QuizController::class, 'publish'])->name('quizzes.publish');
    Route::put('/quizzes/unpublish/{id}', [QuizController::class, 'unpublish'])->name('quizzes.unpublish');
    Route::get('/report/{userId}/{quizId}/{attempt}/participant/submit', [ReportController::class, 'studentReport'])->name('report.studentsubmit');
    Route::get('/report/{quizId}/quiz', [ReportController::class, 'creatorReport'])->name('report.creator');
    Route::get('/report/{quizId}/export', [ReportController::class, 'exportCreatorReport'])->name('export.creator');
    // Route::get('/contact', function () {return view('contact');})->name('contact');
    Route::get('/questions/{quiz}/manage', [QuestionController::class, 'index'])->name('questions.index');
    Route::get('/report/{userId}/{quizId}/{attempt}/participant', [ReportController::class, 'studentReport'])->name('report.student');
    Route::get('/report/view/{userId}/{quizId}/{attempt}/participant', [ReportController::class, 'viewReport'])->name('report.view');
    Route::get('/report/pdf/{quizId}/participant', [ReportController::class, 'viewPdf'])->name('report.pdfStudent');
    Route::get('/report/pdf/participant/{quizId}', [ReportController::class, 'pdfReport'])->name('report.pdf');
    Route::post('review/{userId}/{quizId}/quiz', [ReviewController::class, 'store'])->name('review.store');
    Route::post('quizzes/{id}/duplicate', [QuizController::class, 'duplicate'])->name('quizzes.duplicate');
    Route::post('bookmark/quiz/status', [BookmarkController::class, 'store'])->name('bookmark.store');
    Route::get('bookmark/quiz', [BookmarkController::class, 'index'])->name('bookmark.index');
    Route::post('/profile/image/upload', [ProfileController::class, 'uploadImage'])->name('profile.image.upload');
    Route::get('/answer/{quizId}/{userId}/{attempt}/review/', [ReportController::class, 'answerReview'])->name('report.answerReview');
    Route::get('/group/list', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/group/create', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/group/store', [GroupController::class, 'store'])->name('groups.store');
    Route::get('/group/assign/{id}', [GroupController::class, 'assign'])->name('groups.assign');
    Route::post('/group/assignQuiz', [GroupController::class, 'assignQuiz'])->name('groups.assignQuiz');
    Route::get('/group/manage/{id}', [GroupController::class, 'manageGroup'])->name('groups.manage');
    Route::get('/quiz/manage/{id}', [GroupController::class, 'manageQuiz'])->name('groups.manageQuiz');
    Route::put('/group/{id}/update', [GroupController::class, 'update'])->name('groups.update');
    Route::get('/group/{id}/{groupId}/editAssignment', [GroupController::class, 'editAssignment'])->name('groups.editAssignment');
    Route::put('/group/{id}/{groupId}/updateAssignment', [GroupController::class, 'updateAssignment'])->name('groups.updateAssignment');
    Route::get('/group/{id}/show', [GroupController::class, 'show'])->name('groups.show');
    Route::get('/group/{group}/{quiz}/quiz', [GroupController::class, 'quizContent'])->name('groups.quiz');
    Route::get('/group/notification', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('group/enroll', [GroupController::class, 'enroll'])->name('groups.enroll');
    Route::delete('member/{id}/delete', [GroupController::class, 'memberDestroy'])->name('member.destroy');
    Route::put('group/accept/{id}', [NotificationController::class, 'accept'])->name('groups.accept');
    Route::get('invitation/{id}/accept', [InvitationController::class, 'accept'])->name('groups.accept.get');
    Route::put('group/reject/{id}', [NotificationController::class, 'reject'])->name('groups.reject');
    Route::get('group/notification/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('group/notification/readAll', [NotificationController::class, 'readAll'])->name('notifications.readAll');
    Route::delete('/groups/{id}/leave', [GroupController::class, 'leaveGroup'])->name('groups.leave');
    // Route::delete('group/{id}/delete', [GroupController::class, 'destroy'])->name('groups.destroy');
    Route::put('/quiz/unassign/{quiz}', [GroupController::class, 'unassignQuiz'])->name('groups.unassignQuiz');
    Route::put('/quiz/assign/{quiz}', [GroupController::class, 'assignBack'])->name('groups.assignBack');
    Route::get('/invitation/status/{id}', [GroupController::class, 'invitationStatus'])->name('groups.invitationStatus');
    Route::delete('member/{id}/cancel', [GroupController::class, 'invitationCancel'])->name('invitation.cancel');
    Route::post('group/{id}/send/invitation', [InvitationController::class, 'invite'])->name('groups.invite');
    Route::get('group/{groupId}/{quizId}/members', [GroupController::class, 'members'])->name('groups.members');
    Route::get('/questions/show/{quizId}', [QuestionController::class, 'show'])->name('questions.show');
    Route::get('/questions/show/{quizId}/{groupId}', [QuestionController::class, 'show'])->name('questions.show.group');
    Route::post('/responses/{quizId}/{userId}', [ResponseController::class, 'store'])->name('responses.store');
    Route::post('/responses/{quizId}/{userId}/{groupId}', [ResponseController::class, 'store'])->name('responses.store.group');
    Route::post('send/announcement/{groupId}', [AnnouncementController::class, 'manual'])->name('groups.sendAnnouncement');
    Route::get('/report/{userId}/{quizId}/{attempt}/participant/group', [ReportController::class, 'groupReport'])->name('report.group');
    //Route::post('/password/retrieve', [PasswordController::class, 'retrievePassword']);
    Route::get('/fetch-notifications', [NotificationController::class, 'fetchNotifications'])->name('notifications.fetch');
    Route::get('/fetch-announcements/{id}', [AnnouncementController::class, 'fetchAnnouncements'])->name('announcements.fetch');
    Route::get('index/users', [AdminController::class, 'indexUser'])->name('admin.indexUser');
    Route::get('index/quizzes/{userId}', [AdminController::class, 'indexQuiz'])->name('admin.indexQuiz');
    Route::get('index/groups/{userId}', [AdminController::class, 'indexGroup'])->name('admin.indexGroup');
    Route::get('/groups/edit/{id}', [GroupController::class, 'edit'])->name('groups.edit');
    Route::get('/users/edit/{id}', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::get('/admin/genre', [AdminController::class, 'genre'])->name('admin.genre');
    Route::post('/admin/genre/store', [AdminController::class, 'storeGenre'])->name('admin.storeGenre');
    Route::put('/user/{id}/update', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::PUT('/genre/archive/{id}', [AdminController::class, 'archiveGenre'])->name('admin.archiveGenre');
    Route::PUT('/genre/unarchive/{id}', [AdminController::class, 'unarchiveGenre'])->name('admin.unarchiveGenre');
    Route::delete('/group/remove/{id}', [AdminController::class, 'destroyGroup'])->name('groups.destroy');
    Route::put('/user/block/{id}', [AdminController::class, 'blockUser'])->name('admin.blockUser');
    Route::put('/user/unblock/{id}', [AdminController::class, 'unblockUser'])->name('admin.unblockUser');
    Route::get('/group/{groupId}/shareLink', [GroupController::class, 'shareLink'])->name('groups.shareLink');
    Route::get('/group/{groupId}/shareCode', [GroupController::class, 'shareCode'])->name('groups.shareCode');
    Route::get('/users/search', [FilterController::class, 'searchUsers'])->name('user.search');
    Route::get('/admin/quizzes/search', [FilterController::class, 'searchQuizzes'])->name('quiz.search');
    Route::get('/groups/search', [FilterController::class, 'searchGroups'])->name('group.search');
    Route::get('export-quiz/{quizId}', [ReportController::class, 'exportCreatorReport'])->name('exports.quiz');
    Route::get('export-student/{userId}/{quizId}/{attempt}', [ReportController::class, 'exportStudentReport'])->name('exports.student');
    Route::get('export-regenerate/{exportId}', [ReportController::class, 'regenerate'])->name('export.regenerate');
    Route::get('export-history/', [ReportController::class, 'exportHistory'])->name('export.history');
    Route::get('download-quiz/{exportId}', [ReportController::class, 'downloadQuiz'])->name('export.download');
    Route::get('download-student/{exportId}', [ReportController::class, 'downloadStudent'])->name('export.downloadStudent');
    Route::post('/groups/join/code', [GroupController::class, 'joinGroup'])->name('groups.joinCode');
    Route::get('/download-studentreport/pdf/{quizId}', [ReportController::class, 'exportStudentReportPdf'])->name('exports.pdfStudent');
    // Route::post('/upload-chart', [ReportController::class, 'uploadImages'])->name('upload.image');
    Route::get('new/notifications', [NotificationController::class, 'getNewNotifications'])->name('notification.new');
    












    
    



    
    








    





    

       

});

require __DIR__.'/auth.php';
