<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Http\Requests\ExpoApplicationFormRequest;
use App\Http\Requests\ExpoCompanyRequest;
use App\Http\Resources\ExpoCompanyResource;
use App\Interfaces\ExpoCompanyRepositoryInterface;
use App\Models\Expo;
use App\Models\ExpoCompany;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ExpoCompanyController extends BaseController
{
    protected mixed $crudRepository;

    public function __construct(ExpoCompanyRepositoryInterface $pattern)
    {
        $this->crudRepository = $pattern;
    }

    public function index()
    {
        try {
            $expo = ExpoCompanyResource::collection($this->crudRepository->all([]));
            return $expo->additional(JsonResponse::success());
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function store(ExpoCompanyRequest $request)
    {
        try {
            $expo = $this->crudRepository->create($request->validated());
            if (request('image') !== null) {
                $this->crudRepository->AddMediaCollection('image', $expo);
            }
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_ADDED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }



    public function show(ExpoCompany $expo_company)
    {
        try {
            $expoResource = new ExpoCompanyResource($expo_company);
            return $expoResource->additional(JsonResponse::success());
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function update(ExpoCompanyRequest $request, ExpoCompany $expo_company)
    {
        try {
            $expo_company = $this->crudRepository->find($expo_company->id);
            if (request('image') !== null) {
                $expoImage = ExpoCompany::find($expo_company->id);
                $this->crudRepository->AddMediaCollection('image', $expoImage);
            }
            $expo_company->update($request->validated());
            activity()->performedOn($expo_company)->withProperties(['attributes' => $expo_company])->log('update');
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $count = $this->crudRepository->deleteRecords('expo_companies', $request['items']);
            return $count > 1
                ? JsonResponse::respondError(trans(JsonResponse::MSG_CANNOT_DELETED_MULTI_RESOURCE))
                : ($count == 1 ? JsonResponse::respondError(trans(JsonResponse::MSG_CANNOT_DELETED))
                    : JsonResponse::respondSuccess(trans(JsonResponse::MSG_DELETED_SUCCESSFULLY)));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function restore(Request $request)
    {
        try {
            $this->crudRepository->restoreItem(ExpoCompany::class, $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_RESTORED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }


    public function forceDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->crudRepository->deleteRecordsFinial(ExpoCompany::class, $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_FORCE_DELETED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

}
