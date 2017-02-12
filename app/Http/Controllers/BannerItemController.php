<?php

namespace App\Http\Controllers;

use App\DataTables\BannerItemDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBannerItemRequest;
use App\Http\Requests\UpdateBannerItemRequest;
use App\Repositories\BannerItemRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class BannerItemController extends AppBaseController
{
    /** @var  BannerItemRepository */
    private $bannerItemRepository;

    public function __construct(BannerItemRepository $bannerItemRepo)
    {
        $this->bannerItemRepository = $bannerItemRepo;
    }

    /**
     * Display a listing of the BannerItem.
     *
     * @param BannerItemDataTable $bannerItemDataTable
     * @return Response
     */
    public function index(BannerItemDataTable $bannerItemDataTable)
    {
        return $bannerItemDataTable->render('banner_items.index');
    }

    /**
     * Show the form for creating a new BannerItem.
     *
     * @return Response
     */
    public function create()
    {
        return view('banner_items.create');
    }

    /**
     * Store a newly created BannerItem in storage.
     *
     * @param CreateBannerItemRequest $request
     *
     * @return Response
     */
    public function store(CreateBannerItemRequest $request)
    {
        $input = $request->all();

        $bannerItem = $this->bannerItemRepository->create($input);

        Flash::success('Banner Item saved successfully.');

        return redirect(route('bannerItems.index'));
    }

    /**
     * Display the specified BannerItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bannerItem = $this->bannerItemRepository->findWithoutFail($id);

        if (empty($bannerItem)) {
            Flash::error('Banner Item not found');

            return redirect(route('bannerItems.index'));
        }

        return view('banner_items.show')->with('bannerItem', $bannerItem);
    }

    /**
     * Show the form for editing the specified BannerItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bannerItem = $this->bannerItemRepository->findWithoutFail($id);

        if (empty($bannerItem)) {
            Flash::error('Banner Item not found');

            return redirect(route('bannerItems.index'));
        }

        return view('banner_items.edit')->with('bannerItem', $bannerItem);
    }

    /**
     * Update the specified BannerItem in storage.
     *
     * @param  int              $id
     * @param UpdateBannerItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBannerItemRequest $request)
    {
        $bannerItem = $this->bannerItemRepository->findWithoutFail($id);

        if (empty($bannerItem)) {
            Flash::error('Banner Item not found');

            return redirect(route('bannerItems.index'));
        }

        $bannerItem = $this->bannerItemRepository->update($request->all(), $id);

        Flash::success('Banner Item updated successfully.');

        return redirect(route('bannerItems.index'));
    }

    /**
     * Remove the specified BannerItem from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bannerItem = $this->bannerItemRepository->findWithoutFail($id);

        if (empty($bannerItem)) {
            Flash::error('Banner Item not found');

            return redirect(route('bannerItems.index'));
        }

        $this->bannerItemRepository->delete($id);

        Flash::success('Banner Item deleted successfully.');

        return redirect(route('bannerItems.index'));
    }
}
