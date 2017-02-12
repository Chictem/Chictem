<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExpertAPIRequest;
use App\Http\Requests\API\UpdateExpertAPIRequest;
use App\Models\Expert;
use App\Repositories\ExpertRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Germey\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ExpertController
 * @package App\Http\Controllers\API
 */

class ExpertAPIController extends AppBaseController
{
    /** @var  ExpertRepository */
    private $expertRepository;

    public function __construct(ExpertRepository $expertRepo)
    {
        $this->expertRepository = $expertRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/experts",
     *      summary="Get a listing of the Experts.",
     *      tags={"Expert"},
     *      description="Get all Experts",
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
     *                  @SWG\Items(ref="#/definitions/Expert")
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
        $this->expertRepository->pushCriteria(new RequestCriteria($request));
        $this->expertRepository->pushCriteria(new LimitOffsetCriteria($request));
        $experts = $this->expertRepository->all();

        return $this->sendResponse($experts->toArray(), 'Experts retrieved successfully');
    }

    /**
     * @param CreateExpertAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/experts",
     *      summary="Store a newly created Expert in storage",
     *      tags={"Expert"},
     *      description="Store Expert",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Expert that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Expert")
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
     *                  ref="#/definitions/Expert"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateExpertAPIRequest $request)
    {
        $input = $request->all();

        $experts = $this->expertRepository->create($input);

        return $this->sendResponse($experts->toArray(), 'Expert saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/experts/{id}",
     *      summary="Display the specified Expert",
     *      tags={"Expert"},
     *      description="Get Expert",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Expert",
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
     *                  ref="#/definitions/Expert"
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
        /** @var Expert $expert */
        $expert = $this->expertRepository->findWithoutFail($id);

        if (empty($expert)) {
            return $this->sendError('Expert not found');
        }

        return $this->sendResponse($expert->toArray(), 'Expert retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateExpertAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/experts/{id}",
     *      summary="Update the specified Expert in storage",
     *      tags={"Expert"},
     *      description="Update Expert",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Expert",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Expert that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Expert")
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
     *                  ref="#/definitions/Expert"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateExpertAPIRequest $request)
    {
        $input = $request->all();

        /** @var Expert $expert */
        $expert = $this->expertRepository->findWithoutFail($id);

        if (empty($expert)) {
            return $this->sendError('Expert not found');
        }

        $expert = $this->expertRepository->update($input, $id);

        return $this->sendResponse($expert->toArray(), 'Expert updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/experts/{id}",
     *      summary="Remove the specified Expert from storage",
     *      tags={"Expert"},
     *      description="Delete Expert",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Expert",
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
        /** @var Expert $expert */
        $expert = $this->expertRepository->findWithoutFail($id);

        if (empty($expert)) {
            return $this->sendError('Expert not found');
        }

        $expert->delete();

        return $this->sendResponse($id, 'Expert deleted successfully');
    }
}
