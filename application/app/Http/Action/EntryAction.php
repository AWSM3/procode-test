<?php
/**
 * @filename: EntryAction.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Http\Action;

/** @uses */
use App\Core\Http\ActionInterface;
use App\Repository\Interfaces\FilePageRepositoryInterface;
use App\View\EntryModel;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

/**
 * Class EntryAction
 * @package App\Http\Action
 */
class EntryAction implements ActionInterface
{
    /** @var Twig */
    private $renderer;
    /** @var FilePageRepositoryInterface */
    private $filePageRepository;

    /**
     * EntryAction constructor.
     *
     * @param Twig                        $renderer
     * @param FilePageRepositoryInterface $filePageRepository
     */
    public function __construct(Twig $renderer, FilePageRepositoryInterface $filePageRepository)
    {
        $this->renderer = $renderer;
        $this->filePageRepository = $filePageRepository;
    }

    /**
     * @inheritdoc
     */
    public function __invoke(Request $request, Response $response, $args): ResponseInterface
    {
        $pages = $this->filePageRepository->getByFile((string)$args['id']);
        $file = $pages->first()->getFile();

        return $this->renderer->render($response, 'entry.html', [
            'model' => new EntryModel($file, $pages)
        ]);
    }
}