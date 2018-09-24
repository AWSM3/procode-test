<?php
/**
 * @filename: FormSubmitAction.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Http\Action;

/** @uses */
use App\Core\Http\ActionInterface;
use App\Core\Routing\RouterInterface;
use App\Manager\Exception\FileAlreadyProcessedException;
use App\Manager\FileHandler;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class FormSubmitAction
 * @package App\Http\Action
 */
class FormSubmitAction implements ActionInterface
{
    /** @var FileHandler */
    private $fileHandler;
    /** @var RouterInterface */
    private $router;

    /**
     * FormSubmitAction constructor.
     *
     * @param FileHandler                                     $fileHandler
     * @param RouterInterface|\Slim\Interfaces\RouterInterface $router
     */
    public function __construct(FileHandler $fileHandler, \Slim\Interfaces\RouterInterface $router)
    {
        $this->fileHandler = $fileHandler;
        $this->router = $router;
    }

    /**
     * @inheritdoc
     */
    public function __invoke(Request $request, Response $response, $args): ResponseInterface
    {
        $files = $request->getUploadedFiles();

        try {
            $this->fileHandler->convertFile($files['pdf']);

            return $response->withRedirect($this->router->pathFor('list'));
        } catch (FileAlreadyProcessedException $e) {
            return $response->withRedirect($this->router->pathFor('entry', ['id' => $e->getFileEntity()->getId()]));
        } catch (\Exception $e) {
            return $response->write(
                sprintf('An error occurred while processing your request :< (%s)',
                    $e->getMessage()
                )
            );
        }
    }
}