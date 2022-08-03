<?php declare(strict_types=1);

namespace Macademy\Blog\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\Result\Forward;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;

// WILL REDIRECT THE USER TO /BLOG/POST/LIST URL WHEN THEY ACCESS /BLOG
/*class Index implements HttpGetActionInterface {
     public function __construct(
         private RedirectFactory $redirectFactory
     )

     {
     }

    public function execute(): Redirect
    {
        $redirect = $this->redirectFactory->create();
        return $redirect->setPath('blog/post/list');
    }
}*/

// WILL REDIRECT THE USER TO /BLOG/POST/LIST URL WHEN THEY ACCESS /BLOG BUT WILL
// NOT CHANGE THE URL PATH (STAYS AS /BLOG)
class Index implements HttpGetActionInterface
{
    public function __construct(
        private ForwardFactory $forwardFactory,
    ) {}

    public function execute(): Forward
    {
        /** @var Forward $forward */
        $forward = $this->forwardFactory->create();
        return $forward->setController('post')->forward('list');
    }
}
