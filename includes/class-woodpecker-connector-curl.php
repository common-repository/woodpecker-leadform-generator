<?php
/**
 * Created by Wojtek
 * Modify by Woodpecker Team
 * User: Wojciech
 * Conect to woodpecker API
 */
class Woodpecker_Connector_Curl
{
    /**
     * data to API
     *
     * @var string
     */
    private $url = 'https://api.woodpecker.co';
    private $urlconnect = '';

    private $apikey = '';

    private $urlaction = '';

    /**
     * user name
     *
     * @var string
     */
    private $username = '';

    /**
     * response data
     *
     * @var string
     */
    private $thisJson = '';

    /**
     * data to send
     *
     * @var string
     */
    private $postdata = '';

    private $total = 0;

    /**
     * Constructor
     *
     * @param string $urlaction
     * @param string $apikey
     *
     */
    public function __construct($urlaction, $apikey, $postdata = array() ) {

        if($urlaction == '' OR $apikey == '' ){
            return 'Need data to connect';
        }

        $this->urlconnect = $this->url . preg_replace('/\s+/', '', $urlaction);
        $this->apikey = $apikey;
        $this->postdata = $postdata;
    }


    private function woodpeckerAPIconnect(){

        $basicauth = 'Basic ' . base64_encode( $this->apikey. ":" );

        if( count($this->postdata) ) {
            $woodpecerMethod = 'POST';
        } else{
            $woodpecerMethod = 'GET';
        }

        $woodpeckerParam = array(
            'method'      => $woodpecerMethod,
            'headers'     => array(
                'Content-type' => 'application/json',
                'Cache-Control' =>  'no-cache',
                'Authorization' => $basicauth,
            ),
            'timeout' => '5',
            'redirection' => '5',
            'httpversion' => '1.0',
            'blocking' => true,
            'sslverify' => false,
            'body'        => $this->postdata,
        );

        $jsonData = wp_remote_post( $this->urlconnect, $woodpeckerParam);


        $return = "";

        $httpCode = wp_remote_retrieve_response_code( $jsonData );

        if ( $httpCode != 200 )
        {
            $return .=  "Return code is {" . $httpCode. "} \n".'<br>';
        }

        $this->total = wp_remote_retrieve_header($jsonData, 'x-total-count');
        $this->thisJson = wp_remote_retrieve_body( $jsonData );
        $this->thisJsonerror = $return;
    }

    public function getJson()
    {
        $this->woodpeckerAPIconnect();
        return json_decode($this->thisJson);

    }

    public function getTotalCount() {
      return $this->total;
    }

}
