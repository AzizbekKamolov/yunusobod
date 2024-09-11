<?php

namespace App\Http\Controllers\Accident;

use Akbarali\ViewModel\PaginationViewModel;
use App\ActionData\Accident\AccidentRecord\CreateAccidentRecordActionData;
use App\ActionData\Accident\AccidentRecord\ExportAccidentRecordActionData;
use App\ActionData\Accident\AccidentRecord\UpdateAccidentRecordActionData;
use App\DataObjects\Accident\AccidentRecord\AccidentRecordData;
use App\DataObjects\Accident\AccidentType\AccidentTypeData;
use App\Exports\Accident\AccidentRecordExport;
use App\Filters\Accident\AccidentRecordFilter;
use App\Http\Controllers\Controller;
use App\Services\Accident\AccidentRecordService;
use App\Services\Accident\AccidentTypeService;
use App\Services\EmployeeService;
use App\Services\FileService;
use App\ViewModels\Accident\AccidentRecord\AccidentRecordViewModel;
use App\ViewModels\Accident\AccidentType\AccidentTypeViewModel;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;


class AccidentRecordController extends Controller
{
    public function __construct(
        protected AccidentRecordService $service,
        protected AccidentTypeService   $accidentTypeService,
        protected EmployeeService       $employeeService,
    )
    {
    }

    /**
     * @return View
     */
    public function index(Request $request): View
    {
        $filters[] = AccidentRecordFilter::getRequest($request);
        $accidentTypes = $this->accidentTypeService->getAccidentTypes()->transform(fn(AccidentTypeData $data) => AccidentTypeViewModel::fromDataObject($data));
        $collection = $this->service->paginate(page: $request->get('page', 1),limit: (int)$request->get('limit', 10),filters: $filters);
        return (new PaginationViewModel($collection, AccidentRecordViewModel::class))
            ->toView('admin.accident.accidentrecord.index',compact('accidentTypes'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $accidenttypes = $this->accidentTypeService->getAccidentTypes()->transform(fn(AccidentTypeData $accidentTypeData) => AccidentTypeViewModel::fromDataObject($accidentTypeData));
        return view('admin.accident.accidentrecord.create', compact('accidenttypes'));
    }

    /**
     * @param CreateAccidentRecordActionData $actionData
     * @return RedirectResponse
     */
    public function store(CreateAccidentRecordActionData $actionData): RedirectResponse
    {
        $this->service->createAccidentRecord($actionData);
        return redirect()->route('accident.accidentrecord.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_create', ['attribute' => trans('form.accident.accidentrecord')])
        ]);
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $accidenttypes = $this->accidentTypeService->getAccidentTypes()->transform(fn(AccidentTypeData $accidentTypeData) => AccidentTypeViewModel::fromDataObject($accidentTypeData));
        $viewModel = AccidentRecordViewModel::fromDataObject($this->service->edit($id));
        return $viewModel->toView('admin.accident.accidentrecord.edit', compact('accidenttypes'));
    }

    /**
     * @param UpdateAccidentRecordActionData $actionData
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateAccidentRecordActionData $actionData, int $id): RedirectResponse
    {
        $this->service->updateAccidentRecord($actionData, $id);
        return redirect()->route('accident.accidentrecord.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_update', ['attribute' => trans('form.accident.accidentrecord')])
        ]);

    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->service->deleteAccidentRecord($id);
        return redirect()->route('accident.accidentrecord.index')->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.accident.accidentrecord')])
        ]);
    }

    public function fileDelete(int $id): RedirectResponse
    {
        $documentId = FileService::fileDelete('medicals', $id);
        return redirect()->route('accident.accidentrecord.edit', [$documentId])->with('res', [
            'method' => 'success',
            'msg' => trans('form.success_delete', ['attribute' => trans('form.documents.document')]),
        ]);
    }

    public function export(ExportAccidentRecordActionData $actionData)
    {
        $accidentRecords = $this->service->exportAccidentRecords($actionData)->transform(fn(AccidentRecordData $data) => AccidentRecordViewModel::fromDataObject($data));
        $fileName = trans('form.accident.accidentrecords')."(".Carbon::now()->format('d-m-Y').").xlsx";
        return Excel::download(new AccidentRecordExport($accidentRecords),$fileName);
    }
}
