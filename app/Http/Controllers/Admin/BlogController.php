<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBlogRequest;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\Blog;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    use FileUploadTrait;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Blog::query()->select(sprintf('%s.*', (new Blog())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'blog_show';
                $editGate = 'blog_edit';
                $deleteGate = 'blog_delete';
                $crudRoutePart = 'blogs';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                $id =  $row->id ? $row->id : '';
                return '<div class="text-center"><span class="text-dark">'.$id.'</span></div>';
            });
            $table->editColumn('title', function ($row) {
                $name =  $row->title ? $row->title : '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$name.'</span></div>';
            });
            $table->editColumn('sub_title', function ($row) {
                $title =  $row->sub_title ? $row->sub_title : '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$title.'</span></div>';
            });
            $table->editColumn('slug', function ($row) {
                $slug =  $row->slug ? $row->slug : '';
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$slug.'</span></div>';
            });

            $table->editColumn('image', function ($row) {
                if ($photo = $row->icon) {
                    return sprintf(
                        '<div class="text-center"><a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a></div>',
                        $photo->url,
                        $photo->thumb
                    );
                }

                return '';
            });
            $table->editColumn('meta_title', function ($row) {
                $meta =  $row->meta_title ? $row->meta_title : '';
                return '<div class="text-center"><span class="badge p-2" style="background-color : #4c6f9c; color : white;">'.$meta.'</span></div>';
            });

            $table->editColumn('status', function ($row) {
                $status =  $row->status ? Blog::STATUS_SELECT[$row->status] : '';
                $is_attribute = $status === 'Active' ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_attribute.' id="is-attribute-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });

            $table->editColumn('published_on', function ($row) {
                   return '<div class="text-center"><span class="badge badge-secondary p-2">'.date('d M Y',strtotime($row->published_on)).'</span></div>';
            });

            $table->rawColumns(['actions', 'placeholder', 'image','status','meta_title','slug','sub_title','title','id','published_on']);

            return $table->make(true);
        }

        return view('admin.blogs.index');
    }

    public function create()
    {
        // abort_if(Gate::denies('blog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.blogs.create');
    }

    public function store(StoreBlogRequest $request)
    {
        // $request = $this->imageUpload($request, 'blog');
         Blog::create($request->all());

        // if ($request->input('image', false)) {
        //     $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        // }

        // if ($media = $request->input('ck-media', false)) {
        //     Media::whereIn('id', $media)->update(['model_id' => $blog->id]);
        // }

        return redirect()->route('admin.blogs.index');
    }

    public function edit(Blog $blog)
    {
        // abort_if(Gate::denies('blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        // $request = $this->imageUpload($request, 'blog');
        $blog->update($request->all());

        // if ($request->input('image', false)) {
        //     if (!$blog->image || $request->input('image') !== $blog->image->file_name) {
        //         if ($blog->image) {
        //             $blog->image->delete();
        //         }
        //         $blog->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        //     }
        // } elseif ($blog->image) {
        //     $blog->image->delete();
        // }

        return redirect()->route('admin.blogs.index');
    }

    public function show(Blog $blog)
    {
        // abort_if(Gate::denies('blog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.blogs.show', compact('blog'));
    }

    public function destroy(Blog $blog)
    {
        // abort_if(Gate::denies('blog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blog->delete();

        return back();
    }

    public function massDestroy(MassDestroyBlogRequest $request)
    {
        Blog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        // abort_if(Gate::denies('blog_create') && Gate::denies('blog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Blog();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }


    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;


        $blog = Blog::find($id);
        $blog->status = $status;
        $blog->save();

        if($blog->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }
}
