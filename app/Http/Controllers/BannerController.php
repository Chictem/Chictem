<?php

namespace App\Http\Controllers;

use App\DataTables\BannerDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Repositories\BannerRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class BannerController extends AppBaseController
{
    /** @var  BannerRepository */
    private $bannersRepository;

    public function __construct(BannerRepository $bannersRepo)
    {
        $this->bannersRepository = $bannersRepo;
    }

    /**
     * Display a listing of the Banner.
     *
     * @param BannerDataTable $bannersDataTable
     * @return Response
     */
    public function index(BannerDataTable $bannersDataTable)
    {
        return $bannersDataTable->render('banners.index');
    }

    /**
     * Show the form for creating a new Banner.
     *
     * @return Response
     */
    public function create()
    {
        return view('banners.create');
    }

    /**
     * Store a newly created Banner in storage.
     *
     * @param CreateBannerRequest $request
     *
     * @return Response
     */
    public function store(CreateBannerRequest $request)
    {
        $input = $request->all();

        $banners = $this->bannersRepository->create($input);

        Flash::success('Banner saved successfully.');

        return redirect(route('banners.index'));
    }

    /**
     * Display the specified Banner.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $banners = $this->bannersRepository->findWithoutFail($id);

        if (empty($banners)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        return view('banners.show')->with('banners', $banners);
    }

    /**
     * Show the form for editing the specified Banner.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $banners = $this->bannersRepository->findWithoutFail($id);

        if (empty($banners)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        return view('banners.edit')->with('banners', $banners);
    }

    /**
     * Update the specified Banner in storage.
     *
     * @param  int              $id
     * @param UpdateBannerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBannerRequest $request)
    {
        $banners = $this->bannersRepository->findWithoutFail($id);

        if (empty($banners)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        $banners = $this->bannersRepository->update($request->all(), $id);

        Flash::success('Banner updated successfully.');

        return redirect(route('banners.index'));
    }

    /**
     * Remove the specified Banner from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $banners = $this->bannersRepository->findWithoutFail($id);

        if (empty($banners)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        $this->bannersRepository->delete($id);

        Flash::success('Banner deleted successfully.');

        return redirect(route('banners.index'));
    }
}
