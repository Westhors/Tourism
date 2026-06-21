<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Http\Requests\JobRequest;
use App\Http\Resources\JobResource;
use App\Interfaces\JobRepositoryInterface;
use App\Models\Job;
use Exception;
use Illuminate\Http\Request;

class JobController extends BaseController
{
    protected mixed $crudRepository;

    public function __construct(JobRepositoryInterface $pattern)
    {
        $this->crudRepository = $pattern;
    }

    public function index()
    {
        try {
            $message = JobResource::collection($this->crudRepository->all(
                [],
                [],
                ['*']
            ));
            return $message->additional(JsonResponse::success());
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }



    public function show(Job $job): ?\Illuminate\Http\JsonResponse
    {
        try {
            return JsonResponse::respondSuccess('Item fetched successfully', new JobResource($job));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function store(JobRequest $request)
    {
        try {
            $content = $this->crudRepository->create($request->validated());
            if (request('cv') !== null) {
                $this->crudRepository->AddMediaCollection('cv', $content);
            }
            return new JobResource($content);
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function update(JobRequest $request, Job $job): \Illuminate\Http\JsonResponse
    {
        try {
           $job =  $this->crudRepository->update($request->validated(), $job->id);
           if (request('cv') !== null) {
                $job = Job::find($job->id);
                $this->crudRepository->AddMediaCollection('cv', $job );
            }
            activity()->performedOn($job)->withProperties(['attributes' => $job])->log('update');
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_UPDATED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->crudRepository->deleteRecords('request_jobs', $request['items']);
            return  JsonResponse::respondSuccess(trans(JsonResponse::MSG_DELETED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    public function restore(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->crudRepository->restoreItem(Job::class, $request['items']);
            return JsonResponse::respondSuccess(trans(JsonResponse::MSG_RESTORED_SUCCESSFULLY));
        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

}
