<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pagination {

    protected $CI;
    protected $per_page = 10;
    protected $uri_segment = 3;
    protected $total_rows;
    protected $base_url;
    protected $suffix = '';
    protected $first_url;
    protected $cur_page;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('pagination');
    }

    public function initialize($params = array()) {
        foreach ($params as $key => $val) {
            $this->$key = $val;
        }
    }

    public function create_links() {
        $CI =& get_instance();

        // Get the current page number
        $this->cur_page = $CI->uri->segment($this->uri_segment);

        // Ensure page is an integer
        if (!is_null($this->cur_page) && !ctype_digit((string)$this->cur_page)) {
            $this->cur_page = 0;
        }

        // Page number configuration
        $this->cur_page = (int) $this->cur_page;

        // Calculate total pages
        $num_pages = ceil($this->total_rows / $this->per_page);

        // Page numbers range
        $start = (($this->cur_page - 1) / $this->per_page) + 1;
        $end = $start + $this->per_page;

        // Generate the links
        $links = [];
        for ($i = $start; $i <= $end; $i++) {
            $links[] = "<a href='" . $this->base_url . $i . "'>" . $i . "</a>";
        }

        return implode(' ', $links);
    }
}
