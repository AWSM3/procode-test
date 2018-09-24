<?php
/**
 * @filename: FormAction.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Http\Action;

/** @uses */
use App\Core\Http\ActionInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

/**
 * Class FormAction
 * @package App\Http\Action
 */
class FormAction implements ActionInterface
{
    /** @var Twig */
    private $renderer;

    /**
     * FormAction constructor.
     *
     * @param Twig $renderer
     */
    public function __construct(Twig $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @inheritdoc
     */
    public function __invoke(Request $request, Response $response, $args): ResponseInterface
    {
        return $this->renderer->render($response, 'form.html');
    }
}