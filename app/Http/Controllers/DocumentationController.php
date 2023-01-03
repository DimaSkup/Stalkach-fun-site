<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class DocumentationController extends Controller
{
	// the main page of the  documentation
    public function index()
	{
		Session::remove("breadcrumbs");

		return view('documentation.index')
			->with([
				'title' => 'Документація'
			]);
	}


	// for chapters main page
	public function show($path = null)
	{
		$templateData = $this->getCorrectPathToTemplate($path);
		$pathToTemplate = $templateData['path'];
		$pathElems = $templateData['elems'];

		if ($path !== null)
		{
			$fullTemplatePath = "documentation.show" . (string)$pathToTemplate;
		}
		else
		{
			$fullTemplatePath = "documentation.show.index";
		}

		$breadcrumbs = $this->makeBreadcrumbs($pathElems);
		Session::put("breadcrumbs", $breadcrumbs);

		// there can be cases when template path ends with "index"
		if (!View::exists($fullTemplatePath))
		{
			$fullTemplatePath .= ".index";
		}

		return view($fullTemplatePath)->with([
			'path' => $pathToTemplate,
			'modelsDoc' => route('documentation.show', ['path' => 'models.index']),
		]);
	}


	// extract path elements from the input $path
	public static function getCorrectPathToTemplate(string $path): array
	{

		$pathElems = new Collection(explode(".", $path));   // explode the input $path to the template
		$pathElemsWithoutIndex = [];
		$pathToTemplateDir = "";

		$pathElemsCount = count($pathElems);
		for ($i = 0; $i < $pathElemsCount; $i++)
		{
			$curElem = $pathElems[$i];
			if ($curElem !== "index" && $curElem !== "")   // get rid of all the empty elements and index elements
			{
				$pathToTemplateDir .= "." . $pathElems[$i];
				$pathElemsWithoutIndex[] = $pathElems[$i];
			}
		}

		if ($pathElems->last() === "index")
			$pathToTemplateDir .= ".index";

		return [
			'path'  => $pathToTemplateDir,
			'elems' => $pathElemsWithoutIndex,
		];
	} // getCorrectPathToTemplate()

	// makes a breadcrumbs array of 'link_to_template' => 'link_name'
	private function makeBreadcrumbs(array $breadcrumbsArray): array
	{
		$linksToTemplates = [];  // links to templates
		$linkNames = [];         // breadcrumbs links names

		// make names for breadcrumbs links
		foreach ($breadcrumbsArray as $breadcrumb)
		{
			$linkNames[] = ucwords($breadcrumb);
		}

		// for each breadcrumbs part we make a link to the related template
		foreach ($breadcrumbsArray as $key => $val)
		{
			$linkToTemplate = "";

			for ($i = 0; $i <= $key; $i++)
			{
				if ($linkToTemplate === "")
				{
					$linkToTemplate .= $breadcrumbsArray[$i];
				}
				else
				{
					$linkToTemplate .= ".$breadcrumbsArray[$i]";
				}
			}

			$linksToTemplates[] = $linkToTemplate;
		}

		return [
			'links' => $linksToTemplates,
			'names' => $linkNames
		];
	} // makeBreadcrumbs()

}
