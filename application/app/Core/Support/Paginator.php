<?php
/**
 * @filename: Paginator.php
 */
declare(strict_types=1);

/** @namespace */
namespace App\Core\Support;

/**
 * Class Paginator
 * @package App\Core\Support
 */
class Paginator
{
    const
        PAGE_PLACEHOLDER = '{page}';

    /** @var Collection */
    private $items;
    /** @var int */
    private $total;
    /** @var int */
    private $page;
    /** @var int */
    private $perPage;
    /** @var int */
    private $pagesTotal = 0;
    /** @var string */
    private $urlTemplate;

    /**
     * Paginator constructor.
     *
     * @param Collection $items
     * @param int        $total
     * @param int        $page
     * @param int        $perPage
     */
    public function __construct(Collection $items, int $total, int $page, int $perPage)
    {
        $this->items = $items;
        $this->total = $total;
        $this->page = $page;
        $this->perPage = $perPage;
        $this->process();
    }

    protected function process(): void
    {
        $this->pagesTotal = ceil($this->total / $this->perPage);
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @param string $urlTemplate
     *
     * @return Paginator
     */
    public function setUrlTemplate(string $urlTemplate): Paginator
    {
        $this->urlTemplate = $urlTemplate;

        return $this;
    }

    /**
     * @return string
     */
    public function renderPages(): string
    {
        if ($this->pagesTotal <= 1) {
            return '';
        }
        $template = '<nav><ul class="pagination" style="overflow-x: auto;">%s</ul></nav>';
        $pageTemplate = '<li class="page-item %s"><a class="page-link" href="%s">%d</a></li>';
        $pagesHtml = '';

        for ($page = 1; $page<=$this->pagesTotal; $page++) {
            $pagesHtml .= sprintf($pageTemplate,
                $page === $this->page ? 'active' : '',
                str_replace(self::PAGE_PLACEHOLDER, $page, $this->urlTemplate),
                $page
            );
        }

        return sprintf($template, $pagesHtml);
    }
}