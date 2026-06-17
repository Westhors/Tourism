<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Http\Requests\PackageRequest;
use App\Http\Resources\PackageResource;
use App\Interfaces\PackageRepositoryInterface;
use App\Models\Package;
use Exception;
use Illuminate\Http\Request;

class PackageController extends BaseController
{
    protected mixed $crudRepository;

    public function __construct(PackageRepositoryInterface $pattern)
    {
        $this->crudRepository = $pattern;
    }

    public function index()
    {
        try {
            $Package = PackageResource::collection($this->crudRepository->all(
                [],
                [],
                ['*']
            ));
            return $Package->additional(JsonResponse::success());
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function show(Package $package)
    {
        try {
            return JsonResponse::respondSuccess('Item Fetched Successfully', new PackageResource($package));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function store(PackageRequest $request)
    {
        try {
            $package = $this->crudRepository->create($request->validated());
            return new PackageResource($package);
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }



    public function update(PackageRequest $request, Package $package): ?\Illuminate\Http\JsonResponse
    {
        try {
            $this->crudRepository->update($request->validated(), $package->id);
            activity()->performedOn($package)->withProperties(['attributes' => $package])->log('update');
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        try {
            $this->crudRepository->deleteRecords('packages', $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_DELETED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function restore(Request $request): ?\Illuminate\Http\JsonResponse
    {
        try {
            $this->crudRepository->restoreItem(Package::class, $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_RESTORED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }


    public function forceDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->crudRepository->deleteRecordsFinial(Package::class, $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_FORCE_DELETED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function indexPublic()
    {
        try {
            $Package = Package::get();
            return PackageResource::collection($Package);
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }
}
