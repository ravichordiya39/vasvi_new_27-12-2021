<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNewsletterRequest;
use App\Http\Requests\StoreNewsletterRequest;
use App\Http\Requests\UpdateNewsletterRequest;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NewsletterController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('newsletter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newsletters = Newsletter::all();

        return view('admin.newsletters.index', compact('newsletters'));
    }

    public function create()
    {
        // abort_if(Gate::denies('newsletter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsletters.create');
    }

    public function store(StoreNewsletterRequest $request)
    {
         Newsletter::create($request->all());

        return redirect()->route('admin.newsletters.index');
    }

    public function edit(Newsletter $newsletter)
    {
        // abort_if(Gate::denies('newsletter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsletters.edit', compact('newsletter'));
    }

    public function update(UpdateNewsletterRequest $request, Newsletter $newsletter)
    {
        $newsletter->update($request->all());

        return redirect()->route('admin.newsletters.index');
    }

    public function show(Newsletter $newsletter)
    {
        // abort_if(Gate::denies('newsletter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsletters.show', compact('newsletter'));
    }

    public function destroy(Newsletter $newsletter)
    {
        // abort_if(Gate::denies('newsletter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newsletter->delete();

        return back();
    }

    public function massDestroy(MassDestroyNewsletterRequest $request)
    {
        Newsletter::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }


    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $news = Newsletter::find($id);
        $news->status = $status;
        $news->save();

        if($news->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }
}
