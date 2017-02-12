<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBannerAPIRequest;
use App\Http\Requests\API\UpdateBannerAPIRequest;
use App\Models\Banner;
use App\Repositories\BannerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Germey\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BannerController
 * @package App\Http\Controllers\API
 */

class BannerAPIController extends AppBaseController
{
    /** @var  BannerRepository */
    private $bannersRepository;

    public function __construct(BannerRepository $bannersRepo)
    {
        $this->bannersRepository = $bannersRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/banners",
     *      summary="Get a listing of the Banner.",
     *      tags={"Banner"},
     *      description="Get all Banner",
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
     *                  @SWG\Items(ref="#/definitions/Banner")
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
        $this->bannersRepository->pushCriteria(new RequestCriteria($request));
        $this->bannersRepository->pushCriteria(new LimitOffsetCriteria($request));
        $banners = $this->bannersRepository->all();

        return $this->sendResponse($banners->toArray(), 'Banner retrieved successfully');
    }

    /**
     * @param CreateBannerAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/banners",
     *      summary="Store a newly created Banner in storage",
     *      tags={"Banner"},
     *      description="Store Banner",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Banner that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Banner")
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
     *                  ref="#/definitions/Banner"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBannerAPIRequest $request)
    {
        $input = $request->all();

        $banners = $this->bannersRepository->create($input);

        return $this->sendResponse($banners->toArray(), 'Banner saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/banners/{id}",
     *      summary="Display the specified Banner",
     *      tags={"Banner"},
     *      description="Get Banner",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Banner",
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
     *                  ref="#/definitions/Banner"
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
        /** @var Banner $banners */
        $banners = $this->bannersRepository->findWithoutFail($id);

        if (empty($banners)) {
            return $this->sendError('Banner not found');
        }

        return $this->sendResponse($banners->toArray(), 'Banner retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBannerAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/banners/{id}",
     *      summary="Update the specified Banner in storage",
     *      tags={"Banner"},
     *      description="Update Banner",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Banner",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Banner that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Banner")
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
     *                  ref="#/definitions/Banner"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBannerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Banner $banners */
        $banners = $this->bannersRepository->findWithoutFail($id);

        if (empty($banners)) {
            return $this->sendError('Banner not found');
        }

        $banners = $this->bannersRepository->update($input, $id);

        return $this->sendResponse($banners->toArray(), 'Banner updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/banners/{id}",
     *      summary="Remove the specified Banner from storage",
     *      tags={"Banner"},
     *      description="Delete Banner",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Banner",
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
        /** @var Banner $banners */
        $banners = $this->bannersRepository->findWithoutFail($id);

        if (empty($banners)) {
            return $this->sendError('Banner not found');
        }

        $banners->delete();

        return $this->sendResponse($id, 'Banner deleted successfully');
    }
}
