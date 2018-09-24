<?php
/**
 * @filename: ActionServiceProvider.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Providers;

/** @uses */
use App\Http\Action;


/**
 * Class ActionServiceProvider
 * @package App\Providers
 */
class ActionServiceProvider extends AbstractServiceProvider
{
    /**
     * @return array
     */
    protected function factories(): array
    {
        return [
            Action\EntryAction::class      => $this->invokableFactory(new Action\Factory\EntryActionFactory),
            Action\ListAction::class       => $this->invokableFactory(new Action\Factory\ListActionFactory),
            Action\FormAction::class       => $this->invokableFactory(new Action\Factory\FormActionFactory),
            Action\FormSubmitAction::class => $this->invokableFactory(new Action\Factory\FormSubmitActionFactory),
        ];
    }
}