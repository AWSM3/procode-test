<?php
declare(strict_types=1);

/** @uses */
use App\Core\Routing\Constraints;
use App\Http\Action;

/** Каталог обработанных PDF */
$app->get('/list[/{page}]', Action\ListAction::class)
    ->setName('list');

/** Форма загрузки */
$app->get('/form', Action\FormAction::class)
    ->setName('form');

/** Сабмит формы */
$app->post('/form/submit', Action\FormSubmitAction::class)
    ->setName('form-submit');

/** Карточка PDF (в HTML) */
$app->get('/entry/{id:' . Constraints::REGEXP__UUID . '}', Action\EntryAction::class)
    ->setName('entry');


$app->redirect('/', '/list');