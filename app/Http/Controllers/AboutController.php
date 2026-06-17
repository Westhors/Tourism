<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Http\Requests\AboutRequest;
use App\Http\Resources\AboutResource;
use App\Interfaces\AboutRepositoryInterface;
use App\Models\About;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends BaseController
{
    protected mixed $crudRepository;

    public function __construct(AboutRepositoryInterface $pattern)
    {
        $this->crudRepository = $pattern;
    }


    public function index()
    {
        try {
            $About = AboutResource::collection($this->crudRepository->all(
                [],
                [],
                ['*']

            ));
            return $About->additional(JsonResponse::success());
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function store(AboutRequest $request)
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

    public function show(About $about)
    {
        try {
            return JsonResponse::respondSuccess('Item Fetched Successfully', new AboutResource($about));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function update(AboutRequest $request, About $about)
    {
        try {
            $this->crudRepository->update($request->validated(), $about->id);
            $aboutImage = About::find($about->id);
            $image = $this->crudRepository->AddMediaCollection('image', $aboutImage);
            activity()->performedOn($about)->withProperties(['attributes' => $about])->log('update');
        } catch (\Exception $e) {
            \Log::error('Error updating About: ' . $e->getMessage());

            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY));
        }
        return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY));
    }

    public function destroy(Request $request)
    {
        try {
            $this->crudRepository->deleteRecords('abouts', $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_DELETED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function restore(Request $request): ?\Illuminate\Http\JsonResponse
    {
        try {
            $this->crudRepository->restoreItem(About::class, $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_RESTORED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function forceDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->crudRepository->deleteRecordsFinial(About::class, $request['items']);
            DB::table('pages_page_sections')->whereIn('page_id', $request['items'])->delete();
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_FORCE_DELETED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

}

