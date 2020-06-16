<?php

namespace App\Http\Controllers;


use App\Http\Requests\Advertisement\CreateAdvertisementRequest;
use App\Http\Requests\Advertisement\GetAdvertisementRequest;
use App\Http\Requests\Advertisement\UpdateAdvertisementRequest;
use App\Models\Advertisement;
use App\Services\AdvertisementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AdvertisementController
{

    private $advertisementService;

    public function __construct(AdvertisementService $advertisementService)
    {
        return $this->advertisementService = $advertisementService;
    }

    public function index()
    {
        $advertisements = Advertisement::paginate(5);
        return view('advertisements', compact('advertisements'));
    }

    public function store(CreateAdvertisementRequest $request): JsonResponse
    {
        $adv = $this->advertisementService->createAdvertisement(
            $request->validated(),
            $request->user(),
            $request->file('image')
        );

        return response()->json($adv, Response::HTTP_CREATED);
    }

    public function show(int $advertisementId)
    {
        return $this->advertisementService->getAdvertisementInfo($advertisementId);
    }

    /**
     * @param $advertisementId
     * @param UpdateAdvertisementRequest $request
     * @return Advertisement
     * @throws \Exception
     */
    public function update($advertisementId, UpdateAdvertisementRequest $request)
    {
        return $this->advertisementService->updateAdvertisement($advertisementId, $request->validated(), $request->user());
    }

    /**
     * @param int $advertisement
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(int $advertisement, Request $request): JsonResponse
    {
        $status = $this->advertisementService->deleteAdvertisement($advertisement, $request->user());

        return response()->json(['status' => $status], ($status ? Response::HTTP_OK : Response::HTTP_FORBIDDEN));
    }
}
