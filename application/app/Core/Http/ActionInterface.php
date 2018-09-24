<?php
/**
 * @filename: ActionInterface.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Core\Http;

/** @uses */
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Interface ActionInterface
 * @package App\Core\Http
 */
interface ActionInterface
{
    /**
     * @param Request  $request
     * @param Response $response
     * @param          $args
     *
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $args): ResponseInterface;
}