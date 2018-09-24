<?php
/**
 * @filename: ListAction.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Http\Action;

/** @uses */
use App\Core\Http\ActionInterface;
use App\Core\Support\Paginator;
use App\Repository\Interfaces\FileRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

/**
 * Class ListAction
 * @package App\Http\Action
 */
class ListAction implements ActionInterface
{
    /** @var Twig */
    private $renderer;
    /** @var FileRepositoryInterface */
    private $fileRepository;

    /**
     * ListAction constructor.
     *
     * @param Twig                    $renderer
     * @param FileRepositoryInterface $fileRepository
     */
    public function __construct(Twig $renderer, FileRepositoryInterface $fileRepository)
    {
        $this->renderer = $renderer;
        $this->fileRepository = $fileRepository;
    }

    /**
     * @inheritdoc
     */
    public function __invoke(Request $request, Response $response, $args): ResponseInterface
    {
        $paginator = $this->fileRepository->paginateAll(20, (int)$args['page']);
        $paginator->setUrlTemplate('/list/'.Paginator::PAGE_PLACEHOLDER);

        return $this->renderer->render($response, 'list.html', [
            'items'     => $paginator->getItems()->toArray(),
            'paginator' => $paginator
        ]);
    }
}