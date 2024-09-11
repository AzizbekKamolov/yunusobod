<?php

use App\Http\Controllers\{AuthController,
    BranchController,
    DashboardController,
    DepartmentController,
    DocumentController,
    EmployeeController,
    FileCategoryController,
    OrganizationController,
    PermissionController,
    PositionController,
    RoleController,
    UserController};
use App\Http\Controllers\Accident\{AccidentRecordController, AccidentTypeController};
use App\Http\Controllers\Medical\{MedicalOrderController, MedicalResultController, MedicalStatusController};
use App\Http\Controllers\Quiz\{ExamController, TopicController};
use App\Http\Controllers\Warehouse\{EmployeeProductController, WarehouseCategoryController, WarehouseController};
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('web.login');
    Route::post('login', 'login')->name('web.loginPost');
    Route::post('login-employee', 'loginEmployee')->name('web.loginEmployee');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::controller(DashboardController::class)->name('dashboard.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('change-lang/{lang}', 'changeLang')->name('changeLang');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::controller(OrganizationController::class)->prefix('organizations')->name('organizations.')->group(function () {
        Route::get('home', 'index')->name('index')->can('view_organization');
        Route::get('create', 'create')->name('create')->can('create_organization');
        Route::post('store', 'store')->name('store')->can('create_organization');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_organization');
        Route::get('update/{id}', 'update')->name('update')->can('update_organization');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_organization');
        Route::get('show/{id}', 'show')->name('show')->can('view_organization');

    });

    Route::controller(BranchController::class)->prefix('branches')->name('branches.')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_branch');
        Route::get('create', 'create')->name('create')->can('create_branch');
        Route::post('store', 'store')->name('store')->can('create_branch');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_branch');
        Route::put('update/{id}', 'update')->name('update')->can('update_branch');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_branch');
        Route::get('show/{id}', 'show')->name('show')->can('view_branch');
    });

    Route::controller(DepartmentController::class)->prefix('departments')->name('departments.')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_department');
        Route::get('create', 'create')->name('create')->can('create_department');
        Route::post('store', 'store')->name('store')->can('create_department');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_department');
        Route::put('update/{id}', 'update')->name('update')->can('update_department');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_department');
        Route::get('show/{id}', 'show')->name('show')->can('view_department');
    });

    Route::controller(PositionController::class)->prefix('positions')->name('positions.')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_position');
        Route::get('create', 'create')->name('create')->can('create_position');
        Route::post('store', 'store')->name('store')->can('create_position');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_position');
        Route::put('update/{id}', 'update')->name('update')->can('update_position');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_position');
        Route::get('show/{id}', 'show')->name('show')->can('view_position');
    });

    Route::controller(EmployeeController::class)->prefix('employees')->name('employees.')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_employee');
        Route::get('export', 'export')->name('export')->can('view_employee');
        Route::post('import', 'import')->name('import')->can('view_employee');
        Route::get('create', 'create')->name('create')->can('create_employee');
        Route::post('store', 'store')->name('store')->can('create_employee');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_employee');
        Route::put('update/{id}', 'update')->name('update')->can('update_employee');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_employee');
        Route::get('show/{id}', 'show')->name('show')->can('view_employee');
        Route::get('get-all', 'getAll')->name('getAll');
        Route::get('fileDelete/{id}', 'fileDelete')->name('fileDelete')->can('update_employee');
    });

    // Permissions
    Route::controller(PermissionController::class)->name('permissions.')->prefix('permissions')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_permission');
        Route::get('create', 'create')->name('create')->can('create_permission');
        Route::post('/store', 'store')->name('store')->can('create_permission');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_permission');
        Route::put('/update/{id}', 'update')->name('update')->can('update_permission');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_permission');
    });

    // Roles
    Route::controller(RoleController::class)->name('roles.')->prefix('roles')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_role');
        Route::get('new', 'new')->name('new');
        Route::post('store', 'store')->name('store')->can('create_role');
        Route::get('create', 'create')->name('create')->can('create_role');
//        Route::post('sync-permissions', 'syncPermissions')->name('syncPermissions');
        Route::put('update/{id}', 'update')->name('update')->can('update_role');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_role');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_role');
    });

    //
    Route::controller(UserController::class)->name('users.')->prefix('users')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_user');
        Route::post('store', 'store')->name('store')->can('create_user');
        Route::get('create', 'create')->name('create')->can('create_user');
        Route::get('updateProfile', 'updateProfile')->name('updateProfile');
        Route::put('update/{id}', 'update')->name('update')->can('update_user');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_user');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_user');
    });
    Route::get('profile',[UserController::class,'profile'])->name('user.profile');
    Route::controller(FileCategoryController::class)->name('categories.')->prefix('categories')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_category');
        Route::post('store', 'store')->name('store')->can('create_category');
        Route::get('create', 'create')->name('create')->can('create_category');
        Route::put('update/{id}', 'update')->name('update')->can('update_category');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_category');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_category');
    });
    Route::controller(DocumentController::class)->name('documents.')->prefix('documents')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_document');
        Route::post('store', 'store')->name('store')->can('create_document');
        Route::get('create', 'create')->name('create')->can('create_document');
        Route::put('update/{id}', 'update')->name('update')->can('update_document');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_document');
        Route::get('file/{id}/delete', 'fileDelete')->name('fileDelete')->can('delete_document');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_document');
    });
    Route::controller(TopicController::class)->prefix('topics')->group(function () {
        Route::get('index', 'index')->name('topics.index')->can('view_topic');
        Route::post('store', 'store')->name('topics.store')->can('create_topic');
        Route::get('create', 'create')->name('topics.create')->can('create_topic');
        Route::put('update/{id}', 'update')->name('topics.update')->can('update_topic');
        Route::get('edit/{id}', 'edit')->name('topics.edit')->can('update_topic');
        Route::get('delete/{id}', 'delete')->name('topics.delete')->can('delete_topic');
        Route::get('get/{lang}', 'getAll')->name('topics.getAll')->can('view_topic');

        //questions
        Route::get('{topic}/get-questions', 'getQuestions')->name('questions.index')->can('view_question');
        Route::post('{topic}/store-question', 'storeQuestion')->name('questions.store')->can('create_question');
        Route::get('{topic}/create-question', 'createQuestion')->name('questions.create')->can('create_question');
        Route::post('{topic}/import-question', 'import')->name('questions.import')->can('create_question');
        Route::put('{topic}/update-question/{id}', 'updateQuestion')->name('questions.update')->can('update_question');
        Route::get('{topic}/edit-question/{id}', 'editQuestion')->name('questions.edit')->can('update_question');
        Route::get('{topic}/delete-question/{id}', 'deleteQuestion')->name('questions.delete')->can('delete_question');
    });
    Route::controller(ExamController::class)->prefix('exams')->name('exams.')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_exam');
        Route::post('store', 'store')->name('store')->can('create_exam');
        Route::get('create', 'create')->name('create')->can('create_exam');
        Route::put('update/{id}', 'update')->name('update')->can('update_exam');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_exam');
        Route::get('show/{id}', 'show')->name('show')->can('view_exam');
        Route::get('result/{id}', 'result')->name('result')->can('view_exam');
        Route::get('{id}/export', 'exportAttempt')->name('exportAttempt')->can('view_exam');
        Route::get('{id}/attempt', 'showAttempt')->name('showAttempt')->can('view_exam');
        Route::post('{id}/check-attempt', 'checkAttempt')->name('checkAttempt')->can('view_exam');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_exam');
    });

    Route::controller(MedicalStatusController::class)->name('medical.statuses.')->prefix('medical-statuses')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_medicalstatus');
        Route::post('store', 'store')->name('store')->can('create_medicalstatus');
        Route::get('create', 'create')->name('create')->can('create_medicalstatus');
        Route::put('update/{id}', 'update')->name('update')->can('update_medicalstatus');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_medicalstatus');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_medicalstatus');
    });
    Route::controller(MedicalOrderController::class)->name('medical.orders.')->prefix('medical-orders')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_medicalorder');
        Route::post('store', 'store')->name('store')->can('create_medicalorder');
        Route::get('create', 'create')->name('create')->can('create_medicalorder');
        Route::put('update/{id}', 'update')->name('update')->can('update_medicalorder');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_medicalorder');
        Route::get('show/{id}', 'show')->name('show')->can('view_medicalorder');
        Route::get('export/{id}', 'export')->name('export')->can('view_medicalorder');
        Route::get('file/{id}/delete', 'fileDelete')->name('fileDelete')->can('delete_medicalorder');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_medicalorder');
    });
    Route::controller(MedicalResultController::class)->name('medical.results.')->prefix('medical-results')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_medicalresult');
        Route::post('store', 'store')->name('store')->can('create_medicalresult');
        Route::get('create', 'create')->name('create')->can('create_medicalresult');
        Route::put('update/{id}', 'update')->name('update')->can('update_medicalresult');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_medicalresult');
        Route::get('file/{id}/delete', 'fileDelete')->name('fileDelete')->can('delete_medicalresult');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_medicalresult');
    });
    Route::controller(AccidentTypeController::class)->name('accident.accidenttype.')->prefix('accident-accidenttype')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_accidenttype');
        Route::post('store', 'store')->name('store')->can('create_accidenttype');
        Route::get('create', 'create')->name('create')->can('create_accidenttype');
        Route::put('update/{id}', 'update')->name('update')->can('update_accidenttype');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_accidenttype');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_accidenttype');
    });
    Route::controller(AccidentRecordController::class)->name('accident.accidentrecord.')->prefix('accident-accidentrecord')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_accidentrecord');
        Route::get('export', 'export')->name('export')->can('view_accidentrecord');
        Route::post('store', 'store')->name('store')->can('create_accidentrecord');
        Route::get('create', 'create')->name('create')->can('create_accidentrecord');
        Route::put('update/{id}', 'update')->name('update')->can('update_accidentrecord');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_accidentrecord');
        Route::get('file/{id}/delete', 'fileDelete')->name('fileDelete')->can('delete_accidentrecord');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_accidentrecord');
    });

    Route::controller(WarehouseCategoryController::class)->name('warehouse.warehousecategory.')->prefix('warehouse-category')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_warehousecategory');
        Route::get('all', 'all');
        Route::post('store', 'store')->name('store')->can('create_warehousecategory');
        Route::get('create', 'create')->name('create')->can('create_warehousecategory');
        Route::put('update/{id}', 'update')->name('update')->can('update_warehousecategory');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_warehousecategory');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_warehousecategory');
    });
    Route::controller(WarehouseController::class)->name('warehouse.')->prefix('warehouse')->group(function () {
        Route::get('index', 'index')->name('index')->can('view_warehouse');
        Route::post('store', 'store')->name('store')->can('create_warehouse');
        Route::get('create', 'create')->name('create')->can('create_warehouse');
        Route::put('update/{id}', 'update')->name('update')->can('update_warehouse');
        Route::get('edit/{id}', 'edit')->name('edit')->can('update_warehouse');
        Route::get('export', 'export')->name('export')->can('view_warehouse');
        Route::get('exportProductEmployees/{id}', 'exportProductEmployees')->name('exportProductEmployees')->can('view_warehouse');
        Route::get('show/{id}', 'show')->name('show')->can('view_warehouse');
        Route::get('delete/{id}', 'delete')->name('delete')->can('delete_warehouse');
    });
    Route::controller(EmployeeProductController::class)->name('employee_product.')->prefix('employee-product')->group(function () {
        Route::post('store', 'store')->name('store');
        Route::put('update/{id}', 'update')->name('update');
        Route::get('delete/{id}', 'delete')->name('delete');
    });
});
