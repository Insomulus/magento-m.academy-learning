<?php declare(strict_types=1);

namespace Macademy\Blog\Controller\Post;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

// if keyword is reserved append Action

class ListAction implements HttpGetActionInterface
{
    public function __construct(
        private PageFactory $pageFactory,
    )
    {
    }

    public function execute(): Page
    {
        return $this->pageFactory->create();
    }
}
