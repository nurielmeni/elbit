<?php
require_once 'NlsSoapClient.php';
require_once 'NlsHelper.php';
require_once 'NlsService.php';

/**
 * Handles the security with Niloosoft Services 
 */
class NlsSecurity
{
    private $url;
    /**
     * 
     * @param type $config the $auth and $settings
     */
    public function __construct()
    {
        $this->url = get_option(NlsHunterApi_Admin::SECURITY_WSDL_URL);        
    }

    /**
     * Authenticate the user against the service and gets an Auth object
     * @return auth object with user data and expiration time
     * @throws \app\modules\niloos\models\Exception
     */
    public function authenticate($username, $password) 
    {
        if (!isset($this->url) || substr($this->url, -strlen('?wsdl')) !== '?wsdl')
            return false;

        /** Define SOAP headers for token authentication **/        
        $this->soap_headers = [
            new SoapHeader('_', 'NiloosoftCred0', get_option(NlsHunterApi_Admin::NLS_CONSUMER_KEY)),
            new SoapHeader('_', 'NiloosoftCred1', get_option(NlsHunterApi_Admin::NLS_WEB_SERVICE_DOMAIN) . '\\' . $username),
            new SoapHeader('_', 'NiloosoftCred2', $password)
        ];
        
        $this->client = new NlsSoapClient($this->url, array(
            'trace' => 1,
            'exceptions' => 0,
            'cache_wsdl' => WSDL_CACHE_BOTH,
            'location' => explode('?', $this->url)[0],
        ));

        $this->client->__setSoapHeaders($this->soap_headers);
        
        $transactionCode = NlsHelper::newGuid();
        try {
            $param[] = new SoapVar(get_option(NlsHunterApi_Admin::NLS_WEB_SERVICE_DOMAIN) . '\\' . $username, XSD_STRING, null, null, 'userName', null);
            $param[] = new SoapVar($password, XSD_STRING, null, null, 'password', null);
            $param[] = new SoapVar($transactionCode, XSD_STRING, null, null, 'transactionCode', null);
            $param[] = new SoapVar(get_option(NlsHunterApi_Admin::NLS_CONSUMER_KEY), XSD_STRING, null, null, 'applicationSecret', null);
            $options = new SoapVar($param, SOAP_ENC_OBJECT, null, null);

            $this->auth  = json_encode( $this->client->__soapCall("Authenticate2", array($options)) );
            update_option(NlsService::AUTH_KEY, $this->auth);
            return $this->auth;
        } catch (\Exception $ex) {
            $this->auth = false;
            $ex->transactionCode = $transactionCode;
            throw $ex;
        }
    }

    public function authenticateByConsumerKeyAndSecretKey($userName) 
    {
        $transactionCode = Helper::newGuid();
        try {
            $param = array(
                'userName' => $userName,
                "ConsumerKey" => null,
                "SecretKey" => null,
                "ipAddress" => "127.0.0.1",
                'transactionCode' => $transactionCode);
            $res = $this->client->AuthenticateByConsumerKeyAndSecretKey($param);
            return $res;
        } catch (SoapFault $ex) {
            echo "Request " . $this->client->__getLastRequest();
            echo "Response " . $this->client->__getLastResponse();
            die;
        } catch (Exception $ex) {
            $ex->transactionCode = $transactionCode;
            throw $ex;
        }
    }    

    /**
     * Checks if the app is authenticated and the auth is valid (not expired)
     * if not valid Authenticates
     * 
     * @return boolian true if authenticated
     */
    public function isAuth()
    {
        $this->auth = json_decode(get_option(NlsService::AUTH_KEY));
        try {
            if (!$this->auth || $this->auth->Authenticate2Result != "Success") {
                $this->auth = false;
                return false;            
            } 
            $expTime = \DateTime::createFromFormat("d/m/Y H:i:s", explode("^^^^", $this->auth->UsernameToken)[1]);
            if ($expTime->getTimestamp() < time()) {
                $this->auth = false;
                return false;
            }
        }
        catch(Exception $ex) {
            $this->auth = false;
            $ex->reason = "Authntication Failed";
            throw $ex;
        }
        return $this->auth; 
    }
}
