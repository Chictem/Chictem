<?php

namespace App\Http\Controllers;

use App\DataTables\ExpertDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExpertRequest;
use App\Http\Requests\UpdateExpertRequest;
use App\Repositories\ExpertRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ExpertController extends AppBaseController
{
    /** @var  ExpertRepository */
    private $expertRepository;

    public function __construct(ExpertRepository $expertRepo)
    {
        $this->expertRepository = $expertRepo;
    }

    /**
     * Display a listing of the Expert.
     *
     * @param ExpertDataTable $expertDataTable
     * @return Response
     */
    public function index(ExpertDataTable $expertDataTable)
    {
        return $expertDataTable->render('experts.index');
    }

    /**
     * Show the form for creating a new Expert.
     *
     * @return Response
     */
    public function create()
    {
        return view('experts.create');
    }

    /**
     * Store a newly created Expert in storage.
     *
     * @param CreateExpertRequest $request
     *
     * @return Response
     */
    public function store(CreateExpertRequest $request)
    {
        $input = $request->all();

        $expert = $this->expertRepository->create($input);

        Flash::success('Expert saved successfully.');

        return redirect(route('experts.index'));
    }

    /**
     * Display the specified Expert.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $expert = $this->expertRepository->findWithoutFail($id);

        if (empty($expert)) {
            Flash::error('Expert not found');

            return redirect(route('experts.index'));
        }

        return view('experts.show')->with('expert', $expert);
    }

    /**
     * Show the form for editing the specified Expert.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $expert = $this->expertRepository->findWithoutFail($id);

        if (empty($expert)) {
            Flash::error('Expert not found');

            return redirect(route('experts.index'));
        }

        return view('experts.edit')->with('expert', $expert);
    }

    /**
     * Update the specified Expert in storage.
     *
     * @param  int              $id
     * @param UpdateExpertRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExpertRequest $request)
    {
        $expert = $this->expertRepository->findWithoutFail($id);

        if (empty($expert)) {
            Flash::error('Expert not found');

            return redirect(route('experts.index'));
        }

        $expert = $this->expertRepository->update($request->all(), $id);

        Flash::success('Expert updated successfully.');

        return redirect(route('experts.index'));
    }

    /**
     * Remove the specified Expert from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $expert = $this->expertRepository->findWithoutFail($id);

        if (empty($expert)) {
            Flash::error('Expert not found');

            return redirect(route('experts.index'));
        }

        $this->expertRepository->delete($id);

        Flash::success('Expert deleted successfully.');

        return redirect(route('experts.index'));
    }
}
