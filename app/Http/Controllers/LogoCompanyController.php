<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Http\Requests\LogoCompanyRequest;
use App\Http\Resources\LogoCompanyResource;
use App\Interfaces\LogoCompanyRepositoryInterface;
use App\Models\LogoCompany;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogoCompanyController extends BaseController
{
    protected mixed $crudRepository;

    public function __construct(LogoCompanyRepositoryInterface $pattern)
    {
        $this->crudRepository = $pattern;
    }


    public function index()
    {
        try {
            $LogoCompany = LogoCompanyResource::collection($this->crudRepository->all(
                [],
                [],
                ['*']

            ));
            return $LogoCompany->additional(JsonResponse::success());
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function store(LogoCompanyRequest $request)
    {
        try {
            $model = $this->crudRepository->create($request->validated());
            if (request('image') !== null) {
                $this->crudRepository->AddMediaCollection('image', $model);
            }
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_ADDED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function show(LogoCompany $logo_company)
    {
        try {
            return JsonResponse::respondSuccess('Item Fetched Successfully', new LogoCompanyResource($logo_company));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function update(LogoCompanyRequest $request, LogoCompany $logo_company)
    {
        try {
            $this->crudRepository->update($request->validated(), $logo_company->id);
            $logoCompanyImage = LogoCompany::find($logo_company->id);
            $image = $this->crudRepository->AddMediaCollection('image', $logoCompanyImage);
            activity()->performedOn($logo_company)->withProperties(['attributes' => $logo_company])->log('update');
        } catch (\Exception $e) {
            \Log::error('Error updating LogoCompany: ' . $e->getMessage());

            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY));
        }
        return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY));
    }

    public function destroy(Request $request)
    {
        try {
            $this->crudRepository->deleteRecords('logo_companies', $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_DELETED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function restore(Request $request): ?\Illuminate\Http\JsonResponse
    {
        try {
            $this->crudRepository->restoreItem(LogoCompany::class, $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_RESTORED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function forceDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->crudRepository->deleteRecordsFinial(LogoCompany::class, $request['items']);
            DB::table('pages_page_sections')->whereIn('page_id', $request['items'])->delete();
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_FORCE_DELETED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }


    public function indexPublic()
    {
        try {
            $slider = LogoCompany::where('show_home', 1)
                ->orderBy('position', 'asc')
                ->get();
            return LogoCompanyResource::collection($slider);
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }
    public function indexPublicExpo()
    {
        try {
            $slider = LogoCompany::where('show_expo', 1)
                ->orderBy('position', 'asc')
                ->get();
            return LogoCompanyResource::collection($slider);
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }
}

