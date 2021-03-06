<?php
include_once ABSPATH . 'wp-content/plugins/NlsHunterApi/renderFunction.php';
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    NlsHunterApi
 * @subpackage NlsHunterApi/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    NlsHunterApi
 * @subpackage NlsHunterApi/public
 * @author     Meni Nuriel <nurielmeni@gmail.com>
 */
class NlsHunterApi_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $NlsHunterApi    The ID of this plugin.
	 */
	private $NlsHunterApi;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
    private $version;
    
    /** 
     * Show log messages
    */
    private $debug;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $NlsHunterApi       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $NlsHunterApi, $version ) {

		$this->NlsHunterApi = $NlsHunterApi;
		$this->version = $version;
        $this->debug = WP_DEBUG;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in NlsHunterApi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The NlsHunterApi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->NlsHunterApi, plugin_dir_url( __FILE__ ) . 'css/NlsHunterApi-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->NlsHunterApi, plugin_dir_url( __FILE__ ) . 'css/NlsHunterApi-public-responsive.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'somo-select-css', plugin_dir_url( __FILE__ ) . 'css/sumoselect.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'somo-select-css-rtl', plugin_dir_url( __FILE__ ) . 'css/sumoselect-rtl.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'font-face-open-sans-heb', plugin_dir_url( __FILE__ ) . 'css/fonts.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'front-page-loader', plugin_dir_url( __FILE__ ) . 'css/loader.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in NlsHunterApi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The NlsHunterApi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'sumo-select-js', plugin_dir_url( __FILE__ ) . 'js/jquery.sumoselect.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'nls-form-validation', plugin_dir_url( __FILE__ ) . 'js/NlsHunterForm.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->NlsHunterApi, plugin_dir_url( __FILE__ ) . 'js/NlsHunterApi-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'mobile_event', plugin_dir_url( __FILE__ ) . 'js/mobileEvent.js', null, $this->version, false );
		wp_enqueue_script( 'people_slider', plugin_dir_url( __FILE__ ) . 'js/slider.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'checkbox', plugin_dir_url( __FILE__ ) . 'js/checkbox.js', [], $this->version, false );
        
        /** Form Validators Script **/
        // included in taas object defined in   NlsHunterApi-public.js
        //wp_enqueue_script('form-validators-script', plugin_dir_url( __FILE__ ) . 'js/formValidators.js' );

        /** The Google API Loader script. **/
        //wp_enqueue_script('google-api', 'https://apis.google.com/js/api.js?onload=onApiLoad' );
        //wp_enqueue_script('google-drive-file-picker', plugin_dir_url( __FILE__ ) . 'js/googleFilePicker.js' );

        /** The Dropbox API Script **/
        //wp_enqueue_script( 'dropbox-api', 'https://www.dropbox.com/static/api/2/dropins.js' );
        //wp_enqueue_script('dropbox-file-chooser', plugin_dir_url( __FILE__ ) . 'js/dropboxFileChooser.js' );
        
        // enqueue and localise scripts
        //wp_enqueue_script( 'search-results-pager-ajax-handle', plugin_dir_url( __FILE__ ) . 'js/searchResultsPagerAjax.js', array( 'jquery' ), $this->version, false );
        //wp_localize_script( 'search-results-pager-ajax-handle', 'search_results_pager_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

        // enqueue and localise scripts for handling Ajax Submit CV
        // Don't forget to add the action (apply_cv_function)
        wp_enqueue_script( 'apply-cv-ajax-handle', plugin_dir_url( __FILE__ ) . 'js/NlsHunterForm.js', [ 'jquery' ], $this->version, false );
        wp_localize_script( 'apply-cv-ajax-handle', 'apply_cv_script', [ 'applyajaxurl' => admin_url( 'admin-ajax.php' ) ] );        

        // enqueue and localise scripts for handling Polyfill for IE support UrlSearchParams
        //wp_enqueue_script( 'apply-cv-ajax-handle', plugin_dir_url( __FILE__ ) . 'js/url-search-params.js', [ 'jquery' ], $this->version, false );
    }

    /**
     * Return the locations
     */
    public function locations_function() {
        ob_start();

            $max = key_exists('max', $_POST) ? $_POST['max'] : -1;
            $args = [
                'numberposts'   => $max, 
                'category_name' => 'locations',
                'orderby'       => 'date',
                'order'         => 'ASC',
            ];
            
            $locations = get_posts( $args );

            include_once plugin_dir_path( __FILE__ ). '../public/partials/locations.php';

            $my_html = ob_get_contents();
            
        ob_end_clean();
        wp_send_json_success( array('html'=>$my_html) );
        //return ob_get_clean();
    }
    
    /*
     * Return the pager data to the search result module
     */
    public function search_results_pager_function() {
        $modules = new NlsHunterApi_modules();
        $selectedOptions = key_exists('SelectedOptions', $_POST) ? $_POST['SelectedOptions'] : null;
        $offset = key_exists('offset', $_POST) ? $_POST['offset'] : 0;
        $countPerPage = NlsHunterApi_modules::NLS_SEARCH_COUNT_PER_PAGE;
        
        $modules->nlsHunterSearchResultsAjax($selectedOptions, $offset, $countPerPage);
        // Don't forget to stop execution afterward.
        wp_die();    
    }

    /**
     * Helper function to write log messages
     */
    public function writeLog($message, $level = 'debug') {
        if (!$this->debug) return;
        
        $logFile = NLS_PLUGIN_PATH . 'logs/default.log';

        $data = date("Ymd") . ' ' . $level . ' ' . $message;
        file_put_contents($logFile, $data, FILE_APPEND);
    }

    public function test_function() {
        $response = ["test" => "TEST SUBMIT FUNCTION"];
        wp_send_json($response);
        wp_die(); 
    }

    /*
     * Return the pager data to the search result module
     */
    public function apply_cv_function() {
        $fileName = isset($_FILES['file']) ? $_FILES['file']['name'] : "";
        if ($_FILES['file']['error']) {
            $response = ['sent' => 0, 'html' => $this->sentError(__('Error on uploading the file', 'NlsHunterApi'))];
            wp_send_json($response);
        }
        $fileExt = pathinfo($fileName)['extension'];
        $tmpFileName = isset($_FILES['file']) ? $_FILES['file']['tmp_name'] : "";
        $jobids = isset($_POST['jobIds']) ? explode(',', $_POST['jobIds']) : [];

        $fields['name'] = ['label' => __('Name', 'NlsHunterApi'), 'value' => isset($_POST['name']) ? $_POST['name'] : ""];
        $fields['id'] = ['label' => __('ID', 'NlsHunterApi'), 'value' => isset($_POST['idnumber']) ? $_POST['idnumber'] : ""];
        //$fields['cell'] = ['label' => __('Cell', 'NlsHunterApi'), 'value' => isset($_POST['cell']) ? $_POST['cell'] : ""];
        //$fields['email'] = ['label' => __('Email', 'NlsHunterApi'), 'value' => isset($_POST['email']) ? $_POST['email'] : ""];
        //$fields['city'] = ['label' => __('City', 'NlsHunterApi'), 'value' => isset($_POST['city']) ? $_POST['city'] : ""];
        //$fields['isCitizenship'] = ['label' => __('Have additional citizenship', 'NlsHunterApi'), 'value' => isset($_POST['is-citizenship']) ? $_POST['is-citizenship'] : ""];
        //$fields['citizenship'] = ['label' => __('Additional citizenship', 'NlsHunterApi'), 'value' => isset($_POST['citizenship']) ? $_POST['citizenship'] : ""];
        //$fields['strongSide'] = ['label' => __('Strong Side', 'NlsHunterApi'), 'value' => isset($_POST['strongSide']) ? $_POST['strongSide'] : ""];
        //$fields['student'] = ['label' => __('Is student', 'NlsHunterApi'), 'value' => isset($_POST['student']) ? $_POST['student'] : ""];
        //$fields['dateDegree'] = ['label' => __('Date of completion', 'NlsHunterApi'), 'value' => isset($_POST['date-degree']) ? $_POST['date-degree'] : ""];
        //$fields['avarage'] = ['label' => __('Avarage', 'NlsHunterApi'), 'value' => isset($_POST['avarage']) ? $_POST['avarage'] : ""];
        //$fields['relative'] = ['label' => __('Have relative', 'NlsHunterApi'), 'value' => isset($_POST['relative']) ? $_POST['relative'] : ""];
        //$fields['relation'] = ['label' => __('Company worker relation', 'NlsHunterApi'), 'value' => isset($_POST['relation']) ? $_POST['relation'] : ""];
        $fields['sid'] = ['label' => __('Supplier Id', 'NlsHunterApi'), 'value' => isset($_POST['sid']) ? $_POST['sid'] : ""];

        $tmpCvFile = null;

        $this->writeLog("JobIds: " . print_r($jobids, true) . ", Fields: " . print_r($fields, true) . ", File Name: $fileName");

        if (strlen($fileName) > 0) {
            $tmpCvFile = $this->getTempFile($fileExt);
            move_uploaded_file( $tmpFileName, $tmpCvFile);
        }
        
        $this->writeLog('tmpCvFile: ' . $tmpCvFile);

        // NCAI Files
        $ncaiFile = $this->createNCAI($fields);


        $sent = 0;

        // Send the email foreach Job
        if (count($jobids) > 0) {
            foreach ($jobids as $jobid) {
                $sent += $this->sendHtmlMail($jobid, [$tmpCvFile, $ncaiFile], $fields) ? 1 : 0;
            }
        } else { // Send General CV 
            $sent += $this->sendHtmlMail(null, $tmpCvFile, $fields, __('CV without a Job', 'NlsHunterApi')) ? 1 : 0;
        }
        
        // Remove the temp file from the Upload directory
        if ($tmpCvFile) unlink($tmpCvFile);
        if ($ncaiFile) unlink($ncaiFile);
        
        $response = ['sent' => $sent, 'html' => ($sent > 0 ? $this->sentSuccess($sent) : $this->sentError())];
        wp_send_json($response);
    }
    
    private function driveFileContent($id, $oauthToken) {
        $getUrl = 'https://www.googleapis.com/drive/v2/files/' . $id . '?alt=media';
        $authHeader = 'Authorization: Bearer ' . $oauthToken;                                
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $data = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        
        return $data;
    }    
    private function getTempFile($fileExt) {
        $tmpFolder = 'cvTempFiles';
        $upload_dir   = wp_upload_dir();

        if ( ! empty( $upload_dir['basedir'] ) ) {
            $cv_dirname = $upload_dir['basedir'].'/'.$tmpFolder;
                if ( ! file_exists( $cv_dirname ) ) {
                wp_mkdir_p( $cv_dirname );
            }
        } 
        if ($fileExt === 'ncai') {
            return $cv_dirname . DIRECTORY_SEPARATOR . 'NlsCvAnalysisInfo.'. $fileExt;
        }
        return $cv_dirname . 'CV_FILE_' . mt_rand(100, 999) . '.' . $fileExt;
    }

    private function createNCAI($fields) {
        //create xml file
        $xml_obj = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" standalone="yes"?><NiloosoftCvAnalysisInfo xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"></NiloosoftCvAnalysisInfo>');

        $applyingPerson = $xml_obj->addChild('ApplyingPerson');
        $applyingPerson->addChild('EntityLocalName', $fields['name']['value']);
        $applyingPerson->addChild('FederalId', $fields['id']['value']);
        //$applyingPerson->addChild('Email', $fields['email']['value']);
        //$applyingPerson->addChild('Phones')->addChild('PhoneInfo')->addChild('PhoneNumber', $fields['cell']['value']);
        $applyingPerson->addChild('SupplierId', $fields['sid']['value']);

        // $CardProfessinalFields = $applyingPerson->addChild('CardProfessinalFields');
        // foreach ($applicant_profession as $profession){
        //     $CardProfessinalField = $CardProfessinalFields->addChild('CardProfessinalField')->addChild('CategoryId', $fields['strongSide']['value']);
        // }                                

        $applicant_notes = __('Applicant form data: ', 'NlsHunterApi')."\r\n";
        foreach($fields as $key => $field) {
            if (empty($field['value'])) continue;
            $applicant_notes .= $field['label'] . ': ' . __($field['value'], 'NlsHunterApi') . "\r\n";
        }

        $xml_obj->addChild('Notes', $applicant_notes);
        $xml_obj->SupplierId = $fields['sid']['value'];
        
        $ncaiFile = $this->getTempFile('ncai');
        $xml_obj->asXML($ncaiFile);
        return $ncaiFile;
    }

    public function sendHtmlMail($jobid, $files, $fields, $msg = '') {
        $to = get_option(NlsHunterApi_Admin::TO_MAIL);
        $fromEmail = get_option(NlsHunterApi_Admin::FROM_MAIL);
        $fromName = get_option(NlsHunterApi_Admin::FROM_NAME);
        $bcc = get_option(NlsHunterApi_Admin::BCC_MAIL);
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'bcc: ' . $bcc
        );
        $subject = __('CV Applied Elbit Jobs Site', 'NlsHunterApi') . ': ';
        $subject .= $jobid ? ( 'Job ID: ' . $jobid ) : $msg;
        
        $attachments = $files ?: [];
        
        $body = render('mailApply', [
            'fields' => $fields
        ]);

        // Add image to the mail
        $file = wp_upload_dir()['basedir'] . '/logo@512.png'; //phpmailer will load this file
        $uid = 'logo@512'; //will map it to this UID
        $name = 'logo@512.png'; //this will be the file name for the attachment

        global $phpmailer;
        add_action( 'phpmailer_init', function(&$phpmailer)use($file,$uid,$name){
            $phpmailer->SMTPKeepAlive = true;
            $phpmailer->AddEmbeddedImage($file, $uid, $name);
        });

        add_filter( 'wp_mail_from', function( $fromEmail ) {
            return get_option(NlsHunterApi_Admin::FROM_MAIL);
        });
        add_filter( 'wp_mail_from_name', function( $fromName ) {
            return get_option(NlsHunterApi_Admin::FROM_NAME);
        });

        $result =  wp_mail($to, $subject, $body, $headers, $attachments);
        $this->writeLog("\nMail Result: $result");

        return $result;
    }
    
    private function sentSuccess($sent) {
        $html = '  <h2>' . __('Send cv', 'NlsHunterApi') . '</h2><br>';
        $html .= ' <p role="alert">' . __('Thenk you for applying, the form submited successfully!', 'NlsHunterApi') . '</p>';
        $html .= ' <a href="#" class="back-step"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>' . __('Back', 'NlsHunterApi') . '  </a>';
        
        return $html;
    }

    private function sentError($msg = '') {
        $html = '  <h2>' . __('Error occured', 'NlsHunterApi') . '</h2><br>';
        $html .= ' <p role="alert">' . __('The cv could not be sent successfully!', 'NlsHunterApi') . '</p>';
        $html .= ' <a href="#" class="back-step"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>' . __('Back', 'NlsHunterApi') . '  </a>';
                
        return $html;
    }

    public function configure_smtp( $phpmailer ){
        $sendgridApiKey = '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';
        
        $phpmailer->isSMTP(); //switch to smtp
        $phpmailer->Host = 'smtp.sendgrid.net';
        //$phpmailer->Host = 'mailsrv01.niloosoft.com';
        $phpmailer->SMTPAuth = true;
        //$phpmailer->Port = 25;
        $phpmailer->Port = 587;
        //$phpmailer->Username = 'idc@hunterhrms.com';
        $phpmailer->Username = 'apikey';
        //$phpmailer->Password = 'Pass2015!';
        $phpmailer->Password = $sendgridApiKey;
        $phpmailer->SMTPSecure = false;
        
    }
}
