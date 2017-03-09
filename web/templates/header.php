<?php
/**
 * Header Template
 *
 * Uses HTML5, but all template HTML is (should be) xHTML 1.1 compatable
 */
class Header{
	private $title = "UM Ldap Search";
	private $scripts = array();
	private $stylesheets = array("");

	/*
	 * The Attributes array. Holds data for the page.
	 */
	private $attributes = array(
		"title"    => "UM Ldap Search",
		"tagline"  => "Ldap Searching FTW",
	);

	/**
	 * Constructor
	 *
	 * @param string $title - the title of the page
	 * @param mixed $scripts - the url (or array of urls) of the script(s) to include
	 * @param mixed $stylesheets - the url (or array of urls) of the stylesheet(s) to include
	 */
	public function __construct($title = null, $scripts = null, $stylesheets = null){
		// Page Title
		if (! empty($title)) $this->title = $title;

		if (! empty($scripts) && is_array($scripts)) $this->scripts = array_merge($scripts, $this->scripts);
		else if (! empty($scripts)) $this->addScript($scripts);

		if (! empty($stylesheets) && is_array($stylesheets)) $this->stylesheets = array_merge($stylesheets, $this->stylesheets);
		else if (! empty($stylesheets)) $this->addStyle($stylesheets);
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function addScript($script){
		if (empty($script) || strncmp($script, '/', 1) !== 0) return false;

		$this->scripts[] = $script;
		return true;
	}

	public function addStyle($stylesheet){
		if (empty($stylesheet) || strncmp($stylesheet, '/', 1) !== 0) return false;

		$this->stylesheets[] = $stylesheet;
		return true;
	}

	public function setAttribute($attribute, $value){
		$this->attributes[$attribute] = $value;
	}

	public function output($return = false){
		global $user;

		// Doctype
		$html  = "<!doctype html>\n";
		$html .= "<html>\n";
		$html .= "\t<head>\n";

		// Page Attributes/Head information
		$html .= "\t\t<title>" . $this->title . "</title>";

		// Stylesheet import
		foreach ($this->stylesheets as $style){
			$html .= "\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"$style\" />\n";
		}

		// Script import
		foreach ($this->scripts as $script){
			$html .= "\t\t<script type=\"text/javascript\" src=\"$script\"></script>\n";
		}

		// Set viewport to device width
		echo "\t\t<meta name=\"viewport\" content=\"width=device-width\" />\n";

		// Start Body of the page
		$html .= "\t</head>\n";
		$html .= "\t<body>\n";

		// Page layout
		$html .= "\t\t<div id=\"container\">\n";

		if($return === true) return $html;
		echo $html;
	}
}
