<?php


namespace App\Admin\Sections;


use App\Admin\Helpers;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Display\ControlLink;
use SleepingOwl\Admin\Section as SleepingOwlSection;

abstract class Section extends SleepingOwlSection
{
    public function getListRoute($parameters = []): string
    {
        //return route('admin.model', [$this->getAlias()]);
        return Helpers::sectionListRoute($this->getAlias(), $parameters);
    }

    public function getEditRoute($id = null, $parameters = []): string
    {
        if (!$id && $this->getModelValue()) {
            $id = $this->getModelValue()->id;
        }
        return Helpers::sectionEditRoute($id, $this->getAlias(), $parameters);
    }

    public function getCreateRoute($parameters = []): string
    {
        return Helpers::sectionCreateRoute($this->getAlias(), $parameters);
    }

    protected static function watchControlButton(?string $route = null): ControlLink
    {
        $button = new ControlLink(
            fn(Model $model) => $route ?? $model->route,
            trans('admin.button.watch')
        );
        $button->setIcon('fas fa-eye')
            ->hideText()
            ->setHtmlAttribute('class', 'btn-success btn btn-xs');
        return $button;
    }
}
