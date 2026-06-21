<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Http\Requests\PageContactUsRequest;
use App\Http\Resources\PageContactUsResource;
use App\Interfaces\PageContactUsRepositoryInterface;
use App\Models\PageContactUs;
use Exception;
use Illuminate\Http\Request;

class PageContactUsController extends BaseController
{
    protected mixed $crudRepository;

    public function __construct(PageContactUsRepositoryInterface $pattern)
    {
        $this->crudRepository = $pattern;
    }

    public function index()
    {
        try {
            $pageContactUs = PageContactUsResource::collection($this->crudRepository->all(
                [],
                [],
                ['*']
            ));
            return $pageContactUs->additional(JsonResponse::success());
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }


    public function show(PageContactUs $page_contact_u)
    {
        try {
            $pageContactUs = new PageContactUsResource($page_contact_u);
            return $pageContactUs->additional(JsonResponse::success());
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function store(PageContactUsRequest $request)
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

    public function update(PageContactUsRequest $request, PageContactUs $page_contact_u)
    {
        try {
            $this->crudRepository->update($request->validated(), $page_contact_u->id);
            if ($request->filled('image')) {
                $network = PageContactUs::find($page_contact_u->id);
                $this->crudRepository->AddMediaCollection('image', $network);
            }
            if ($request->filled('slider_image')) {
                $network = PageContactUs::find($page_contact_u->id);
                $this->crudRepository->AddMediaCollection('image', $network, 'slider_image');
            }
            if ($request->filled('gallery')) {
                $network = PageContactUs::find($page_contact_u->id);
                $this->crudRepository->AddMediaCollectionArray('gallery', $network, 'gallery');
            }
            activity()->performedOn($page_contact_u)->withProperties(['attributes' => $page_contact_u])->log('update');
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY), null);
        } catch (\Exception $e) {
            \Log::error('Error updating PageContactUs: ' . $e->getMessage());
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY));
        }
        return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY));
    }

    public function destroy(Request $request)
    {
        try {
            $count = $this->crudRepository->deleteRecords('page_contact_us', $request['items']);
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
            $this->crudRepository->restoreItem(PageContactUs::class, $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_RESTORED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }




    public function forceDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->crudRepository->deleteRecordsFinial(PageContactUs::class, $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_FORCE_DELETED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

}
