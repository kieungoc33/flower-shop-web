<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateLanguageRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Http\Requests\StoreLanguageRequest;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;


class LanguageController extends Controller
{
    protected $languageService;
    protected $languageRespository;
    public function __construct(LanguageService $languageService
                             , LanguageRepository $languageRespository)
    {
        $this->languageService = $languageService;
        $this->languageRespository = $languageRespository;
    }
     
    
    public function index(Request $request){
        $languages= $this->languageService->paginate($request);

        $config = [
            'js' =>[
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' =>[
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
        ] ;
        $config['seo'] = config('apps.language'); 
        $template='backend.language.index';
        return view('backend.dashboard.layout', compact('template', 'config',
         'languages')) ;
    }
   public function create(){
       
        $config['seo'] = config('apps.language');
        $config['method'] = 'create';


        $template='backend.language.store';
        return view ('backend.dashboard.layout', compact('template', 'config'));
    }
    public function store(StoreLanguageRequest $request){
        if($this->languageService->create( $request)){
            return redirect()->route('language.index')->with('success', 'Thêm mới thành công');
        }
        return redirect()->route('language.index')->with('error', 'Thêm mới thất bại');
    }
    
    public function edit($id){  
        $language = $this->languageRespository->findById($id);
        $config['seo'] = config('apps.language');
        $config['method'] = 'edit';
        $template='backend.language.store';
        return view ('backend.dashboard.layout', compact('template', 'config', 'language'));
    }
    public function update( $id,UpdateLanguageRequest $request,){
        if($this->languageService->update( $id, $request)){
            return redirect()->route('language.index')->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('language.index')->with('error', 'Cập nhật thất bại');
        
        
    }
    
    public function delete($id){
        $config['seo'] = config('apps.language');
        $language = $this->languageRespository->findById($id);
        $template='backend.language.delete';
        return view ('backend.dashboard.layout', compact('template', 'language', 'config'));

    }
    public function destroy($id){
        if($this->languageService->destroy($id)){
            return redirect()->route('language.index')->with('success', 'Xóa  thành công');
        }
        return redirect()->route('language.index')->with('error', 'Xóa thất bại');
    }
    
   
}
