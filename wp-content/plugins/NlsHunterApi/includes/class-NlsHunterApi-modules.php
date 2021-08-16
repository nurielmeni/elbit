<?php
require_once 'Hunter/NlsHelper.php';
require_once ABSPATH . 'wp-content/plugins/NlsHunterApi/renderFunction.php';

/**
 * Description of class-NlsHunterApi-modules
 *
 * @author nurielmeni
 */
class NlsHunterApi_modules {
     const NlS_SEARCH_TOKEN = 'nlsSearchTokenId';
     const NLS_SEARCH_COUNT_PER_PAGE_HOTJOBS = 6;
     
     private $model;
     
     public function __construct($model) {
         $this->model = $model;
     }

     
    /**
     * Handler for Locations shortcode
     */
    public function nlsHunterLocations($attrs = []) {
        ob_start();
            $max = is_array($attrs) && key_exists('max', $attrs) ? $attrs['max'] : -1;

            $args = [
                'numberposts'   => $max, 
                'category_name' => 'locations',
                'orderby'       => 'date',
                'order'         => 'ASC',
            ];
            
            $locations = get_posts( $args );

            include_once plugin_dir_path( __FILE__ ). '../public/partials/locations.php';

        return ob_get_clean();
    }

    /**
     * Handler for personal area shortcode
     */
    public function nlsHunterPersonalArea() {
        ob_start();

            $personalItems = [
                [
                    'url' => '#',
                    'title' => __('Submited Jobs', 'NlsHunterApi'),
                    'value' => 2
                ],
                [
                    'url' => '#',
                    'title' => __('CVs', 'NlsHunterApi'),
                    'value' => 1
                ],
                [
                    'url' => '#',
                    'title' => __('Additional Files', 'NlsHunterApi'),
                    'value' => 0
                ],
                [
                    'url' => '#',
                    'title' => __('New Jobs', 'NlsHunterApi'),
                    'subtitle' => __('Found by the smart agent', 'NlsHunterApi'), 
                    'value' => 3
                ],               
            ];
            
            include_once plugin_dir_path( __FILE__ ). '../public/partials/personalArea.php';

        return ob_get_clean();
    }   
    
    
    /**
     * Handler for slider people shortcode
     */
    public function nlsHunterCategoryGalery() {
        $categories = ['col-practice-1', 'col-practice-2', 'col-practice-3', 'col-practice-4'];
        $searchResultsUrl = $this->model->getPageUrl(NlsHunterApi_Admin::NLS_SEARCH_RESULTS_PAGE);
        
        ob_start();

        include_once plugin_dir_path( __FILE__ ). '../public/partials/categoryGaleryStart.php';
        
        foreach ($categories as $category) {
            
            $args = [
                'numberposts'   => -1, 
                'category_name' => $category,
                'orderby'       => 'date',
                'order'         => 'ASC',
            ];
            
            $categoryItems = get_posts( $args );
            
            // column wrapper
            echo '<div class="col-practice ' . $category . '">';
            
            // render each column item
            foreach ($categoryItems as $categoryItem) {
                $image = get_the_post_thumbnail_url($categoryItem->ID);
                echo render('category-item', [
                    'categoryItem' => $categoryItem,
                    'searchResultsUrl' => $searchResultsUrl,
                    'image' => $image,
                ]);
            }
            
            echo '</div>';
        }
        
        include_once plugin_dir_path( __FILE__ ). '../public/partials/categoryGaleryEnd.php';

        return ob_get_clean();
    }

    /**
     * Handler for slider people shortcode
     */
    public function nlsHunterSliderPeople() {
        
        $args = [
            'numberposts' => -1, 
            'category_name' => 'slider-people',
        ];

        $peoples = get_posts( $args );

        ob_start();

        include_once plugin_dir_path( __FILE__ ). '../public/partials/sliderPeopleStart.php';

        // render each people item
        foreach ($peoples as $people) {
            $image = get_the_post_thumbnail_url($people->ID);
            echo render('sliderPeople', [
                'people' => $people,
                'image' => $image,
            ]);
        }

        include_once plugin_dir_path( __FILE__ ). '../public/partials/sliderPeopleEnd.php';

        return ob_get_clean();
    }

    /**
     * Handler for the Search Slug
     */
    public function nlsHunterSearch() {
        

        //The next line is used to flush authentication
        //update_option(NlsService::AUTH_KEY, null);
                 
        // Look to see if the search page was submited and get options
        $search = $this->model->getSearchOptions();
        
        //$professionalFields = $this->model->get_professional_fields();
        //$areas = $this->model->get_areas();
        //$jobTypes = $this->model->get_jobTypes();
        // Custom select student/the rest
        //$experties = $this->model->get_experties();
        //$myStrongSide = $this->model->get_professional_fields();
        
        // Get the url for the search result page, if not provided show error
        $searchResultsUrl = $this->model->getPageUrl(NlsHunterApi_Admin::NLS_SEARCH_RESULTS_PAGE);

        // Set message to user, no search result page was found
        if (!$searchResultsUrl) {
            $message = __('Search Results page was not provided (Hunter Plugin Admin).', 'NlsHunterApi');
            $subject = __('Missing Settings', 'NlsHunterApi');
            echo NlsHelper::addFlash($message, $subject);
        }
        
        /*
         *  Display The Search Form
         *  Required Variables: 
         *      $searchResultsUrl   
         *      $professionalFields
         *      $areas
         *      $jobTypes
         */
        ob_start();

        include_once plugin_dir_path( __FILE__ ). '../public/partials/searchForm.php';
        //include_once plugin_dir_path( __FILE__ ). '../public/partials/applyForJobs.php';

        return ob_get_clean();
    }

    // Search Results Slug
    public function nlsHunterSearchResults() {
        $search = $this->model->getSearchOptions();
        $id = is_array($search) && 
            key_exists('professionalFields', $search) && 
            is_array($search['professionalFields']) &&
            count($search['professionalFields']) > 0 ? 
            intval($search['professionalFields']['0']) : 
            0;
        
        $professionalFields = $id > 0 ? $this->model->get_professional_fields() : null;
        
        $searchResultsTitle = $id > 0 && key_exists($id, $professionalFields) ? 
            $professionalFields[$id] : 
            __('Search Results', 'NlsHunterApi');

        // Temporarily down untill personal arae is in
        $professionalFields = null;

        $jobs = $this->model->getNlsHunterSearchResults();

        $supplierId = $this->model->get_supplierId();

        // Set the initial offset for the pager        
        $offset = $this->model->getPagerOffset();

        $areas = $this->model->get_areas();

        $searchPageUrl = $this->model->getPageUrl(NlsHunterApi_Admin::NLS_SEARCH_PAGE);
        $jobDetailsPageUrl = $this->model->getPageUrl(NlsHunterApi_Admin::NLS_JOB_DETAILS_PAGE);
        $searchResultsUrl = $this->model->getPageUrl(NlsHunterApi_Admin::NLS_SEARCH_RESULTS_PAGE);
        $isMobile = NlsHelper::isMobile();
        
        ob_start();

        echo '<div class="container ' . ($isMobile ? ' mobile' : '') . '">';
            echo '<div class="searc-results-wrapper">';
                include_once plugin_dir_path( __FILE__ ). '../public/partials/searchResults.php';
            echo '</div>';
        echo '</div>';

        include_once plugin_dir_path( __FILE__ ). '../public/partials/popup.php';

        return ob_get_clean();
    }

    // Job details slug
    public function nlsHunterJobDetails() {
        // Getting the job details that were gotten on plugin init
        // Done to set the meta tags
        $referer = wp_get_referer();
        $searchResultsUrl = $this->model->getPageUrl(NlsHunterApi_Admin::NLS_SEARCH_RESULTS_PAGE);
        $jobDetailsPageUrl = $this->model->getPageUrl(NlsHunterApi_Admin::NLS_JOB_DETAILS_PAGE);

        $referer = strpos($referer, $searchResultsUrl) !== false ? $referer : home_url();

        $jobDetailsPage = get_post(get_option(NlsHunterApi_Admin::NLS_JOB_DETAILS_PAGE));
        $bannerImage = $jobDetailsPage ? get_the_post_thumbnail_url($jobDetailsPage->ID) : '';
         
        $jobDetails = $this->model->get_jobDetails();
        $jobResult = $jobDetails['jobResult'];
        $jobCode = $jobDetails['JobCode'];
        $job = count($jobResult) > 0 ? $jobResult[$jobCode] : [];
        $supplierId = $this->model->get_supplierId();
        
        ob_start();

        if ($jobDetails) {
            include_once plugin_dir_path( __FILE__ ). '../public/partials/jobDetails.php';
            include_once plugin_dir_path( __FILE__ ). '../public/partials/popup.php';            
        }

        return ob_get_clean();
    }

    public function nlsHunterHotJobs() {
        

        // Get the first 6 hotjobs, By the hot Jobs supplier Id
        $hotjobs = $this->model->getHotJobs();
        
        $jobDetailsPageUrl = $this->getPageUrl(NlsHunterApi_Admin::NLS_JOB_DETAILS_PAGE);

        /*
         *  Display The Hot Jobs module
         *  Required Variables: 
         *      $hotjobs  
         *      $jobDetailsPageUrl
         */
        ob_start();

        include_once plugin_dir_path( __FILE__ ). '../public/partials/hotJobs.php';
        include_once plugin_dir_path( __FILE__ ). '../public/partials/applyForJobs.php';

        return ob_get_clean();
    }
    
    public function nlsHunterSocial() {
        $nlsSocialIn = get_option(NlsHunterApi_Admin::NLS_SOCIAL_IN);
        $nlsSocialFace = get_option(NlsHunterApi_Admin::NLS_SOCIAL_FACE);
        $nlsSocialInsta = get_option(NlsHunterApi_Admin::NLS_SOCIAL_INSTA);
        $nlsSocialWeb = get_option(NlsHunterApi_Admin::NLS_SOCIAL_WEB);
        $nlsSocialMailTo = get_option(NlsHunterApi_Admin::NLS_SOCIAL_MAIL_TO);
        
        /*
         *  Display The Social Media module
         *  Required Variables: 
         *      $nlsSocialIn  
         *      $nlsSocialFace
         *      $nlsSocialMailTo
         */
        ob_start();

        include plugin_dir_path( __FILE__ ). '../public/partials/socialMedia.php';

        return ob_get_clean();
    }
}
