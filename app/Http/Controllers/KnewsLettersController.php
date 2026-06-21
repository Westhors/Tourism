<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Http\Requests\KnewsLettersRequest;
use App\Http\Resources\KnewsLettersResource;
use App\Interfaces\KnewsLettersRepositoryInterface;
use App\Models\KnewsLetters;
use Exception;
use Illuminate\Http\Request;

class KnewsLettersController extends BaseController
{
    protected mixed $crudRepository;

    public function __construct(KnewsLettersRepositoryInterface $pattern)
    {
        $this->crudRepository = $pattern;
    }

    public function index()
    {
        try {
            $knewsLetter = KnewsLettersResource::collection($this->crudRepository->all(
                [],
                [],
                ['*']
            ));
            return $knewsLetter->additional(JsonResponse::success());
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }


    public function show(KnewsLetters $knews_letter)
    {
        try {
            $knewsLetter = new KnewsLettersResource($knews_letter);
            return $knewsLetter->additional(JsonResponse::success());
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function store(KnewsLettersRequest $request)
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

    public function update(KnewsLettersRequest $request, KnewsLetters $knews_letter)
    {
        try {
            $this->crudRepository->update($request->validated(), $knews_letter->id);
            if ($request->filled('image')) {
                $network = KnewsLetters::find($knews_letter->id);
                $this->crudRepository->AddMediaCollection('image', $network);
            }
            if ($request->filled('slider_image')) {
                $network = KnewsLetters::find($knews_letter->id);
                $this->crudRepository->AddMediaCollection('image', $network, 'slider_image');
            }
            if ($request->filled('gallery')) {
                $network = KnewsLetters::find($knews_letter->id);
                $this->crudRepository->AddMediaCollectionArray('gallery', $network, 'gallery');
            }
            activity()->performedOn($knews_letter)->withProperties(['attributes' => $knews_letter])->log('update');
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY), null);
        } catch (\Exception $e) {
            \Log::error('Error updating KnewsLetters: ' . $e->getMessage());
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY));
        }
        return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY));
    }

    public function destroy(Request $request)
    {
        try {
            $count = $this->crudRepository->deleteRecords('knews_letters', $request['items']);
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
            $this->crudRepository->restoreItem(KnewsLetters::class, $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_RESTORED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }




    public function forceDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->crudRepository->deleteRecordsFinial(KnewsLetters::class, $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_FORCE_DELETED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

}
