<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Interfaces\ServiceRepositoryInterface;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends BaseController
{
    protected mixed $crudRepository;

    public function __construct(ServiceRepositoryInterface $pattern)
    {
        $this->crudRepository = $pattern;
    }

    public function index()
    {
        try {
            $service = ServiceResource::collection($this->crudRepository->all(
                [],
                [],
                ['*']
            ));
            return $service->additional(JsonResponse::success());
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }


    public function show(Service $service)
    {
        try {
            $service = new ServiceResource($service);
            return $service->additional(JsonResponse::success());
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function store(ServiceRequest $request)
    {
        try {
            $model = $this->crudRepository->create($request->validated());
            if (request('image') !== null) {
                $this->crudRepository->AddMediaCollection('image', $model);
            }
            if (request('slider_image') !== null) {
                $this->crudRepository->AddMediaCollection('slider_image', $model , 'slider_image');
            }
            if (request('gallery') !== null) {
                $this->crudRepository->AddMediaCollectionArray('gallery', $model, 'gallery');
            }
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_ADDED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function update(ServiceRequest $request, Service $service)
    {
        try {
            $this->crudRepository->update($request->validated(), $service->id);
            if ($request->filled('image')) {
                $network = Service::find($service->id);
                $this->crudRepository->AddMediaCollection('image', $network);
            }
            if ($request->filled('slider_image')) {
                $network = Service::find($service->id);
                $this->crudRepository->AddMediaCollection('image', $network, 'slider_image');
            }
            if ($request->filled('gallery')) {
                $network = Service::find($service->id);
                $this->crudRepository->AddMediaCollectionArray('gallery', $network, 'gallery');
            }
            activity()->performedOn($service)->withProperties(['attributes' => $service])->log('update');
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY), null);
        } catch (\Exception $e) {
            \Log::error('Error updating LogoCompany: ' . $e->getMessage());
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY));
        }
        return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY));
    }

    public function destroy(Request $request)
    {
        try {
            $count = $this->crudRepository->deleteRecords('services', $request['items']);
            return $count > 1
                ? JsonResponse::respondError(trans("responses.msg_multi_resources_cannot_deleted"))
                : ($count == 1 ? JsonResponse::respondError(trans("responses.msg_cannot_deleted"))
                    : JsonResponse::respondSuccess(trans(JsonResponse::MSG_DELETED_SUCCESSFULLY)));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function restore(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->crudRepository->restoreItem(Service::class, $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_RESTORED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }




    public function forceDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->crudRepository->deleteRecordsFinial(Service::class, $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_FORCE_DELETED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

}
