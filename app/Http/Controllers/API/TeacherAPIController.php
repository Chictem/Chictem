<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTeacherAPIRequest;
use App\Http\Requests\API\UpdateTeacherAPIRequest;
use App\Models\Teacher;
use App\Repositories\TeacherRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Germey\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TeacherController
 * @package App\Http\Controllers\API
 */

class TeacherAPIController extends AppBaseController
{
    /** @var  TeacherRepository */
    private $teacherRepository;

    public function __construct(TeacherRepository $teacherRepo)
    {
        $this->teacherRepository = $teacherRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/teachers",
     *      summary="Get a listing of the Teachers.",
     *      tags={"Teacher"},
     *      description="Get all Teachers",
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
     *                  @SWG\Items(ref="#/definitions/Teacher")
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
        $this->teacherRepository->pushCriteria(new RequestCriteria($request));
        $this->teacherRepository->pushCriteria(new LimitOffsetCriteria($request));
        $teachers = $this->teacherRepository->all();

        return $this->sendResponse($teachers->toArray(), 'Teachers retrieved successfully');
    }

    /**
     * @param CreateTeacherAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/teachers",
     *      summary="Store a newly created Teacher in storage",
     *      tags={"Teacher"},
     *      description="Store Teacher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Teacher that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Teacher")
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
     *                  ref="#/definitions/Teacher"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTeacherAPIRequest $request)
    {
        $input = $request->all();

        $teachers = $this->teacherRepository->create($input);

        return $this->sendResponse($teachers->toArray(), 'Teacher saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/teachers/{id}",
     *      summary="Display the specified Teacher",
     *      tags={"Teacher"},
     *      description="Get Teacher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Teacher",
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
     *                  ref="#/definitions/Teacher"
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
        /** @var Teacher $teacher */
        $teacher = $this->teacherRepository->findWithoutFail($id);

        if (empty($teacher)) {
            return $this->sendError('Teacher not found');
        }

        return $this->sendResponse($teacher->toArray(), 'Teacher retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTeacherAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/teachers/{id}",
     *      summary="Update the specified Teacher in storage",
     *      tags={"Teacher"},
     *      description="Update Teacher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Teacher",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Teacher that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Teacher")
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
     *                  ref="#/definitions/Teacher"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTeacherAPIRequest $request)
    {
        $input = $request->all();

        /** @var Teacher $teacher */
        $teacher = $this->teacherRepository->findWithoutFail($id);

        if (empty($teacher)) {
            return $this->sendError('Teacher not found');
        }

        $teacher = $this->teacherRepository->update($input, $id);

        return $this->sendResponse($teacher->toArray(), 'Teacher updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/teachers/{id}",
     *      summary="Remove the specified Teacher from storage",
     *      tags={"Teacher"},
     *      description="Delete Teacher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Teacher",
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
        /** @var Teacher $teacher */
        $teacher = $this->teacherRepository->findWithoutFail($id);

        if (empty($teacher)) {
            return $this->sendError('Teacher not found');
        }

        $teacher->delete();

        return $this->sendResponse($id, 'Teacher deleted successfully');
    }
}
