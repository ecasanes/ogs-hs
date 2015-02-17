<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	# @authour : Abella, Demby Genesis M.
	# @description : A pagination class to specifically display the results of the boardpassers.
	
	class Pagination 
	{
		public $row_limit = '';
		public $page_limit = '';
		public $row_count = '';
		public $current_page = '';
		public $query_results = '';
		public $derived_section = '';
		public $derived_offset = '';

		function __construct($row_limit, $page_limit, $current_page)
		{
			// Set data.
			$this->row_limit = $row_limit;
			$this->page_limit = $page_limit;
			$this->current_page = $current_page;

			// Clean paramters.
			if( ! is_numeric(trim($this->current_page)) || trim($this->current_page  < 1))
			{
				$this->current_page = 1;
			}	

			$this->set_derived_values();
		}

		function get_query_count($row_count)
		{
			$this->row_count = $row_count;
		}

		// This function displays the links below.
		function set_derived_values()
		{
			// Identify the offset section.
			$page_offset = $this->current_page * $this->row_limit;
			
			// Identify the section basing on the page offset.
			$section = 0;
			$offset_count = 0;

			// Untill the page offset is less than the page offset count.
			while( $page_offset > $offset_count )
			{
				// Get total offset per page.
				$offset_count = $offset_count + ($this->row_limit * $this->page_limit);
				
				// Iterate section every loop.
				$section++;
			}

			$this->derived_offset = $page_offset;
			$this->derived_section = $section;

			# security checks.
			if($this->derived_section < 1)
			{
				$this->derived_section = 1;
			}
		}

		// @description : This function returns the offset value given the page number. It either returns a valid offset or an invalid page number.
		function get_offset($page)
		{
			$offset = ($page  - 1) * $this->row_limit;
			return $offset;
		}

		function get_uri()
		{
			$uri = '';

			if(strpos($_SERVER['REQUEST_URI'], '?'))
			{
				$uri = $_SERVER['REQUEST_URI'];
				$uri = explode('?', $uri);
				$uri = $uri[1];
			}
			
			return $uri;
		}

		function get_page_link($uri, $page_number)
		{
			// check if there is a page set in the uri.
			if( strpos($uri, 'page') )
			{
				// if there is, we erase it to have a new one replace it.
				// Regular expression removes page and the corresponding number assigned to it.
				$uri = preg_replace('/&(page\=[0-9]*)/', '', $uri);
			}

			// Add new page number to the uri.
			$uri .= "&page=$page_number";

			// Return new URI.
			return $uri;
		}

		function generate_pagination_links()
		{
			// Determine the start of the section.
			$section_start = ($this->derived_section * $this->page_limit) - $this->page_limit + 1; 
	
			$html_data = '';

			$html_data .= '<div class="text-center" id="paginated-links">';
			$html_data .= '<ul class="pagination pagination-centered">';

			/* Previous Page. */
			if(isset($this->row_count))
			{
				if($this->current_page > 1)
				{
					$uri = $this->get_page_link($this->get_uri(), $this->current_page - 1);
					$uri = htmlentities($uri);
					$back_page = $this->current_page - 1;
					// print("<li><a data-page-number=\"$back_page\"> &laquo; </a></li>");
					$html_data .= "<li><a data-page-number=\"$back_page\"> &laquo; </a></li>";
				}
			}

			for( $i = $section_start; $i < ($section_start + $this->page_limit); $i++ )
			{
				$current = $i;
				
				// Check if the succeeding offset does not exceed the number of rows.
				if( !  ( ($this->get_offset($i)) >= $this->row_count ) )
				{
					// Assign page uri.
					$uri = $this->get_page_link($this->get_uri(), $i);
					$uri = htmlentities($uri);
					// Assign current page.
					if($current == $this->current_page)
					{
						// print("<li class=\"active\"><a data-page-number=\"$current\"> $current </a></li>");	
						$html_data .= "<li class=\"active\"><a data-page-number=\"$current\"> $current </a></li>";
					}
					else 
					{
						// print("<li><a data-page-number=\"$current\"> $current </a></li>");	
						$html_data .= "<li class=\"active\"><a data-page-number=\"$current\"> $current </a></li>";
					}
				}
				else 
				{	
					break;
				}
			}

			/* Next Page. */
			if( ($this->row_limit * $this->current_page) < $this->row_count  )
			{
				$uri = $this->get_page_link($this->get_uri(), $this->current_page + 1);
				$uri = htmlentities($uri);
				$forward_page = $this->current_page + 1;

				// print("<li><a data-page-number=\"$forward_page\"> &raquo; </a></li>");
				$html_data .= "<li><a data-page-number=\"$forward_page\"> &raquo; </a></li>";
			}

			$html_data .= '</ul>';
			$html_data .= '</div>';

			return $html_data;
		}

		function display_paginated_links()
		{
			// Determine the start of the section.
			$section_start = ($this->derived_section * $this->page_limit) - $this->page_limit + 1; 
	
			/* Previous Page. */
			if(isset($this->row_count))
			{
				if($this->current_page > 1)
				{
					$uri = $this->get_page_link($this->get_uri(), $this->current_page - 1);
					$uri = htmlentities($uri);
					$back_page = $this->current_page - 1;
					print("<li><a data-page-number=\"$back_page\"> &laquo; </a></li>");
				}
			}

			for( $i = $section_start; $i < ($section_start + $this->page_limit); $i++ )
			{
				$current = $i;
				
				// Check if the succeeding offset does not exceed the number of rows.
				if( !  ( ($this->get_offset($i)) >= $this->row_count ) )
				{
					// Assign page uri.
					$uri = $this->get_page_link($this->get_uri(), $i);
					$uri = htmlentities($uri);
					// Assign current page.
					if($current == $this->current_page)
					{
						print("<li class=\"active\"><a data-page-number=\"$current\"> $current </a></li>");	
					}
					else 
					{
						print("<li><a data-page-number=\"$current\"> $current </a></li>");	
					}
				}
				else 
				{	
					break;
				}
			}

			/* Next Page. */
			if( ($this->row_limit * $this->current_page) < $this->row_count  )
			{
				$uri = $this->get_page_link($this->get_uri(), $this->current_page + 1);
				$uri = htmlentities($uri);
				$forward_page = $this->current_page + 1;

				print("<li><a data-page-number=\"$forward_page\"> &raquo; </a></li>");
			}
		}
	}
?>