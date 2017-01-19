<?php

namespace App\Http\Controllers;

use App\DataTables\TagDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Repositories\TagRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TagController extends AppBaseController
{
    /** @var  TagRepository */
    private $tagRepository;

    public function __construct(TagRepository $tagRepo)
    {
        $this->tagRepository = $tagRepo;
    }

    /**
     * Display a listing of the Tag.
     *
     * @param TagDataTable $tagDataTable
     * @return Response
     */
    public function index(TagDataTable $tagDataTable)
    {
        return $tagDataTable->render('tags.index');
    }

    /**
     * Show the form for creating a new Tag.
     *
     * @return Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created Tag in storage.
     *
     * @param CreateTagRequest $request
     *
     * @return Response
     */
    public function store(CreateTagRequest $request)
    {
        $input = $request->all();

        $tag = $this->tagRepository->create($input);

        Flash::success('Tag saved successfully.');

        return redirect(route('tags.index'));
    }

    /**
     * Display the specified Tag.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tag = $this->tagRepository->findWithoutFail($id);

        if (empty($tag)) {
            Flash::error('Tag not found');

            return redirect(route('tags.index'));
        }

        return view('tags.show')->with('tag', $tag);
    }

    /**
     * Show the form for editing the specified Tag.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tag = $this->tagRepository->findWithoutFail($id);

        if (empty($tag)) {
            Flash::error('Tag not found');

            return redirect(route('tags.index'));
        }

        return view('tags.edit')->with('tag', $tag);
    }

    /**
     * Update the specified Tag in storage.
     *
     * @param  int              $id
     * @param UpdateTagRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTagRequest $request)
    {
        $tag = $this->tagRepository->findWithoutFail($id);

        if (empty($tag)) {
            Flash::error('Tag not found');

            return redirect(route('tags.index'));
        }

        $tag = $this->tagRepository->update($request->all(), $id);

        Flash::success('Tag updated successfully.');

        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified Tag from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tag = $this->tagRepository->findWithoutFail($id);

        if (empty($tag)) {
            Flash::error('Tag not found');

            return redirect(route('tags.index'));
        }

        $this->tagRepository->delete($id);

        Flash::success('Tag deleted successfully.');

        return redirect(route('tags.index'));
    }
}
