<?php

namespace App\Http\Controllers\Admin;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\MassDestroyCmsPageRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UpdateCmsPageRequest;
use App\Http\Requests\StoreCmsPageRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;

use App\Models\Page;
use App\Models\ShopPage;
use App\Models\PolicyPage;
use App\Models\CustomerPage;

class CmsPageController extends Controller
{
    use FileUploadTrait;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('cms_page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CmsPage::query()->select(sprintf('%s.*', (new CmsPage())->table));
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                $viewGate = 'cms_page_show';
                $editGate = 'cms_page_edit';
                $deleteGate = 'cms_page_delete';
                $crudRoutePart = 'cms-pages';

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
                $title =  $row->title ? $row->title : '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$title.'</span></div>';
            });
            $table->editColumn('slug', function ($row) {
                $slug =  $row->slug ? $row->slug : '';
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$slug.'</span></div>';
            });
            $table->editColumn('url', function ($row) {
                $url =  $row->url ? $row->url : '';
                return '<div class="text-center"><span class="text-secondary font-weight-bold">'.$url.'</span></div>';
            });
            $table->editColumn('image', function ($row) {
                $image =  $row->image ? $row->image : '';
                if($image !== ''){
                    return '<div class="text-center">
                  <img src="https://vasvi.in/file/'.$image.'" style="width : 70px;">
                </div>';
                }
                else {
                    return;
                }
            });
            $table->editColumn('meta_title', function ($row) {
                $meta_title =  $row->meta_title ? $row->meta_title : '';
                return '<div class="text-center">'.$meta_title.'</div>';
            });
            $table->editColumn('meta_description', function ($row) {
                $meta_description =  $row->meta_description ? $row->meta_description : '';
                return '<div class="text-center">'.substr($meta_description, 0, 150).'...</div>';
            });
            $table->editColumn('tags', function ($row) {
                $tag =  $row->tags ? $row->tags : '';
                return '<div class="text-center"><span class="badge badge-warning p-2">'.$tag.'</span></div>';
            });
            $table->editColumn('status', function ($row) {
                $status =  $row->status ? CmsPage::STATUS_SELECT[$row->status] : '';
                $is_attribute = $status === 'Active' ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_attribute.' id="is-attribute-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });

            $table->rawColumns(['actions','id','title','slug','url','image','meta_title','meta_description','tags','status']);

            return $table->make(true);
        }

        return view('admin.cmsPages.index');
    }

    public function create()
    {
        // abort_if(Gate::denies('cms_page_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.cmsPages.create');
    }

    public function store(StoreCmsPageRequest $request)
    {
        $cms = CmsPage::create($request->all());
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $cmsPage->id]);
        }

        $page =  new Page;
        $page->name = $request->title;
        $page->page_type = 1;
        $page->url = $request->url;
        $page->follow_id = $cms->id;
        $page->detail = $request->description;
        $page->save();
        return redirect()->route('admin.cms-pages.index');
    }

    public function edit(CmsPage $cmsPage)
    {
        // abort_if(Gate::denies('cms_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.cmsPages.edit', compact('cmsPage'));
    }

    public function update(UpdateCmsPageRequest $request, CmsPage $cmsPage)
    {
        $cmsPage->update($request->all());

        \DB::table('pages')->where('follow_id',$cmsPage->id)
              ->update([
                'name' => $request->title,
                'page_type' => 1,
                'url' => $request->url,
                'detail' => $request->description
              ]);


        return redirect()->route('admin.cms-pages.index');
    }

    public function show(CmsPage $cmsPage)
    {
        // abort_if(Gate::denies('cms_page_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.cmsPages.show', compact('cmsPage'));
    }

    public function destroy(CmsPage $cmsPage)
    {
        // abort_if(Gate::denies('cms_page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cmsPage->delete();

        $page = Page::where('follow_id', $cmsPage->id)->first();
        ShopPage::where('page_id', $page->id)->delete();
        CustomerPage::where('page_id', $page->id)->delete();
        PrivacyPage::where('page_id', $page->id)->delete();
        Page::where('id', $page->id)->delete();
        return back();
    }

    public function massDestroy(MassDestroyCmsPageRequest $request)
    {
        CmsPage::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {

        // abort_if(Gate::denies('cms_page_create') && Gate::denies('cms_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CmsPage();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;

        // if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('cms'), $fileName);
            $url = asset('cms/'.$fileName);
        // }
        // $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => 5 ,'url' => $url], Response::HTTP_CREATED);
    }

    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $page = CmsPage::find($id);
        $page->status = $status;
        $page->save();

        if($page->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }


    public function arrange(Request $request)
    {
        $pages = Page::all();
        $shopids = ShopPage::pluck('page_id')->toArray();
        $spages = Page::whereNotIn('id', $shopids)->get();

        $customerids = CustomerPage::pluck('page_id')->toArray();
        $cpages = Page::whereNotIn('id', $customerids)->get();

        $policyids = PolicyPage::pluck('page_id')->toArray();
        $ppages = Page::whereNotIn('id', $policyids)->get();

        $customers = CustomerPage::orderBy('order_no')->get();

        $policies = PolicyPage::orderBy('order_no')->get();
        $shops = ShopPage::orderBy('order_no')->get();
        return view('admin.cmsPages.arrange', compact('pages','policies','shops','customers','spages','cpages','ppages'));
    }

    public function shop_store(Request $request)
    {
        $page = Page::find($request->id);
        $shop = ShopPage::orderBy('order_no','desc')->first();

        $new = new ShopPage;
        $new->page_id = $request->id;
        $new->order_no = $shop ? $shop->order_no + 1 : 1;
        $new->save();

        return ShopPage::with('pages')->get();
    }


    public function shop_remove(Request $request)
    {
        $page = Page::find($request->id);
        ShopPage::where('page_id' ,$request->id)->delete();
        return ShopPage::with('pages')->get();
    }

    public function shop_seq(Request $request){
       if($request->has('ids')){
        $count = 1;
        foreach($request->ids as $id){
            $shop = ShopPage::find($id);
            $shop->order_no = $count;
            $shop->save();
            $count++;
        }
       }

       return ShopPage::with('pages')->orderBy('order_no')->get();
    }

    public function customer_store(Request $request)
    {
        $page = Page::find($request->id);
        $shop = CustomerPage::orderBy('order_no','desc')->first();

        $new = new CustomerPage;
        $new->page_id = $request->id;
        $new->order_no = $shop ? $shop->order_no + 1 : 1;
        $new->save();

        return CustomerPage::with('pages')->get();
    }


    public function customer_remove(Request $request)
    {
        $page = Page::find($request->id);
        CustomerPage::where('page_id' ,$request->id)->delete();
        return CustomerPage::with('pages')->get();
    }


    public function cust_seq(Request $request){
        if($request->has('ids')){
         $count = 1;
         foreach($request->ids as $id){
             $shop = CustomerPage::find($id);
             $shop->order_no = $count;
             $shop->save();
             $count++;
         }
        }

        return CustomerPage::with('pages')->orderBy('order_no')->get();
     }

    public function policy_store(Request $request)
    {
        $page = Page::find($request->id);
        $shop = PolicyPage::orderBy('order_no','desc')->first();

        $new = new PolicyPage;
        $new->page_id = $request->id;
        $new->order_no = $shop ? $shop->order_no + 1 : 1;
        $new->save();

        return PolicyPage::with('pages')->get();
    }


    public function policy_remove(Request $request)
    {
        $page = Page::find($request->id);
        PolicyPage::where('page_id' ,$request->id)->delete();
        return PolicyPage::with('pages')->get();
    }

    public function policy_seq(Request $request){
        if($request->has('ids')){
         $count = 1;
         foreach($request->ids as $id){
             $shop = PolicyPage::find($id);
             $shop->order_no = $count;
             $shop->save();
             $count++;
         }
        }

        return PolicyPage::with('pages')->orderBy('order_no')->get();
     }

    public function update_title(Request $request){
      $identity = $request->identity;
      $title = $request->title;

      \DB::table('footer_titles')->where('identity',$identity)->update([
        'title' => $title
      ]);
      return response()->json([
        'success' => true,
        'code' => 200,
        'message' => 'Title updated successfully'
      ]);
    }
}
