<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBannerItemAPIRequest;
use App\Http\Requests\API\UpdateBannerItemAPIRequest;
use App\Models\BannerItem;
use App\Repositories\BannerItemRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Germey\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BannerItemController
 * @package App\Http\Controllers\API
 */

class BannerItemAPIController extends AppBaseController
{
    /** @var  BannerItemRepository */
    private $bannerItemRepository;

    public function __construct(BannerItemRepository $bannerItemRepo)
    {
        $this->bannerItemRepository = $bannerItemRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/bannerItems",
     *      summary="Get a listing of the BannerItems.",
     *      tags={"BannerItem"},
     *      description="Get all BannerItems",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/BannerItem")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->bannerItemRepository->pushCriteria(new RequestCriteria($request));
        $this->bannerItemRepository->pushCriteria(new LimitOffsetCriteria($request));
        $bannerItems = $this->bannerItemRepository->all();

        return $this->sendResponse($bannerItems->toArray(), 'Banner Items retrieved successfully');
    }

    /**
     * @param CreateBannerItemAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/bannerItems",
     *      summary="Store a newly created BannerItem in storage",
     *      tags={"BannerItem"},
     *      description="Store BannerItem",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BannerItem that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BannerItem")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/BannerItem"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBannerItemAPIRequest $request)
    {
        $input = $request->all();

        $bannerItems = $this->bannerItemRepository->create($input);

        return $this->sendResponse($bannerItems->toArray(), 'Banner Item saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/bannerItems/{id}",
     *      summary="Display the specified BannerItem",
     *      tags={"BannerItem"},
     *      description="Get BannerItem",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BannerItem",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/BannerItem"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var BannerItem $bannerItem */
        $bannerItem = $this->bannerItemRepository->findWithoutFail($id);

        if (empty($bannerItem)) {
            return $this->sendError('Banner Item not found');
        }

        return $this->sendResponse($bannerItem->toArray(), 'Banner Item retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBannerItemAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/bannerItems/{id}",
     *      summary="Update the specified BannerItem in storage",
     *      tags={"BannerItem"},
     *      description="Update BannerItem",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BannerItem",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BannerItem that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BannerItem")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/BannerItem"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBannerItemAPIRequest $request)
    {
        $input = $request->all();

        /** @var BannerItem $bannerItem */
        $bannerItem = $this->bannerItemRepository->findWithoutFail($id);

        if (empty($bannerItem)) {
            return $this->sendError('Banner Item not found');
        }

        $bannerItem = $this->bannerItemRepository->update($input, $id);

        return $this->sendResponse($bannerItem->toArray(), 'BannerItem updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/bannerItems/{id}",
     *      summary="Remove the specified BannerItem from storage",
     *      tags={"BannerItem"},
     *      description="Delete BannerItem",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BannerItem",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var BannerItem $bannerItem */
        $bannerItem = $this->bannerItemRepository->findWithoutFail($id);

        if (empty($bannerItem)) {
            return $this->sendError('Banner Item not found');
        }

        $bannerItem->delete();

        return $this->sendResponse($id, 'Banner Item deleted successfully');
    }
}
