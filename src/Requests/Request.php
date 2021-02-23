<?php

namespace Howkins\Borica\Requests;

use Howkins\Borica\Borica;
use Howkins\Borica\Utils\ParameterBag;
use Howkins\Borica\Contracts\Request as iRequest;

class Request implements iRequest
{

    const ORDER_LIMIT = 999999;
    const ADDENDUM = 'AD,TD';

    /**
     * @var Howkins\Borica\Utils\ParameterBag
     */
    private $_parameters;

    public function __construct(array $parameters = [])
    {
        $this->initialize($parameters);
    }

    public function initialize(array $parameters = [])
    {
        $this->_parameters = new ParameterBag($parameters);
        $this->setCurrency('BGN');
        $this->setCountry('BG');
        $this->setLanguage('BG');
        $this->setAddendum(self::ADDENDUM);
        $this->setMerchantGmt('+03');
    }

    public function setTerminal(string $terminal)
    {
        $this->_parameters->set('TERMINAL', $terminal);
        return $this;
    }

    public function setTransactionType(int $transaction_type)
    {
        $this->_parameters->set('TRTYPE', $transaction_type);
        return $this;
    }

    public function setAmount(float $amount)
    {
        $amount = number_format($amount, 2, '.', '');
        $this->_parameters->set('AMOUNT', $amount);
        return $this;
    }

    public function setCurrency(string $currency)
    {
        $this->_parameters->set('CURRENCY', mb_strtoupper($currency));
        return $this;
    }

    public function setOrder(int $order)
    {
        $this->_parameters->set('ORDER', $order % self::ORDER_LIMIT + 1 );
        return $this;
    }

    public function setDescription(string $description)
    {
        $this->_parameters->set('DESC', $description);
        return $this;
    }

    public function setMerchant(string $merchant)
    {
        $this->_parameters->set('MERCHANT', $merchant);
        return $this;
    }

    public function setMerchantName(string $merchant_name)
    {
        $this->_parameters->set('MERCH_NAME', $merchant_name);
        return $this;
    }

    public function setMerchantUrl(string $merchant_url)
    {
        $this->_parameters->set('MERCH_URL', $merchant_url);
        return $this;
    }

    public function setMerchantGmt(string $merchant_gmt)
    {
        $this->_parameters->set('MERCH_GMT', $merchant_gmt);
        return $this;
    }

    public function setEmail(string $email)
    {
        $this->_parameters->set('EMAIL', $email);
        return $this;
    }

    public function setCountry(string $country)
    {
        $this->_parameters->set('COUNTRY', mb_strtoupper($country));
        return $this;
    }

    public function setLanguage(string $language)
    {
        $this->_parameters->set('LANG', mb_strtoupper($language));
        return $this;
    }

    public function setAddendum(string $addendum)
    {
        $this->_parameters->set('ADDENDUM', $addendum);
        return $this;
    }

    public function setAdCustomBoricaOrderId(string $custom_order_id)
    {
        $this->_parameters->set('AD.CUST_BOR_ORDER_ID', $custom_order_id);
        return $this;
    }

    public function setTimestamp(string $timestamp)
    {
        $this->_parameters->set('TIMESTAMP', $timestamp);
        return $this;
    }

    public function setOriginalTransactionType(string $tran_trtype)
    {
        $this->_parameters->set('TRAN_TRTYPE', $tran_trtype);
        return $this;
    }

    public function setRetrievalReferenceNumber (string $rrn)
    {
        $this->_parameters->set('RRN', $rrn);
        return $this;
    }

    public function setInternalReference(string $int_ref)
    {
        $this->_parameters->set('INT_REF', $int_ref);
        return $this;
    }

    public function setMInfo(string $m_info)
    {
        $this->_parameters->set('M_INFO', $m_info);
        return $this;
    }

    public function setNonce(string $nonce)
    {
        $this->_parameters->set('NONCE', $nonce);
        return $this;
    }

    public function setPSign(string $p_sign)
    {
        $this->_parameters->set('P_SIGN', $p_sign);
        return $this;
    }

    public function getFields()
    {
        return $this->_parameters->all();
    }

    public function sign(Borica $borica)
    {
        $mac = Borica::generateMac($this->_parameters->all(), false);

        $this->setPSign($borica->sign($mac));

        return $this;
    }

    public function renderForm(Borica $borica, $formId = 'borica_form'): string
    {
        $html = '<form action="' . $borica->getUrl() . '" method="POST" id="'. $formId .'">';

        foreach ($this->_parameters->all() as $key => $value) {
            $html .= '<input name="' . htmlspecialchars($key, ENT_QUOTES) . '" value="' . htmlspecialchars($value, ENT_QUOTES) . '" style="width: 100%;"><br>';
        }

        $html .= '<button type="submit">Submit</button></form>';

        return $html;
    }

}
