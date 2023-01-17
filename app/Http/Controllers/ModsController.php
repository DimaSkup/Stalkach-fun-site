<?php
namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Http\Requests\Mod\StoreRequest;
use App\Http\Requests\Mod\UpdateRequest;
use App\Models\Mod;
use App\Models\Repository\ModRepository;
use App\Models\Tag;
use App\Service\ImageUploader;
use App\Service\YouTubeVideoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class ModsController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View|Response
     */
    public function index()
    {
        return $this->modIndexHelper();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('mods.create.create')
            ->with([
                "currentLocale" => App::currentLocale(),
                "downloadSources" => Mod::DOWNLOAD_SOURCES,    // an array with key=>values as ['google' => 'google_drive_disk', etc]
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * //param  App\Http\Requests\ModsStoreRequest $request
     *
     * @throws \Exception
     */
    public function store(StoreRequest $request,
                          ImageUploader $imageUploader,
                          ModRepository $modRepository): JsonResponse
    {
        return $this->modStoreHelper($request, $imageUploader, $modRepository);
    }

    /**
     * Display the specified resource.
     *
     * @param  Mod  $mod
     * @return View
     */
    public function show(Mod $mod): View
    {
    	$isDevMode = false;

    	if ($isDevMode)
    		$pathToShowTemplate = "mods.test.show"; // show a test page of a single modification
    	else
    		$pathToShowTemplate = "mods.show.show"; // show a usual page of a single modification

        return view($pathToShowTemplate)
            ->with('mod', $mod);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Mod  $mod
     * @return View
     */
    public function edit(Mod $mod)    {
        //$modification = Mods::where('slug', $slug)->first();

        return view('mods.edit.edit')
            ->with([
                "modification" => $mod,
                "downloadSources" => Mod::DOWNLOAD_SOURCES,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Mod $mod
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Mod $mod): JsonResponse
    {
        return $this->modUpdateHelper($request, $mod);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd("delete page");
    }

    // ----------------------------------------------------------------------//
    //                        PRIVATE  HELPERS                               //
    // ----------------------------------------------------------------------//
    private function modIndexHelper(): View
    {
        $mods = Mod::orderBy('created_at', "DESC")->limit(10)->get();
        $latestMods = Mod::orderBy('created_at', "DESC")->limit(10)->get();
        $filteredMods = Mod::orderBy('created_at', "DESC")->limit(20)->get();

        return view('mods.index')->with([
            'latestMods' => $latestMods,
            'modsList' => $mods,
			'filteredMods' => $filteredMods, // ATTENTION: this variable is needed just for temporal needs
        ]);
    }

    // helps to create a new modification and store it into the database;
    // returns a JsonResponse about the storing process;
    private function modStoreHelper(StoreRequest $request,
                                    ImageUploader $imageUploader,
                                    ModRepository $modRepository): JsonResponse
    {
        try
        {
            $validatedData = $request->validated();
            Utils::dd($validatedData);

            $modDataCollection = new Collection($validatedData['request']);
            $newMod = $modRepository->create($modDataCollection);

            if (!$newMod) // if something went wrong
            {
                throw new ValidationException($request->getValidator());
            }

            $data = [
                'success' => true,
                'linkToThisModPage' => $newMod->url,  // the route to go to after a modification was created
                'message' => __('modification.create.success_creation', [], App::currentLocale()),
            ];

            return response()->json($data, 200);
        }
        catch (ValidationException $e)
        {
            $translatedErrorMessages = $request->getTranslatedErrors(); // get translated messages about validation errors

            return response()->json([
                'success' => false,
                'errorMessages' => $translatedErrorMessages,
                'message' => __('modification.create.submit.error_common', [], App::currentLocale()),
            ], 200);
        }
    }


    private function modUpdateHelper(UpdateRequest $request, Mod $mod): JsonResponse
    {
        try
        {
            $validatedData = new Collection($request->validated());

            if (!$mod->updateMods($validatedData)) {
                throw new ValidationException($request->getValidator());
            }

            $data = [
                'success' => true,
                'linkToThisModPage' => $mod->url,  // the route to go to after a modification was updated
                'message' => __('modification.edit.success_updating', [], App::currentLocale()),
            ];

            return response()->json($data, 200);
        }
        catch (ValidationException $e)
        {
            $translatedErrorMessages = $request->getTranslatedErrors(); // get translated messages about validation errors

            return response()->json([
                'success' => false,
                'errorMessages' => $translatedErrorMessages,
                'message' => __('modification.edit.failed_updating', [], App::currentLocale()),
            ], 200);
        }
    }
}
