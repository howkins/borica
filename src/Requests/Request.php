<?php

namespace Howkins\Borica\Requests;

use Howkins\Borica\Borica;
use Howkins\Borica\Utils\ParameterBag;
use Howkins\Borica\Contracts\Request as iRequest;
use Howkins\Borica\Utils\ErrorsBag;

class Request implements iRequest
{

    const ORDER_LIMIT = 999999;
    const ADDENDUM = 'AD,TD';

    /**
     * @var Howkins\Borica\Utils\ParameterBag
     */
    protected $parameters, $errors;

    public function __construct(array $parameters = [])
    {
        $this->initialize($parameters);
    }

    public function initialize(array $parameters = [])
    {
        $this->parameters = new ParameterBag($parameters);
        $this->errors = new ErrorsBag();
        $this->setCurrency('BGN');
        $this->setCountry('BG');
        $this->setLanguage('BG');
        $this->setAddendum(self::ADDENDUM);
        $this->setMerchantGmt('+02');
        $this->setNonce(strtoupper(bin2hex(openssl_random_pseudo_bytes(16))));
    }

    public function setTerminal(string $terminal)
    {
        $this->parameters->set('TERMINAL', $terminal);
        return $this;
    }

    public function setTransactionType(int $transaction_type)
    {
        $this->parameters->set('TRTYPE', $transaction_type);
        return $this;
    }

    public function setAmount(float $amount)
    {
        $amount = number_format($amount, 2, '.', '');
        $this->parameters->set('AMOUNT', $amount);
        return $this;
    }

    public function setCurrency(string $currency)
    {
        $this->parameters->set('CURRENCY', mb_strtoupper($currency));
        return $this;
    }

    public function setOrder(int $order)
    {
        $this->parameters->set('ORDER', $order % self::ORDER_LIMIT + 1 );
        return $this;
    }

    public function getOrder()
    {
        return str_pad($this->parameters->get('ORDER'), 6, '0', STR_PAD_LEFT);
    }

    public function setDescription(string $description)
    {
        $this->parameters->set('DESC', $description);
        return $this;
    }

    public function setMerchant(string $merchant)
    {
        $this->parameters->set('MERCHANT', $merchant);
        return $this;
    }

    public function getMerchant()
    {
        return $this->parameters->get('MERCHANT');
    }

    public function setMerchantName(string $merchant_name)
    {
        $this->parameters->set('MERCH_NAME', $merchant_name);
        return $this;
    }

    public function setMerchantUrl(string $merchant_url)
    {
        $this->parameters->set('MERCH_URL', $merchant_url);
        return $this;
    }

    public function setMerchantGmt(string $merchant_gmt)
    {
        $this->parameters->set('MERCH_GMT', $merchant_gmt);
        return $this;
    }

    public function setEmail(string $email)
    {
        $this->parameters->set('EMAIL', $email);
        return $this;
    }

    public function setCountry(string $country)
    {
        $this->parameters->set('COUNTRY', mb_strtoupper($country));
        return $this;
    }

    public function setLanguage(string $language)
    {
        $this->parameters->set('LANG', mb_strtoupper($language));
        return $this;
    }

    public function setAddendum(string $addendum)
    {
        $this->parameters->set('ADDENDUM', $addendum);
        return $this;
    }

    public function setAdCustomBoricaOrderId(string $custom_order_id)
    {
        $this->parameters->set('AD.CUST_BOR_ORDER_ID', $custom_order_id);
        return $this;
    }

    public function setTimestamp(int $timestamp)
    {
        $this->parameters->set('TIMESTAMP', gmdate('YmdHis', $timestamp));
        return $this;
    }

    public function setOriginalTransactionType(string $tran_trtype)
    {
        $this->parameters->set('TRAN_TRTYPE', $tran_trtype);
        return $this;
    }

    public function setRetrievalReferenceNumber (string $rrn)
    {
        $this->parameters->set('RRN', $rrn);
        return $this;
    }

    public function setInternalReference(string $int_ref)
    {
        $this->parameters->set('INT_REF', $int_ref);
        return $this;
    }

    public function setMInfo(string $m_info)
    {
        $this->parameters->set('M_INFO', $m_info);
        return $this;
    }

    public function setNonce(string $nonce)
    {
        $this->parameters->set('NONCE', $nonce);
        return $this;
    }

    public function setPSign(string $p_sign)
    {
        $this->parameters->set('P_SIGN', $p_sign);
        return $this;
    }

    public function getFields()
    {
        return $this->parameters->all();
    }

    public function getErrors()
    {
        $this->errors->all();
    }

    public function sign(Borica $borica)
    {
        $mac = Borica::generateMac($this->parameters->all(), false);

        $this->setPSign($borica->sign($mac));

        return $this;
    }

    public function renderForm(Borica $borica, $formId = 'borica_form'): string
    {
        $html = '<form action="' . $borica->getUrl() . '" method="POST" id="'. $formId .'">';

        foreach ($this->parameters->all() as $key => $value) {
            $html .= '<input name="' . htmlspecialchars($key, ENT_QUOTES) . '" value="' . htmlspecialchars($value, ENT_QUOTES) . '" style="width: 100%;"><br>';
        }

        $html .= '<button type="submit">Submit</button></form>';

        return $html;
    }

}
