<?php
namespace Chetu\Anshika\Block;
class Index extends \Magento\Framework\View\Element\Template
{
    protected $storeManager;
    public function __construct(\Magento\Store\Model\StoreManagerInterface $storeManager){
        $this->_storeManager = $storeManager;
    }
    

    public function getBaseUrl(){

        return $this->_storeManager->getStore()->getBaseUrl();
    }
}
