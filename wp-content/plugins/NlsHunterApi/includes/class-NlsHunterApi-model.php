<?php
require_once 'Hunter/NlsCards.php';
require_once 'Hunter/NlsSecurity.php';
require_once 'Hunter/NlsDirectory.php';
require_once 'Hunter/NlsSearch.php';
require_once 'Hunter/NlsHelper.php';
/**
 * Description of class-NlsHunterApi-modules
 *
 * @author nurielmeni
 */
class NlsHunterApi_model {
    const NlS_SEARCH_TOKEN = 'nlsSearchTokenId';
    const NLS_SEARCH_COUNT_PER_PAGE = 10;
    const NLS_SEARCH_COUNT_PER_PAGE_HOTJOBS = 6;
    
    private $nlsSecutity;
    private $auth;
    private $nlsCards;
    private $nlsDirectory;
    private $supplierId;

    private $areas;
    private $professionalFields;
    private $jobTypes;
    private $experties;
    private $myStrongSide;
    private $cities;

    private $searchOptions;

    private $searchResultJobs;
    private $jobDetails;
    private $hotJobs;

    private $pagerPage = 1;
    private $isLastPage = false;

    public function __construct() {
        $this->nlsSecutity = new NlsSecurity();
        $this->auth = $this->nlsSecutity->isAuth();

        $this->supplierId = key_exists('sid', $_GET) ? $_GET['sid'] : get_option(NlsHunterApi_Admin::NSOFT_SUPPLIER_ID);
        $this->pagerPage = key_exists('pager-page', $_GET) && $_GET['pager-page'] > 1 ? $_GET['pager-page'] : 1;
        
        if (!$this->auth) {
            $username = get_option(NlsHunterApi_Admin::NLS_SECURITY_USERNAME);
            $password = get_option(NlsHunterApi_Admin::NLS_SECURITY_PASSWORD);
            $this->auth = $this->nlsSecutity->authenticate($username, $password);
            
            // Check if Auth is OK and convert to object
            $this->auth = $this->nlsSecutity->isAuth();        
        }
        
        // Load all the select options for the module
        $this->loadSelectOptions();
    }
    
    public function getCities() {
        if (isset($this->cities) && is_array($this->cities)) return $this->cities;
        $citiesList = $this->nlsDirectory->getListByName('Cities');
        
        return is_array($citiesList) && count($citiesList) > 0 && key_exists('id', $citiesList[0]) && key_exists('name', $citiesList[0]) ?
                $this->listToAssociative($citiesList) : [];
    }

    private function getCityNameById($cityId) {
        if (!$cityId) return '';
        $cities = $this->getCities();
        return key_exists($cityId, $cities) ? $cities[$cityId] : '';
    }

    private function addLastApplicationDate(&$jobs) {
        foreach ($jobs as &$job) {
            $jobDetails = $this->nlsCards->jobGetConsideringIsDiscreetFiled($job['jobId']);
            $lastApplyDate = NlsHelper::getExtendedProperty($jobDetails->ExtendedProperties, 'LAST DATE');
            if (!empty($lastApplyDate)) {
                $job['lastApplyDate'] = $lastApplyDate;
            }
        }
    }

    private function addCity(&$jobs) {
        foreach ($jobs as &$job) {
            $jobDetails = $this->nlsCards->jobGetConsideringIsDiscreetFiled($job['jobId']);
            $cityId = NlsHelper::getExtendedProperty($jobDetails->ExtendedProperties, 'Cities');
            $job['cityName'] = $this->getCityNameById($cityId);
        }
    }

    public function getPagerUrl($next = true) {
        $url = $this->getPageUrl(NlsHunterApi_Admin::NLS_SEARCH_RESULTS_PAGE);

        $params['pager-page'] = $this->getPagerPage($next ? 1 : -1);
        foreach ($this->searchOptions as $param => $value) {
            if (empty($value)) continue;

            $params[$param] = $value;
        }

        $query = http_build_query($params);

        return $url . '?' . $query;
    }

    public function getPagerOffset() {
        return (intval($this->pagerPage) - 1) * intval(get_option(NlsHunterApi_Admin::NLS_PAGER_PER_PAGE));
    }

    /**
     * @param mod 0 - current 1 - next -1 prev
     */
    public function getPagerPage($mod = 0) {
        if ($mod < -1 || $mod > 1 || ($this->pagerPage === 1 && $mod === -1)) {
            return $this->pagerPage;
        }
        return $this->pagerPage + $mod;
    }

    /**
     * Init cards service
     */
    public function initCardService() {
        if ($this->auth && !$this->nlsCards) {
            $this->nlsCards = new NlsCards([
                'auth' => $this->auth,
            ]);
        }
    }

    /**
     * Init directory service
     */
    public function initDirectoryService() {
        if ($this->auth && !$this->nlsDirectory) {
            $this->nlsDirectory = new NlsDirectory([
                'auth' => $this->auth
            ]);
        }
    }

    /**
     * Init search service
     */
    public function initSearchService() {
        if ($this->auth && !$this->nlsSearch) {
            $this->nlsSearch = new NlsSearch([
                'auth' => $this->auth,
            ]);
        }
    }

    /**
     * Return associative array of list
     * @param noKey boolean, if true make the key the same as the value
     */
    private function listToAssociative($list, $noKey = false) {
        $arr = [];
        if ($noKey) {
            foreach ($list as $listItem) {
                if (key_exists('name', $listItem)) {
                    $arr[$listItem['name']] = $listItem['name'];
                }
            }
        } else {
            foreach ($list as $listItem) {
                if (key_exists('id', $listItem) && key_exists('name', $listItem)) {
                    $arr[$listItem['id']] = $listItem['name'];
                }
            }
        }
        return $arr;
    }

    /**
     * Return custom associative array of list
     */
    private function listToCustomAssociative($list) {
        $arr = [];
        foreach ($list as $listItem) {
            if (key_exists('id', $listItem) && key_exists('name', $listItem) && $listItem['name'] === 'סטודנט') {
                $arr[$listItem['id']] = $listItem['name'];
            }
        }
        $arr[0] = 'משרה מלאה';
        return $arr;
    }

    /**
     * Gets The Search options from request if no search options set new key for search form
     * @return array the search parameters that were gotten from GET/POST
     */
    public function getSearchOptions() {
        if ($this->searchOptions && is_array($this->searchOptions)) return $this->searchOptions;

        $search = [];
        if ($this->getField('professionalFields')) $search['professionalFields'] = $this->getField('professionalFields');
        if ($this->getField('areas')) $search['areas'] = $this->getField('areas');
        if ($this->getField('jobTypes')) $search['jobTypes'] = $this->getField('jobTypes');
        if ($this->getField('experties')) $search['experties'] = $this->getField('experties');
        $search['keywords'] = $this->getField('keywords', '');

        $this->searchOptions = $search;
        return $this->searchOptions;
    }

    private function getField($field, $default = null) {
        if (isset($_POST[$field])) return $_POST[$field];
        if (isset($_GET[$field])) return $_GET[$field];
        return $default;
    }
        
    public function getPageUrl($page) {
        // Get the url for the search result page, if not provided show error
        $pageUrl = get_permalink(get_option($page));
        
        // Set message to user, no search result page was found
        if (!$pageUrl) {
            $message = __('Page was not provided (Hunter Plugin Admin) - ' , 'NlsHunterApi') . $page;
            $subject = __('Missing Settings', 'NlsHunterApi');
            
            $this->addErrorToPage($message, $subject);
            wp_die($message, $subject);
        }

        return $pageUrl;
    }
    
    /**
     * Handler for the Search Slug
     */
    public function loadSelectOptions() {
        $this->initDirectoryService();

        // if no directory empty form
        if ( $this->nlsDirectory ) {
            $this->professionalFields = $this->nlsDirectory->getCategories();
            $this->areas = $this->nlsDirectory->getlistbyname('Regions');
        } else {
            $this->addErrorToPage(
                __('Could not connect to Hunter Directory Services', 'NlsHunterApi'), 
                __('Authentication Error', 'NlsHunterApi')
            );
            $this->professionalFields = [];
            $this->areas = [];
        }       
    }

    private function makeListIdEqualName($options) {
        $res = [];
        foreach($options as $option) {
            $res[$option['name']] = $option['name'];
        }
        return $res;
    }

    public function getNlsHunterSearchResults() {
        // Look to see if the search page was submited and get options
        $search = $this->getSearchOptions();
        if ($search) {
            $jobs = $this->nlsCards->jobsGetByFilter([
                'keywords' => key_exists('keywords', $search) ? $search['keywords'] : '',
                'categoryId' => is_array($search) && key_exists('professionalFields', $search) ? $search['professionalFields'] : [],
                'regionValue' => is_array($search) && key_exists('areas', $search) ? $search['areas'] : [],
                'supplierId' => self::get_supplierId(),
                'lastId' => $this->getPagerOffset(),
                'countPerPage' => get_option(NlsHunterApi_Admin::NLS_PAGER_PER_PAGE) * 2,
                'sendToAgent' => false
            ]);

            $this->isLastPage = !(count($jobs) > get_option(NlsHunterApi_Admin::NLS_PAGER_PER_PAGE));
            
            $this->searchResultJobs = array_slice($jobs, 0, 9);
            //$this->addLastApplicationDate($this->searchResultJobs);
            $this->addCity($this->searchResultJobs);

            return $this->searchResultJobs;
        }
        
        $this->searchResultJobs = [];
        return $this->searchResultJobs;
    }    
       
    public function getJobDescriptions(&$jobs) {
        foreach ($jobs as &$job) {
            $jobDetails = $this->nlsCards->jobGetConsideringIsDiscreetFiled($job['jobId']);
            $job['description'] = $jobDetails->Description;
            unset($job);
        }
    }
    
    public function nlsHunterSearchResultsAjax($selectedOptions, $offset, $countPerPage) {
        if (!$this->nlsCards) return;
        $jobs = $this->nlsCards->jobsGetByFilter([
            'keywords' => is_array($selectedOptions) && key_exists('keywords', $selectedOptions) ? $selectedOptions['keywords'] : [],
            'categoryId' => is_array($selectedOptions) && key_exists('professionalFields', $selectedOptions) ? $selectedOptions['professionalFields'] : [],
            'regionId' => is_array($selectedOptions) && key_exists('areas', $selectedOptions) ? $selectedOptions['areas'] : [],
            'supplierId' => self::get_supplierId(),
            'lastId' => $offset,
            'countPerPage' => get_option(NlsHunterApi_Admin::NLS_PAGER_PER_PAGE),
            'sendToAgent' => false
        ]);
        
        /*
         *  Display The Search Results
         *  Required Variables: 
         *      $jobs: name, jobid, jobCode, date, address  
         *      $jobDetailsPageUrl
         */
        $jobDetailsPageUrl = $this->getPageUrl(NlsHunterApi_Admin::NLS_JOB_DETAILS_PAGE);
        include_once plugin_dir_path( __FILE__ ). '../public/partials/searchResults.php';
    }
    
    /*
     * Returns the pager button properties
     * offset property for the pager offset
     * disabled if no more next or prev
     */
    public function getPagerData($jobs, $offset = 0, $next = true, $class='') {
        $count = count($jobs);
        if ($next) {
            $prop = ' offset="' . ($offset + $count) . '"';
            $prop .= ' class="next ' . $class;
            $prop .= $this->isLastPage ? ' disabled"' : ' enabled"';
        } else {
            $prop = ' offset="' . ($offset < $count ? 0 : $offset - ($count < self::NLS_SEARCH_COUNT_PER_PAGE ? self::NLS_SEARCH_COUNT_PER_PAGE : $count)) . '"';
            $prop .= ' class="prev ' . $class;
            $prop .= $offset < $count || $count == 0 ? ' disabled"' : ' enabled"';
        }
        return  $prop;
    }

    public function searchJobByJobCode($jobCode) {
        return $this->nlsCards->searchJobByJobCode($jobCode);
    }    

    // This function is called when the plugin instance is created and the page requested is job details
    // so the meta tags can be updated, it can be called also to get details.
    public function getNlsHunterJobDetails() {
        if (!$this->nlsCards || !$this->nlsDirectory) return;
        $jobcode = key_exists('jobcode', $_GET) ? $_GET['jobcode'] : null;
        $supplierId = $this->get_supplierId();
        
        if (!$jobcode || empty($jobcode)) {
            $this->addErrorToPage(
                __('Job Code is missing (or not found).', 'NlsHunterApi'), 
                __('Could not display Job Details', 'NlsHunterApi')
            );
            return;
        } 
        try {
            $jobResult = $this->nlsCards->searchJobByJobCode($jobcode);
            $jobDetails = (array)$this->nlsCards->jobGetConsideringIsDiscreetFiled($jobResult[$jobcode]['jobId']);
        } catch (Exception $ex) {
            $this->addErrorToPage(
                __('Job Code is missing (or not found).', 'NlsHunterApi'), 
                __('Could not display Job Details', 'NlsHunterApi')
            );
            return null;
        }
        //if ($jobDetails['RegionId']) {
        //    $jobDetails['Region'] = $this->nlsDirectory->getListItemById('Regions', $jobDetails->RegionId);
        //}

        $jobDetails['supplierId'] = $supplierId;
        $cityId = NlsHelper::getExtendedProperty($jobDetails['ExtendedProperties'], 'Cities');
        $jobResult[$jobcode]['cityName'] = $this->getCityNameById($cityId);
        $jobDetails['jobResult'] = $jobResult;

        $this->jobDetails = $jobDetails;
        return $this->jobDetails;
    }

    private function addErrorToPage($message, $subject) {
        add_action('the_post', function() use ($message, $subject) {
            echo NlsHelper::addFlash(
                $message, 
                $subject,
                'error'
            );
        });
    }

    public function nlsHunterHotJobs() {
        if (!$this->nlsCards) return;
        
        // Get the first 6 hotjobs, By the hot Jobs supplier Id
        $hotjobs = $this->nlsCards->jobsGetByFilter([
            ['supplierId'] => get_option(NlsHunterApi_Admin::NSOFT_HOT_JOBS_ID),
            ['lastId'] => 0,
            ['countPerPage'] => get_option(NlsHunterApi_Admin::NLS_PAGER_PER_PAGE),
        ]);
        
        $this->hotjobs = $hotjobs ?: [];
        return $this->hotjobs;
    }
    
	/**
	 * Retrieve the areas.
	 *
	 * @since     1.0.0
	 * @return    array    jobDetails.
	 */
	public function get_jobDetails() {
		return $this->jobDetails;
	}

	/**
	 * Retrieve the areas.
	 *
	 * @since     1.0.0
	 * @return    array    searchResultJobs.
	 */
	public function get_searchResultJobs() {
		return $this->searchResultJobs;
	}

	/**
	 * Retrieve the areas.
	 *
	 * @since     1.0.0
	 * @return    array    hotJobs.
	 */
	public function get_hotJobs() {
		return $this->hotJobs;
	}

	/**
	 * Retrieve the areas.
	 *
	 * @since     1.0.0
	 * @return    array    areas.
	 */
	public function get_areas($noKey = false) {
        if (!is_array($this->areas)) return [];
		return $this->listToAssociative($this->areas, $noKey);
	}

	/**
	 * Retrieve the professional fields.
	 *
	 * @since     1.0.0
	 * @return    array    The professional fields.
	 */
	public function get_professional_fields($noKey = false) {
        if (!is_array($this->professionalFields)) return [];
		return $this->listToAssociative($this->professionalFields, $noKey);
	}

	/**
	 * Retrieve the categories.
	 *
	 * @since     1.0.0
	 * @return    array    The jobTypes.
	 */
	public function get_jobTypes($noKey = false) {
        if (!is_array($this->jobTypes)) return [];
		return $this->listToAssociative($this->jobTypes, $noKey);
	}

	/**
	 * Retrieve the my strong side.
	 *
	 * @since     1.0.0
	 * @return    array    The Job details for the current job ID.
	 */
	public function get_my_strong_side() {
        if (!is_array($this->myStrongSide)) return [];
		return $this->myStrongSide;
	}

	/**
	 * Retrieve the experties.
	 *
	 * @since     1.0.0
	 * @return    array    The Job experties.
	 */
	public function get_experties() {
        // This is from service/custom experties
        if (!is_array($this->experties)) return [];
        return $this->listToAssociative($this->experties);
	}

	/**
	 * Retrieve the experties.
	 *
	 * @since     1.0.0
	 * @return    array    The Job experties.
	 */
	public function get_supplierId() {
		return $this->supplierId;
	}

}
