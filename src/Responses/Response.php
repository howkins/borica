<?php

namespace Howkins\Borica\Responses;

use Howkins\Borica\Borica;
use Howkins\Borica\Utils\ParameterBag;
use Howkins\Borica\Constants\Action;
use Howkins\Borica\Contracts\Response as iResponse;
use Howkins\Borica\Constants\ResponseCode;

class Response implements iResponse
{
    public $isVerified = false;
    /**
     * @var Howkins\Borica\Utils\ParameterBag
     */
    private $_parameters;

    public function __construct(array $parameters = [])
    {
        $this->_parameters = new ParameterBag($parameters);
    }

    public function getAction()
    {
        return $this->_parameters->get('ACTION');
    }

    public function getResponseCode()
    {
        return $this->_parameters->get('RC');
    }

    public function getResponseCodeMessage(array $responseCodeErrors = []) : string
    {
        if(empty($responseCodeErrors)){
            $responseCodeErrors = ResponseCode::ERRORS;
        }

        if(!$this->_parameters->has('RC')) {
            return 'Response code is not exists.';
        }

        if(!array_key_exists($this->_parameters->get('RC'), $responseCodeErrors)){
            return $this->_parameters->get('RC');
        }

        return $responseCodeErrors[$this->_parameters->get('RC')];
    }

    public function getStatusMessage()
    {
        return $this->_parameters->get('STATUSMSG');
    }

    public function getTerminal()
    {
        return $this->_parameters->get('TERMINAL');
    }

    public function getTransactionType()
    {
        return $this->_parameters->get('TRTYPE');
    }

    public function getAmount()
    {
        return $this->_parameters->get('AMOUNT');
    }

    public function getCurrency()
    {
        return $this->_parameters->get('CURRENCY');
    }

    public function getOrder()
    {
        return $this->_parameters->get('ORDER');
    }

    public function getLanguage()
    {
        return $this->_parameters->get('LANG');
    }

    public function getTimestamp()
    {
        return $this->_parameters->get('TIMESTAMP');
    }

    public function getTransactionDate()
    {
        return $this->_parameters->get('TRAN_DATE');
    }

    public function getOriginalTransactionType()
    {
        return $this->_parameters->get('TRAN_TRTYPE');
    }

    public function getApproval()
    {
        return $this->_parameters->get('APPROVAL');
    }

    public function getRetrievalReferenceNumber()
    {
        return $this->_parameters->get('RRN');
    }

    public function getInternalReference()
    {
        return $this->_parameters->get('INT_REF');
    }

    public function getParesStatus()
    {
        return $this->_parameters->get('PARES_STATUS');
    }

    public function getECommerceIdentificator()
    {
        return $this->_parameters->get('ECI');
    }

    public function getCard()
    {
        return $this->_parameters->get('CARD');
    }

    public function getNonce()
    {
        return $this->_parameters->get('NONCE');
    }

    public function getReservedForFutureUse()
    {
        return $this->_parameters->get('RFU');
    }

    public function getPSign()
    {
        return $this->_parameters->get('P_SIGN', '');
    }

    public function getFields()
    {
        return $this->_parameters->all();
    }

    public function isSuccessful()
    {
        return $this->getResponseCode() === '00';
    }

    public function verify(Borica $borica)
    {
        $mac = Borica::generateMac($this->_parameters->all(), true);

        $this->isVerified = $borica->verifySignature($mac, $this->getPSign());
        
        return $this;
    }
}
